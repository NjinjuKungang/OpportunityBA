<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <section class="max-w-4/5 first-line:px-6 py-8 mx-auto bg-white dark:bg-gray-900">
        <header>
            <a class="bg-clip-text text-4xl font-bold text-transparent bg-gradient-to-r from-amber-500 to-violet-500" href="#">
                OppBoard
            </a>
        </header>

        <main class="mt-8">
            <h2 class="text-gray-700 dark:text-gray-200"> Hello, {{$mailData['applicant']->name}}</h2>
            <p>
                {{$mailData['opportunity']->user->name}} has posted a new opportunity for the role <span>{{$mailData['opportunity']->user->category}}</span> 
            </p>
            <a href="http://127.0.0.1:8082">
                <button class="px-6 py-2 mt-4 text sm font-medium tracking-wider text-white capitalize">
                    View Opportunity
                </button>
            </a>
    
            <p>
                Thanks, <br> OppBoard
            </p>
        </main>
    </section>


</body>
</html>