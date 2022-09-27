@extends('admin.layouts.app')

@section('content')
<h1>We are in events page</h1>
<div class="flex justify-between my-2">
    <button type="button" class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-2xl  text-sm p-2 text-center inline-flex items-center mr-2 mb-2">
        <span class="text-2xl text-gray-100 border-gray-100 inline-flex items-center">
            <i class='bx bx-plus bx-sm'></i>
        </span>
        <div class='text-xl font-mono font-bold pt-0.5'>
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
@endsection