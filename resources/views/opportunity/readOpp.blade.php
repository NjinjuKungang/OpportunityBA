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
              <label class="text-2xl font-semibold">{{ $opportunity.tile }}</label>
              <div>
                <label class="text-xl">Title:</label>
                <span class="px-2 text-xl font-bold">{{ $opportunity->title }}</span>
              </div>
              <div>
                <label class="text-xl">Image:</label>
                <span> <img src="{{ asset($opportunity->image) }}" alt="Img"></span>
              </div>
              <div>
                <label class="text-xl">Description:</label>
                <span class="px-2 text-xl font-bold">{{ $opportunity->description }}</span>
              </div>
              
              <a  href="">
                <button type="submit" class="grid justify-items-center bg-violet-600 rounded ring-2 ring-violet-500 hover:ring-gray-600/50 p-2 font-semibold">Apply</button>
              </a>
          </div>
        </div>
    </div>
  </form>

</body>
</html>