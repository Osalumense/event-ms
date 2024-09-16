<!DOCTYPE html>
<html lang="en">
@if(count($event) > 0)
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $event['title'] . ' Registration - ' . config('app.name', 'Laravel') }}</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body class="bg-gray-50 text-gray-800">
        <main>
            <section class="relative overflow-hidden">
                <img
                    @if(!empty($event['bg_image_path']))
                        src="{{ asset('images/events/' . $event['bg_image_path']) }}"
                    @else
                        src="https://images.pexels.com/photos/3747463/pexels-photo-3747463.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260"
                    @endif
                    class="absolute inset-0 h-full w-full object-cover"
                    alt="{{ $event['title'] }}"
                />
                <div class="relative bg-slate-900/80">
                    <div class="mx-auto max-w-6xl px-6 py-20 text-white">
                        <a href="{{ url('/e/' . $event['slug']) }}" class="inline-flex items-center text-sm font-semibold text-indigo-200 hover:text-white">
                            <i class='bx bx-arrow-back mr-2'></i>
                            Back to event page
                        </a>
                        <div class="mt-8 max-w-3xl">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-200">Registration</p>
                            <h1 class="mt-3 text-4xl font-black md:text-5xl">{{ $event['title'] }}</h1>
                            <p class="mt-4 text-base text-slate-200 md:text-lg">
                                Complete your attendee details to reserve your spot for this event.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mx-auto grid max-w-6xl gap-8 px-6 py-12 lg:grid-cols-[1.1fr,0.9fr]">
                <div class="space-y-6">
                    <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                        <h2 class="text-2xl font-bold text-slate-900">Event details</h2>
                        <div class="mt-6 grid gap-4 md:grid-cols-2">
                            <div class="rounded-xl bg-slate-50 p-4">
                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Date</p>
                                <p class="mt-2 text-lg font-semibold text-slate-900">
                                    {{ date('D, d M Y', strtotime($event['start_date'])) }}
                                </p>
                                <p class="text-sm text-slate-600">
                                    {{ date('H:i', strtotime($event['start_date'])) }} to {{ date('H:i', strtotime($event['end_date'])) }}
                                </p>
                            </div>
                            <div class="rounded-xl bg-slate-50 p-4">
                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Venue</p>
                                <p class="mt-2 text-lg font-semibold text-slate-900">{{ $event['location_address'] }}</p>
                                <p class="text-sm text-slate-600">
                                    {{ $event['location_address_line_1'] }}{{ !empty($event['location_address_line_2']) ? ', ' . $event['location_address_line_2'] : '' }}
                                </p>
                                <p class="text-sm text-slate-600">{{ $event['location_state'] }}, {{ $event['location_post_code'] }}</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">About this event</p>
                            <div class="prose mt-3 max-w-none text-slate-700">
                                {!! $event['description'] !!}
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                        <h2 class="text-2xl font-bold text-slate-900">Hosted by</h2>
                        <div class="mt-4 flex items-center gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-100 text-xl font-bold text-indigo-600">
                                {{ strtoupper(substr($user['first_name'] ?? 'E', 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-lg font-semibold text-slate-900">{{ trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) }}</p>
                                <a href="mailto:{{ $user['email'] ?? '' }}" class="text-sm text-indigo-600 hover:text-indigo-700">
                                    {{ $user['email'] ?? '' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Attendee form</p>
                                <h2 class="mt-2 text-2xl font-bold text-slate-900">Reserve your spot</h2>
                            </div>
                            @if(count($ticket) > 0)
                                <span class="rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-indigo-700">
                                    {{ count($ticket) }} ticket {{ count($ticket) > 1 ? 'types' : 'type' }}
                                </span>
                            @else
                                <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-emerald-700">
                                    Free event
                                </span>
                            @endif
                        </div>

                        @if(session('success'))
                            <div class="mt-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mt-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ url('/event/attendees') }}" class="mt-6 space-y-6">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $event['id'] }}">

                            @if(count($ticket) > 0)
                                <div class="space-y-3">
                                    <label class="text-sm font-bold uppercase tracking-[0.2em] text-slate-500">Choose a ticket</label>
                                    @foreach($ticket as $currentTicket)
                                        @php
                                            $remaining = is_null($currentTicket['quantity_available'])
                                                ? null
                                                : max($currentTicket['quantity_available'] - $currentTicket['quantity_sold'], 0);
                                        @endphp
                                        <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-slate-200 p-4 transition hover:border-indigo-400 hover:bg-indigo-50">
                                            <input
                                                type="radio"
                                                name="ticket_id"
                                                value="{{ $currentTicket['id'] }}"
                                                class="mt-1 h-4 w-4 border-slate-300 text-indigo-600 focus:ring-indigo-500"
                                                {{ old('ticket_id') == $currentTicket['id'] ? 'checked' : '' }}
                                            >
                                            <div class="flex-1">
                                                <div class="flex flex-wrap items-center justify-between gap-2">
                                                    <p class="text-base font-semibold text-slate-900">{{ $currentTicket['title'] }}</p>
                                                    <p class="text-base font-bold text-indigo-600">{{ number_format((float) $currentTicket['price'], 2) }}</p>
                                                </div>
                                                <p class="mt-1 text-sm text-slate-600">
                                                    @if(is_null($remaining))
                                                        Unlimited availability
                                                    @else
                                                        {{ $remaining }} seats remaining
                                                    @endif
                                                </p>
                                            </div>
                                        </label>
                                    @endforeach
                                    @error('ticket_id')
                                        <p class="text-sm font-medium text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif

                            <div class="grid gap-4 md:grid-cols-2">
                                <div>
                                    <label for="first_name" class="text-sm font-semibold text-slate-700">First name</label>
                                    <input
                                        type="text"
                                        name="first_name"
                                        id="first_name"
                                        value="{{ old('first_name') }}"
                                        class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                                        placeholder="John"
                                    >
                                    @error('first_name')
                                        <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="last_name" class="text-sm font-semibold text-slate-700">Last name</label>
                                    <input
                                        type="text"
                                        name="last_name"
                                        id="last_name"
                                        value="{{ old('last_name') }}"
                                        class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                                        placeholder="Doe"
                                    >
                                    @error('last_name')
                                        <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="email" class="text-sm font-semibold text-slate-700">Email address</label>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                                    placeholder="johndoe@example.com"
                                >
                                @error('email')
                                    <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button
                                type="submit"
                                class="inline-flex w-full items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2"
                            >
                                {{ count($ticket) > 0 ? 'Complete registration' : 'Complete free registration' }}
                            </button>
                        </form>
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-slate-200 bg-white">
            <div class="mx-auto flex max-w-6xl flex-col gap-3 px-6 py-6 text-sm text-slate-500 md:flex-row md:items-center md:justify-between">
                <p>© Copyright {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                <div class="flex items-center gap-4">
                    <a href="{{ url('/e/' . $event['slug']) }}" class="hover:text-indigo-600">Event page</a>
                    <a href="{{ url('/') }}" class="hover:text-indigo-600">Homepage</a>
                </div>
            </div>
        </footer>
    </body>
@else
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body class="flex min-h-screen items-center justify-center bg-slate-950 px-6">
        <div class="max-w-xl rounded-2xl bg-white p-10 text-center shadow-2xl">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-500">EventMS</p>
            <h1 class="mt-4 text-4xl font-black text-slate-900">Event not found</h1>
            <p class="mt-4 text-slate-600">The event link may be unpublished, expired, or no longer available.</p>
            <a
                href="{{ url('/') }}"
                class="mt-8 inline-flex items-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700"
            >
                Back to homepage
            </a>
        </div>
    </body>
@endif
</html>
