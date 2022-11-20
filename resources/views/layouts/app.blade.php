<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('docs/favicon.png') }}"> --}}

    
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    @yield('styles')
    @include('layouts.frontend.header')
</head>
<body class="bg-gray-50">
    <main class="mt-32 bg-gray-200">
        @yield('content')
    </main>
    @include('layouts.frontend.footer')

    <script src="{{URL::asset('js/script.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{URL::asset('js/bootstrap.js')}}"></script>
    <script src="{{URL::asset('js/app.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    @yield('scripts')
    @stack('inline-scripts')    
</body>
</html>