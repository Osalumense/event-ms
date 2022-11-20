@extends('layouts.app')
@section('content')
    <section class="py-20 bg-white">
        <div class="flex flex-col px-8 mx-auto space-y-12 max-w-7xl xl:px-12">
            <div class="relative">
                <h2 class="w-full text-3xl font-bold text-center sm:text-4xl md:text-5xl"> Manage events like a pro</h2>
                <p class="w-full py-8 mx-auto -mt-2 text-lg text-center text-gray-700 intro sm:max-w-3xl">{{config('app.name')}} allows you create a simple event website, set up custom registration processes, manage attendees, payments, tickets and badges.</p>
            </div>
            <div class="flex flex-col mb-8 animated fadeIn sm:flex-row">
                <div class="flex items-center mb-8 sm:w-1/2 md:w-5/12 sm:order-last">
                    <img class="rounded-lg shadow-xl" src="https://cdn.devdojo.com/images/december2020/dashboard-011.png" alt="">
                </div>
                <div class="flex flex-col justify-center mt-5 mb-8 md:mt-0 sm:w-1/2 md:w-7/12 sm:pr-16">
                    <p class="mb-2 text-sm font-semibold leading-none text-left text-indigo-600 uppercase">Intuitive User Interface</p>
                    <h3 class="mt-2 text-2xl sm:text-left md:text-4xl">Simple dashboard without unnecessary details</h3>
                    <p class="mt-5 text-lg text-gray-700 text md:text-left">Creating your event shouldn't be too complex, setup your event, create tickets and make it open for registrations.</p>
                </div>
            </div>
            <div class="flex flex-col mb-8 animated fadeIn sm:flex-row">
                <div class="flex items-center mb-8 sm:w-1/2 md:w-5/12">
                    <img class="rounded-lg shadow-xl" src="https://cdn.devdojo.com/images/december2020/dashboard-04.png" alt="">
                </div>
                <div class="flex flex-col justify-center mt-5 mb-8 md:mt-0 sm:w-1/2 md:w-7/12 sm:pl-16">
                    <p class="mb-2 text-sm font-semibold leading-none text-left text-indigo-600 uppercase">Collect payments</p>
                    <h3 class="mt-2 text-2xl sm:text-left md:text-4xl">Create a paid event with differnt access levels</h3>
                    <p class="mt-5 text-lg text-gray-700 text md:text-left">Accept payments easily for your event by creating tickets for different access levels.</p>
                </div>
            </div>
            <div class="flex flex-col mb-8 animated fadeIn sm:flex-row">
                <div class="flex items-center mb-8 sm:w-1/2 md:w-5/12 sm:order-last">
                    <img class="rounded-lg shadow-xl" src="https://cdn.devdojo.com/images/december2020/dashboard-03.png" alt="">
                </div>
                <div class="flex flex-col justify-center mt-5 mb-8 md:mt-0 sm:w-1/2 md:w-7/12 sm:pr-16">
                    <p class="mb-2 text-sm font-semibold leading-none text-left text-indigo-600 uppercase">Easy to customize</p>
                    <h3 class="mt-2 text-2xl sm:text-left md:text-4xl">Make It Your Own</h3>
                    <p class="mt-5 text-lg text-gray-700 text md:text-left">Customize your event page and setup your registration process.</p>
                </div>
            </div>

        </div>
    </section>
@endsection