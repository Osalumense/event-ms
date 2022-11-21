<div class="flex flex-col justify-end items-center py-5 space-y-6 ticket_div">
    <a class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 cursor-pointer bg-indigo-700 rounded text-white px-2 py-2 text-xs sm:text-sm text-center inline-flex items-center create_ticket">
        <span class="text-md text-gray-100 border-gray-100 inline-flex items-center">
            <i class='inline-flex items-center bx bx-plus bx-sm'></i>
        </span>
        Create Ticket
    </a>
</div>
{{-- Create ticket form --}}
<div class="hidden create_ticket_form">
    <div class="flex flex-row justify-between items-center space-y-5 p-5">
        <h2 class="text-xl text-indigo-600 font-black">Create ticket</h2>
        <button class="text-red-600 font-black text-2xl close_ticket_form">X</button>
    </div>
    <form class="flex-col" action="" id="add_ticket_form">
        @csrf
        <input name="event_id" id="event_id" value="{{$event['id']}}" class="hidden">
        <div>
            <label for="location_address_line_1" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Name</label>
            <input name="title" id="ticket_title" class="p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-semibold w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="Ticket Name" required/>
            <div class="mb-3">
                @error('title')
                    <span class="invalid-feedback text-red-500" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="w-full mt-4 flex justify-start md:space-x-4 flex-col md:flex-row">
            <div class="flex flex-col w-full md:w-1/3">
                <label for="amount" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Amount:</label>
                <input type="number" id="ticket_amount" name="amount" class="p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-semibold w-full h-auto flex items-center text-sm border-gray-300 rounded border" placeholder="2000" required>
                <div class="mb-3">
                    @error('amount')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="flex flex-col w-full md:w-1/3">
                <label for="quantity" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Quantity:</label>
                <input type="number" name="quantity" id="ticket_quantity" class="p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-semibold w-full h-auto flex items-center text-sm border-gray-300 rounded border" placeholder="200 (Leave blank for unlimited number)" required>
                <div class="mb-3">
                    @error('quantity')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end w-full">
            <button type="button" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm" id="create_ticket">Create Ticket</button>
        </div>
    </form>
</div>
{{-- Update ticket form --}}
<div class="hidden update_ticket_form" tabindex='1'>
    <div class="flex flex-row justify-between items-center space-y-5 p-5">
        <h2 class="text-xl text-indigo-600 font-black">Update ticket</h2>
        <button class="text-red-600 font-black text-2xl close_ticket_form">X</button>
    </div>
    <form class="flex-col" action="" id="modify_ticket_form">
        <input name="token" id="token" value="{{ csrf_token() }}" class="hidden">
        <input name="edit_ticket_id" id="edit_ticket_id">
        <div>
            <label for="location_address_line_1" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Name</label>
            <input name="edit_ticket_title" id="edit_ticket_title" class="p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-semibold w-full h-10 flex items-center text-sm border-gray-300 rounded border" placeholder="Ticket Name" required/>
            <div class="mb-3">
                @error('title')
                    <span class="invalid-feedback text-red-500" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="w-full mt-4 flex justify-start md:space-x-4 flex-col md:flex-row">
            <div class="flex flex-col w-full md:w-1/3">
                <label for="amount" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Amount:</label>
                <input type="number" id="edit_ticket_amount" name="edit_ticket_amount" class="p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-semibold w-full h-auto flex items-center text-sm border-gray-300 rounded border" placeholder="2000" required>
                <div class="mb-3">
                    @error('amount')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="flex flex-col w-full md:w-1/3">
                <label for="quantity" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Quantity:</label>
                <input type="number" name="edit_ticket_quantity" id="edit_ticket_quantity" class="p-2 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-semibold w-full h-auto flex items-center text-sm border-gray-300 rounded border" placeholder="200 (Leave blank for unlimited number)" required>
                <div class="mb-3">
                    @error('quantity')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end w-full">
            <button type="button" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm" id="update_ticket_btn">Update Ticket</button>
        </div>
    </form>
</div>

@if(count($ticket) > 0)
    <div class="flex flex-wrap">
    @foreach ($ticket as $ticket)
        <div class="w-full md:w-1/2 lg:w-1/3 p-5 my-2">
            <div class="bg-white font-semibold text-center rounded-md border shadow-lg p-10">
                <p class="tracking-wide text-lg font-bold text-gray-700"> {{$ticket['title']}} </p>
                <p class="text-sm text-gray-700">Price: {{$ticket['price']}}  </p>
                <p class="text-sm text-gray-700 mt-4">Quantity available: {{$ticket['quantity_available']}} </p>
                <p class="text-sm text-gray-700 mt-4">Quantity sold: {{$ticket['quantity_sold']}} </p>
                <div class="flex items-center justify-center w-full my-3">
                    <button class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-600 mr-3 bg-indigo-600 transition duration-150 text-white ease-in-out hover:border-indigo-700 hover:bg-indigo-700 border rounded px-8 py-2 text-sm update_ticket" id="{{$ticket['id']}}" type="button">Update</button>
                    <button class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-600 mr-3 bg-red-600 transition duration-150 text-white ease-in-out hover:border-red-700 hover:bg-red-700 border rounded px-8 py-2 text-sm delete_ticket" id="{{$ticket['id']}}" type="button">Delete</button>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@else
    <div class="flex flex-col justify-center items-center py-5 space-y-6 ticket_div">
        <i class='bx bx-barcode text-indigo-600 bx-lg'></i>
        <h2 class="font-semibold text-indigo-600 text-2xl">No Ticket created for this Event yet</h2>
    </div>
@endif