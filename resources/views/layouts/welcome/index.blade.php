@extends('web-base')

@section('title', "Welcome")

@section('content')
    <div class="relative flex flex-col items-center justify-center min-h-screen overflow-hidden">
        <!-- Logo -->
        <img id="logo" src="{{asset('Plantdrop-Leaf.png')}}"
             class="w-20 h-auto fixed transition-all duration-700 ease-in-out z-50"
             style="top: 40%; left: 50%; transform: translate(-50%, -50%) scale(1);"
             alt="Our Logo">

        <!-- Heading -->
        <h1 class="mt-40 bg-linear-to-r from-gradient-start to-gradient-end bg-clip-text text-transparent font-black text-8xl w-fit text-center transition-all duration-700 ease-in-out" id="heading">
            Plantdrop
        </h1>

        <!-- Buttons -->
        <div class="flex space-x-4 mt-5">
            <x-forms.button href="" class="text-2xl border-2 border-gray-400">
                See what you can do here
            </x-forms.button>
            @auth
                <x-forms.button href="{{route('dashboard.index')}}" class="text-2xl border-2 border-gray-400">
                    Dashboard
                </x-forms.button>
            @endauth
            @guest
                <x-forms.button href="{{route('login')}}" class="text-2xl border-2 border-gray-400">
                    Login
                </x-forms.button>
            @endguest
        </div>
    </div>

    <script>
        const logo = document.getElementById('logo');
        const heading = document.getElementById('heading');

        // Store the initial position values
        const initialState = {
            top: '40%',
            left: '50%',
            transform: 'translate(-50%, -50%) scale(1)'
        };

        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;

            if (scrollY > 50) {
                // Move logo to top-left
                logo.style.top = '1rem';
                logo.style.left = '1rem';
                logo.style.transform = 'translate(0, 0) scale(0.5)';

                // Shrink heading
                heading.style.transform = 'scale(0.8)';
            } else {
                // Reset logo to exact initial position
                logo.style.top = initialState.top;
                logo.style.left = initialState.left;
                logo.style.transform = initialState.transform;

                // Reset heading
                heading.style.transform = 'scale(1)';
            }
        });
    </script>

    <hr>
    <div class="flex flex-col items-center justify-center min-h-screen">

    </div>
@endsection
