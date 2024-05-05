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
    <div class="bg-gray-200 mx-auto px-10 py-5 flex items-center justify-between">
        <span class="bg-clip-text text-4xl font-bold text-transparent bg-gradient-to-r from-amber-500 to-violet-500">
            OppBoard
        </span>
        <span class="text-lg font-bold  animate-bounce hover:animate-ping mr-3">An opportunity is all you need!!!</span>
        <div class="flex space-x-3">
            <a class="grid justify-items-center w-20 bg-amber-600 rounded ring-2 ring-amber-500 hover:ring-gray-600/50 p-2 font-semibold" href="/sign-up">
                <button>Sign Up</button>
            </a>
            <a class="grid justify-items-center w-20 bg-amber-600 rounded ring-2 ring-amber-500 hover:ring-gray-600/50 p-2 font-semibold" href="/login">
                <button>Login</button>
            </a>
        </div>
    </div>
  <div class="flex justify-center py-10">
    <div class="grid gap-5 justify-items-center">
        <span class="text-5xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-violet-700 to-amber-500">
            Your world of opportunities!!!
        </span>
        <label class="text-center text-3xl font-semibold w-3/5">
            In every opportunity.... there lies a chance to close the gap to success!!! 
        </label>
        <label class="text-xl">
            An opportunity taken, is an experience created...
        </label>
    </div>
    
  </div>
</body>
</html>