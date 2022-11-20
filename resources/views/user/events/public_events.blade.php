<!DOCTYPE html>
<html lang="en">
    @if(count($event) > 0)
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <link rel="shortcut icon" type="image/x-icon" 
            href="
            @if($event['bg_image_path'])
                src="{{asset('images/events').'/'.$event['bg_image_path']}}"
            @else
                src="https://images.pexels.com/photos/3747463/pexels-photo-3747463.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260" 
            @endif>    
            <title>{{$event['title'] . ' - ' . config('app.name', 'Laravel') }}</title>
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
            <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
            <link rel="stylesheet" href="{{mix('css/app.css')}}">
        
        <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">      
        </head>
        <body class="bg-gray-50">
            <main class="profile-page">
                <div class="relative">
                    <img 
                        @if($event['bg_image_path'])
                            src="{{asset('images/events').'/'.$event['bg_image_path']}}"
                        @else
                            src="https://images.pexels.com/photos/3747463/pexels-photo-3747463.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260" 
                        @endif
                        class="absolute inset-0 object-cover w-full h-full" alt="" />                 
                    <div class="relative bg-gray-900 bg-opacity-75">
                    <div class="px-4 py-16 mx-auto lg:px-8 lg:py-20">
                        <div class="flex flex-col items-center justify-center mx-auto text-center">
                        <div class="w-full mb-12">
                            <h2 class="mb-6 font-sans text-3xl font-bold tracking-tight text-white sm:text-4xl md:text-5xl sm:leading-none uppercase">
                                {{$event['title']}}
                            </h2>
                            <div class="border-t-4 border-white w-24 mx-auto my-4 mb-12"></div>
                            @if ( \Carbon\Carbon::now() > $event['end_date'] )
                                <button type="button" class="px-6 mt-8 py-2 bg-gray-400 outline-none border-2 border-indigo-600 rounded text-indigo-600 font-medium active:scale-95 focus:bg-indigo-700 focus:text-white focus:border-transparent focus:ring-2 focus:ring-indigo-700 focus:ring-offset-2 transition-colors duration-200 cursor-not-allowed" disabled>Registration closed</button>
                            @else
                                <a href="{{url('/e/').'/'.$event['slug']}}/register" class="px-6 mt-8 py-2 bg-transparent outline-none border-2 border-indigo-600 rounded text-indigo-600 font-medium active:scale-95 hover:bg-indigo-700 hover:text-white hover:border-transparent focus:bg-indigo-700 focus:text-white focus:border-transparent focus:ring-2 focus:ring-indigo-700 focus:ring-offset-2 transition-colors duration-200">Register</a>
                            @endif
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <section class="relative block h-500-px">
                    <div class="absolute top-0 w-full h-full bg-center bg-cover"
                        @if($event['bg_image_path'])
                            style="background-image: url('/images/events/{{$event['bg_image_path']}}');"
                        @else
                            style="background-image: url('https://images.unsplash.com/photo-1499336315816-097655dcfbda?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=2710&amp;q=80');"
                        @endif
                    >
                    <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-black"></span>
                    </div>
                    <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px" style="transform: translateZ(0px)">
                    <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                        <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
                    </svg>
                    </div>
                </section>
                <section class="relative py-16 bg-blueGray-200">
                    <div class="container mx-auto md:px-2">
                        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg">
                         <div class="">
                            <div class="text-center mt-12">
                                @if($event['location_address'])
                                    <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-semibold uppercase">
                                    <i class="fas fa-map-marker-alt mr-2 text-lg text-blueGray-400"></i>
                                        {{$event['location_address']}}, {{$event['location_address']}},  {{$event['location_state']}}
                                    </div>
                                @endif
                                <div class="mb-2 font-semibold text-blueGray-600 mt-2">
                                <i class="fas fa-clock mr-2 text-lg text-blueGray-400"></i> {{date('D, d-M-Y h:i:s', strtotime($event['start_date'])) . ' - ' . date('D, d-M-Y h:i:s', strtotime($event['end_date'])) }}
                                </div>
                            </div>
                            <div class="mt-10 py-10 border-t-2 border-gray-200 flex flex-col justify-center">
                                <div class="flex flex-col space-y-4 justify-center text-center mx-auto px-5">
                                    <div class="w-full px-4">
                                        <p class="mb-4 text-lg leading-relaxed text-blueGray-700">
                                            {!!$event['description']!!}
                                        </p>
                                    </div>
                                    
                                </div>
                                <div class="mt-6 flex justify-center border-t-2 border-gray-200">
                                    @if ( \Carbon\Carbon::now() > $event['end_date'] )
                                        <button type="button" class="px-6 mt-5 py-2 bg-gray-300 outline-none border-2 border-indigo-400 rounded text-indigo-500 font-medium active:scale-95 focus:bg-indigo-600 focus:text-white focus:border-transparent focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 cursor-not-allowed transition-colors duration-200" disabled>Registration closed</button>
                                    @else
                                        <a href="{{url('/e/').'/'.$event['slug']}}/register" class="px-6 mt-5 py-2 bg-transparent outline-none border-2 border-indigo-400 rounded text-indigo-500 font-medium active:scale-95 hover:bg-indigo-600 hover:text-white hover:border-transparent focus:bg-indigo-600 focus:text-white focus:border-transparent focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 disabled:bg-gray-400/80 disabled:shadow-none disabled:cursor-not-allowed transition-colors duration-200">Register</a>
                                    @endif
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <section>
                <div class="p-6 mr-2 bg-gray-100 mx-auto text-center">
                    <p class="text-md tracking-wide font-semibold text-gray-600 dark:text-gray-400 mt-2"><span> 
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-gray-500 mr-2 inline-flex"><path d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5zM20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h17z"></path></svg>
                       </span>{{$user['first_name'] . ' ' . $user['last_name']}}</p>
                    <a href="mailto:{{$user['email']}}" class="text-md tracking-wide font-semibold text-gray-600 dark:text-gray-400 mt-2">
                        <span><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500 mr-2 inline-flex">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                          </svg>
                        </span>{{$user['email']}}</a>
                    </div>
            </section>
        
            <footer class="bg-gray-800">
                <div class="sm:flex sm:items-center sm:justify-center text-gray-400 px-5 m-auto pt-4">
                    
                </div>
                <div class="sm:flex sm:items-center sm:justify-between text-gray-400 px-5 m-auto py-8">
                    <span class="text-sm sm:text-center">© Copyright <?=date('Y');?> All Rights Reserved {{config('app.name')}}.
                    </span>
                    <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
                        <div class="order-1 md:order-2">
                            @if (Auth::user() && $user['account_id'] == Auth::user()->id)
                                    <a href="{{url('/events/').'/'.$event['slug']}}" class="px-2 border-l">Event Dashboard</a>
                            @endif
                            <a href="{{url('/dashboard')}}" class="px-2 border-l">Create an event</a>
                            <span class="px-2 border-l">Contact</span>
                            <span class="px-2 border-l border-r">Privacy Policy</span>
                        </div>
                    </div>
                </div>
            </footer>
        </body>
        </html>
    @else
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" type="image/x-icon" 
        href=""
        src="https://images.pexels.com/photos/3747463/pexels-photo-3747463.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260">    
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{mix('css/app.css')}}">
    </head>
    <body class="bg-gray-50">
        <main class="profile-page">
            <div class="relative">
                <img src="https://images.pexels.com/photos/3747463/pexels-photo-3747463.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260" class="absolute inset-0 object-cover w-full h-screen" alt="" />
                    
                <div class="relative bg-gray-900 bg-opacity-75 h-screen flex items-center">
                <div class="px-4 py-16 mx-auto lg:px-8 lg:py-20 bg-white rounded-md">
                    <div class="flex flex-col items-center justify-center mx-auto text-center">
                        <div class="w-full mb-12">
                            <h2 class="mb-6 font-sans text-3xl font-bold tracking-tight text-indigo-600 sm:text-4xl md:text-5xl sm:leading-none uppercase">
                                Event not found
                            </h2>
                            <div class="border-t-4 border-indigo-600 w-24 mx-auto my-4 mb-12"></div>
                            <a href="{{url('/')}}" class="px-6 mt-8 py-2 bg-transparent outline-none border-2 border-indigo-600 rounded text-indigo-600 font-medium active:scale-95 hover:bg-indigo-700 hover:text-white hover:border-transparent focus:bg-indigo-700 focus:text-white focus:border-transparent focus:ring-2 focus:ring-indigo-700 focus:ring-offset-2 transition-colors duration-200">Back to {{config('app.name', 'Laravel')}}</a>
                        </div>
                        <div class=" px-6 flex flex-col md:flex-row md:items-center text-gray-400">
                            <div
                                class="flex px-3 m-auto text-sm">© Copyright <?=date('Y');?> All Rights Reserved {{config('app.name')}}.
                            </div>
                            <div class="order-1 md:order-2">
                                <a href="{{url('/dashboard')}}" class="px-2">Create an event</a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </main>
    </body>
    </html>
    @endif

