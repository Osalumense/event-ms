@extends('layouts.app')

@section('content')
<section class="contact d-flex align-items-center bg-gray-200">
    <div class="flex justify-center items-center">
        <div class="p-10 border-2 border-slate-200 rounded-lg flex flex-col items-center space-y-3 bg-white">
            <div class="pt-8">
                <h1 class="-mt-10 font-semibold text-2xl">Event management System</h1>
                <h4 class="pt-3 text-center">Create and Manage events easily</h4>
              </div>
            <form method="POST" class="flex flex-col space-y-4 " action="{{ route('register') }}">
                @csrf
                <div class="form-group mb-1 pb-2">
                    <input id="first_name" type="text" class="p-3 border-2 border-slate-500 rounded-sm w-80" name="first_name" value="{{ old('first_name') }}" placeholder="Enter first name" required autocomplete="first_name" autofocus>

                    @error('first_name')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                
                <div class="form-group my-1 pb-2">
                    <input id="last_name" type="text" class="p-3 border-2 border-slate-500 rounded-sm w-80" name="last_name" value="{{ old('last_name') }}" placeholder="Enter last name" required autocomplete="last_name" autofocus>

                    @error('last_name')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                

                
                <div class="form-group my-1 pb-2">
                    <input id="email" type="email" class="p-3 border-2 border-slate-500 rounded-sm w-80" name="email" value="{{ old('email') }}" placeholder="Enter email" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                
                <div class="form-group my-1 pb-2">
                    <input id="password" type="password" class="p-3 border-2 border-slate-500 rounded-sm w-80" placeholder="Enter password" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

            
                <div class="form-group my-1 pb-2">
                    <input id="password-confirm" type="password" class="p-3 border-2 border-slate-500 rounded-sm w-80" name="password_confirmation" placeholder="Confirm password" required autocomplete="new-password">
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 mt-3 offset-md-4">
                        <button type="submit" class="w-full bg-blue-500 rounded-3xl p-3 text-white font-bold transition duration-200 hover:bg-blue-700">
                            {{ __('Register') }}
                        </button>
                    </div>

                    <div class="d-flex justify-content-center">
                        <p class="para-light my-4">Already have an account? <span><a class="font-bold text-blue-500" href="{{ url('/login') }}"> Log in</a></span></p>
                        
                    </div> 
                    
                </div>
            </form>
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</section>
@endsection
