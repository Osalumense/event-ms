@extends('admin.layouts.app')

@section('content')
<style>
    #modal {
        display:none;
    }
</style>


<div class="flex justify-between my-2 bg-white p-4" >
    {{-- <button type="button" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-2 py-2 text-xs sm:text-sm text-center inline-flex items-center" onclick="modalHandler(true)">
        <span class="text-2xl text-gray-100 border-gray-100 inline-flex items-center">
            <i class='inline-flex items-center bx bx-plus bx-sm'></i>
        </span>
        <div class="text-md">
            Create Event
        </div>
    </button> --}}

    <a class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-2 py-2 text-xs sm:text-sm text-center inline-flex items-center" href="{{url('/events/create')}}">
        <span class="text-2xl text-gray-100 border-gray-100 inline-flex items-center">
            <i class='inline-flex items-center bx bx-plus bx-sm'></i>
        </span>
        <div class="text-md">
            Create Event
        </div>
    </a>

    <div class="bg-white rounded flex items-center w-full max-w-xl mr-4 p-2 shadow-sm border border-gray-200">
        <input type="search" name="" id="" placeholder="Search events" class="w-full pl-3 text-sm text-black outline-none focus:outline-none bg-transparent" />
        <button class="outline-none focus:outline-none">
            <svg class="w-5 text-gray-600 h-5 cursor-pointer" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </button>
    </div>    
</div>

<div class="flex flex-wrap">
    @foreach ($userEvents as $userEvents)
        <a href="{{url('/events/').'/'.$userEvents['slug']}}">
            <div class="w-full md:w-1/2 lg:w-1/3 p-5 my-2">
                <div class="bg-white transition-shadow shadow-lg hover:shadow-xl rounded-lg overflow-hidden">
                        <div class="bg-cover bg-center h-56 p-4"
                        style="background-image: 
                        @if($userEvents['bg_image_path'])
                            url('/images/events/{{$userEvents['bg_image_path']}}')
                        @else
                            url(https://images.unsplash.com/photo-1475855581690-80accde3ae2b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80)
                        @endif
                        ">
                            <div class="flex justify-end">
                                @if($userEvents['is_active'] == 0)
                                    <i class='bx bxs-circle text-red-600 bx-sm'></i>
                                @else
                                    <a class="text-green-600 flex items-center" target="_blank" href="{{url('/e/').'/'.$userEvents['slug']}}">View<i class='bx bx-link-external inline-flex items-center'></i></a>
                                @endif
                            </div>
                        </div>
                        <div class="p-4">
                            <p class="uppercase tracking-wide text-lg font-bold text-gray-700">{{$userEvents['title']}} </p>
                            <div class="h-12 overflow-hidden text-ellipsis">
                                <p class="text-gray-700">{!!$userEvents['description']!!}</p>
                            </div>                        
                        </div>
                        <div class="flex justify-between items-center p-4 border-t border-gray-300 text-gray-700">
                            <div class="flex-1 inline-flex items-end">
                                <span class="mr-2">
                                    <i class='bx bxs-barcode bx-sm' ></i>
                                </span>
                                <p><span class="text-gray-900 text-lg font-bold"></span>0 Tickets</p>
                            </div>
                            <div class="items-center">
                                @if($userEvents['is_active'] == 0)
                                    <button class="text-indigo-400 rounded-md border-2 border-indigo-400 button px-2 py-1 publish_event" id="{{$userEvents['id']}}">Publish now</button>
                                @else
                                    <p class="text-green-400 rounded-md bg-green-100 px-2 py-1">Live</p>
                                @endif
                                
                            </div>
                        </div>
                        <div class="px-4 pt-3 pb-4 border-t border-gray-300 bg-gray-100">
                            <div class="text-xs uppercase font-bold text-gray-600 tracking-wide"> Hosted by {{ Auth::user()->first_name}}</div>
                            <div class="flex items-center pt-2">
                                <div>
                                    <p class="font-bold text-gray-900">{{$userEvents['location_address']}}</p>
                                    <p class="text-sm text-gray-700 flex items-center"><span><i class='bx bxs-map mr-1'></i></span> {{$userEvents['location_address_line_1']}}, {{$userEvents['location_state']}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end w-full my-3">
                            <a href="{{url('/events/').'/'.$userEvents['slug']}}" class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 mr-3 bg-indigo-600 transition duration-150 text-white ease-in-out hover:border-indigo-700 hover:bg-indigo-700 border rounded px-8 py-2 text-sm">View</a>
                            <button class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-600 mr-3 bg-red-600 transition duration-150 text-white ease-in-out hover:border-red-700 hover:bg-red-700 border rounded px-8 py-2 text-sm delete_event" id="{{$userEvents['id']}}">Delete</button>
                        </div>
                </div>
            </div>
        </a>
    @endforeach
</div>

{{-- <div class="py-12 bg-gray-700 bg-opacity-50 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0 overflow-y-scroll" id="modal">
    <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-2xl ">
        <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
            <div class="w-full flex justify-between items-center text-gray-600 mb-3">
                <h1 class="text-gray-800 text-2xl font-bold leading-tight mb-2">Create Event</h1>
                <button class="focus:outline-none p-2 text-red-400" onclick="modalHandler()"><i
                    class='bx bx-x-circle bx-sm'></i>
                </button>
            </div>
            
            <form id="create_event_form" method="POST" action="{{url('/events')}}" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="title" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Event Name</label>
                    <input name="title" id="title" class="mt-2 p-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="John Doe" />
                    <div class="mb-3">
                        @error('title')
                            <span class="invalid-feedback text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div>
                    <label for="description" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Event Description</label>
                    <textarea id="description" name="description" class="editor mt-2 p-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-auto flex items-center text-sm border-gray-300 rounded border"></textarea>
                    <div class="mb-3">
                        @error('description')
                            <span class="invalid-feedback text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                
                <div class="w-full mt-4 flex justify-between flex-row">
                    <div class="flex flex-col">
                        <label for="start_date" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Start date:</label>
                        <input type="datetime" id="start_date" name="start_date" class="p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-auto flex items-center text-sm border-gray-300 rounded border start_date" placeholder="2022-09-28 07:30">
                        <div class="mb-3">
                            @error('start_date')
                                <span class="invalid-feedback text-red-500" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label for="end_date" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">End date:</label>
                        <input type="datetime" name="end_date" id="end_date" class="p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-auto flex items-center text-sm border-gray-300 rounded border end_date" placeholder="2022-09-28 07:30">
                        <div class="mb-3">
                            @error('end_date')
                                <span class="invalid-feedback text-red-500" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <label for="location_address" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Venue Name</label>
                    <input name="location_address" id="location_address" class="p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="The event center" />
                    <div class="mb-3">
                        @error('location_address')
                            <span class="invalid-feedback text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div>
                    <label for="location_address_line_1" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Address Line 1</label>
                    <input name="location_address_line_1" id="location_address_line_1" class="p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="2, Newton Street" />
                    <div class="mb-3">
                        @error('location_address_line_1')
                            <span class="invalid-feedback text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                  
                <div>
                    <label for="location_address_line_2" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Address Line 2</label>
                    <input name="location_address_line_2" id="location_address_line_2" class="p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="Abuja Nigeria" />
                    <div class="mb-3">
                        @error('location_address_line_2')
                            <span class="invalid-feedback text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                            
                <div class="w-full flex justify-between flex-row">
                    <div class="flex flex-col w-3/4">
                        <label for="location_state" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">City:</label>
                        <input type="text" name="location_state" id="location_state" class="p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="Abuja">
                        <div class="mb-3">
                            @error('location_state')
                                <span class="invalid-feedback text-red-500" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-col w-3/4">
                        <label for="location_post_code" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Post Code:</label>
                        <input type="text" id="location_post_code" name="location_post_code" class="mt-2 p-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="901101">
                        <div class="mb-3">
                            @error('location_post_code')
                                <span class="invalid-feedback text-red-500" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end w-full">
                    <button class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 mr-3 bg-red-400 transition duration-150 text-white ease-in-out hover:border-red-400 hover:bg-red-300 border rounded px-8 py-2 text-sm" onclick="(e)=>{e.preventDefault();modalHandler()}">Cancel</button>
                    <button class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm" id="save_event">Submit</button>
                </div>
            </form>
            {{-- <div class="flex items-center justify-end w-full">
                
            </div> --}}
        </div>
    </div>
</div> --}}

{{-- <script>
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
</script> --}}

@endsection

@section('scripts')
<script>
    $('.publish_event').on('click', function() {
        id = $(this).attr('id');
        console.log(id);
        $.ajax({
            url : '/events/publish/'+id,
            type : 'POST',
            data: {
                _token: '{!! csrf_token() !!}',
                id : id
            },
            success: function(response) {
                if(response.code == 200) {
                Swal.fire({
                        icon: 'success',
                        title: response.msg,
                        iconColor: '#4f46e5',
                        confirmButtonColor: '#4f46e5'
                }).then((result) =>{
                        window.location.reload()
                });
                }
                else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: response.msg,
                    });
                }
            }
        });
    });

    $('.delete_event').on('click', function() {
        id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure you want to delete this event? This action can\'t be reversed',
            icon: 'warning',
            showCancelButton: true,
            iconColor: '#4f46e5',
            confirmButtonColor: '#4f46e5',
            cancelButtonColor: '#e11d48',
            confirmButtonText: 'Yes, delete event'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : '/events/delete/'+id,
                    type : 'DELETE',
                    data : {
                        _token: '{!! csrf_token() !!}',
                    },
                    success: function(response) {
                        if(response.code == 200) {
                            Swal.fire({
                                    icon: 'success',
                                    title: response.msg,
                                    iconColor: '#4f46e5',
                                    confirmButtonColor: '#4f46e5'
                            }).then((result) =>{
                                    window.location.reload()
                            });
                        }
                        else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.msg,
                                confirmButtonColor: '#4f46e5'
                            });
                        }
                    }
                });
            }
        })
    });
    
</script>

@endsection