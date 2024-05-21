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
  <form action="{{ route('edit.post', $opportunity->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="mx-auto max-w-xl">
      <div class="flex justify-center py-20 bg-gray-100 shadow-lg shadow-amber-200">
          <div class="grid gap-5 justify-items-left">
              <label class="text-2xl font-semibold">Edit opportunity!!!</label>
              <label class="text-xl">Title:</label>
              <input class="h-10 px-2 italic rounded-md" type="text" placeholder="Enter title" name="title" value="{{ $opportunity->title }}">
              @error('title')
                    <span class="text-red-500 italic">*{{$message}}</span>
                @enderror
              <select name="category" class="h-10 px-2 rounded-md" value="{{ $opportunity->category}}" >
                <option  value="Intern">Intern</option>
                <option  value="Volunteer">Volunteer</option>
                <option  value="Job">Job</option>
              @error('category')
                <span class="text-red-500 italic">*{{$message}}</span>
              @enderror
              <label class="text-xl">Image:</label>
              <input class="h-10 px-2 rounded-md" type="file" name="image" value="{{old('image')}}" id="upload_file" onchange="getImagePreview(event)">
              @error('image')
                    <span class="text-red-500 italic">*{{$message}}</span>
                @enderror
              <div id="preview"> <img class="h-40 w-60 rounded-xl" src="{{ asset($opportunity->image) }}" alt="Img"></div>
              <label class="text-xl">Description:</label>
              <textarea class="rounded-md italic p-1" rows="5" cols="50" placeholder="Description about opportunity" name="description">{{ $opportunity->description }}</textarea>
              @error('description')
                    <span class="text-red-500 italic">*{{$message}}</span>
                @enderror

              {{-- <a class="grid justify-items-center bg-amber-600 rounded ring-2 ring-amber-500 hover:ring-gray-600/50 p-2 font-semibold" href="/">
              </a> --}}
              <button type="submit" class="grid justify-items-center bg-amber-600 rounded ring-2 ring-amber-500 hover:ring-gray-600/50 p-2 font-semibold">Update</button>
          </div>
        </div>
    </div>
  </form>
  <script type="text/javascript">
    function getImagePreview(event)
    {
      var image=URL.createObjectURL(event.target.files[0]);
      var imagediv= document.getElementById('preview');
      var newimg=document.createElement('img');
      imagediv.innerHTML='';
      newimg.width="200";
      newimg.src=image;
      imagediv.appendChild(newimg);
    }
  </script>
</body>
</html>