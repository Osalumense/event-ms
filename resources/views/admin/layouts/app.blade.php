<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}"/>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
      [x-cloak] { 
            display: none !important; 
        }

        :root {
            --admin-accent: #4f46e5;
            --admin-accent-dark: #4338ca;
            --admin-border: #e5e7eb;
            --admin-text: #0f172a;
            --admin-muted: #64748b;
            --admin-surface: #ffffff;
            --admin-bg: #f3f4f6;
            --admin-shadow: 0 1px 2px rgba(15, 23, 42, 0.06), 0 10px 30px rgba(15, 23, 42, 0.04);
        }

        body {
            background: var(--admin-bg);
            color: var(--admin-text);
        }

        .admin-page {
            display: flex;
            flex-direction: column;
            gap: 24px;
            padding: 24px;
        }

        .admin-page--narrow {
            margin: 0 auto;
            max-width: 1120px;
        }

        .admin-page-header,
        .admin-card,
        .admin-panel,
        .admin-metric {
            background: var(--admin-surface);
            border: 1px solid var(--admin-border);
            box-shadow: var(--admin-shadow);
            border-radius: 8px;
        }

        .admin-page-header {
            align-items: flex-start;
            display: flex;
            gap: 24px;
            justify-content: space-between;
            padding: 28px 24px;
        }

        .admin-page-header__eyebrow {
            color: var(--admin-muted);
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.22em;
            margin: 0;
            text-transform: uppercase;
        }

        .admin-page-header__title {
            color: var(--admin-text);
            font-size: 2.25rem;
            font-weight: 900;
            line-height: 1.05;
            margin: 10px 0 0;
        }

        .admin-page-header__body {
            max-width: 760px;
        }

        .admin-page-header__text {
            color: #334155;
            font-size: 1rem;
            line-height: 1.65;
            margin: 12px 0 0;
        }

        .admin-page-actions {
            align-items: center;
            display: flex;
            flex-shrink: 0;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: flex-end;
            margin-left: auto;
        }

        .admin-btn {
            align-items: center;
            border: 1px solid transparent;
            border-radius: 6px;
            display: inline-flex;
            font-size: 0.95rem;
            font-weight: 700;
            justify-content: center;
            line-height: 1.2;
            min-height: 46px;
            padding: 0 18px;
            text-decoration: none;
            transition: background-color 0.15s ease, border-color 0.15s ease, color 0.15s ease, box-shadow 0.15s ease;
        }

        .admin-btn:hover,
        .admin-btn:focus {
            outline: none;
            text-decoration: none;
        }

        .admin-btn--primary {
            background: var(--admin-accent);
            color: #ffffff;
        }

        .admin-btn--primary:hover,
        .admin-btn--primary:focus {
            background: var(--admin-accent-dark);
            color: #ffffff;
        }

        .admin-btn--secondary {
            background: #ffffff;
            border-color: #cbd5e1;
            color: #334155;
        }

        .admin-btn--secondary:hover,
        .admin-btn--secondary:focus {
            background: #f8fafc;
            color: #0f172a;
        }

        .admin-btn--dark {
            background: #111827;
            color: #ffffff;
        }

        .admin-btn--dark:hover,
        .admin-btn--dark:focus {
            background: #0f172a;
            color: #ffffff;
        }

        .admin-btn--danger {
            background: #e11d48;
            color: #ffffff;
        }

        .admin-btn--danger:hover,
        .admin-btn--danger:focus {
            background: #be123c;
            color: #ffffff;
        }

        .admin-metric-grid {
            display: grid;
            gap: 16px;
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .admin-metric {
            min-height: 152px;
            padding: 24px 20px;
        }

        .admin-metric__label {
            color: var(--admin-muted);
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            margin: 0;
            text-transform: uppercase;
        }

        .admin-metric__value {
            color: var(--admin-text);
            font-size: 2.35rem;
            font-weight: 900;
            line-height: 1;
            margin: 18px 0 0;
        }

        .admin-metric__meta {
            color: #334155;
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 12px 0 0;
        }

        .admin-layout-split {
            display: grid;
            gap: 24px;
            grid-template-columns: minmax(0, 1.45fr) minmax(320px, 0.8fr);
        }

        .admin-stack {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .admin-panel {
            overflow: hidden;
        }

        .admin-panel__header {
            align-items: flex-start;
            display: flex;
            gap: 16px;
            justify-content: space-between;
            padding: 24px 24px 0;
        }

        .admin-panel__header--solid {
            padding-bottom: 24px;
        }

        .admin-panel__body {
            padding: 24px;
        }

        .admin-panel__eyebrow {
            color: var(--admin-muted);
            font-size: 0.74rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            margin: 0;
            text-transform: uppercase;
        }

        .admin-panel__title {
            color: var(--admin-text);
            font-size: 1.85rem;
            font-weight: 900;
            line-height: 1.15;
            margin: 10px 0 0;
        }

        .admin-panel__text {
            color: #475569;
            font-size: 0.96rem;
            line-height: 1.6;
            margin: 12px 0 0;
            max-width: 720px;
        }

        .admin-link {
            color: var(--admin-accent);
            font-size: 0.95rem;
            font-weight: 700;
            text-decoration: none;
        }

        .admin-link:hover,
        .admin-link:focus {
            color: var(--admin-accent-dark);
            text-decoration: none;
        }

        .admin-filter-form {
            display: grid;
            gap: 16px;
            grid-template-columns: minmax(0, 1.5fr) minmax(220px, 0.75fr) minmax(220px, 0.75fr) auto;
        }

        .admin-filter-form--compact {
            grid-template-columns: minmax(0, 1.4fr) minmax(220px, 0.75fr) auto;
        }

        .admin-field {
            display: flex;
            flex-direction: column;
        }

        .admin-label {
            color: #334155;
            font-size: 0.93rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .admin-input,
        .admin-select {
            appearance: none;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            color: var(--admin-text);
            font-size: 0.95rem;
            min-height: 48px;
            padding: 0 14px;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
            width: 100%;
        }

        .admin-input:focus,
        .admin-select:focus {
            border-color: var(--admin-accent);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.14);
            outline: none;
        }

        .admin-field__hint {
            color: var(--admin-muted);
            font-size: 0.82rem;
            margin-top: 8px;
        }

        .admin-field__error {
            color: #e11d48;
            font-size: 0.84rem;
            font-weight: 600;
            margin-top: 8px;
        }

        .admin-form-grid {
            display: grid;
            gap: 18px 20px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .admin-filter-actions {
            align-items: flex-end;
            display: flex;
            gap: 12px;
        }

        .admin-form-section {
            padding: 24px;
        }

        .admin-form-section + .admin-form-section {
            border-top: 1px solid var(--admin-border);
        }

        .admin-form-section__title {
            color: var(--admin-text);
            font-size: 1.15rem;
            font-weight: 800;
            margin: 0;
        }

        .admin-form-section__text {
            color: var(--admin-muted);
            font-size: 0.92rem;
            line-height: 1.6;
            margin: 8px 0 0;
            max-width: 720px;
        }

        .admin-empty {
            color: var(--admin-muted);
            font-size: 0.95rem;
            padding: 28px 0;
            text-align: center;
        }

        .admin-form-actions {
            align-items: center;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 28px;
        }

        .admin-form-actions--between {
            justify-content: space-between;
        }

        .admin-table-wrap {
            overflow-x: auto;
        }

        .admin-table {
            border-collapse: collapse;
            min-width: 100%;
            width: 100%;
        }

        .admin-table thead {
            background: #f8fafc;
        }

        .admin-table th,
        .admin-table td {
            border-top: 1px solid var(--admin-border);
            padding: 16px 18px;
            text-align: left;
            vertical-align: top;
        }

        .admin-table thead th {
            border-top: none;
            color: var(--admin-muted);
            font-size: 0.74rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .admin-table__title {
            color: var(--admin-text);
            font-size: 1.05rem;
            font-weight: 800;
            line-height: 1.35;
            margin: 0;
        }

        .admin-table__meta {
            color: #64748b;
            font-size: 0.9rem;
            line-height: 1.55;
            margin-top: 4px;
        }

        .admin-table__numeric {
            font-weight: 800;
        }

        .admin-table__actions {
            align-items: center;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: flex-end;
        }

        .admin-chip {
            border-radius: 999px;
            display: inline-flex;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            padding: 7px 11px;
            text-transform: uppercase;
        }

        .admin-chip--success {
            background: #dcfce7;
            color: #166534;
        }

        .admin-chip--warning {
            background: #fef3c7;
            color: #92400e;
        }

        .admin-chip--info {
            background: #e0e7ff;
            color: #3730a3;
        }

        .admin-chip--muted {
            background: #e2e8f0;
            color: #334155;
        }

        .admin-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .admin-list-item {
            align-items: center;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            display: flex;
            gap: 18px;
            justify-content: space-between;
            padding: 16px 18px;
        }

        .admin-list-item__title {
            color: var(--admin-text);
            font-size: 1rem;
            font-weight: 800;
            margin: 0;
        }

        .admin-list-item__meta {
            color: var(--admin-muted);
            font-size: 0.9rem;
            margin-top: 4px;
        }

        .admin-list-item__stat {
            color: var(--admin-text);
            font-size: 1.6rem;
            font-weight: 900;
            line-height: 1;
            text-align: right;
        }

        .admin-list-item__label {
            color: var(--admin-muted);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            margin-top: 4px;
            text-align: right;
            text-transform: uppercase;
        }

        .admin-sidebar-link {
            align-items: center;
            border-radius: 6px;
            color: #475569;
            display: flex;
            font-weight: 600;
            gap: 10px;
            min-height: 44px;
            padding: 10px 12px;
            text-decoration: none;
            transition: background-color 0.15s ease, color 0.15s ease;
        }

        .admin-sidebar-link:hover {
            background: #f8fafc;
            color: var(--admin-text);
            text-decoration: none;
        }

        .admin-sidebar-link--active {
            background: #eef2ff;
            color: var(--admin-accent-dark);
        }

        .admin-navbar-button {
            align-items: center;
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 999px;
            color: #0f172a;
            display: inline-flex;
            height: 46px;
            justify-content: center;
            position: relative;
            transition: background-color 0.15s ease, border-color 0.15s ease;
            width: 46px;
        }

        .admin-navbar-button:hover,
        .admin-navbar-button:focus {
            background: #e5e7eb;
            border-color: #cbd5e1;
            outline: none;
        }

        .admin-notification-badge {
            align-items: center;
            background: #ef4444;
            border: 2px solid #ffffff;
            border-radius: 999px;
            color: #ffffff;
            display: inline-flex;
            font-size: 0.68rem;
            font-weight: 800;
            height: 20px;
            justify-content: center;
            min-width: 20px;
            padding: 0 5px;
            position: absolute;
            right: -4px;
            top: -4px;
        }

        .admin-notification-badge[hidden] {
            display: none !important;
        }

        .admin-dropdown-menu {
            background: #ffffff;
            border: 1px solid var(--admin-border);
            border-radius: 8px;
            box-shadow: 0 16px 38px rgba(15, 23, 42, 0.14);
        }

        .admin-notification-menu {
            margin-top: 12px;
            position: absolute;
            right: 0;
            width: 360px;
            z-index: 40;
        }

        .admin-notification-menu__header {
            align-items: flex-start;
            border-bottom: 1px solid var(--admin-border);
            display: flex;
            gap: 14px;
            justify-content: space-between;
            padding: 18px 18px 14px;
        }

        .admin-notification-menu__title {
            color: var(--admin-text);
            font-size: 1rem;
            font-weight: 800;
            margin: 0;
        }

        .admin-notification-menu__text {
            color: var(--admin-muted);
            font-size: 0.85rem;
            margin-top: 4px;
        }

        .admin-notification-list {
            display: flex;
            flex-direction: column;
            max-height: 360px;
            overflow-y: auto;
        }

        .admin-notification-item {
            align-items: flex-start;
            border-bottom: 1px solid #eef2f7;
            color: inherit;
            display: grid;
            gap: 12px;
            grid-template-columns: 40px minmax(0, 1fr) auto;
            padding: 14px 18px;
            text-decoration: none;
            transition: background-color 0.15s ease;
        }

        .admin-notification-item--read {
            opacity: 0.72;
        }

        .admin-notification-item:hover,
        .admin-notification-item:focus {
            background: #f8fafc;
            color: inherit;
            text-decoration: none;
        }

        .admin-notification-item:last-child {
            border-bottom: none;
        }

        .admin-notification-item__icon {
            align-items: center;
            background: #eef2ff;
            border-radius: 8px;
            color: var(--admin-accent-dark);
            display: inline-flex;
            font-size: 1.2rem;
            height: 40px;
            justify-content: center;
            width: 40px;
        }

        .admin-notification-item--read .admin-notification-item__icon {
            background: #f1f5f9;
            color: #64748b;
        }

        .admin-notification-item__content {
            color: inherit;
            display: block;
            min-width: 0;
            text-decoration: none;
        }

        .admin-notification-item__content:hover,
        .admin-notification-item__content:focus {
            color: inherit;
            text-decoration: none;
        }

        .admin-notification-item__title {
            color: var(--admin-text);
            display: flex;
            gap: 8px;
            align-items: center;
            font-size: 0.92rem;
            font-weight: 800;
            line-height: 1.4;
        }

        .admin-notification-item__dot {
            background: var(--admin-accent);
            border-radius: 999px;
            display: inline-flex;
            flex-shrink: 0;
            height: 9px;
            margin-top: 2px;
            width: 9px;
        }

        .admin-notification-item--read .admin-notification-item__dot {
            display: none;
        }

        .admin-notification-item__meta {
            color: #475569;
            font-size: 0.84rem;
            line-height: 1.5;
            margin-top: 3px;
        }

        .admin-notification-item__time {
            color: var(--admin-muted);
            font-size: 0.78rem;
            margin-top: 6px;
        }

        .admin-notification-menu__footer {
            align-items: center;
            border-top: 1px solid var(--admin-border);
            display: flex;
            gap: 10px;
            justify-content: space-between;
            padding: 14px 18px;
        }

        .admin-notification-empty {
            color: var(--admin-muted);
            font-size: 0.9rem;
            padding: 20px 18px;
            text-align: center;
        }

        .admin-notification-action {
            align-items: center;
            background: transparent;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            color: #475569;
            cursor: pointer;
            display: inline-flex;
            font-size: 0.78rem;
            font-weight: 700;
            justify-content: center;
            min-height: 34px;
            padding: 0 10px;
            transition: background-color 0.15s ease, border-color 0.15s ease, color 0.15s ease;
            white-space: nowrap;
        }

        .admin-notification-action:hover,
        .admin-notification-action:focus {
            background: #f8fafc;
            border-color: #94a3b8;
            color: #0f172a;
            outline: none;
        }

        .admin-notification-action[disabled] {
            cursor: default;
            opacity: 0.45;
        }

        @media (max-width: 1279px) {
            .admin-metric-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .admin-layout-split {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 1024px) {
            .admin-page-header {
                flex-direction: column;
            }

            .admin-page-actions {
                justify-content: flex-start;
                margin-left: 0;
            }

            .admin-filter-form,
            .admin-filter-form--compact,
            .admin-form-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .admin-page {
                gap: 20px;
                padding: 18px;
            }

            .admin-page-header {
                padding: 22px 18px;
            }

            .admin-page-header__title {
                font-size: 1.9rem;
            }

            .admin-panel__header,
            .admin-panel__body,
            .admin-metric,
            .admin-form-section {
                padding: 18px;
            }

            .admin-metric-grid {
                grid-template-columns: 1fr;
            }
        }
    </style> 
    @yield('styles')
</head>
<body>
    @php
        $currentAdminUser = Auth::user();
        $adminNotifications = collect();

        if ($currentAdminUser) {
            if ((string) $currentAdminUser->type === (string) \UserType::SUPER_ADMIN) {
                $recentUsersForFeed = \App\Models\User::query()
                    ->orderByDesc('id')
                    ->take(3)
                    ->get()
                    ->map(function ($user) {
                        return [
                            'id' => 'user-' . $user->id,
                            'title' => 'User account updated',
                            'meta' => trim($user->first_name . ' ' . $user->last_name) . ' is set up as ' . \UserType::getValue($user->type) . '.',
                            'href' => url('/admin/users/edit/' . $user->id),
                            'icon' => 'bx-user-plus',
                            'timestamp' => $user->created_at,
                        ];
                    });

                $recentEventsForFeed = \App\Models\Events::with('user')
                    ->orderByDesc('id')
                    ->take(3)
                    ->get()
                    ->map(function ($event) {
                        $owner = trim(($event->user->first_name ?? '') . ' ' . ($event->user->last_name ?? ''));

                        return [
                            'id' => 'event-' . $event->id,
                            'title' => $event->title . ' is on the radar',
                            'meta' => ($owner ?: ($event->user->email ?? 'An organizer')) . ' owns this event and it is ' . ($event->is_active ? 'published' : 'still in draft') . '.',
                            'href' => url('/admin/events?q=' . urlencode($event->title)),
                            'icon' => 'bx-calendar-event',
                            'timestamp' => $event->created_at,
                        ];
                    });

                $recentAttendeesForFeed = \App\Models\Attendees::with('event')
                    ->orderByDesc('id')
                    ->take(3)
                    ->get()
                    ->map(function ($attendee) {
                        return [
                            'id' => 'attendee-' . $attendee->id,
                            'title' => trim($attendee->first_name . ' ' . $attendee->last_name) . ' registered',
                            'meta' => 'For ' . ($attendee->event->title ?? 'an event') . ' at $' . number_format((float) $attendee->amount, 2) . '.',
                            'href' => url('/admin/attendees?q=' . urlencode($attendee->email)),
                            'icon' => 'bx-group',
                            'timestamp' => $attendee->created_at,
                        ];
                    });

                $adminNotifications = $recentUsersForFeed
                    ->merge($recentEventsForFeed)
                    ->merge($recentAttendeesForFeed);
            } else {
                $recentOwnedEvents = \App\Models\Events::query()
                    ->where('user_id', $currentAdminUser->id)
                    ->orderByDesc('id')
                    ->take(3)
                    ->get()
                    ->map(function ($event) {
                        return [
                            'id' => 'owned-event-' . $event->id,
                            'title' => $event->title . ' was updated',
                            'meta' => 'Status: ' . ($event->is_active ? 'published' : 'draft') . '. Public link ready when published.',
                            'href' => url('/events'),
                            'icon' => 'bx-calendar-event',
                            'timestamp' => $event->updated_at ?: $event->created_at,
                        ];
                    });

                $recentOwnedAttendees = \App\Models\Attendees::with('event')
                    ->whereHas('event', function ($query) use ($currentAdminUser) {
                        $query->where('user_id', $currentAdminUser->id);
                    })
                    ->orderByDesc('id')
                    ->take(3)
                    ->get()
                    ->map(function ($attendee) {
                        return [
                            'id' => 'owned-attendee-' . $attendee->id,
                            'title' => trim($attendee->first_name . ' ' . $attendee->last_name) . ' joined your event',
                            'meta' => 'Registered for ' . ($attendee->event->title ?? 'your event') . '.',
                            'href' => url('/events'),
                            'icon' => 'bx-user-check',
                            'timestamp' => $attendee->created_at,
                        ];
                    });

                $adminNotifications = $recentOwnedEvents->merge($recentOwnedAttendees);
            }

            $adminNotifications = $adminNotifications
                ->sortByDesc(function ($item) {
                    return optional($item['timestamp'])->timestamp ?? 0;
                })
                ->take(6)
                ->values();
        }

        $adminNotificationCount = $adminNotifications->count();
        $adminNotificationStorageKey = $currentAdminUser ? 'eventms_admin_notifications_read_' . $currentAdminUser->id : 'eventms_admin_notifications_read_guest';
    @endphp

    <div>
        <div class="flex h-screen overflow-y-hidden bg-white" x-data="setup()" x-init="$refs.loading.classList.add('hidden')">
          <!-- Loading screen -->
          <div
            x-ref="loading"
            class="fixed inset-0 z-50 flex items-center justify-center text-white bg-black bg-opacity-50"
            style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"
          >
            Please wait <br/>
            Page Loading...
          </div>

          @include('admin.layouts.sidebar')
    
          <div class="flex flex-col flex-1 h-full overflow-hidden">
            <!-- Navbar -->
            <header class="flex-shrink-0 border-b">
              <div class="flex items-center justify-between p-2">
                <!-- Navbar left -->
                <div class="flex items-center space-x-3">
                  <span class="p-2 text-xl font-semibold tracking-wider uppercase lg:hidden">EMS Dashboard</span>
                  <!-- Toggle sidebar button -->
                  <button @click="toggleSidbarMenu()" class="p-2 rounded-md focus:outline-none focus:ring">
                    <svg
                      class="w-4 h-4 text-gray-600"
                      :class="{'transform transition-transform -rotate-180': isSidebarOpen}"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg>
                  </button>
                </div>
    
                <!-- Navbar right -->
                <div class="relative flex items-center space-x-3">
    
                  <div class="items-center hidden space-x-3 md:flex">
                    <!-- Notification Button -->
                    <div class="relative" x-data="{ isOpen: false }">
                      <button
                        @click="isOpen = !isOpen"
                        class="admin-navbar-button js-admin-notification-toggle"
                        data-notification-storage-key="{{ $adminNotificationStorageKey }}"
                      >
                        <i class='bx bx-bell bx-sm bx-tada-hover'></i>
                        @if ($adminNotificationCount > 0)
                            <span class="admin-notification-badge js-admin-notification-badge">{{ $adminNotificationCount > 9 ? '9+' : $adminNotificationCount }}</span>
                        @endif
                      </button>
    
                      <!-- Dropdown card -->
                      <div
                        @click.away="isOpen = false"
                        x-show.transition.opacity="isOpen"
                        class="admin-dropdown-menu admin-notification-menu"
                      >
                        <div class="admin-notification-menu__header">
                          <div>
                              <p class="admin-notification-menu__title">Recent activity</p>
                              <p class="admin-notification-menu__text">
                                {{ Auth::user()->type == \UserType::SUPER_ADMIN ? 'Latest platform updates across users, events, and registrations.' : 'Latest updates from your event workspace.' }}
                              </p>
                          </div>
                          @if ($adminNotifications->isNotEmpty())
                              <button type="button" class="admin-notification-action js-admin-notifications-mark-all">Mark all as read</button>
                          @endif
                        </div>
                        @if ($adminNotifications->isEmpty())
                            <div class="admin-notification-empty">No recent activity yet.</div>
                        @else
                            <div class="admin-notification-list">
                                @foreach ($adminNotifications as $notification)
                                    <div class="admin-notification-item js-admin-notification-item" data-notification-id="{{ $notification['id'] }}">
                                        <span class="admin-notification-item__icon">
                                            <i class='bx {{ $notification['icon'] }}'></i>
                                        </span>
                                        <a href="{{ $notification['href'] }}" class="admin-notification-item__content js-admin-notification-link" data-notification-id="{{ $notification['id'] }}">
                                            <span class="admin-notification-item__title"><span class="admin-notification-item__dot"></span>{{ $notification['title'] }}</span>
                                            <span class="admin-notification-item__meta">{{ $notification['meta'] }}</span>
                                            <span class="admin-notification-item__time">{{ optional($notification['timestamp'])->diffForHumans() }}</span>
                                        </a>
                                        <button type="button" class="admin-notification-action js-admin-notification-mark-read" data-notification-id="{{ $notification['id'] }}">Mark as read</button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="admin-notification-menu__footer">
                            <a href="{{ Auth::user()->type == \UserType::SUPER_ADMIN ? url('/admin') : url('/dashboard') }}" class="admin-link">Open dashboard</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="admin-btn admin-btn--secondary" type="submit">Logout</button>
                            </form>
                        </div>
                      </div>
                    </div>
    
                  </div>
    
                  <!-- avatar button -->
                  <div class="relative" x-data="{ isOpen: false }">
                    <button @click="isOpen = !isOpen" class="">
                      <p class="rounded-full bg-gray-200 p-2">
                        <span class="text-gray-900 font-bold">
                          {!! \Illuminate\Support\Str::substr(Auth::user()->last_name, 0, 1) . \Illuminate\Support\Str::substr(Auth::user()->first_name, 0, 1) !!}
                        </span>
                      </p>
                    </button>
                   
    
                    <!-- Dropdown card -->
                    <div
                      @click.away="isOpen = false"
                      x-show.transition.opacity="isOpen"
                      class="absolute mt-1 transform -translate-x-full bg-white rounded-md shadow-lg min-w-max"
                    >
                      <div class="flex flex-col p-4 space-y-1 font-medium border-b">
                        <span class="text-gray-800">{{ (Auth::user()->last_name) }} {{ (Auth::user()->first_name) }}</span>
                        <span class="text-sm text-gray-400">{{ (Auth::user()->email) }}</span>
                      </div>
                      <div class="flex items-center justify-center hover:bg-gray-100 text-red-600 p-2 border-t">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="px-2 py-1 transition rounded-md" type="submit">Logout</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </header>
            <!-- Main content -->
            <main class="flex-1 max-h-full 
            overflow-hidden bg-gray-100 overflow-y-auto">

                @if (session('success'))
                    <div class=" mt-3 flex justify-center">
                        <div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 7000)"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-0"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-0"
                            class="bg-green-200 text-green-800 px-4 py-2 rounded-md text-lg flex items-center mx-auto w-3/4 xl:w-2/4">
                            <span class=" mx-auto"><i class='bx bxs-check-circle mr-2'></i>
                                {!! session('success') !!} </span>
                        </div>
                    </div>
                @endif
                @if (session('error'))
                    <div class="flex justify-center">
                        <div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 7000)"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-0"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-0"
                            class="bg-red-200 text-red-800 px-4 py-2 rounded-md text-lg flex items-center mx-auto w-3/4 xl:w-2/4">
                            <span class=" mx-auto"><i class='bx bxs-x-circle mr-2'></i> {!! session('error') !!}
                            </span>
                        </div>
                    </div>
                @endif
                @if (session('warning'))
                    <div class="flex justify-center">
                        <div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 7000)"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-0"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-0"
                            class="bg-orange-200 text-yellow-600 px-4 py-2 rounded-md text-lg flex items-center mx-auto w-3/4 xl:w-2/4">
                            <span class="mx-auto"><i class='bx bxs-error mr-2'></i>{!! session('warning') !!}
                            </span>
                        </div>
                    </div>
                @endif
                @if (session('info'))
                    <div class="flex justify-center">
                        <div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 7000)"
                            class="bg-blue-200 text-blue-600 px-4 py-2 rounded-md text-lg flex items-center mx-auto w-3/4 xl:w-2/4">
                            <span class="mx-auto"><i class='bx bxs-error mr-2'></i> {!! session('info') !!}
                            </span>
                        </div>
                    </div>
                @endif
              @yield('content')
            </main>

            <!-- Main footer -->
          {{-- <!-- Setting panel button -->
          <div>
            <button
              @click="isSettingsPanelOpen = true"
              class="fixed right-0 px-4 py-2 text-sm font-medium text-white uppercase transform rotate-90 translate-x-8 bg-blue-600 top-1/2 rounded-b-md"
            >
              Settings
            </button>
          </div>
    
          <!-- Settings panel -->
          <div
            x-show="isSettingsPanelOpen"
            @click.away="isSettingsPanelOpen = false"
            x-transition:enter="transition transform duration-300"
            x-transition:enter-start="translate-x-full opacity-30  ease-in"
            x-transition:enter-end="translate-x-0 opacity-100 ease-out"
            x-transition:leave="transition transform duration-300"
            x-transition:leave-start="translate-x-0 opacity-100 ease-out"
            x-transition:leave-end="translate-x-full opacity-0 ease-in"
            class="fixed inset-y-0 right-0 flex flex-col bg-white shadow-lg bg-opacity-20 w-80"
            style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"
          >
            <div class="flex items-center justify-between flex-shrink-0 p-2">
              <h6 class="p-2 text-lg">Settings</h6>
              <button @click="isSettingsPanelOpen = false" class="p-2 rounded-md focus:outline-none focus:ring">
                <svg
                  class="w-6 h-6 text-gray-600"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
            <div class="flex-1 max-h-full p-4 overflow-hidden hover:overflow-y-scroll">
              <span>Settings Content</span>
              <!-- Settings Panel Content ... -->
            </div>
          </div> --}}
        </div>

        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
          function APP() {
          }
      </script>
      <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
      <script>
        const setup = () => {
          return {
            loading: true,
            isSidebarOpen: false,
            toggleSidbarMenu() {
              this.isSidebarOpen = !this.isSidebarOpen
            },
            isSettingsPanelOpen: false,
            isSearchBoxOpen: false,
          }
        };

        const initAdminNotifications = () => {
          const toggle = document.querySelector('.js-admin-notification-toggle');
          if (!toggle) {
            return;
          }

          const storageKey = toggle.dataset.notificationStorageKey || 'eventms_admin_notifications_read';
          const readClass = 'admin-notification-item--read';

          const getReadMap = () => {
            try {
              return JSON.parse(window.localStorage.getItem(storageKey) || '{}');
            } catch (error) {
              return {};
            }
          };

          const setReadMap = (value) => {
            window.localStorage.setItem(storageKey, JSON.stringify(value));
          };

          const items = Array.from(document.querySelectorAll('.js-admin-notification-item'));
          const badge = document.querySelector('.js-admin-notification-badge');
          const markAllButton = document.querySelector('.js-admin-notifications-mark-all');

          const applyState = () => {
            const readMap = getReadMap();
            let unreadCount = 0;

            items.forEach((item) => {
              const notificationId = item.dataset.notificationId;
              const isRead = !!readMap[notificationId];
              const markButton = item.querySelector('.js-admin-notification-mark-read');

              item.classList.toggle(readClass, isRead);

              if (markButton) {
                markButton.disabled = isRead;
                markButton.textContent = isRead ? 'Read' : 'Mark as read';
              }

              if (!isRead) {
                unreadCount += 1;
              }
            });

            if (badge) {
              if (unreadCount > 0) {
                badge.hidden = false;
                badge.textContent = unreadCount > 9 ? '9+' : String(unreadCount);
              } else {
                badge.hidden = true;
              }
            }

            if (markAllButton) {
              markAllButton.disabled = unreadCount === 0;
            }
          };

          const markRead = (notificationId) => {
            const readMap = getReadMap();
            readMap[notificationId] = true;
            setReadMap(readMap);
            applyState();
          };

          items.forEach((item) => {
            const notificationId = item.dataset.notificationId;
            const markButton = item.querySelector('.js-admin-notification-mark-read');
            const link = item.querySelector('.js-admin-notification-link');

            if (markButton) {
              markButton.addEventListener('click', (event) => {
                event.preventDefault();
                markRead(notificationId);
              });
            }

            if (link) {
              link.addEventListener('click', () => {
                markRead(notificationId);
              });
            }
          });

          if (markAllButton) {
            markAllButton.addEventListener('click', () => {
              const readMap = getReadMap();
              items.forEach((item) => {
                readMap[item.dataset.notificationId] = true;
              });
              setReadMap(readMap);
              applyState();
            });
          }

          applyState();
        };

        document.addEventListener('DOMContentLoaded', initAdminNotifications);
      </script>
      @yield('scripts')
        {{-- @stack('inline-scripts')   --}}
</body>
</html>
