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
  <form action="{{ route('opportunity'.$opportunity->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mx-auto max-w-xl">
      <div class="flex justify-center py-20 bg-gray-100 shadow-lg shadow-amber-200">
          <div class="grid gap-5 justify-items-left">
              <label class="text-2xl font-semibold">Edit opportunity!!!</label>
              <label class="text-xl">Title:</label>
              <input class="h-10 px-2 italic rounded-md" type="text" placeholder="Enter title" name="title" value="{{ $opportunity->title }}">
              @error('title')
                    <span class="text-red-500 italic">*{{$message}}</span>
                @enderror
              <label class="text-xl">Image:</label>
              <input class="h-10 px-2 italic rounded-md" type="file" name="image" id="">
              @error('name')
                    <span class="text-red-500 italic">*{{$message}}</span>
                @enderror
              <label class="text-xl">Description:</label>
              <textarea class="rounded-md italic p-1" rows="5" cols="50" placeholder="Description about opportunity" name="description">{{ $opportunity->description }}</textarea>
              @error('description')
                    <span class="text-red-500 italic">*{{$message}}</span>
                @enderror
              <input type="hidden" value="{{ $user->id }}">

              {{-- <a class="grid justify-items-center bg-amber-600 rounded ring-2 ring-amber-500 hover:ring-gray-600/50 p-2 font-semibold" href="/">
              </a> --}}
              <button type="submit" class="grid justify-items-center bg-amber-600 rounded ring-2 ring-amber-500 hover:ring-gray-600/50 p-2 font-semibold">Update</button>
          </div>
        </div>
    </div>
  </form>

</body>
</html>