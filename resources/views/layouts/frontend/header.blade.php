<header class="container">
    <!-- Navbar -->
    <nav
        class="flex justify-between py-4 bg-white/80 backdrop-blur-md shadow-md w-full px-10 fixed top-0 md:items-center left-0 right-0 z-10 md:px-3">
        <!-- Logo Container -->
        <div class="flex">
            <!-- Logo -->
            <a href="{{url('/')}}" class="cursor-pointer">
                <h3 class="text-2xl px-4 font-medium text-indigo-600">
                    EMS
                </h3>
            </a>
        </div>

        <!-- Links Section -->
        <div
            class="items-center md:space-x-8 space-y-6 mt-12 md:mt-0 md:space-y-0 justify-end justify-items-center hidden md:justify-items-center md:flex md:pt-2 w-full left-0 top-16 px-5 md:px-10 py-3 md:py-0" id="navbar">
            <a
                class="flex text-gray-600 cursor-pointer transition-colors duration-300 hover:text-indigo-600">
                Organize an event
            </a>
            <a
                href="{{url('/faq')}}"
                class="flex text-gray-600 hover:text-indigo-600 cursor-pointer transition-colors duration-300">
                FAQ
            </a>
            <a
                class="flex text-gray-600 hover:text-indigo-600 cursor-pointer transition-colors duration-300">
                Contact
            </a>
            <a
                class="flex text-gray-600 hover:text-indigo-600 cursor-pointer transition-colors duration-300">
                Why EMS?
            </a>

            <div class="md:hidden space-y-6">
                @if (Auth::user())
                    <a href="{{url('/dashboard')}}" class="flex cursor-pointer transition-colors duration-300 font-semibold text-indigo-600">
                        Dashboard
                    </a>
                    <form method="POST" class="flex p-1 rounded-md text-gray-100 bg-indigo-500 hover:bg-indigo-600 cursor-pointer transition-colors duration-300" action="{{ route('logout') }}">
                        @csrf
                        <span class="inline-flex items-center">
                            <svg
                                class="fill-current h-5 w-5 mr-2 mt-0.5"
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                version="1.1"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M10,17V14H3V10H10V7L15,12L10,17M10,2H19A2,2 0 0,1 21,4V20A2,2 0 0,1 19,22H10A2,2 0 0,1 8,20V18H10V20H19V4H10V6H8V4A2,2 0 0,1 10,2Z"/>
                            </svg>
                        </span>
                        <button class="p-2 btn-reverse" type="submit">Logout</button>
                    </form>
                @else
                    <a href="{{url('/login')}}" class="flex cursor-pointer transition-colors duration-300 font-semibold text-indigo-600">
                        <svg
                            class="fill-current h-5 w-5 mr-2 mt-0.5"
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            version="1.1"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M10,17V14H3V10H10V7L15,12L10,17M10,2H19A2,2 0 0,1 21,4V20A2,2 0 0,1 19,22H10A2,2 0 0,1 8,20V18H10V20H19V4H10V6H8V4A2,2 0 0,1 10,2Z" />
                        </svg>
                        Login
                    </a>
                    <a
                    class="flex p-2 rounded-md text-gray-100 bg-indigo-500 hover:bg-indigo-600 cursor-pointer transition-colors duration-300" href="{{url('/register')}}">
                        <svg
                            class="fill-current h-5 w-5 mr-2 mt-0.5"
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            version="1.1"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 0L11.34 .03L15.15 3.84L16.5 2.5C19.75 4.07 22.09 7.24 22.45 11H23.95C23.44 4.84 18.29 0 12 0M12 4C10.07 4 8.5 5.57 8.5 7.5C8.5 9.43 10.07 11 12 11C13.93 11 15.5 9.43 15.5 7.5C15.5 5.57 13.93 4 12 4M12 6C12.83 6 13.5 6.67 13.5 7.5C13.5 8.33 12.83 9 12 9C11.17 9 10.5 8.33 10.5 7.5C10.5 6.67 11.17 6 12 6M.05 13C.56 19.16 5.71 24 12 24L12.66 23.97L8.85 20.16L7.5 21.5C4.25 19.94 1.91 16.76 1.55 13H.05M12 13C8.13 13 5 14.57 5 16.5V18H19V16.5C19 14.57 15.87 13 12 13M12 15C14.11 15 15.61 15.53 16.39 16H7.61C8.39 15.53 9.89 15 12 15Z" />
                        </svg>
                        Register
                    </a>
                @endif
            </div>

        </div>

        <!-- Auth Links -->
        <div class="md:inline-flex items-center space-x-5 hidden">
            <!-- Register -->
            @if (Auth::user())
                <a href="{{url('/dashboard')}}" class="flex cursor-pointer transition-colors duration-300 font-semibold text-indigo-600">
                    Dashboard
                </a>
                <form method="POST" class="inline-flex p-1 rounded-md text-gray-100 bg-indigo-500 hover:bg-indigo-600 cursor-pointer transition-colors duration-300" action="{{ route('logout') }}">
                    @csrf
                    <span class="inline-flex items-center">
                        <svg
                            class="fill-current h-5 w-5 mr-2"
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            version="1.1"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M10,17V14H3V10H10V7L15,12L10,17M10,2H19A2,2 0 0,1 21,4V20A2,2 0 0,1 19,22H10A2,2 0 0,1 8,20V18H10V20H19V4H10V6H8V4A2,2 0 0,1 10,2Z"/>
                        </svg>
                    </span>
                    <button class="p-1" type="submit">Logout</button>
                </form>
            @else
                <a href="{{url('/login')}}" class="flex cursor-pointer transition-colors duration-300 font-semibold text-indigo-600">
                    <svg
                        class="fill-current h-5 w-5 mr-2 mt-0.5"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        version="1.1"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M10,17V14H3V10H10V7L15,12L10,17M10,2H19A2,2 0 0,1 21,4V20A2,2 0 0,1 19,22H10A2,2 0 0,1 8,20V18H10V20H19V4H10V6H8V4A2,2 0 0,1 10,2Z" />
                    </svg>
                    Login
                </a>
                <a
                class="flex p-2 rounded-md text-gray-100 bg-indigo-500 hover:bg-indigo-600 cursor-pointer transition-colors duration-300" href="{{url('/register')}}">
                    <svg
                        class="fill-current h-5 w-5 mr-2 mt-0.5"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        version="1.1"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 0L11.34 .03L15.15 3.84L16.5 2.5C19.75 4.07 22.09 7.24 22.45 11H23.95C23.44 4.84 18.29 0 12 0M12 4C10.07 4 8.5 5.57 8.5 7.5C8.5 9.43 10.07 11 12 11C13.93 11 15.5 9.43 15.5 7.5C15.5 5.57 13.93 4 12 4M12 6C12.83 6 13.5 6.67 13.5 7.5C13.5 8.33 12.83 9 12 9C11.17 9 10.5 8.33 10.5 7.5C10.5 6.67 11.17 6 12 6M.05 13C.56 19.16 5.71 24 12 24L12.66 23.97L8.85 20.16L7.5 21.5C4.25 19.94 1.91 16.76 1.55 13H.05M12 13C8.13 13 5 14.57 5 16.5V18H19V16.5C19 14.57 15.87 13 12 13M12 15C14.11 15 15.61 15.53 16.39 16H7.61C8.39 15.53 9.89 15 12 15Z" />
                    </svg>
                    Register
                </a>
            @endif
            <!-- Login -->
            
        </div>

        <!-- Hamberger Menu -->
        <button
            class="w-10 h-10 md:hidden justify-self-end rounded-full hover:bg-gray-100" onclick="showMenu()">
            <svg
                class="mx-auto"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                version="1.1"
                width="24"
                height="24"
                viewBox="0 0 24 24">
                <path d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z" />
            </svg>
        </button>
    </nav>
</header>

<script>
    const showMenu = () => {
        document.querySelector("#navbar").classList.toggle("hidden");
    }
</script>
