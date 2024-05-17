<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
   <!-- Fonts -->
   <link rel="preconnect" href="https://fonts.bunny.net">
   <link href="https://fonts.bunny.net/css?family=figtre e:400,600&display=swap" rel="stylesheet" /> 
   <title>View opportunity</title>
  
  @vite('resources/css/app.css')
</head>
<body>
  @include('components/navbarLanding')
    <div class="mx-auto max-w-xl pt-10">
      <div class="flex justify-center py-20 bg-gray-100 shadow-lg shadow-amber-200">
          <div class="grid gap-5 justify-items-left">
              <label class="text-2xl font-bold">{{ $opportunity->title }}</label>
              <div>
                <label class="text-xl">Title:</label>
                <span class="px-2 text-xl font-semibold">{{ $opportunity->title }}</span>
              </div>
              <div>
                <label class="text-xl">Image:</label>
                <span> <img class="h-40 w-60 rounded-xl" src="{{ asset($opportunity->image) }}" alt="Img"></span>
              </div>
              <div>
                <label class="text-xl">Description:</label>
                <span class="px-2 text-xl font-semibold">{{ $opportunity->description }}</span>
              </div>
              
              <a class="grid justify-items-center pt-4" href="{{route('apply',$opportunity->id)}}">
                <button type="submit" class="w-20 bg-violet-600 rounded ring-2 ring-violet-500 hover:ring-gray-600/50 p-2 font-semibold">Apply</button>
              </a>
          </div>
        </div>
    </div>

</body>
</html>