@extends('web-base')

@section('title', 'Login')

@section('content')
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-primary-green w-100 rounded-md p-5 border-2 border-gray-400">
            <form action="{{ route('login.post') }}" method="post">
                @csrf
                <x-forms.input
                    label="Email Address"
                    name="email"
                    type="email"
                    placeholder="you@example.com"
                    class="text-white"
                    label-class="text-white"
                />
                <x-forms.input
                    label="Password"
                    name="password"
                    type="password"
                    class="text-white"
                    label-class="text-white"
                    placeholder="Your Password"
                />
                <div class="flex justify-center">
                    <x-forms.button color="blue" type="submit" class="flex justify-center items-center">
                        Login
                    </x-forms.button>
                </div>
            </form>
        </div>
    </div>
@endsection
