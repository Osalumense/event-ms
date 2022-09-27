@extends('layouts.app')

@section('content')
<section class="contact d-flex align-items-center bg-gray-200">
    <div class="min-h-screen flex justify-center items-center">
        <div class="p-10 border-2 border-slate-200 rounded-lg flex flex-col items-center space-y-3 bg-white">
          <div class="pt-8">
            <h1 class="-mt-10 font-semibold text-2xl">Event management System</h1>
          </div>
          <form method="POST" class="flex flex-col space-y-4" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <input id="email" type="email" class="p-3 border-2 border-slate-500 rounded-sm w-80" name="email" placeholder="Enter Email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                <div class="mb-3">
                    @error('email')
                        <strong class="text-red-500">{{ $message }}</strong>
                    @enderror
                </div>              
            </div>
            <div class="">
                <input class="p-3 border-2 border-slate-500 rounded-sm w-80" placeholder="Password" name="password" id="password" type="password" />
                <div class="mb-3">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  
            </div>
                      
            <div>
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
            <a class="font-bold text-blue-500" href="#">Forgot password?</a>
            <div class="flex flex-col space-y-5 w-full">
                <button class="w-full bg-blue-500 rounded-3xl p-3 text-white font-bold transition duration-200 hover:bg-blue-700" type="submit">Log in</button>
            </div>
          </form>
        </div>
      

      </div> 
</section>
@endsection
