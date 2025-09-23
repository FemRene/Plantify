@extends('web-base')

@section('title', "Error 404")

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen">
        <img src="{{asset('Plantdrop-Leaf.png')}}" style="width:5%; height:auto;" alt="Our Logo">
        <h1 class="bg-linear-to-r from-gradient-start to-gradient-end bg-clip-text text-transparent font-black text-8xl w-fit text-center">
            Plantdrop
        </h1>
        <p class="mt-6 text-2xl font-semibold text-white text-center">
            {{ $exception->getStatusCode() }} — {{ $exception->getMessage() ?: 'Something went wrong' }}
        </p>
    </div>
@endsection
