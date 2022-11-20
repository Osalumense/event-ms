@extends('admin.layouts.app')
@section('content')
<div class="p-3 md:p-16">
    <div class="shadow-lg rounded-md p-5 bg-white mb-4">
        <h1 class="text-3xl text-indigo-600 font-black">Create Event</h1>
    </div>
    <div class="shadow-lg rounded-md p-8 bg-white">
        <form id="create_event_form" method="POST" action="{{url('/events')}}" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="title" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Event Name</label>
                <input name="title" id="title" class="mt-2 p-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-semibold w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="John Doe" />
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
                <textarea id="description" name="description" class="editor mt-2 p-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-semibold w-full h-auto flex items-center text-sm border-gray-300 rounded border"></textarea>
                <div class="mb-3">
                    @error('description')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div>
                <label class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Cover Image</label>
                <label class="w-1/2 mt-2 flex flex-col items-center px-4 py-6 bg-white text-indigo-600 rounded-lg shadow-lg tracking-wide uppercase border border-indigo-600 cursor-pointer">
                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                    </svg>
                    <span class="mt-2 text-base leading-normal">Select a file</span>
                    <input type='file' name="bg_image_path" class="flex justify-center" />
                </label>
            </div>
            
            <div class="w-full mt-4 flex justify-start md:space-x-4 flex-col md:flex-row">
                <div class="flex flex-col w-full md:w-1/3">
                    <label for="start_date" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Start date:</label>
                    <input type="datetime" id="start_date" name="start_date" class="p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-semibold w-full h-auto flex items-center text-sm border-gray-300 rounded border start_date" placeholder="2022-09-28 07:30">
                    <div class="mb-3">
                        @error('start_date')
                            <span class="invalid-feedback text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-col w-full md:w-1/3">
                    <label for="end_date" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">End date:</label>
                    <input type="datetime" name="end_date" id="end_date" class="p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-semibold w-full h-auto flex items-center text-sm border-gray-300 rounded border end_date" placeholder="2022-09-28 07:30">
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
                <input name="location_address" id="location_address" class="p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-semibold w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="The event center" />
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
                <input name="location_address_line_1" id="location_address_line_1" class="p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-semibold w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="2, Newton Street" />
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
                <input name="location_address_line_2" id="location_address_line_2" class="p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-semibold w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="Abuja Nigeria" />
                <div class="mb-3">
                    @error('location_address_line_2')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
                        
            <div class="w-full flex space-x-4 justify-start flex-row">
                <div class="flex flex-col w-full md:w-1/3">
                    <label for="location_state" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">City:</label>
                    <input type="text" name="location_state" id="location_state" class="p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-semibold w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="Abuja">
                    <div class="mb-3">
                        @error('location_state')
                            <span class="invalid-feedback text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-col w-full md:w-1/3">
                    <label for="location_post_code" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Post Code:</label>
                    <input type="text" id="location_post_code" name="location_post_code" class="mt-2 p-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-semibold w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="901101">
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
                <a href="{{url('/events')}}" class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 mr-3 bg-red-400 transition duration-150 text-white ease-in-out hover:border-red-400 hover:bg-red-300 border rounded px-8 py-2 text-sm">Cancel</a>
                <button class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    ClassicEditor
        .create( document.querySelector( '.editor' ) )
        .catch( error => {
            console.error( error );
        });
</script>
<script>
    $( document ).ready(function() {
      $(".start_date, .end_date").flatpickr(
          {
              minDate: "today",
              enableTime: true,
              dateFormat: "Y-m-d H:i",
          }
      );
    });
</script>
@endsection