@extends('admin.layouts.app')

@section('content')
<div class="admin-page">
    <section class="admin-page-header">
        <div class="admin-page-header__body">
            <p class="admin-page-header__eyebrow">Organizer Workspace</p>
            <h1 class="admin-page-header__title">Your event dashboard</h1>
            <p class="admin-page-header__text">
                Keep an eye on event activity, registrations, and the next experience going live from one clean workspace.
            </p>
        </div>
        <div class="admin-page-actions">
            <a href="{{ url('/events') }}" class="admin-btn admin-btn--secondary">Manage events</a>
            <a href="{{ url('/events/create') }}" class="admin-btn admin-btn--primary">Create event</a>
        </div>
    </section>

    <section class="admin-metric-grid">
        <article class="admin-metric">
            <p class="admin-metric__label">Events</p>
            <p class="admin-metric__value">{{ number_format($metrics['total_events']) }}</p>
            <p class="admin-metric__meta">{{ number_format($metrics['published_events']) }} live and {{ number_format($metrics['draft_events']) }} still in draft</p>
        </article>
        <article class="admin-metric">
            <p class="admin-metric__label">Tickets</p>
            <p class="admin-metric__value">{{ number_format($metrics['total_tickets']) }}</p>
            <p class="admin-metric__meta">Ticket types configured across your event portfolio</p>
        </article>
        <article class="admin-metric">
            <p class="admin-metric__label">Registrations</p>
            <p class="admin-metric__value">{{ number_format($metrics['total_attendees']) }}</p>
            <p class="admin-metric__meta">Guests tracked across free and paid event registration</p>
        </article>
        <article class="admin-metric">
            <p class="admin-metric__label">Revenue</p>
            <p class="admin-metric__value">${{ number_format($metrics['total_revenue'], 2) }}</p>
            <p class="admin-metric__meta">Calculated from attendee order totals already recorded in the app</p>
        </article>
    </section>

    <section class="admin-layout-split">
        <div class="admin-panel">
            <div class="admin-panel__header">
                <div>
                    <p class="admin-panel__eyebrow">Recent events</p>
                    <h2 class="admin-panel__title">What needs your attention</h2>
                    <p class="admin-panel__text">Review your latest event pages, check publication status, and jump back into editing without hunting through the sidebar.</p>
                </div>
                <a href="{{ url('/events') }}" class="admin-link">Open event list</a>
            </div>
            <div class="admin-panel__body">
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Schedule</th>
                                <th>Status</th>
                                <th>Registrations</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentEvents as $event)
                                <tr>
                                    <td>
                                        <p class="admin-table__title">{{ $event->title }}</p>
                                        <p class="admin-table__meta">{{ $event->location_address ?: 'Venue to be confirmed' }}{{ $event->location_state ? ', ' . $event->location_state : '' }}</p>
                                    </td>
                                    <td>
                                        <p class="admin-table__meta">{{ optional($event->start_date)->format('D, d M Y H:i') ?: 'Date pending' }}</p>
                                    </td>
                                    <td>
                                        @if ($event->is_active)
                                            <span class="admin-chip admin-chip--success">Published</span>
                                        @else
                                            <span class="admin-chip admin-chip--warning">Draft</span>
                                        @endif
                                    </td>
                                    <td class="admin-table__numeric">{{ $event->attendees_count }}</td>
                                    <td>
                                        <div class="admin-table__actions">
                                            <a href="{{ url('/events/' . $event->slug) }}" class="admin-btn admin-btn--secondary">Open</a>
                                            @if ($event->is_active)
                                                <a href="{{ url('/e/' . $event->slug) }}" target="_blank" class="admin-btn admin-btn--primary">Public page</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="admin-empty">You have not created an event yet. Start with a draft and publish when the page is ready.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="admin-stack">
            <div class="admin-panel">
                <div class="admin-panel__header admin-panel__header--solid">
                    <div>
                        <p class="admin-panel__eyebrow">Next up</p>
                        <h2 class="admin-panel__title">Closest upcoming event</h2>
                        <p class="admin-panel__text">A quick pulse-check on the next event on your calendar.</p>
                    </div>
                </div>
                <div class="admin-panel__body">
                    @if ($nextEvent)
                        <div class="admin-list">
                            <div class="admin-list-item">
                                <div>
                                    <p class="admin-list-item__title">{{ $nextEvent->title }}</p>
                                    <p class="admin-list-item__meta">{{ optional($nextEvent->start_date)->format('D, d M Y H:i') ?: 'Date pending' }}</p>
                                    <p class="admin-list-item__meta">{{ $nextEvent->location_address ?: 'Venue to be confirmed' }}{{ $nextEvent->location_state ? ', ' . $nextEvent->location_state : '' }}</p>
                                </div>
                                <div>
                                    @if ($nextEvent->is_active)
                                        <span class="admin-chip admin-chip--success">Live</span>
                                    @else
                                        <span class="admin-chip admin-chip--warning">Draft</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="admin-empty">No upcoming event is scheduled yet. Create your next event to keep momentum going.</div>
                    @endif
                </div>
            </div>

            <div class="admin-panel">
                <div class="admin-panel__header">
                    <div>
                        <p class="admin-panel__eyebrow">Best performers</p>
                        <h2 class="admin-panel__title">Top events by registrations</h2>
                        <p class="admin-panel__text">See which event pages are drawing the most sign-ups right now.</p>
                    </div>
                    <a href="{{ url('/events') }}" class="admin-link">View all</a>
                </div>
                <div class="admin-panel__body">
                    <div class="admin-list">
                        @forelse ($topEvents as $event)
                            <div class="admin-list-item">
                                <div>
                                    <p class="admin-list-item__title">{{ $event->title }}</p>
                                    <p class="admin-list-item__meta">{{ $event->ticket_count }} ticket types configured</p>
                                </div>
                                <div>
                                    <p class="admin-list-item__stat">{{ $event->attendees_count }}</p>
                                    <p class="admin-list-item__label">Registrations</p>
                                </div>
                            </div>
                        @empty
                            <div class="admin-empty">Your top events will show up here once registrations start coming in.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="admin-panel">
                <div class="admin-panel__header">
                    <div>
                        <p class="admin-panel__eyebrow">Recent registrations</p>
                        <h2 class="admin-panel__title">Latest attendee activity</h2>
                        <p class="admin-panel__text">Useful for quickly spotting new sign-ups without opening individual event workspaces.</p>
                    </div>
                </div>
                <div class="admin-panel__body">
                    <div class="admin-list">
                        @forelse ($recentRegistrations as $registration)
                            <div class="admin-list-item">
                                <div>
                                    <p class="admin-list-item__title">{{ trim($registration->first_name . ' ' . $registration->last_name) }}</p>
                                    <p class="admin-list-item__meta">{{ $registration->event->title ?? 'Event unavailable' }}</p>
                                </div>
                                <div>
                                    <p class="admin-list-item__meta" style="text-align: right;">${{ number_format((float) $registration->amount, 2) }}</p>
                                    <p class="admin-list-item__label">{{ optional($registration->created_at)->format('d M Y') }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="admin-empty">New registrations will appear here as attendees join your events.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
