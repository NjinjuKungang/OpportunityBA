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
  <form action="{{route('create.post')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mx-auto max-w-xl">
      <div class="flex justify-center py-20 bg-gray-100 shadow-lg shadow-amber-200">
          <div class="grid gap-5 justify-items-left">
              <label class="text-2xl font-semibold">Create an opportunity!!!</label>
              <label class="text-xl">Title:</label>
              <input class="h-10 px-2 rounded-md" type="text" placeholder="Enter title" name="title" value="{{old('title')}}">
              @error('title')
                    <span class="text-red-500 italic">*{{$message}}</span>
                @enderror
              <select name="category" class="h-10 px-2 rounded-md" >
                <option  value="Intern">Intern</option>
                <option  value="Volunteer">Volunteer</option>
                <option  value="Job">Job</option>
              @error('category')
               <span class="text-red-500 italic">*{{$message}}</span>
              @enderror
              </select>
              <label class="text-xl">Image:</label>
              <input class="h-10 px-2 rounded-md" type="file" name="image" value="{{old('image')}}" id="upload_file" onchange="getImagePreview(event)">
              @error('image')
                    <span class="text-red-500 italic">*{{$message}}</span>
                @enderror
              <div id="preview"></div>
              <label class="text-xl">Description:</label>
              <textarea class="rounded-md  p-1" rows="5" cols="50" placeholder="Description about opportunity" name="description">{{old('description')}}</textarea>
              @error('description')
                    <span class="text-red-500 italic">*{{$message}}</span>
                @enderror
              
              {{-- <input type="hide" value="{{$product->user->id}}"> --}}
              {{-- <a class="grid justify-items-center bg-amber-600 rounded ring-2 ring-amber-500 hover:ring-gray-600/50 p-2 font-semibold" href="/">
              </a> --}}
              <button type="submit" class="grid w-md justify-items-center bg-amber-600 rounded ring-2 ring-amber-500 hover:ring-gray-600/50 p-2 font-semibold">Create</button>
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