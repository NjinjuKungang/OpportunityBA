<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
   <!-- Fonts -->
   <link rel="preconnect" href="https://fonts.bunny.net">
   <link href="https://fonts.bunny.net/css?family=figtre e:400,600&display=swap" rel="stylesheet" /> 
   <title></title>

  @vite('resources/css/app.css')
</head>
<body>
@include('components/navbarLanding')
        
@extends('components/welcome')
@section('content')
    <span class="text-left text-3xl px-10 font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-700 to-slate-200">Available Opportunities...</span>
    <div class="flex flex-wrap justify-around space-y-3 mx-auto">
        @foreach ($opportunities as $item)
            <div class="mx-auto w-120 px-4 pb-6 pt-2 bg-gray-100 rounded-md shadow-lg shadow-gray-400">
                <div class="grid justify-items-center text-2xl p-2 font-semibold">{{ $item->title }}</div>
                <div class="flex flex-row pt-2 "> 
                    <img class="h-40 w-60 rounded-xl" src="{{ asset($item->image) }}" alt="Img">
                    <div class="mx-auto w-2/5 px-1">
                        <span>Description: </span>
                        <div class="text-lg grid justify-left">{{ $item->description }}</div>
                        <div class="italic">
                            <span>Role: </span> 
                        <span> {{ $item->category }}</span>
                        </div>
                        <div class="pt-4">
                            <a href="{{ route('apply',$item->id) }}">
                                <button class="bg-blue-500 w-20 h-8 ring-blue-400 ring rounded-full  mx-1.5">Apply</button> 
                            </a>
                            <a href="{{ route('view',$item->id) }}">
                                <button class="bg-amber-400 w-16 h-8 ring-amber-500 ring rounded-full  mx-1.5">View</button> 
                            </a>
                        </div>
                        </div>
                    </div>
                
            </div>
        @endforeach

@endsection
</body>
</html>