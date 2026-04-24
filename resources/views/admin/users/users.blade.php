@extends('admin.layouts.app')

@section('content')
<div class="admin-page">
    <section class="admin-page-header">
        <div class="admin-page-header__body">
            <p class="admin-page-header__eyebrow">User Management</p>
            <h1 class="admin-page-header__title">Manage super admins and organizers</h1>
            <p class="admin-page-header__text">Search, filter, update, or remove platform users from one clear admin workspace.</p>
        </div>
        <div class="admin-page-actions">
            <a href="{{ url('/admin/users/add') }}" class="admin-btn admin-btn--primary">Add new user</a>
        </div>
    </section>

    <section class="admin-metric-grid">
        <article class="admin-metric">
            <p class="admin-metric__label">Total users</p>
            <p class="admin-metric__value">{{ number_format($summary['total_users']) }}</p>
            <p class="admin-metric__meta">Everyone with access to the platform</p>
        </article>
        <article class="admin-metric">
            <p class="admin-metric__label">Active users</p>
            <p class="admin-metric__value">{{ number_format($summary['active_users']) }}</p>
            <p class="admin-metric__meta">Accounts currently marked as active</p>
        </article>
        <article class="admin-metric">
            <p class="admin-metric__label">Organizers</p>
            <p class="admin-metric__value">{{ number_format($summary['organizers']) }}</p>
            <p class="admin-metric__meta">Event owners and operators</p>
        </article>
        <article class="admin-metric">
            <p class="admin-metric__label">Super admins</p>
            <p class="admin-metric__value">{{ number_format($summary['super_admins']) }}</p>
            <p class="admin-metric__meta">Full-access platform administrators</p>
        </article>
    </section>

    <section class="admin-panel">
        <div class="admin-panel__header admin-panel__header--solid">
            <div>
                <p class="admin-panel__eyebrow">Filters</p>
                <h2 class="admin-panel__title">Find the right account quickly</h2>
                <p class="admin-panel__text">Use search and account filters to narrow the list before making changes.</p>
            </div>
        </div>
        <div class="admin-panel__body">
            <form method="GET" action="{{ url('/admin/users') }}" class="admin-filter-form">
                <div class="admin-field">
                    <label for="q" class="admin-label">Search</label>
                    <input id="q" name="q" value="{{ $filters['q'] }}" class="admin-input" placeholder="Search by name, email, or phone">
                </div>
                <div class="admin-field">
                    <label for="type" class="admin-label">User type</label>
                    <select id="type" name="type" class="admin-select">
                        <option value="">All types</option>
                        @foreach (UserType::getAll() as $key => $value)
                            <option value="{{ $key }}" {{ $filters['type'] === (string) $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="admin-field">
                    <label for="status" class="admin-label">Status</label>
                    <select id="status" name="status" class="admin-select">
                        <option value="">All statuses</option>
                        @foreach (ActiveStatus::getAll() as $key => $value)
                            <option value="{{ $key }}" {{ $filters['status'] === (string) $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="admin-filter-actions">
                    <button type="submit" class="admin-btn admin-btn--dark">Apply filters</button>
                    <a href="{{ url('/admin/users') }}" class="admin-btn admin-btn--secondary">Reset</a>
                </div>
            </form>
        </div>
    </section>

    <section class="admin-panel">
        <div class="admin-panel__header">
            <div>
                <p class="admin-panel__eyebrow">User directory</p>
                <h2 class="admin-panel__title">Accounts on the platform</h2>
                <p class="admin-panel__text">{{ number_format($users->total()) }} result{{ $users->total() === 1 ? '' : 's' }} in the current view.</p>
            </div>
        </div>
        <div class="admin-panel__body">
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Type</th>
                            <th>Phone</th>
                            <th>Events</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>
                                    <p class="admin-table__title">{{ trim($user->first_name . ' ' . $user->last_name) }}</p>
                                    <p class="admin-table__meta">{{ $user->email }}</p>
                                </td>
                                <td><p class="admin-table__meta">{{ \UserType::getValue($user->type) }}</p></td>
                                <td><p class="admin-table__meta">{{ $user->mobile_number ?: 'Not provided' }}</p></td>
                                <td class="admin-table__numeric">{{ $user->organized_events_count }}</td>
                                <td>
                                    @if ((string) $user->is_active === \ActiveStatus::ACTIVE)
                                        <span class="admin-chip admin-chip--success">Active</span>
                                    @else
                                        <span class="admin-chip admin-chip--muted">Inactive</span>
                                    @endif
                                </td>
                                <td><p class="admin-table__meta">{{ $user->created_at?->format('d M Y') }}</p></td>
                                <td>
                                    <div class="admin-table__actions">
                                        <a href="{{ url('/admin/users/edit/' . $user->id) }}" class="admin-btn admin-btn--primary">Edit</a>
                                        <form method="POST" action="{{ url('/admin/users/delete/' . $user->id) }}" onsubmit="return confirm('Delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="admin-btn admin-btn--danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="admin-empty">No users match the current filters.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="border-t border-slate-200 px-4 py-4">
            {{ $users->links() }}
        </div>
    </section>
</div>
@endsection
