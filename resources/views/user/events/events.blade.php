@extends('admin.layouts.app')
@section('content')
    <div class="md:p-16 m-3">
        <div class="shadow-lg flex flex-row justify-start items-baseline rounded-md space-x-4 p-5 bg-white mb-4">
            <h1 class="text-3xl text-indigo-600 font-black">{{$event['title']}}</h1>
            @if($event['is_active'] == 1)
                <div class="flex items-center relative">
                    <span class="animate-ping absolute inline-flex rounded-full h-4 w-4 bg-green-500 opacity-75"></span>
                    <span class="relative rounded-full h-4 w-4 bg-green-600"></span>
                </div>
                <a target="_blank" href="{{url('/e/').'/'.$event['slug']}}"><i class='bx bx-link-external bx-sm text-indigo-600'></i></a>
            @else
                <i class='bx bxs-circle bx-md text-red-600 mr-3'></i>
            @endif  
        </div>
        <div class="flex flex-wrap" id="tabs-id">
            <div class="w-full">
                <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                    <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                    <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-white bg-indigo-600" onclick="changeAtiveTab(event,'tab-event')">
                        Event
                    </a>
                    </li>
                    <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                    <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-indigo-600 bg-white" onclick="changeAtiveTab(event,'tab-ticket')">
                        Tickets
                    </a>
                    </li>
                    <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                    <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-indigo-600 bg-white" onclick="changeAtiveTab(event,'tab-attendees')">
                        Attendees
                    </a>
                    </li>
                </ul>
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                    <div class="px-4 py-5 flex-auto">
                    <div class="tab-content tab-space">
                        <div class="block" id="tab-event">
                            @include('user.events.partials.events.events')
                        </div>
                        <div class="hidden" id="tab-ticket">
                            @include('user.events.partials.tickets.tickets', array( "ticket" => $ticket))  
                        </div>
                        <div class="hidden" id="tab-attendees">
                            <p>
                                Efficiently unleash cross-media information without
                                cross-media value. Quickly maximize timely deliverables for
                                real-time schemas.
                                <br />
                                <br />
                                Dramatically maintain clicks-and-mortar solutions
                                without functional solutions.
                            </p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function changeAtiveTab(event,tabID){
        let element = event.target;
        while(element.nodeName !== "A"){
            element = element.parentNode;
        }
        ulElement = element.parentNode.parentNode;
        aElements = ulElement.querySelectorAll("li > a");
        tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");
        for(let i = 0 ; i < aElements.length; i++){
            aElements[i].classList.remove("text-white");
            aElements[i].classList.remove("bg-indigo-600");
            aElements[i].classList.add("text-indigo-600");
            aElements[i].classList.add("bg-white");
            tabContents[i].classList.add("hidden");
            tabContents[i].classList.remove("block");
        }
        element.classList.remove("text-indigo-600");
        element.classList.remove("bg-white");
        element.classList.add("text-white");
        element.classList.add("bg-indigo-600");
        document.getElementById(tabID).classList.remove("hidden");
        document.getElementById(tabID).classList.add("block");
        }
    </script>
    <script>
        ClassicEditor
            .create( document.querySelector( '.editor' ) )
            .catch( error => {
                console.error( error );
            });
    </script>
    <script>
        $( document ).ready(function() {
        $(".start_date").flatpickr(
            {
                minDate: "today",
                enableTime: true,
                defaultDate: '{!!date('Y-m-d h:i:s', strtotime($event['start_date']))!!} ',
                dateFormat: "Y-m-d H:i",
            }
        );
        $(".end_date").flatpickr(
            {
                minDate: "today",
                enableTime: true,
                defaultDate: '{!!date('Y-m-d h:i:s', strtotime($event['end_date']))!!} ',
                dateFormat: "Y-m-d H:i",
            }
        );
        $('.create_ticket').on('click', function() {
                $('.create_ticket_form').removeClass('hidden');
                $('.ticket_div').addClass('hidden');
                $('.update_ticket_form').addClass('hidden');
        });
        $('.close_ticket_form').on('click', function() {
                $('.ticket_div').removeClass('hidden');
                $('.create_ticket_form').addClass('hidden');
                $('.update_ticket_form').addClass('hidden');
        });

        $('#create_ticket').on('click', function() {
            let form = $('#add_ticket_form');
            form.parsley().validate();
            if(form.parsley().isValid()) {
                $.ajax({
                    url : '/tickets',
                    type : 'POST',
                    dataType : 'json',
                    data : {
                        _token: '{!! csrf_token() !!}',
                        title: $('#ticket_title').val(),
                        price: $('#ticket_amount').val(),
                        event_id : $('#event_id').val(),
                        quantity_available: $('#ticket_quantity').val()
                    },
                    success : (response) => {
                        if(response.code == 200) {
                            Swal.fire({
                                    icon: 'success',
                                    title: response.msg,
                                    iconColor: '#4f46e5',
                                    confirmButtonColor: '#4f46e5'
                            }).then(() => {
                                location.reload();
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
        });

        $('.delete_ticket').on('click', function() {
            id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure you want to delete this ticket? This action can\'t be reversed',
                icon: 'warning',
                showCancelButton: true,
                iconColor: '#4f46e5',
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#e11d48',
                confirmButtonText: 'Yes, delete ticket'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url : '/tickets/delete/'+id,
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
        $('.update_ticket').on('click', function() {
            $('.create_ticket_form').addClass('hidden');
            $('.ticket_div').addClass('hidden');
            $('.update_ticket_form').removeClass('hidden');
            $('.update_ticket_form').focus();
            let id = $(this).attr('id')
            $.ajax({
                url : '/tickets/edit/'+id,
                dataType : 'json',
                success : function (response) {
                    $('#edit_ticket_id').val(response.ticket.id);
                    $('#edit_ticket_title').val(response.ticket.title);
                    $('#edit_ticket_amount').val(response.ticket.price);
                    $('#edit_ticket_quantity').val(response.ticket.quantity_available);
                }
            });
        });
        $('#update_ticket_btn').on('click', function() {
            $.ajax({
                url : '/tickets/update',
                data: {
                    '_token': $('#token').val(),
                    'id': $('#edit_ticket_id').val(),
                    'title': $('#edit_ticket_title').val(),
                    'price': $('#edit_ticket_amount').val(),
                    'quantity_available': $('#edit_ticket_quantity').val()
                },
                dataType : 'json',
                method: 'POST',
                success : function (response) {
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
        })
        
        });

        
    </script>
@endsection