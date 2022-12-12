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
            <style>
                [x-cloak], #modal {
                    display: none;
                }
            </style>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" defer></script>
                <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>  
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
                                    <div class="border-t-4 border-white w-24 mx-auto my-4 mb-6"></div>   
                                    <h2 class="font-sans text-2xl font-semibold text-gray-200 tracking-tight">Registration Page</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="relative block h-500">
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
                <div class="mt-6 flex justify-center">
                        @if ( \Carbon\Carbon::now() > $event['end_date'] )
                            <section class="relative py-24 bg-blueGray-200">
                                <h3 class="font-bold text-3xl py-2 text-gray-700">Registration Closed</h3>
                                <a href="{{url('/e/').'/'.$event['slug']}}" class="px-6 mt-5 py-2 bg-transparent outline-none border-2 border-indigo-400 rounded text-indigo-500 font-medium active:scale-95 hover:bg-indigo-600 hover:text-white hover:border-transparent focus:bg-indigo-600 focus:text-white focus:border-transparent focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 transition-colors duration-200 flex justify-center">Back to event</a>
                            </section>
                        @else
                            
                                @if(count($ticket) < 1)
                                    <section class="relative py-18 bg-blueGray-200">
                                        <div class="py-10 text-gray-700">
                                            <p class="font-bold text-3xl py-8">Registration to this event is free</p>
                                            <div class="flex justify-between py-10">
                                                <a href="{{url('/e/').'/'.$event['slug']}}" class="w-32 px-4 py-2 bg-transparent outline-none border-2 border-indigo-400 rounded text-indigo-500 text-center font-medium active:scale-95 hover:bg-indigo-600 hover:text-white hover:border-transparent focus:bg-indigo-600 focus:text-white focus:border-transparent focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 disabled:bg-gray-400/80 disabled:shadow-none disabled:cursor-not-allowed transition-colors duration-200">
                                                    Back
                                                </a>
                                                <button type="button" class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded shadow-sm text-center text-white bg-indigo-600 hover:bg-indigo-700 font-medium" onclick="modalHandler(true)">
                                                    Checkout
                                                </button>
                                            </div>
                                            
                                        </div>
                                    </section>
                                @else
                                <div class="w-full max-w-8xl flex flex-col lg:flex-row m-5 px-12">
                                    <div class="w-full lg:w-2/3 mx-8">
                                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 hidden">
                                                        id
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Ticket
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Price
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Quantity
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ticket as $ticket)
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                        <td class="px-6 py-4 hidden">
                                                            {{$ticket['id']}}
                                                        </td>
                                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                            {{$ticket['title']}}
                                                        </th>
                                                        <td class="px-6 py-4">
                                                            {{$ticket['price']}}
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <div class="qty">
                                                                <button class="btn-minus incDecQty w-10 h-10 rounded-md bg-indigo-500 text-white">
                                                                    <i class='bx bx-minus'></i>
                                                                </button>
                                                                <input type="text" class="w-10 h-10 text-center" value="0" id="updateQty">
                                                                <button class="btn-plus incDecQty w-10 h-10 rounded-md bg-indigo-500 text-white">
                                                                    <i class='bx bx-plus'></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="w-full lg:w-1/3 bg-gray-100 flex flex-col lg:px-8 md:px-7 px-4 py-6 justify-between overflow-y-auto">
                                        <div>
                                            <p class="lg:text-3xl text-2xl font-bold leading-9 text-gray-800 dark:text-white">Summary</p>
                                            <div class="flex items-center justify-between pt-16">
                                              <p class="text-base leading-none text-gray-800 dark:text-white">Subtotal:</p>
                                              <p class="text-base leading-none text-gray-800 dark:text-white" id="subtotal_div"></p>
                                            </div>
                                            <div class="flex items-center justify-between pt-5">
                                              <p class="text-base leading-none text-gray-800 dark:text-white">Fees:</p>
                                              <p class="text-base leading-none text-gray-800 dark:text-white" id="fees"></p>
                                            </div>
                                            {{-- <div class="flex items-center justify-between pt-5">
                                              <p class="text-base leading-none text-gray-800 dark:text-white">Tax</p>
                                              <p class="text-base leading-none text-gray-800 dark:text-white"></p>
                                            </div> --}}
                                          </div>
                                          <div>
                                            <div class="flex items-center pb-6 justify-between lg:pt-5 pt-20">
                                              <p class="text-2xl leading-normal text-gray-800 dark:text-white">Total</p>
                                              <p class="text-2xl font-bold leading-normal text-right text-gray-800 dark:text-white" id="total"></p>
                                            </div>
                                            <button onclick="checkoutHandler1(true)" class="text-base leading-none rounded-md w-full py-5 bg-indigo-800 border-indigo-800 border focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 text-white dark:hover:bg-indigo-700">Checkout</button>
                                          </div>
                                    </div>

                                </div>
                                @endif
                            
                        @endif
                    </div>
                    <div class="py-12 bg-gray-700 bg-opacity-50 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0 overflow-y-scroll" id="modal">
                        <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-2xl ">
                            <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
                                <div class="w-full flex justify-between items-center text-gray-600 mb-3">
                                    <h1 class="text-gray-800 text-2xl font-bold leading-tight mb-2">Contact information</h1>
                                    <button class="focus:outline-none rounded-full text-gray-500 " onclick="modalHandler()"><i
                                        class='bx bx-x-circle bx-md'></i>
                                    </button>
                                </div>
                                
                                <form id="register_event_form" method="POST" action="{{url('/event/attendees')}}" enctype="multipart/form-data">
                                    @csrf
                                    {{-- <input name="ticket_id" id="ticket_id" value=""/> --}}
                                    <input name="event_id" id="event_id" value="{{$event['id']}}" hidden/>
                                    <div>
                                        <label for="first_name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">First Name</label>
                                        <input name="first_name" id="first_name" class="mt-2 p-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="John" />
                                        <div class="mb-3">
                                            @error('first_name')
                                                <span class="invalid-feedback text-red-500" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label for="last_name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">First Name</label>
                                        <input name="last_name" id="first_name" class="mt-2 p-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="Doe" />
                                        <div class="mb-3">
                                            @error('last_name')
                                                <span class="invalid-feedback text-red-500" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label for="email" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Email</label>
                                        <input name="email" type="email" id="first_name" class="mt-2 p-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="johndoe@gmail.com" />
                                        <div class="mb-3">
                                            @error('email')
                                                <span class="invalid-feedback text-red-500" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end w-full">
                                        <button type="submit" class="w-32 py-3 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 text-sm" id="save_registration">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                {{-- <section class="relative py-16 bg-blueGray-200">
                    <div class="container mx-auto md:px-2">
                        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg">
                         <div class="">
                            <div class="mt-10 py-10 border-gray-200 flex flex-col justify-center">
                                <div class="w-full flex flex-col space-y-4 justify-center text-center mx-auto px-5">
                                    <div>
                                        <div x-data="app()" x-cloak>
                                            <div class="w-full mx-auto px-4 py-10">
                                                <div x-show.transition="step === 'complete'">
                                                    <div class="bg-white rounded-lg p-10 flex items-center shadow justify-between">
                                                        <div>
                                                            <svg class="mb-4 h-20 w-20 text-indigo-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>

                                                            <h2 class="text-2xl mb-4 text-gray-800 text-center font-bold">Registration Success</h2>

                                                            <div class="text-gray-600 mb-8">
                                                                Thank you. We have sent you an email to demo@demo.test. Please click the link in the message to activate your account.
                                                            </div>

                                                            <button
                                                                @click="step = 1"
                                                                class="w-40 block mx-auto focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" 
                                                            >Back to home</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div x-show.transition="step != 'complete'" >	
                                                    <!-- Top Navigation -->
                                                    <div class="border-b-2 py-4 flex justify-between">
                                                        <div class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight" x-text="`Step: ${step} of 3`"></div>
                                                        <div class="flex-1">
                                                            <div x-show="step === 1">
                                                                <div class="text-lg font-bold text-gray-700 leading-tight">My Information</div>
                                                            </div>
                                                            
                                                            <div x-show="step === 2">
                                                                <div class="text-lg font-bold text-gray-700 leading-tight">Tickets</div>
                                                            </div>

                                                            <div x-show="step === 3">
                                                                <div class="text-lg font-bold text-gray-700 leading-tight">Checkout</div>
                                                            </div>
                                                        </div>
                                                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                                            <div class="flex items-center md:w-64">
                                                                <div class="w-full bg-white rounded-full mr-2">
                                                                    <div class="rounded-full bg-indigo-500 text-xs leading-none h-2 text-center text-white" :style="'width: '+ parseInt(step / 3 * 100) +'%'"></div>
                                                                </div>
                                                                <div class="text-xs w-10 text-gray-600" x-text="parseInt(step / 3 * 100) +'%'"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Top Navigation -->

                                                    <!-- Step Content -->
                                                    <div class="py-10">
                                                        <form id="registration_form">
                                                            <div class="form-section">
                                                                <div x-show.transition.in="step === 1">
                                                                    <div class="mb-5">
                                                                        <input type="text" name="id" value="{{$event['id']}}" hidden>
                                                                        <div x-data="{ first_name: '' }">
                                                                            <label for="first_name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal flex justify-start">First Name</label>
                                                                            <input x-model="first_name" name="first_name" id="first_name" class="mt-2 p-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-semibold w-full md:w-2/5 h-10 flex  text-sm border-gray-300 rounded border" placeholder="John Doe" />
                                                                            
                                                                            <div class="mb-3">
                                                                                @error('first_name')
                                                                                    <span class="invalid-feedback text-red-500" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div x-data="{ last_name: '' }">
                                                                            <label for="last_name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal flex justify-start">Last Name</label>
                                                                            <input x-model="last_name" name="last_name" id="last_name" class="mt-2 p-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-semibold w-full md:w-2/5 h-10 flex text-sm border-gray-300 rounded border" placeholder="John Doe" />
                                                                            <span x-text="last_name">
                                                                            <div class="mb-3">
                                                                                @error('last_name')
                                                                                    <span class="invalid-feedback text-red-500" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div x-data="{ email: '' }">
                                                                            <label for="email" class="text-gray-800 text-sm font-bold leading-tight tracking-normal flex justify-start">Email</label>
                                                                            <input x-model="email" name="email" id="email" class="mt-2 p-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-semibold w-full md:w-2/5 h-10 flex text-sm border-gray-300 rounded border" placeholder="johndoe@gmail.com" type="email">
                                                                            <span x-text="email">
                                                                            <div class="mb-3">
                                                                                @error('email')
                                                                                    <span class="invalid-feedback text-red-500" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-section">
                                                                <div x-show.transition.in="step === 2">
                                                                    <div class="mb-5">
                                                                            <div class="flex flex-wrap justify-center">
                                                                                @if(count($ticket) < 1)
                                                                                    <div>
                                                                                        <p class="font-semibold text-lg">Registration to this event is free</p>
                                                                                    </div>
                                                                                @endif
                                                                                @foreach($ticket as $ticket)
                                                                                    {{-- <div class="w-full md:w-1/2 lg:w-1/3 p-5 my-2">
                                                                                        <div class="bg-white font-semibold text-center rounded-md border shadow-lg p-10">
                                                                                            <p class="tracking-wide text-lg font-bold text-gray-700"> {{$ticket['title']}} </p>
                                                                                            <p class="text-sm text-gray-700">Price: {{$ticket['price']}}  </p>
                                                                                            @if($ticket['quantity_available'] > 0)
                                                                                                <p class="text-sm text-gray-700 mt-4">Quantity available: {{$ticket['quantity_available']}} </p>
                                                                                            @endif
                                                                                            <div class="flex items-center justify-center w-full my-3">
                                                                                                <button type="button" class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-600 mr-3 bg-indigo-600 transition duration-150 text-white ease-in-out hover:border-indigo-700 hover:bg-indigo-700 border rounded-md px-8 py-2 text-sm select_ticket" id="{{$ticket['id']}}">Purchase</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div> 
                                                                                    <ul>
                                                                                        <li>
                                                                                            
                                                                                        </li>
                                                                                    </ul>
                                                                                @endforeach
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-section">
                                                                <div x-show.transition.in="step === 3">
                                                                    <div class="mb-5 flex flex-col-reverse md:flex-row">
                                                                        @if(count($ticket) < 1)
                                                                            <div>
                                                                                <p class="font-semibold text-lg">Registration to this event is free</p>
                                                                            </div>
                                                                        @else
                                                                            <div class="w-full md:w-3/5 p-4">
                                                                                <div class="overflow-x-auto">
                                                                                    <table class="table-auto w-full" id="checkout_tbl">
                                                                                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                                                                        <tr>
                                                                                            <th class="hidden">
                                                                                                id
                                                                                            </th>
                                                                                            <th
                                                                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                                                                Ticket
                                                                                            </th>
                                                                                            <th
                                                                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                                                                Price
                                                                                            </th>
                                                                                            <th
                                                                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                                                                Quantity
                                                                                            </th>
                                                                                            <th
                                                                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                                                                Subtotal
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody id="checkout_tbl_body">
                                                                                        <tr>
                                                                                            <td></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                </div>
                                                                            </div>
                                                                            <div class="w-full md:w-2/5 p-4 bg-gray-50">
                                                                                <p class="text-xl tracking-normal font-leading font-bold">Order Summary</p>
                                                                                <div class="flex justify-between mt-5 p-2 md:p-8 text-md">
                                                                                    <p>Subtotal: </p>
                                                                                    <p id="subtotal">8000 </p>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- / Step Content -->
                                                </div>
                                            </div>

                                            <!-- Bottom Navigation -->	
                                            
                                            <div class="w-full flex justify-between">
                                                <div class="">
                                                    <button type="button"
                                                        x-show="step > 1"
                                                        @click="step--"
                                                        class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border previous" 
                                                    >Previous</>
                                                </div>

                                                <div class="text-right">
                                                    <button type="button"
                                                        x-show="step < 3"
                                                        @click="step++"
                                                        class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-indigo-500 hover:bg-indigo-600 font-medium next" 
                                                    >Next</button>

                                                    <button type="button"
                                                        @click="step = 'complete'"
                                                        x-show="step === 3"
                                                        class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-indigo-500 hover:bg-indigo-600 font-medium" 
                                                    >Checkout</button>
                                                </div>
                                            </div>
                                            <!-- / Bottom Navigation https://placehold.co/300x300/e2e8f0/cccccc -->	
                                        </div>


                                </div>
                               
                            </div>
                        </div>
                    </div>
                </section> --}}
            </main>
        
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

    <script>
        $('.qty button').on('click', function () {
            let $button = $(this);
            let oldValue = $button.parent().find('input').val();
            if ($button.hasClass('btn-plus')) {
                let newVal = parseFloat(oldValue) + 1;
            } else {
                if (oldValue >= 0) {
                    if (oldValue == 0) {
                        let newVal = 0;
                    } else {
                        let newVal = parseFloat(oldValue) - 1;
                    }
                } else {
                    newVal = 0;
                }
            }
            $button.parent().find('input').val(newVal);
        });


        let modal = document.getElementById("modal");
        function modalHandler(val) {
            if (val) {
                fadeIn(modal);
            } else {
                fadeOut(modal);
            }
        }
        function fadeOut(el) {
            el.style.opacity = 1;
            (function fade() {
                if ((el.style.opacity -= 0.1) < 0) {
                    el.style.display = "none";
                } else {
                    requestAnimationFrame(fade);
                }
            })();
        }
        function fadeIn(el, display) {
            el.style.opacity = 0;
            el.style.display = display || "flex";
            (function fade() {
                let val = parseFloat(el.style.opacity);
                if (!((val += 0.2) > 1)) {
                    el.style.opacity = val;
                    requestAnimationFrame(fade);
                }
            })();
        }    
    </script>
    {{-- <script>
        $('.select_ticket').on('click', function() {
            let id = $(this).attr('id');
            $.ajax({
                url : '/tickets/get/'+id,
                dataType : 'json',
                success : function (response) {
                    $('#checkout_tbl_body').after('<tr><td class="hidden">'+id+'</td><td>'+response.ticket.title+'</td><td>'+response.ticket.price+'</td><td>'+response.ticket.title+'</td><td>'+response.ticket.price+'</td></tr>');
                }
            });
            
            console.log('Getting set to add');
        });
        // $('.')
    </script> --}}
    