@extends('admin.layouts.app')

@section('content')
    <div class="p-3">
        <a href="{{url("admin/users/add")}}" class="bg-green-400 hover:bg-green-500 relative shadow-xl rounded-md p-2 mb-12 lg:mb-3 text-gray-100">
            Add new user
        </a>
        <h3 class="mt-6 text-3xl">Users</h3>
        <div class="flex flex-col mt-6 bg-white p-5">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                    <table class="min-w-full overflow-x-scroll divide-y divide-gray-200" id="users_tbl">
                    <thead class="bg-gray-50">
                        <tr>
                        <th
                            scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-500"
                        >
                            Name
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-500 uppercase"
                        >
                            Email
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-500 uppercase"
                        >
                            Mobile Number
                        </th>
                        
                        <th
                            scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-500 uppercase"
                        >
                            Date Created
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-500 uppercase"
                        >
                            Status
                        </th>
                        <th scope="col" class="relative px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-500 uppercase">
                            <span >Actions</span>
                        </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection


@section('scripts')
    <script>
    $(function() {
        $('#users_tbl').DataTable({
            processing: true,
            serverSide: true,
            ajax      : '{!! url('/admin/users/fetch') !!}',
            language: {searchPlaceholder: "Search here  "},
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'mobile_number', name: 'mobile_number', orderable: false},
                {data: 'created_at', name: 'created_at', orderable: false},
                {data: 'is_active', name: 'is_active', orderable: false},
                {data: 'action', name: 'action', orderable: false},
            ],
            order: [[0, 'desc']]
        });
    });
    </script>
@endsection