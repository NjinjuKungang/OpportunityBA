<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
   <!-- Fonts -->
   <link rel="preconnect" href="https://fonts.bunny.net">
   <link href="https://fonts.bunny.net/css?family=figtre e:400,600&display=swap" rel="stylesheet" /> 
   <title>Login</title>
  
  @vite('resources/css/app.css')
</head>
<body>
  @include('components/navbar')
  <form action="{{ route('authentication.login') }}" method="post">
    @csrf
    <div class="mx-auto max-w-xl my-12">
      <div class="flex justify-center py-16 bg-gray-100 shadow-lg shadow-gray-500">
        <div class="grid gap-5 justify-items-left">
            <label class="text-2xl font-semibold">Login with your credentials</label>
           <label class="text-xl">Email:</label>
            <input class="h-10 px-2 italic rounded-md" type="email" size="50" placeholder="email address" name="email" value="{{old('email')}}">
            <label class="text-xl">Password:</label>
            <input class="h-10 px-2 italic rounded-md" type="password" name="password" id="">        
            <button type="submit" name="login" size="25" class="grid justify-items-center bg-amber-600 rounded ring-2 ring-amber-500 hover:ring-gray-600/50 p-2 font-semibold">Login</button>
            <label class="text-md">Dont't have an account? <a class="text-amber-500 hover:underline" href="/sign-up">Create account</a></label>
        </div>
      </div>
    </div>
  </form>
</body>
</html>