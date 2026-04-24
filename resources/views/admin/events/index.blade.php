@extends('admin.layouts.app')

@section('content')
<div class="admin-page">
    <section class="admin-page-header">
        <div class="admin-page-header__body">
            <p class="admin-page-header__eyebrow">Event Oversight</p>
            <h1 class="admin-page-header__title">Review events across the platform</h1>
            <p class="admin-page-header__text">Track publish state, organizer ownership, attendee volume, and direct public links for every event.</p>
        </div>
    </section>

    <section class="admin-metric-grid">
        <article class="admin-metric">
            <p class="admin-metric__label">Total events</p>
            <p class="admin-metric__value">{{ number_format($summary['total_events']) }}</p>
            <p class="admin-metric__meta">All created events on the platform</p>
        </article>
        <article class="admin-metric">
            <p class="admin-metric__label">Published</p>
            <p class="admin-metric__value">{{ number_format($summary['published_events']) }}</p>
            <p class="admin-metric__meta">Currently live public event pages</p>
        </article>
        <article class="admin-metric">
            <p class="admin-metric__label">Draft</p>
            <p class="admin-metric__value">{{ number_format($summary['draft_events']) }}</p>
            <p class="admin-metric__meta">Events still waiting to go live</p>
        </article>
        <article class="admin-metric">
            <p class="admin-metric__label">Ticket setups</p>
            <p class="admin-metric__value">{{ number_format($summary['tickets_configured']) }}</p>
            <p class="admin-metric__meta">Ticket types configured across events</p>
        </article>
    </section>

    <section class="admin-panel">
        <div class="admin-panel__header admin-panel__header--solid">
            <div>
                <p class="admin-panel__eyebrow">Filters</p>
                <h2 class="admin-panel__title">Narrow the event list</h2>
                <p class="admin-panel__text">Filter by title, organizer, venue, slug, or publish state.</p>
            </div>
        </div>
        <div class="admin-panel__body">
            <form method="GET" action="{{ url('/admin/events') }}" class="admin-filter-form admin-filter-form--compact">
                <div class="admin-field">
                    <label for="q" class="admin-label">Search</label>
                    <input id="q" name="q" value="{{ $filters['q'] }}" class="admin-input" placeholder="Search by title, slug, venue, or organizer">
                </div>
                <div class="admin-field">
                    <label for="status" class="admin-label">Publish state</label>
                    <select id="status" name="status" class="admin-select">
                        <option value="">All events</option>
                        <option value="published" {{ $filters['status'] === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ $filters['status'] === 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div class="admin-filter-actions">
                    <button type="submit" class="admin-btn admin-btn--dark">Apply filters</button>
                    <a href="{{ url('/admin/events') }}" class="admin-btn admin-btn--secondary">Reset</a>
                </div>
            </form>
        </div>
    </section>

    <section class="admin-panel">
        <div class="admin-panel__header">
            <div>
                <p class="admin-panel__eyebrow">Event directory</p>
                <h2 class="admin-panel__title">Platform events</h2>
                <p class="admin-panel__text">{{ number_format($events->total()) }} result{{ $events->total() === 1 ? '' : 's' }} in the current view.</p>
            </div>
        </div>
        <div class="admin-panel__body">
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>Organizer</th>
                            <th>Schedule</th>
                            <th>Tickets</th>
                            <th>Attendees</th>
                            <th>Status</th>
                            <th style="text-align: right;">Links</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($events as $event)
                            <tr>
                                <td>
                                    <p class="admin-table__title">{{ $event->title }}</p>
                                    <p class="admin-table__meta">{{ $event->location_address ?: 'Venue not set' }}</p>
                                    <p class="admin-table__meta">{{ $event->slug }}</p>
                                </td>
                                <td>
                                    <p class="admin-table__meta">
                                        {{ trim(($event->user->first_name ?? '') . ' ' . ($event->user->last_name ?? '')) ?: ($event->user->email ?? 'Unknown organizer') }}
                                    </p>
                                </td>
                                <td>
                                    <p class="admin-table__meta">{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y H:i') }}</p>
                                    <p class="admin-table__meta">to {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y H:i') }}</p>
                                </td>
                                <td class="admin-table__numeric">{{ $event->ticket->count() }}</td>
                                <td class="admin-table__numeric">{{ $event->attendees->count() }}</td>
                                <td>
                                    @if ($event->is_active)
                                        <span class="admin-chip admin-chip--success">Published</span>
                                    @else
                                        <span class="admin-chip admin-chip--warning">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="admin-table__actions">
                                        <a href="{{ url('/e/' . $event->slug) }}" target="_blank" class="admin-btn admin-btn--primary">Public page</a>
                                        <a href="{{ url('/e/' . $event->slug . '/register') }}" target="_blank" class="admin-btn admin-btn--secondary">Registration page</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="admin-empty">No events match the current filters.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="border-t border-slate-200 px-4 py-4">
            {{ $events->links() }}
        </div>
    </section>
</div>
@endsection
