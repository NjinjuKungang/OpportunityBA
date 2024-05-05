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
  <div class="mx-auto max-w-xl">
    <div class="flex justify-center py-20 bg-gray-100 shadow-lg shadow-amber-200">
        <div class="grid gap-5 justify-items-left">
            <label class="text-2xl font-semibold">Login with your credentials</label>
           <label class="text-xl">Email:</label>
            <input class="h-10 px-2 italic rounded-md" type="email" size="50" placeholder="email address" name="" id="">
            <label class="text-xl">Password:</label>
            <input class="h-10 px-2 italic rounded-md" type="password" name="" id="">
        
            <a class="grid justify-items-center bg-amber-600 rounded ring-2 ring-amber-500 hover:ring-gray-600/50 p-2 font-semibold" href="/">
                <button>Login</button>
            </a>
            <label class="text-md">Dont't have an account? <a class="text-amber-500 hover:underline" href="/sign-up">Create account</a></label>
        </div>
      </div>
  </div>
</body>
</html>