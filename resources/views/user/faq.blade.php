@extends('layouts.app')
@section('content')

<style>
    .accordion li > div {
        display: none;
    }

    .accordion .flipY {
        transform: rotate3d(1, 0, 0, 180deg);
    }

    .accordion svg {
        transition: all 1s cubic-bezier(0, .5, 0, 1);
    }
</style>

<div class='flex items-center justify-center min-h-screen'>
    <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-xl'>
        <div class='max-w-md mx-auto space-y-6'>
            <img src='https://tailwindcomponents.com/svg/logo-color.svg' class='h-8' />

            <!-- Accordion start -->
            <ul class="accordion w-full bg-gray-50 rounded-lg shadow-lg shadow-gray-100 p-2">

                <!-- Duplicate this <li> as often as you want -->
                <li class="cursor-pointer my-1">
                    <span class="font-bold text-xl tracking-tight text-gray-500 flex flex-row justify-between items-center">
                        <p>Heading 1</p>
                        <svg class="text-gray-500 mr-1"xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"/>
                        </svg>
                    </span>
                    <div class="text-gray-500 text-md p-2">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate
                    </div>
                </li>

                <!-- Copy of above <li> -->
                <li class="cursor-pointer my-1">
                    <span class="font-bold text-xl tracking-tight text-gray-500 flex flex-row justify-between items-center">
                        <p>Heading 2</p>
                        <svg class="text-gray-500 mr-1"xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"/>
                        </svg>
                    </span>
                    <div class="text-gray-500 text-md p-2">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate
                    </div>
                </li>

            </ul>
            <!-- Accordion end -->

    
            <a target='_blank' href='https://tailwindcomponents.com' class='block w-full px-4 py-2 font-medium tracking-wide text-center text-white capitalize transition-colors duration-300 transform bg-indigo-400 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-80'>
                Go Back to Tailwind Components
            </a>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script>
    $(document).on('click', '.accordion li', function(e) {
        $(this).find('div').slideToggle();
        $(this).find('svg').toggleClass('flipY');
    });
</script>
@endsection