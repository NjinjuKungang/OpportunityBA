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
@include('components/navbar-landing')
@if (session('status'))
      <div>{{session('status')}}</div>
  @endif
@extends('components/welcome')
@section('content')
    <div class="flex justify-center">
        <a class="w-32 bg-amber-600 rounded ring-2 ring-amber-500 hover:ring-gray-600/50 p-2 font-semibold" href="/createOpp">
            <button>Create Opportunity</button>
        </a>
    </div>
    <span class="text-left text-3xl px-10 font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-700 to-slate-200">Created Opportunities...</span>
    <div class="mx-auto max-w-4/5 py-4">
        <table class="border-separate border-spacing-[5vw] border-spacing-y-5 table-auto mx-auto bg-gray-100 rounded-md shadow-lg shadow-gray-400">
            <thead >
                <tr>
                    <th class="text-xl p-5">Image</th>
                    <th class="text-xl p-5">Title</th>
                    <th class="text-xl p-5">Description</th>
                    <th class="text-xl p-5">Role</th>
                    <th class="text-xl p-5">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($opportunities as $item)
                <tr >
                    <td class="text-xl font-semibold"><img class="h-16 w-16 rounded-full" src="{{ asset($item->image) }}" alt="Img"></td>
                    <td class="text-xl font-semibold">{{$item->title}}</td>
                    <td class="text-xl font-semibold">{{$item->description}}</td>
                    <td class="text-xl font-semibold">{{$item->category}}</td>
                    <td>
                        <a  href="{{ route('edit', $item->id) }}">
                            <button class="bg-violet-500 w-20 h-8 ring-violet-400 ring rounded-full  mx-1.5 my-2">Edit</button> 
                        </a>
                        <a href="{{ route('delete', $item->id) }}">
                            <button class="bg-red-600 w-20 h-8 ring-red-500 ring rounded-full  mx-1.5">Delete</button> 
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
       
            {{-- <div class="mx-auto px-4 pb-6 pt-2 bg-gray-100 rounded-md shadow-lg shadow-gray-400">
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
                        
                        </div>
                    </div>
                
            </div> --}}
    </div>

    @endsection
</body>
</html>