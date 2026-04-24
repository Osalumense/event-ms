@extends('admin.layouts.app')

@section('content')
<div class="admin-page">
    <section class="admin-page-header">
        <div class="admin-page-header__body">
            <p class="admin-page-header__eyebrow">Event workspace</p>
            <h1 class="admin-page-header__title">Manage your events</h1>
            <p class="admin-page-header__text">
                Search, publish, review, and clean up your event pages from one place without losing track of registrations.
            </p>
        </div>
        <div class="admin-page-actions">
            <a href="{{ url('/dashboard') }}" class="admin-btn admin-btn--secondary">Back to dashboard</a>
            <a href="{{ url('/events/create') }}" class="admin-btn admin-btn--primary">Create event</a>
        </div>
    </section>

    <section class="admin-metric-grid">
        <article class="admin-metric">
            <p class="admin-metric__label">All events</p>
            <p class="admin-metric__value">{{ number_format($metrics['total_events']) }}</p>
            <p class="admin-metric__meta">Your full list of drafted and published event pages</p>
        </article>
        <article class="admin-metric">
            <p class="admin-metric__label">Published</p>
            <p class="admin-metric__value">{{ number_format($metrics['published_events']) }}</p>
            <p class="admin-metric__meta">Public event pages currently available to attendees</p>
        </article>
        <article class="admin-metric">
            <p class="admin-metric__label">Drafts</p>
            <p class="admin-metric__value">{{ number_format($metrics['draft_events']) }}</p>
            <p class="admin-metric__meta">Pages still being prepared before launch</p>
        </article>
        <article class="admin-metric">
            <p class="admin-metric__label">Registrations</p>
            <p class="admin-metric__value">{{ number_format($metrics['total_attendees']) }}</p>
            <p class="admin-metric__meta">Total attendees captured across your event portfolio</p>
        </article>
    </section>

    <section class="admin-panel">
        <div class="admin-panel__header">
            <div>
                <p class="admin-panel__eyebrow">Filters</p>
                <h2 class="admin-panel__title">Find the right event faster</h2>
                <p class="admin-panel__text">Search by event name, slug, venue, or city and narrow the list down to live pages or drafts.</p>
            </div>
        </div>
        <div class="admin-panel__body">
            <form method="GET" action="{{ url('/events') }}" class="admin-filter-form admin-filter-form--compact">
                <label class="admin-field">
                    <span class="admin-label">Search</span>
                    <input type="search" name="q" class="admin-input" value="{{ $filters['q'] }}" placeholder="Search by event, slug, venue, or city">
                </label>
                <label class="admin-field">
                    <span class="admin-label">Status</span>
                    <select name="status" class="admin-select">
                        <option value="">All statuses</option>
                        <option value="live" {{ $filters['status'] === 'live' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ $filters['status'] === 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </label>
                <div class="admin-filter-actions">
                    <button type="submit" class="admin-btn admin-btn--primary">Apply</button>
                    <a href="{{ url('/events') }}" class="admin-btn admin-btn--secondary">Reset</a>
                </div>
            </form>
        </div>
    </section>

    <section class="admin-panel">
        <div class="admin-panel__header">
            <div>
                <p class="admin-panel__eyebrow">Event list</p>
                <h2 class="admin-panel__title">Every event in your workspace</h2>
                <p class="admin-panel__text">Open the event workspace, publish drafts when they are ready, or remove old events you no longer need.</p>
            </div>
        </div>
        <div class="admin-panel__body">
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>Schedule</th>
                            <th>Status</th>
                            <th>Tickets</th>
                            <th>Attendees</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($userEvents as $event)
                            <tr>
                                <td>
                                    <p class="admin-table__title">{{ $event->title }}</p>
                                    <p class="admin-table__meta">{{ $event->location_address ?: 'Venue to be confirmed' }}{{ $event->location_state ? ', ' . $event->location_state : '' }}</p>
                                    <p class="admin-table__meta">{{ \Illuminate\Support\Str::limit(strip_tags($event->description), 110) }}</p>
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
                                <td class="admin-table__numeric">{{ $event->ticket_count }}</td>
                                <td class="admin-table__numeric">{{ $event->attendees_count }}</td>
                                <td>
                                    <div class="admin-table__actions">
                                        <a href="{{ url('/events/' . $event->slug) }}" class="admin-btn admin-btn--secondary">Open</a>
                                        @if ($event->is_active)
                                            <a href="{{ url('/e/' . $event->slug) }}" target="_blank" class="admin-btn admin-btn--primary">Public page</a>
                                        @else
                                            <button type="button" class="admin-btn admin-btn--primary publish_event" id="{{ $event->id }}">Publish</button>
                                        @endif
                                        <button type="button" class="admin-btn admin-btn--danger delete_event" id="{{ $event->id }}">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="admin-empty">No events match the current filter. Try resetting the filters or create a new event.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    $('.publish_event').on('click', function() {
        id = $(this).attr('id');
        $.ajax({
            url : '/events/publish/'+id,
            type : 'POST',
            data: {
                _token: '{!! csrf_token() !!}',
                id : id
            },
            success: function(response) {
                if(response.code == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: response.msg,
                        iconColor: '#4f46e5',
                        confirmButtonColor: '#4f46e5'
                    }).then(() =>{
                        window.location.reload()
                    });
                }
                else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: response.msg,
                    });
                }
            }
        });
    });

    $('.delete_event').on('click', function() {
        id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure you want to delete this event? This action can\\'t be reversed',
            icon: 'warning',
            showCancelButton: true,
            iconColor: '#4f46e5',
            confirmButtonColor: '#4f46e5',
            cancelButtonColor: '#e11d48',
            confirmButtonText: 'Yes, delete event'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : '/events/delete/'+id,
                    type : 'DELETE',
                    data : {
                        _token: '{!! csrf_token() !!}',
                    },
                    success: function(response) {
                        if(response.code == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: response.msg,
                                iconColor: '#4f46e5',
                                confirmButtonColor: '#4f46e5'
                            }).then(() =>{
                                window.location.reload()
                            });
                        }
                        else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.msg,
                                confirmButtonColor: '#4f46e5'
                            });
                        }
                    }
                });
            }
        })
    });
</script>
@endsection
