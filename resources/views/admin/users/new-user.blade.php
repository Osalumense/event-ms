@extends('admin.layouts.app')

@section('content')
<section class="">
    <a href="{{url("admin/users")}}" class="bg-green-400 hover:bg-green-500 relative shadow-xl rounded-md p-2 mb-12 lg:mb-3 text-gray-100">
      Back to Users
    </a>
    <form method="POST" action="{{ url('/admin/users/add') }}" class="mx-auto container max-w-2xl md:w-3/4 shadow-xl">
      @csrf
      <div class="bg-gray-100 p-4 border-t-2 bg-opacity-5 border-green-400 rounded-t">
        <h2 class="font-bold text-2xl my-3">Add new user</h2>
        <hr>
      </div>
      <div class="bg-white space-y-6">
        <div class="md:inline-flex space-y-4 md:space-y-0 w-full p-4 text-gray-500 items-center">
          <h2 class="md:w-1/3 max-w-sm mx-auto">Personal info</h2>
          <div class="md:w-2/3 max-w-sm mx-auto space-y-5">
            <div>
                <label class="text-sm text-gray-400">Email</label>
                <div class="w-full inline-flex border">
                <div class="pt-2 w-1/12 bg-gray-100 bg-opacity-50">
                    <svg
                    fill="none"
                    class="w-6 text-gray-400 mx-ahiduto"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                    />
                    </svg>
                </div>
                <input
                    type="email"
                    name="email"
                    class="w-11/12 focus:outline-none focus:text-gray-600 p-2"
                />
                </div>
                @error('email')
                <span class="text-red-500" role="alert">{{ $message }}
                </span>
                @enderror
            </div>
            <div>
                <label class="text-sm text-gray-400">First name</label>
                <div class="w-full inline-flex border">
                  <div class="w-1/12 pt-2 bg-gray-100">
                    <svg
                      fill="none"
                      class="w-6 text-gray-400 mx-auto"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                      />
                    </svg>
                  </div>
                  <input
                    type="text"
                    name="first_name"
                    class="w-11/12 focus:outline-none focus:text-gray-600 p-2"
                  />
                </div>
                @error('first_name')
                  <span class="text-red-500" role="alert">{{ $message }}
                  </span>
                @enderror
              </div>
              <div>
                <label class="text-sm text-gray-400">Last name</label>
                <div class="w-full inline-flex border">
                  <div class="w-1/12 pt-2 bg-gray-100">
                    <svg
                      fill="none"
                      class="w-6 text-gray-400 mx-auto"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                      />
                    </svg>
                  </div>
                  <input
                    type="text"
                    name="last_name"
                    class="w-11/12 focus:outline-none focus:text-gray-600 p-2"
                  />
                </div>
                @error('last_name')
                  <span class="text-red-500" role="alert">{{ $message }}
                  </span>
                @enderror
              </div>
              <div>
                <label class="text-sm text-gray-400">Phone number</label>
                <div class="w-full inline-flex border">
                  <div class="pt-2 w-1/12 bg-gray-100">
                    <svg
                      fill="none"
                      class="w-6 text-gray-400 mx-auto"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"
                      />
                    </svg>
                  </div>
                  <input
                    type="text"
                    name="mobile_number"
                    class="w-11/12 focus:outline-none focus:text-gray-600 p-2"
                  />
                </div>
                @error('mobile_number')
                  <span class="text-red-500" role="alert">{{ $message }}
                  </span>
                @enderror
              </div>
              <div>
                <label class="text-sm text-gray-400">Staff Id</label>
                <div class="w-full inline-flex border">
                  <div class="pt-2 w-1/12 bg-gray-100">
                    <svg
                      fill="none"
                      class="w-6 text-gray-400 mx-auto"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                      />
                    </svg>
                  </div>
                  <input
                    type="text"
                    name="staff_id"
                    class="w-11/12 focus:outline-none focus:text-gray-600 p-2"
                  />
                </div>
                @error('staff_id')
                  <span class="text-red-500" role="alert">{{ $message }}
                  </span>
                @enderror
              </div>
              <div>
                <label class="text-sm text-gray-400">Gender</label>
                <div class="w-full inline-flex border">
                  <div class="w-1/12 pt-2 bg-gray-100">
                    <svg
                      fill="none"
                      class="w-6 text-gray-400 mx-auto"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                      />
                    </svg>
                  </div>
                  <select class="w-11/12 focus:outline-none focus:text-gray-600 p-2" name="gender" required>
                    <option value="">Select gender</option>
                    @foreach (Gender::getAll() as $key => $value)
                      <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
                </div>
                @error('gender')
                  <span class="text-red-500" role="alert">{{ $message }}
                  </span>
                @enderror
              </div>
          </div>
        </div>

        <hr />
        <div class="md:inline-flex  space-y-4 md:space-y-0  w-full p-4 text-gray-500 items-center">
          <h2 class="md:w-1/3 mx-auto max-w-sm">Other info</h2>
          <div class="md:w-2/3 mx-auto max-w-sm space-y-5">
            
            <div>
              <label class="text-sm text-gray-400">User Status</label>
              <div class="w-full inline-flex border">
                <div class="w-1/12 pt-2 bg-gray-100">
                  <svg xmlns="http://www.w3.org/2000/svg"                     class="w-6 text-gray-400 mx-auto"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  fill="none">
                    <path d="M17.988 22a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h11.988zM9 5h6v2H9V5zm5.25 6.25A2.26 2.26 0 0 1 12 13.501c-1.235 0-2.25-1.015-2.25-2.251S10.765 9 12 9a2.259 2.259 0 0 1 2.25 2.25zM7.5 18.188c0-1.664 2.028-3.375 4.5-3.375s4.5 1.711 4.5 3.375v.563h-9v-.563z"></path>
                  </svg>
                </div>
                <select class="w-11/12 focus:outline-none focus:text-gray-600 p-2" name="is_active" required>
                    <option value="">Select user status</option>
                  @foreach (ActiveStatus::getAll() as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>
                  @endforeach
                </select>
              </div>
              @error('is_active')
                <span class="text-red-500" role="alert">{{ $message }}
                </span>
              @enderror
            </div>
            <div>
              <label class="text-sm text-gray-400">User Type</label>
              <div class="w-full inline-flex border">
                <div class="w-1/12 pt-2 bg-gray-100">
                  <svg
                    fill="none"
                    class="w-6 text-gray-400 mx-auto"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                    />
                  </svg>
                </div>
                <select class="w-11/12 focus:outline-none focus:text-gray-600 p-2" name="user_type" required>
                    <option value="">Select user type</option>
                  @foreach (UserType::getAll() as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>
                  @endforeach
              </select>
              </div>
              @error('user_type')
                <span class="text-red-500" role="alert">{{ $message }}
                </span>
              @enderror
            </div>
          </div>
          
        </div>
        

        <hr />
        <div class="flex justify-between p-4 text-gray-100">
          <button type="submit" class="w-1/2 mx-auto max-w-sm rounded-md text-center bg-green-400 hover:bg-green-500 py-2 px-4 inline-flex items-center focus:outline-none shadow-xl">
            <svg
              fill="none"
              class="w-4 text-white mr-2"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
              />
            </svg>
            Create User 
          </button>
        </div>
      </div>
    </form>
</section>    
@endsection