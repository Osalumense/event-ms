@extends('admin.layouts.app')

@section('content')
<div class="admin-page admin-page--narrow">
    <section class="admin-page-header">
        <div class="admin-page-header__body">
            <p class="admin-page-header__eyebrow">New event</p>
            <h1 class="admin-page-header__title">Create an event page</h1>
            <p class="admin-page-header__text">
                Set the title, schedule, venue, and cover image for your next event. You can add tickets and publish it after the draft is created.
            </p>
        </div>
        <div class="admin-page-actions">
            <a href="{{ url('/events') }}" class="admin-btn admin-btn--secondary">Back to events</a>
        </div>
    </section>

    <section class="admin-panel">
        <form id="create_event_form" method="POST" action="{{ url('/events') }}" enctype="multipart/form-data">
            @csrf

            <div class="admin-form-section">
                <h2 class="admin-form-section__title">Core details</h2>
                <p class="admin-form-section__text">Start with the essentials attendees need to recognize and trust the event page.</p>

                <div class="admin-form-grid" style="margin-top: 20px;">
                    <label class="admin-field" style="grid-column: 1 / -1;">
                        <span class="admin-label">Event name</span>
                        <input name="title" id="title" class="admin-input" placeholder="Builders Summit 2026" value="{{ old('title') }}" />
                        @error('title')
                            <span class="admin-field__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="admin-field" style="grid-column: 1 / -1;">
                        <span class="admin-label">Event description</span>
                        <textarea id="description" name="description" class="editor admin-input" style="min-height: 220px; padding: 14px;">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="admin-field__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>
                </div>
            </div>

            <div class="admin-form-section">
                <h2 class="admin-form-section__title">Branding and timing</h2>
                <p class="admin-form-section__text">Choose a cover image and define when the event experience begins and ends.</p>

                <div class="admin-form-grid" style="margin-top: 20px;">
                    <label class="admin-field">
                        <span class="admin-label">Start date</span>
                        <input type="datetime" id="start_date" name="start_date" class="admin-input start_date" placeholder="2026-09-28 07:30" value="{{ old('start_date') }}">
                        @error('start_date')
                            <span class="admin-field__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="admin-field">
                        <span class="admin-label">End date</span>
                        <input type="datetime" name="end_date" id="end_date" class="admin-input end_date" placeholder="2026-09-28 17:30" value="{{ old('end_date') }}">
                        @error('end_date')
                            <span class="admin-field__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="admin-field" style="grid-column: 1 / -1;">
                        <span class="admin-label">Cover image</span>
                        <input type="file" name="bg_image_path" class="admin-input" style="padding: 10px 14px;" />
                        <span class="admin-field__hint">Optional. Supported formats: jpeg, png, gif, and webp.</span>
                    </label>
                </div>
            </div>

            <div class="admin-form-section">
                <h2 class="admin-form-section__title">Venue details</h2>
                <p class="admin-form-section__text">Add the venue information that shows on the event page and helps attendees get there smoothly.</p>

                <div class="admin-form-grid" style="margin-top: 20px;">
                    <label class="admin-field" style="grid-column: 1 / -1;">
                        <span class="admin-label">Venue name</span>
                        <input name="location_address" id="location_address" class="admin-input" placeholder="The Event Centre" value="{{ old('location_address') }}" />
                        @error('location_address')
                            <span class="admin-field__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="admin-field" style="grid-column: 1 / -1;">
                        <span class="admin-label">Address line 1</span>
                        <input name="location_address_line_1" id="location_address_line_1" class="admin-input" placeholder="2 Newton Street" value="{{ old('location_address_line_1') }}" />
                        @error('location_address_line_1')
                            <span class="admin-field__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="admin-field" style="grid-column: 1 / -1;">
                        <span class="admin-label">Address line 2</span>
                        <input name="location_address_line_2" id="location_address_line_2" class="admin-input" placeholder="Abuja, Nigeria" value="{{ old('location_address_line_2') }}" />
                        @error('location_address_line_2')
                            <span class="admin-field__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="admin-field">
                        <span class="admin-label">City</span>
                        <input type="text" name="location_state" id="location_state" class="admin-input" placeholder="Abuja" value="{{ old('location_state') }}">
                        @error('location_state')
                            <span class="admin-field__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="admin-field">
                        <span class="admin-label">Post code</span>
                        <input type="text" id="location_post_code" name="location_post_code" class="admin-input" placeholder="901101" value="{{ old('location_post_code') }}">
                        @error('location_post_code')
                            <span class="admin-field__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>
                </div>
            </div>

            <div class="admin-form-section">
                <div class="admin-form-actions">
                    <a href="{{ url('/events') }}" class="admin-btn admin-btn--secondary">Cancel</a>
                    <button class="admin-btn admin-btn--primary">Create draft</button>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

@section('scripts')
<script>
    ClassicEditor
        .create( document.querySelector( '.editor' ) )
        .catch( error => {
            console.error( error );
        });
</script>
<script>
    $( document ).ready(function() {
      $(".start_date, .end_date").flatpickr(
          {
              minDate: "today",
              enableTime: true,
              dateFormat: "Y-m-d H:i",
          }
      );
    });
</script>
@endsection
