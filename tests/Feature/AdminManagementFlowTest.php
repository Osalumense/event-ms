<?php

namespace Tests\Feature;

use App\Models\Accounts;
use App\Models\Attendees;
use App\Models\Events;
use App\Models\Tickets;
use App\Models\User;
use Database\Seeders\CreateAdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminManagementFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(CreateAdminSeeder::class);
    }

    public function test_super_admin_login_redirects_to_admin_dashboard(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@ems.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin');
    }

    public function test_organizer_login_redirects_to_organizer_dashboard(): void
    {
        $response = $this->post('/login', [
            'email' => 'user@ems.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard');
    }

    public function test_super_admin_can_view_admin_overview_with_platform_metrics(): void
    {
        $this->createSampleEventData();

        $response = $this->actingAs($this->superAdmin())->get('/admin');

        $response->assertOk();
        $response->assertSee('Platform overview');
        $response->assertSee('Builders Summit Demo');
        $response->assertSee('Platform Owner');
    }

    public function test_super_admin_can_create_update_and_delete_a_user(): void
    {
        $createResponse = $this->actingAs($this->superAdmin())->post('/admin/users/add', [
            'email' => 'new.organizer@example.com',
            'first_name' => 'New',
            'last_name' => 'Organizer',
            'mobile_number' => '1234567890',
            'gender' => '10',
            'user_type' => '10',
            'is_active' => '1',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $createResponse->assertRedirect('/admin/users');

        $user = User::where('email', 'new.organizer@example.com')->firstOrFail();

        $this->assertDatabaseHas('accounts', [
            'id' => $user->account_id,
            'email' => 'new.organizer@example.com',
        ]);

        $updateResponse = $this->actingAs($this->superAdmin())->post('/admin/users/update', [
            'id' => $user->id,
            'email' => 'updated.organizer@example.com',
            'first_name' => 'Updated',
            'last_name' => 'Organizer',
            'mobile_number' => '5550001234',
            'gender' => '20',
            'user_type' => '10',
            'is_active' => '0',
            'password' => 'newsecret123',
            'password_confirmation' => 'newsecret123',
        ]);

        $updateResponse->assertRedirect('/admin/users');

        $user->refresh();

        $this->assertSame('updated.organizer@example.com', $user->email);
        $this->assertSame('Updated', $user->first_name);
        $this->assertSame('0', (string) $user->is_active);
        $this->assertTrue(Hash::check('newsecret123', $user->password));

        $deleteResponse = $this->actingAs($this->superAdmin())->delete('/admin/users/delete/' . $user->id);

        $deleteResponse->assertRedirect('/admin/users');
        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }

    public function test_super_admin_can_review_event_and_attendee_pages(): void
    {
        $this->createSampleEventData();

        $eventsResponse = $this->actingAs($this->superAdmin())->get('/admin/events');
        $eventsResponse->assertOk();
        $eventsResponse->assertSee('Builders Summit Demo');
        $eventsResponse->assertSee('Platform Owner');

        $attendeesResponse = $this->actingAs($this->superAdmin())->get('/admin/attendees');
        $attendeesResponse->assertOk();
        $attendeesResponse->assertSee('Grace Hopper');
        $attendeesResponse->assertSee('VIP Pass');
    }

    private function superAdmin(): User
    {
        return User::where('email', 'admin@ems.com')->firstOrFail();
    }

    private function organizer(): User
    {
        return User::where('email', 'user@ems.com')->firstOrFail();
    }

    private function createSampleEventData(): void
    {
        $organizer = $this->organizer();

        $account = Accounts::findOrFail($organizer->account_id);
        $account->first_name = 'Platform';
        $account->last_name = 'Owner';
        $account->save();

        $organizer->first_name = 'Platform';
        $organizer->last_name = 'Owner';
        $organizer->save();

        $event = new Events();
        $event->forceFill([
            'title' => 'Builders Summit Demo',
            'slug' => 'builders-summit-demo',
            'description' => 'A sample admin event.',
            'start_date' => '2030-06-14 09:00:00',
            'end_date' => '2030-06-14 18:00:00',
            'account_id' => $organizer->account_id,
            'user_id' => $organizer->id,
            'location_address' => 'Grand Hall',
            'location_address_line_1' => '15 Rue des Startups',
            'location_address_line_2' => 'Level 3',
            'location_state' => 'Paris',
            'location_post_code' => '75010',
            'is_active' => 1,
        ]);
        $event->save();

        $ticket = Tickets::create([
            'title' => 'VIP Pass',
            'account_id' => $organizer->account_id,
            'user_id' => $organizer->id,
            'event_id' => $event->id,
            'price' => 149,
            'quantity_available' => 50,
            'quantity_sold' => 1,
        ]);

        Attendees::create([
            'event_id' => $event->id,
            'ticket_id' => $ticket->id,
            'user_id' => $organizer->id,
            'account_id' => $organizer->account_id,
            'order_id' => 1001,
            'checked_in' => 1,
            'first_name' => 'Grace',
            'last_name' => 'Hopper',
            'email' => 'grace@example.com',
            'amount' => 149,
        ]);
    }
}
