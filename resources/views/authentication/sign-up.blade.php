<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
   <!-- Fonts -->
   <link rel="preconnect" href="https://fonts.bunny.net">
   <link href="https://fonts.bunny.net/css?family=figtre e:400,600&display=swap" rel="stylesheet" /> 

   <title>Sign up</title>
  
  @vite('resources/css/app.css')
</head>
<body>
  @include('components/navbar')
  <form action="{{ route('authentication.sign-up') }}" method="post">
    @csrf
    <div class="mx-auto max-w-xl my-12">
      <div class="flex justify-center py-16 bg-gray-100 shadow-lg shadow-gray-500">
          <div class="grid gap-3 justify-items-left">
              <label class="text-2xl font-semibold">Let's get you registered</label>
              <label class="text-xl">Name:</label>
              <input class="h-10 px-2 italic rounded-md" type="text" placeholder="Enter full name" name="name" value="{{ old('name') }}">
                @error('name')
                    <span class="text-red-500 italic">*{{$message}}</span>
                @enderror
              <label class="text-xl">Phone number:</label>
              <input class="h-10 px-2 italic rounded-md" type="text" placeholder="Phone number" name="phone" value="{{ old('phone') }}">
              @error('phone')
                    <span class="text-red-500 italic">*{{$message}}</span>
                @enderror
              <label class="text-xl">Email:</label>
              <input class="h-10 px-2 italic rounded-md" type="email" size="50" placeholder="Email address" name="email" value="{{ old('email') }}">
              @error('email')
                    <span class="text-red-500 italic">*{{$message}}</span>
                @enderror
              <label class="text-xl">Password:</label>
              <input class="h-10 px-2 italic rounded-md" type="password" placeholder="input a strong password" name="password" id="">
              @error('password')
                    <span class="text-red-500 italic">*{{$message}}</span>
                @enderror
              <label class="text-xl">Confirm password:</label>
              <input class="h-10 px-2 italic rounded-md" type="password" placeholder="input your password again" name="password_confirmation" id="">
              @error('password_confirmation')
                    <span class="text-red-500 italic">*{{$message}}</span>
                @enderror
              <label class="text-xl">Register as:</label>
              <div>
                  <input type="radio" name="user_type" value="Company" id="company" value="{{ old('user_type') }}">   
                  <label>Company</label>
                  <input type="radio" name="user_type" value="applicant" id="applicant" value="{{ old('user_type') }}">
                  <label>Applicant</label>
              </div>
              @error('user_type')
                    <span class="text-red-500 italic">*{{$message}}</span>
              @enderror
              <div id="category" style="display: none">
                <select name="category" class="h-10 px-2 rounded-md" >
                  <option  value="Intern">Intern</option>
                  <option  value="Volunteer">Volunteer</option>
                  <option  value="Job">Job</option>
              </select>
              </div>
          
              {{-- <a class="grid justify-items-center bg-amber-600 rounded ring-2 ring-amber-500 hover:ring-gray-600/50 p-2 font-semibold" href="/">
              </a> --}}
              <button type="submit" class="grid justify-items-center bg-amber-600 rounded ring-2 ring-amber-500 hover:ring-gray-600/50 p-2 font-semibold">Sign Up</button>
              <label class="text-md">Already having an account? <a class="text-amber-500 hover:underline" href="/login">Login</a></label>
          </div>
        </div>
    </div>
  </form>


  
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const userTypeRadios = document.querySelectorAll('input[name="user_type"]');
      const categoryField = document.getElementById('category');

      userTypeRadios.forEach(radio => {
          radio.addEventListener('change', function () {
              if (this.value === 'applicant') {
                  categoryField.style.display = 'block';
              } else {
                  categoryField.style.display = 'none';
              }
          });
      });
    });
  </script>
</body>
</html>