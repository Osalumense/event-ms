@extends('admin.layouts.app')

@section('content')
<div class="admin-page">
    <section class="admin-page-header">
        <div class="admin-page-header__body">
            <p class="admin-page-header__eyebrow">Super Admin</p>
            <h1 class="admin-page-header__title">Platform overview</h1>
            <p class="admin-page-header__text">
                Get a clear read on platform health, recent event activity, registration volume, and the organizers driving growth.
            </p>
        </div>
        <div class="admin-page-actions">
            <a href="{{ url('/admin/users') }}" class="admin-btn admin-btn--secondary">Manage users</a>
            <a href="{{ url('/admin/events') }}" class="admin-btn admin-btn--primary">Review events</a>
        </div>
    </section>

    <section class="admin-metric-grid">
        <article class="admin-metric">
            <p class="admin-metric__label">Users</p>
            <p class="admin-metric__value">{{ number_format($metrics['total_users']) }}</p>
            <p class="admin-metric__meta">{{ number_format($metrics['total_organizers']) }} organizers and {{ number_format($metrics['total_super_admins']) }} super admins</p>
        </article>
        <article class="admin-metric">
            <p class="admin-metric__label">Events</p>
            <p class="admin-metric__value">{{ number_format($metrics['total_events']) }}</p>
            <p class="admin-metric__meta">{{ number_format($metrics['published_events']) }} currently live and open</p>
        </article>
        <article class="admin-metric">
            <p class="admin-metric__label">Tickets</p>
            <p class="admin-metric__value">{{ number_format($metrics['total_tickets']) }}</p>
            <p class="admin-metric__meta">{{ number_format($metrics['total_attendees']) }} attendee registrations tracked</p>
        </article>
        <article class="admin-metric">
            <p class="admin-metric__label">Revenue</p>
            <p class="admin-metric__value">${{ number_format($metrics['total_revenue'], 2) }}</p>
            <p class="admin-metric__meta">Calculated from recorded attendee order totals</p>
        </article>
    </section>

    <section class="admin-layout-split">
        <div class="admin-panel">
            <div class="admin-panel__header">
                <div>
                    <p class="admin-panel__eyebrow">Recent events</p>
                    <h2 class="admin-panel__title">Newest activity across the platform</h2>
                    <p class="admin-panel__text">Review what was created most recently, who owns it, and whether it is already published.</p>
                </div>
                <a href="{{ url('/admin/events') }}" class="admin-link">View all events</a>
            </div>
            <div class="admin-panel__body">
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Organizer</th>
                                <th>Status</th>
                                <th>Attendees</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentEvents as $event)
                                <tr>
                                    <td>
                                        <p class="admin-table__title">{{ $event->title }}</p>
                                        <p class="admin-table__meta">{{ $event->slug }}</p>
                                    </td>
                                    <td>
                                        <p class="admin-table__meta">
                                            {{ trim(($event->user->first_name ?? '') . ' ' . ($event->user->last_name ?? '')) ?: ($event->user->email ?? 'Unknown organizer') }}
                                        </p>
                                    </td>
                                    <td>
                                        @if ($event->is_active)
                                            <span class="admin-chip admin-chip--success">Published</span>
                                        @else
                                            <span class="admin-chip admin-chip--warning">Draft</span>
                                        @endif
                                    </td>
                                    <td class="admin-table__numeric">{{ $event->attendees->count() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="admin-empty">No events have been created yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="admin-stack">
            <div class="admin-panel">
                <div class="admin-panel__header">
                    <div>
                        <p class="admin-panel__eyebrow">Top organizers</p>
                        <h2 class="admin-panel__title">Most active accounts</h2>
                        <p class="admin-panel__text">Spot the organizers contributing the most event activity.</p>
                    </div>
                    <a href="{{ url('/admin/users?type=10') }}" class="admin-link">View organizers</a>
                </div>
                <div class="admin-panel__body">
                    <div class="admin-list">
                        @forelse ($topOrganizers as $organizer)
                            <div class="admin-list-item">
                                <div>
                                    <p class="admin-list-item__title">{{ trim($organizer->first_name . ' ' . $organizer->last_name) }}</p>
                                    <p class="admin-list-item__meta">{{ $organizer->email }}</p>
                                </div>
                                <div>
                                    <p class="admin-list-item__stat">{{ $organizer->organized_events_count }}</p>
                                    <p class="admin-list-item__label">Events</p>
                                </div>
                            </div>
                        @empty
                            <div class="admin-empty">No organizers available yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="admin-panel">
                <div class="admin-panel__header">
                    <div>
                        <p class="admin-panel__eyebrow">Newest users</p>
                        <h2 class="admin-panel__title">Recently added accounts</h2>
                        <p class="admin-panel__text">Quick access to the latest accounts added to the platform.</p>
                    </div>
                    <a href="{{ url('/admin/users/add') }}" class="admin-link">Add user</a>
                </div>
                <div class="admin-panel__body">
                    <div class="admin-list">
                        @forelse ($recentUsers as $user)
                            <div class="admin-list-item">
                                <div>
                                    <p class="admin-list-item__title">{{ trim($user->first_name . ' ' . $user->last_name) }}</p>
                                    <p class="admin-list-item__meta">{{ $user->email }}</p>
                                </div>
                                <div>
                                    <p class="admin-list-item__meta" style="text-align: right;">{{ \UserType::getValue($user->type) }}</p>
                                    <p class="admin-list-item__label">{{ $user->created_at?->format('d M Y') }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="admin-empty">No users found.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
