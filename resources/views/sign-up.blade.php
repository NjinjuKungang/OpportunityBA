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
            <label class="text-2xl font-semibold">Let's get you registered</label>
            <label class="text-xl">Name:</label>
            <input class="h-10 px-2 italic rounded-md" type="text" placeholder="Enter full name" name="" id="">
            <label class="text-xl">Phone number:</label>
            <input class="h-10 px-2 italic rounded-md" type="text" placeholder="Phone number" name="" id="">
            <label class="text-xl">Email:</label>
            <input class="h-10 px-2 italic rounded-md" type="email" placeholder="Email address" id="">
            <label class="text-xl">Password:</label>
            <input class="h-10 px-2 italic rounded-md" type="password" placeholder="input a strong password" name="" id="">
            <label class="text-xl">Register as:</label>
            <div>
                <input type="radio" name="Company" id="">
                <label>Company</label>
                <input type="radio">
                <label>Opportunity seeker</label>
            </div>
        
            <a class="grid justify-items-center bg-amber-600 rounded ring-2 ring-amber-500 hover:ring-gray-600/50 p-2 font-semibold" href="/">
                <button>Sign Up</button>
            </a>
            <label class="text-md">Already having an account? <a class="text-amber-500 hover:underline" href="/login">Login</a></label>
        </div>
      </div>
  </div>
</body>
</html>