@extends('admin.layouts.app')

@section('content')
<div class="admin-page">
    <section class="admin-page-header">
        <div class="admin-page-header__body">
            <p class="admin-page-header__eyebrow">Attendee Oversight</p>
            <h1 class="admin-page-header__title">Track registrations across all events</h1>
            <p class="admin-page-header__text">Review attendee details, ticket selections, check-in state, and registration value from one screen.</p>
        </div>
    </section>

    <section class="admin-metric-grid">
        <article class="admin-metric">
            <p class="admin-metric__label">Total attendees</p>
            <p class="admin-metric__value">{{ number_format($summary['total_attendees']) }}</p>
            <p class="admin-metric__meta">All attendee records created so far</p>
        </article>
        <article class="admin-metric">
            <p class="admin-metric__label">Checked in</p>
            <p class="admin-metric__value">{{ number_format($summary['checked_in']) }}</p>
            <p class="admin-metric__meta">Attendees already marked present</p>
        </article>
        <article class="admin-metric">
            <p class="admin-metric__label">Registered only</p>
            <p class="admin-metric__value">{{ number_format($summary['registered']) }}</p>
            <p class="admin-metric__meta">Attendees still awaiting check-in</p>
        </article>
        <article class="admin-metric">
            <p class="admin-metric__label">Revenue</p>
            <p class="admin-metric__value">${{ number_format($summary['revenue'], 2) }}</p>
            <p class="admin-metric__meta">Combined value from attendee registrations</p>
        </article>
    </section>

    <section class="admin-panel">
        <div class="admin-panel__header admin-panel__header--solid">
            <div>
                <p class="admin-panel__eyebrow">Filters</p>
                <h2 class="admin-panel__title">Find the right attendee record</h2>
                <p class="admin-panel__text">Search by attendee, event, or filter by attendance state.</p>
            </div>
        </div>
        <div class="admin-panel__body">
            <form method="GET" action="{{ url('/admin/attendees') }}" class="admin-filter-form admin-filter-form--compact">
                <div class="admin-field">
                    <label for="q" class="admin-label">Search</label>
                    <input id="q" name="q" value="{{ $filters['q'] }}" class="admin-input" placeholder="Search by attendee name, email, or event title">
                </div>
                <div class="admin-field">
                    <label for="status" class="admin-label">Attendance state</label>
                    <select id="status" name="status" class="admin-select">
                        <option value="">All attendees</option>
                        <option value="checked_in" {{ $filters['status'] === 'checked_in' ? 'selected' : '' }}>Checked in</option>
                        <option value="registered" {{ $filters['status'] === 'registered' ? 'selected' : '' }}>Registered</option>
                    </select>
                </div>
                <div class="admin-filter-actions">
                    <button type="submit" class="admin-btn admin-btn--dark">Apply filters</button>
                    <a href="{{ url('/admin/attendees') }}" class="admin-btn admin-btn--secondary">Reset</a>
                </div>
            </form>
        </div>
    </section>

    <section class="admin-panel">
        <div class="admin-panel__header">
            <div>
                <p class="admin-panel__eyebrow">Attendee directory</p>
                <h2 class="admin-panel__title">Registration records</h2>
                <p class="admin-panel__text">{{ number_format($attendees->total()) }} result{{ $attendees->total() === 1 ? '' : 's' }} in the current view.</p>
            </div>
        </div>
        <div class="admin-panel__body">
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Attendee</th>
                            <th>Event</th>
                            <th>Organizer</th>
                            <th>Ticket</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Registered</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendees as $attendee)
                            <tr>
                                <td>
                                    <p class="admin-table__title">{{ trim($attendee->first_name . ' ' . $attendee->last_name) }}</p>
                                    <p class="admin-table__meta">{{ $attendee->email }}</p>
                                </td>
                                <td>
                                    <p class="admin-table__title">{{ $attendee->event->title ?? 'Unknown event' }}</p>
                                    @if ($attendee->event)
                                        <p class="admin-table__meta"><a href="{{ url('/e/' . $attendee->event->slug) }}" target="_blank" class="admin-link">Open public page</a></p>
                                    @endif
                                </td>
                                <td>
                                    <p class="admin-table__meta">
                                        {{ trim(($attendee->event->user->first_name ?? '') . ' ' . ($attendee->event->user->last_name ?? '')) ?: ($attendee->event->user->email ?? 'Unknown organizer') }}
                                    </p>
                                </td>
                                <td><p class="admin-table__meta">{{ $attendee->tickets->title ?? 'Free registration' }}</p></td>
                                <td class="admin-table__numeric">${{ number_format((float) $attendee->amount, 2) }}</td>
                                <td>
                                    @if ($attendee->checked_in)
                                        <span class="admin-chip admin-chip--success">Checked in</span>
                                    @else
                                        <span class="admin-chip admin-chip--info">Registered</span>
                                    @endif
                                </td>
                                <td><p class="admin-table__meta">{{ $attendee->created_at?->format('d M Y H:i') }}</p></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="admin-empty">No attendee records match the current filters.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="border-t border-slate-200 px-4 py-4">
            {{ $attendees->links() }}
        </div>
    </section>
</div>
@endsection
