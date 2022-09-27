@extends('admin.layouts.app')

@section('content')
<style>
    #modal {
        display:none;
    }
</style>


<div class="flex justify-between my-2 bg-white p-4" >
    <button type="button" class="text-white focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-2 py-2 text-xs sm:text-sm text-center inline-flex items-center" onclick="modalHandler(true)">
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

<div class="py-12 bg-gray-700 bg-opacity-50 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0" id="modal">
    <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
        <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
            <div class="w-full flex justify-start text-gray-600 mb-3">
                <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">Create Event</h1>
            </div>
            
            <label for="name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Event Name</label>
            <input id="name" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="James" />
            <label for="email2" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Event Description</label>
            <textarea rows="4" name="event_description"></textarea>
            <label for="expiry" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Start date:</label>
            <input type="datetime">
            <label for="cvc" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">CVC</label>
            <div class="relative mb-5 mt-2">
                <div class="absolute right-0 text-gray-600 flex items-center pr-3 h-full cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"></path>
                        <circle cx="12" cy="12" r="9"></circle>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        <polyline points="11 12 12 12 12 16 13 16"></polyline>
                    </svg>
                </div>
                <input id="cvc" class="mb-8 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="MM/YY" />
            </div>
            <div class="flex items-center justify-start w-full">
                <button class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm">Submit</button>
                <button class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm" onclick="modalHandler()">Cancel</button>
            </div>
            <button class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600" onclick="modalHandler()" aria-label="close modal" role="button">
                <svg  xmlns="http://www.w3.org/2000/svg"  class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
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