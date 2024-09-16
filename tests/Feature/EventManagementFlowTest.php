<?php

namespace Tests\Feature;

use App\Models\Accounts;
use App\Models\Events;
use App\Models\Tickets;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class EventManagementFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_organizer_can_create_and_publish_an_event(): void
    {
        $organizer = $this->createOrganizer();

        $response = $this->actingAs($organizer)->post('/events', [
            'title' => 'Laravel Meetup',
            'description' => 'A meetup for Laravel builders.',
            'start_date' => '2030-05-12 09:00',
            'end_date' => '2030-05-12 17:00',
            'location_address' => 'Innovation Hub',
            'location_address_line_1' => '123 Builder Street',
            'location_address_line_2' => '2nd Floor',
            'location_state' => 'Paris',
            'location_post_code' => '75001',
        ]);

        $response->assertRedirect('/events');

        $event = Events::firstOrFail();

        $this->assertSame('laravel-meetup-' . $event->id, $event->slug);
        $this->assertSame(0, $event->is_active);

        $publishResponse = $this->actingAs($organizer)->post('/events/publish/' . $event->id);

        $publishResponse->assertJson([
            'code' => 200,
            'msg' => 'Event published',
        ]);

        $this->assertSame(1, $event->fresh()->is_active);
    }

    public function test_guest_can_register_for_a_free_event(): void
    {
        $event = $this->createPublishedEvent();

        $response = $this->post('/event/attendees', [
            'event_id' => $event->id,
            'first_name' => 'Ada',
            'last_name' => 'Lovelace',
            'email' => 'ada@example.com',
        ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('attendees', [
            'event_id' => $event->id,
            'ticket_id' => null,
            'user_id' => $event->user_id,
            'account_id' => $event->account_id,
            'first_name' => 'Ada',
            'last_name' => 'Lovelace',
            'email' => 'ada@example.com',
            'amount' => 0,
        ]);
    }

    public function test_ticketed_event_requires_ticket_selection(): void
    {
        $event = $this->createPublishedEvent();

        Tickets::create([
            'title' => 'Standard',
            'account_id' => $event->account_id,
            'user_id' => $event->user_id,
            'event_id' => $event->id,
            'price' => 49.99,
            'quantity_available' => 20,
            'quantity_sold' => 0,
        ]);

        $response = $this->from('/e/' . $event->slug . '/register')->post('/event/attendees', [
            'event_id' => $event->id,
            'first_name' => 'Ada',
            'last_name' => 'Lovelace',
            'email' => 'ada@example.com',
        ]);

        $response->assertRedirect('/e/' . $event->slug . '/register');
        $response->assertSessionHas('error');
        $this->assertDatabaseCount('attendees', 0);
    }

    public function test_guest_can_register_for_a_ticketed_event_and_increment_sales(): void
    {
        $event = $this->createPublishedEvent();

        $ticket = Tickets::create([
            'title' => 'VIP',
            'account_id' => $event->account_id,
            'user_id' => $event->user_id,
            'event_id' => $event->id,
            'price' => 149.00,
            'quantity_available' => 3,
            'quantity_sold' => 0,
        ]);

        $response = $this->post('/event/attendees', [
            'event_id' => $event->id,
            'ticket_id' => $ticket->id,
            'first_name' => 'Grace',
            'last_name' => 'Hopper',
            'email' => 'grace@example.com',
        ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('attendees', [
            'event_id' => $event->id,
            'ticket_id' => $ticket->id,
            'email' => 'grace@example.com',
            'amount' => 149,
        ]);

        $this->assertSame(1, $ticket->fresh()->quantity_sold);
    }

    private function createOrganizer(): User
    {
        $account = Accounts::create([
            'first_name' => 'Event',
            'last_name' => 'Organizer',
            'email' => 'organizer@example.com',
        ]);

        return User::create([
            'account_id' => $account->id,
            'first_name' => 'Event',
            'last_name' => 'Organizer',
            'gender' => '10',
            'email' => 'organizer@example.com',
            'password' => Hash::make('password'),
            'type' => '10',
            'is_active' => '1',
        ]);
    }

    private function createPublishedEvent(): Events
    {
        $organizer = $this->createOrganizer();

        $event = new Events();
        $event->forceFill([
            'title' => 'Product Launch',
            'slug' => 'product-launch',
            'description' => 'A polished launch event.',
            'start_date' => '2030-05-12 09:00:00',
            'end_date' => '2030-05-12 17:00:00',
            'account_id' => $organizer->account_id,
            'user_id' => $organizer->id,
            'location_address' => 'Innovation Hub',
            'location_address_line_1' => '123 Builder Street',
            'location_address_line_2' => 'Suite 4',
            'location_state' => 'Paris',
            'location_post_code' => '75001',
            'is_active' => 1,
        ]);

        $event->save();

        return $event;
    }
}
