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
    <span class="text-left text-3xl px-10 font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-700 to-slate-200">Available Opportunities...</span>
    <div class="flex justify-between">
        @foreach ($opportunities as $item)
            <div>
                <span>{{ $item->title }}</span>
                <span> <img src="{{ asset($item->image) }}" alt="Img"></span>
                <span>{{ $item->description }}</span>
                <a href="{{ route('view') }}">
                    <button class="bg-amber-100 w-8 h-4">View</button> 
                </a>
            </div>
        @endforeach

@endsection
</body>
</html>