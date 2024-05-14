<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
   <!-- Fonts -->
   <link rel="preconnect" href="https://fonts.bunny.net">
   <link href="https://fonts.bunny.net/css?family=figtre e:400,600&display=swap" rel="stylesheet" /> 
  
  @vite('resources/css/app.css')
</head>
<body>
@include('components/navbarLanding')
        
@extends('components/welcome')
@section('content')
    <div class="flex justify-center">
        <a class="w-32 bg-amber-600 rounded ring-2 ring-amber-500 hover:ring-gray-600/50 p-2 font-semibold" href="/createOpp">
            <button>Create Opportunity</button>
        </a>
    </div>
    <span class="text-left text-3xl px-10 font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-700 to-slate-200">Created Opportunities...</span>
    <div class="flex justify-between">
        @foreach ($opportunities as $item)
            <div>
                <span>{{ $item->title }}</span>
                <span> <img src="{{ asset($item->image) }}" alt="Img"></span>
                <span>{{ $item->description }}</span>
                <a href="{{ route('edit') }}">
                    <button class="bg-amber-100 w-8 h-4">Edit</button> 
                </a>
            </div>
        @endforeach
    </div>

    @endsection
</body>
</html>