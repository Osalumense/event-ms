<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\Attendees;
use App\Models\Events;
use App\Models\Tickets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminIndex()
    {
        $metrics = [
            'total_users' => User::count(),
            'total_organizers' => User::where('type', \UserType::ADMIN)->count(),
            'total_super_admins' => User::where('type', \UserType::SUPER_ADMIN)->count(),
            'total_events' => Events::count(),
            'published_events' => Events::where('is_active', 1)->count(),
            'total_tickets' => Tickets::count(),
            'total_attendees' => Attendees::count(),
            'total_revenue' => (float) Attendees::sum('amount'),
        ];

        $recentUsers = User::orderByDesc('id')->take(5)->get();
        $recentEvents = Events::with('user')->orderByDesc('id')->take(5)->get();
        $topOrganizers = User::where('type', \UserType::ADMIN)
            ->withCount('organizedEvents')
            ->orderByDesc('organized_events_count')
            ->take(5)
            ->get();

        return view('admin.index', compact('metrics', 'recentUsers', 'recentEvents', 'topOrganizers'));
    }

    public function renderUsersPage(Request $request)
    {
        $filters = [
            'q' => trim((string) $request->query('q', '')),
            'type' => (string) $request->query('type', ''),
            'status' => (string) $request->query('status', ''),
        ];

        $query = User::query()->withCount('organizedEvents')->orderByDesc('id');

        if ($filters['q'] !== '') {
            $query->where(function ($builder) use ($filters) {
                $builder->where('first_name', 'like', '%' . $filters['q'] . '%')
                    ->orWhere('last_name', 'like', '%' . $filters['q'] . '%')
                    ->orWhere('email', 'like', '%' . $filters['q'] . '%')
                    ->orWhere('mobile_number', 'like', '%' . $filters['q'] . '%');
            });
        }

        if (in_array($filters['type'], array_keys(\UserType::getAll()), true)) {
            $query->where('type', $filters['type']);
        }

        if (in_array($filters['status'], array_keys(\ActiveStatus::getAll()), true)) {
            $query->where('is_active', $filters['status']);
        }

        $users = $query->paginate(10)->withQueryString();

        $summary = [
            'total_users' => User::count(),
            'active_users' => User::where('is_active', \ActiveStatus::ACTIVE)->count(),
            'organizers' => User::where('type', \UserType::ADMIN)->count(),
            'super_admins' => User::where('type', \UserType::SUPER_ADMIN)->count(),
        ];

        return view('admin.users.users', compact('users', 'filters', 'summary'));
    }

    public function renderNewUserPage()
    {
        return view('admin.users.new-user');
    }

    public function createNewUser(Request $request)
    {
        $this->ensureSuperAdmin();

        $data = $this->validateUserPayload($request);

        DB::transaction(function () use ($data) {
            $account = new Accounts();
            $account->first_name = $data['first_name'];
            $account->last_name = $data['last_name'];
            $account->email = $data['email'];
            $account->is_active = $data['is_active'];
            $account->save();

            $user = new User();
            $user->account_id = $account->id;
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->gender = $data['gender'];
            $user->email = $data['email'];
            $user->mobile_number = $data['mobile_number'] ?? null;
            $user->type = $data['user_type'];
            $user->is_active = $data['is_active'];
            $user->password = Hash::make($data['password']);
            $user->save();
        });

        return redirect('/admin/users')->with('success', 'User created successfully.');
    }

    public function editUsers($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.user-edit')->with(['user' => $user]);
    }

    public function updateCounsellors(Request $request)
    {
        $this->ensureSuperAdmin();

        $user = User::findOrFail($request->input('id'));
        $data = $this->validateUserPayload($request, $user);

        DB::transaction(function () use ($user, $data) {
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->gender = $data['gender'];
            $user->email = $data['email'];
            $user->mobile_number = $data['mobile_number'] ?? null;
            $user->type = $data['user_type'];
            $user->is_active = $data['is_active'];

            if (!empty($data['password'])) {
                $user->password = Hash::make($data['password']);
            }

            $user->save();

            $account = Accounts::find($user->account_id);
            if ($account instanceof Accounts) {
                $account->first_name = $data['first_name'];
                $account->last_name = $data['last_name'];
                $account->email = $data['email'];
                $account->is_active = $data['is_active'];
                $account->save();
            }
        });

        return redirect('/admin/users')->with('success', 'User updated successfully.');
    }

    public function deleteCounsellor($id)
    {
        $this->ensureSuperAdmin();

        $user = User::findOrFail($id);

        if ((int) $user->id === (int) Auth::id()) {
            return redirect()->back()->with('error', 'You cannot delete the account you are signed in with.');
        }

        $user->delete();

        return redirect('/admin/users')->with('success', 'User removed successfully.');
    }

    public function renderEventsPage(Request $request)
    {
        $filters = [
            'q' => trim((string) $request->query('q', '')),
            'status' => (string) $request->query('status', ''),
        ];

        $query = Events::with(['user', 'ticket', 'attendees'])->orderByDesc('id');

        if ($filters['q'] !== '') {
            $query->where(function ($builder) use ($filters) {
                $builder->where('title', 'like', '%' . $filters['q'] . '%')
                    ->orWhere('slug', 'like', '%' . $filters['q'] . '%')
                    ->orWhere('location_address', 'like', '%' . $filters['q'] . '%')
                    ->orWhereHas('user', function ($userQuery) use ($filters) {
                        $userQuery->where('first_name', 'like', '%' . $filters['q'] . '%')
                            ->orWhere('last_name', 'like', '%' . $filters['q'] . '%')
                            ->orWhere('email', 'like', '%' . $filters['q'] . '%');
                    });
            });
        }

        if ($filters['status'] === 'published') {
            $query->where('is_active', 1);
        }

        if ($filters['status'] === 'draft') {
            $query->where('is_active', 0);
        }

        $events = $query->paginate(10)->withQueryString();

        $summary = [
            'total_events' => Events::count(),
            'published_events' => Events::where('is_active', 1)->count(),
            'draft_events' => Events::where('is_active', 0)->count(),
            'tickets_configured' => Tickets::count(),
        ];

        return view('admin.events.index', compact('events', 'filters', 'summary'));
    }

    public function renderAttendeesPage(Request $request)
    {
        $filters = [
            'q' => trim((string) $request->query('q', '')),
            'status' => (string) $request->query('status', ''),
        ];

        $query = Attendees::with(['event.user', 'tickets'])->orderByDesc('id');

        if ($filters['q'] !== '') {
            $query->where(function ($builder) use ($filters) {
                $builder->where('first_name', 'like', '%' . $filters['q'] . '%')
                    ->orWhere('last_name', 'like', '%' . $filters['q'] . '%')
                    ->orWhere('email', 'like', '%' . $filters['q'] . '%')
                    ->orWhereHas('event', function ($eventQuery) use ($filters) {
                        $eventQuery->where('title', 'like', '%' . $filters['q'] . '%');
                    });
            });
        }

        if ($filters['status'] === 'checked_in') {
            $query->where('checked_in', 1);
        }

        if ($filters['status'] === 'registered') {
            $query->where('checked_in', 0);
        }

        $attendees = $query->paginate(12)->withQueryString();

        $summary = [
            'total_attendees' => Attendees::count(),
            'checked_in' => Attendees::where('checked_in', 1)->count(),
            'registered' => Attendees::where('checked_in', 0)->count(),
            'revenue' => (float) Attendees::sum('amount'),
        ];

        return view('admin.attendees.index', compact('attendees', 'filters', 'summary'));
    }

    private function validateUserPayload(Request $request, ?User $user = null): array
    {
        $passwordRules = $user
            ? ['nullable', 'string', 'min:8', 'confirmed']
            : ['required', 'string', 'min:8', 'confirmed'];

        return $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user?->id),
            ],
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'mobile_number' => 'nullable|string|max:20',
            'gender' => ['required', Rule::in(array_keys(\Gender::getAll()))],
            'is_active' => ['required', Rule::in(array_keys(\ActiveStatus::getAll()))],
            'user_type' => ['required', Rule::in(array_keys(\UserType::getAll()))],
            'password' => $passwordRules,
        ]);
    }

    private function ensureSuperAdmin(): void
    {
        abort_unless(Auth::user() instanceof User && Auth::user()->type === \UserType::SUPER_ADMIN, 403);
    }
}
