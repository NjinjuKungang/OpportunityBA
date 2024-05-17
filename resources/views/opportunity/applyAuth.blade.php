<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
   <!-- Fonts -->
   <link rel="preconnect" href="https://fonts.bunny.net">
   <link href="https://fonts.bunny.net/css?family=figtre e:400,600&display=swap" rel="stylesheet" />
   <title>Apply</title>
  
  @vite('resources/css/app.css')
</head>
<body>
  @include('components/navbarLanding')
  <form action="{{route('apply.post', $opportunity->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mx-auto max-w-3xl pt-8 ">
      <div class="flex justify-center py-12 bg-gray-100 shadow-lg rounded shadow-amber-200">
          <div class="grid gap-5 justify-items-left">
              <label class="text-2xl font-semibold">Apply for <span class="text-amber-500"> {{$opportunity->title}}</span> opportunity!!!</label>
              <label class="text-xl">Upload your CV:</label>
              <input class="h-10 px-2 rounded-md" type="file" name="cv" value="{{old('cv')}}">
              @error('cv')
                    <span class="text-red-500 italic">*{{$message}}</span>
                @enderror
              <div id="preview"></div>
              <label class="text-xl">Motivation:</label>
              <textarea class="rounded-md  p-1" rows="5" cols="50" placeholder="Brief reason why you are fit for the role..." name="reason">{{old('reason')}}</textarea>
              @error('description')
                    <span class="text-red-500 italic">*{{$message}}</span>
                @enderror
              
              <button type="submit" class="grid w-md justify-items-center bg-blue-400 rounded ring-2 ring-blue-300 hover:ring-gray-600/50 p-2 font-semibold">Apply</button>
          </div>
        </div>
    </div>
  </form>
{{-- <script type="text/javascript">
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
</script> --}}
</body>
</html>