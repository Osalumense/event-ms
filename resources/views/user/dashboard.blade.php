@extends('admin.layouts.app')

@section('content')
    <div class="p-3">
        <div class="my-4">
            <a href="#">View Organizer Homepage</a>
        </div>
        <div class="grid grid-cols-1 gap-5 mt-6 sm:grid-cols-1 lg:grid-cols-4">
            <div
                class="min-w-0 transition-shadow border rounded-lg shadow-sm hover:shadow-lg overflow-hidden bg-white dark:bg-gray-800"
            >
                <div class="p-4 flex items-center">
                <div
                    class="p-3 rounded-full text-orange-500 dark:text-orange-100 bg-orange-100 dark:bg-orange-500 mr-4"
                >
                    <svg fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                        <path d="M11 12h6v6h-6z"></path><path d="M19 4h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm.001 16H5V8h14l.001 12z"></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total events created
                    </p>
                    <p class="text-lg font-semibold text-gray-700">
                        {{$total_events}}
                    </p>
                </div>
                </div>
            </div>
            <div
                class="min-w-0 transition-shadow border rounded-lg shadow-sm hover:shadow-lg overflow-hidden bg-white dark:bg-gray-800"
            >
                <div class="p-4 flex items-center">
                <div
                    class="p-3 rounded-full text-green-500 dark:text-green-100 bg-green-100 dark:bg-green-500 mr-4"
                >
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                    <path
                        fill-rule="evenodd"
                        d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                        clip-rule="evenodd"
                    ></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total Revenue
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    $ 26,760.89
                    </p>
                </div>
                </div>
            </div>
            <div
                class="min-w-0 transition-shadow border rounded-lg shadow-sm hover:shadow-lg overflow-hidden bg-white dark:bg-gray-800"
            >
                <div class="p-4 flex items-center">
                <div
                    class="p-3 rounded-full text-blue-500 dark:text-blue-100 bg-blue-100 dark:bg-blue-500 mr-4"
                >
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                    <path
                        d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
                    ></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total tickets sold
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    376,000
                    </p>
                </div>
                </div>
            </div>
            <div
                class="min-w-0 transition-shadow border rounded-lg shadow-sm hover:shadow-lg overflow-hidden bg-white dark:bg-gray-800"
            >
                <div class="p-4 flex items-center">
                <div
                    class="p-3 rounded-full text-teal-500 dark:text-teal-100 bg-teal-100 dark:bg-teal-500 mr-4"
                >
                    <svg fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                        <path d="M11 12h6v6h-6z"></path><path d="M19 4h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm.001 16H5V8h14l.001 12z"></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total attendees
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">234</p>
                </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-5 mt-6 sm:grid-cols-1 lg:grid-cols-3">
            <div class="col-span-2 bg-white p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg text-gray-500">
                <h4 class="text-lg font-semibold  mb-3">Recently created events</h4>
                <hr/>
                @foreach ($recently_added_events as $recent_events)
                <div class="flex justify-between py-3">
                    <p>{{$recent_events['title']}}</p>
                    <span class="bg-indigo-50 text-indigo-700 p-2 rounded-full">{{$recent_events['start_date']}}</span>
                </div>
                <hr/>
                @endforeach
            </div>
            <div class="col-span-1 bg-white p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
            </div>
        </div>
    </div>
        
@endsection