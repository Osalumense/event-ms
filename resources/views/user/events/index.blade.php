@extends('admin.layouts.app')

@section('content')
<style>
    #modal {
        display:none;
    }
</style>


<div class="flex justify-between my-2 bg-white p-4" >
    <button type="button" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-2 py-2 text-xs sm:text-sm text-center inline-flex items-center" onclick="modalHandler(true)">
        <span class="text-2xl text-gray-100 border-gray-100 inline-flex items-center">
            <i class='inline-flex items-center bx bx-plus bx-sm'></i>
        </span>
        <div class="text-md">
            Create Event
        </div>
    </button>

    <div class="bg-white rounded flex items-center w-full max-w-xl mr-4 p-2 shadow-sm border border-gray-200">
        <input type="search" name="" id="" placeholder="Search events" class="w-full pl-3 text-sm text-black outline-none focus:outline-none bg-transparent" />
        <button class="outline-none focus:outline-none">
            <svg class="w-5 text-gray-600 h-5 cursor-pointer" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </button>
    </div>    
</div>

<div>
    @foreach ($userEvents as $userEvents)
        <div class="my-4 mx-3 flex flex-row items-center">
        <div class="items-center justify-center">
            <div class="w-full py-6 px-3">
                <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                    <div class="bg-cover bg-center h-56 p-4" style="background-image: url(https://images.unsplash.com/photo-1475855581690-80accde3ae2b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80)">
                        {{-- <div class="flex justify-end">
                            <svg class="h-6 w-6 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12.76 3.76a6 6 0 0 1 8.48 8.48l-8.53 8.54a1 1 0 0 1-1.42 0l-8.53-8.54a6 6 0 0 1 8.48-8.48l.76.75.76-.75zm7.07 7.07a4 4 0 1 0-5.66-5.66l-1.46 1.47a1 1 0 0 1-1.42 0L9.83 5.17a4 4 0 1 0-5.66 5.66L12 18.66l7.83-7.83z"></path>
                            </svg>
                        </div> --}}
                    </div>
                    <div class="p-4">
                        <p class="uppercase tracking-wide text-sm font-bold text-gray-700">{{$userEvents['title']}} </p>
                        {{-- <p class="text-3xl text-gray-900">$750,000</p> --}}
                        <p class="text-gray-700">{{$userEvents['description']}}</p>
                    </div>
                    <div class="flex p-4 border-t border-gray-300 text-gray-700">
                        <div class="flex-1 inline-flex items-center">
                            <span class="mr-2">
                                <i class='bx bxs-barcode bx-sm' ></i>
                            </span>
                            <p><span class="text-gray-900 text-lg font-bold"></span>0 Tickets</p>
                        </div>
                    </div>
                    <div class="px-4 pt-3 pb-4 border-t border-gray-300 bg-gray-100">
                        <div class="text-xs uppercase font-bold text-gray-600 tracking-wide"> Hosted by {{ Auth::user()->first_name}}</div>
                        <div class="flex items-center pt-2">
                            <div class="bg-cover bg-center w-10 h-10 rounded-full mr-3" style="background-image: url(https://images.unsplash.com/photo-1500522144261-ea64433bbe27?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=751&q=80)">
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">{{$userEvents['location_address']}}</p>
                                <p class="text-sm text-gray-700">{{$userEvents['location_address']}}</p>
                                <p class="text-sm text-gray-700">{{$userEvents['location_address_line_1']}}, {{$userEvents['location_state']}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end w-full my-3">
                        <button class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 mr-3 bg-indigo-400 transition duration-150 text-white ease-in-out hover:border-indigo-400 hover:bg-indigo-300 border rounded px-8 py-2 text-sm">Edit</button>
                        <button class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 mr-3 bg-red-400 transition duration-150 text-white ease-in-out hover:border-red-400 hover:bg-red-300 border rounded px-8 py-2 text-sm">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="py-12 bg-gray-700 bg-opacity-50 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0" id="modal">
    <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-xl overflow-y-scroll">
        <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
            <div class="w-full flex justify-between items-center text-gray-600 mb-3">
                <h1 class="text-gray-800 text-2xl font-bold leading-tight mb-2">Create Event</h1>
                <button class="focus:outline-none p-2 text-red-400" onclick="modalHandler()"><i
                    class='bx bx-x-circle bx-sm'></i>
                </button>
            </div>
            
            <form method="POST" action="{{url('/events')}}">
                @csrf
                <label for="title" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Event Name</label>
                <input name="title" class="mb-5 mt-2 p-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="John Doe" />
                <label for="description" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Event Description</label>
                <textarea rows="4" name="description" class="mb-5 mt-2 p-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-auto flex items-center text-sm border-gray-300 rounded border"></textarea>
                <div class="w-full flex justify-between flex-row">
                    <div class="flex flex-col">
                        <label for="start_date" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Start date:</label>
                        <input type="datetime" name="start_date" class="mb-5 p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-auto flex items-center text-sm border-gray-300 rounded border" placeholder="2022-09-28 07:30">
                    </div>
                    <div class="flex flex-col">
                        <label for="end_date" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">End date:</label>
                        <input type="datetime" name="end_date" class="mb-5 p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-auto flex items-center text-sm border-gray-300 rounded border" placeholder="2022-09-28 07:30">
                    </div>
                </div>
                <label for="location_address" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Venue Name</label>
                <input name="location_address" class="mb-5 p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="The event center" />
                <label for="location_address_line_1" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Address Line 1</label>
                <input name="location_address_line_1" class="mb-5 p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="2, Newton Street" />  
                <label for="location_address_line_2" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Address Line 2</label>
                <input name="location_address_line_2" class="mb-5 p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="Abuja Nigeria" />            
                <div class="w-full flex justify-between flex-row">
                    <div class="flex flex-col">
                        <label for="location_state" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">City:</label>
                        <input type="text" name="location_state" class="mb-5 p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="Abuja">
                    </div>
                    <div class="flex flex-col">
                        <label for="location_post_code" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Post Code:</label>
                        <input type="text" name="location_post_code" class="mb-5 mt-2 p-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="901101">
                    </div>
                </div>
                <div class="flex items-center justify-end w-full">
                    <button class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm" id="save_event">Submit</button>
                </div>
            </form>
            {{-- <div class="flex items-center justify-end w-full">
                <button class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 mr-3 bg-red-400 transition duration-150 text-white ease-in-out hover:border-red-400 hover:bg-red-300 border rounded px-8 py-2 text-sm" onclick="modalHandler()">Cancel</button>
            </div> --}}
        </div>
    </div>
</div>
<script>
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
@endsection