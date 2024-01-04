<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


    @vite('resources/css/app.css')
</head>

<body>

    <main class="relative h-screen overflow-hidden bg-gray-100 dark:bg-gray-800 rounded-2xl">

        <div class="flex items-start justify-between">
            <x-sidebar/>
            <div class="flex flex-col w-full pl-0 md:p-4 md:space-y-4">
               <x-header/>
                <div class="h-screen pt-2 pb-24 pl-2 pr-2 overflow-auto md:pt-0 md:pr-0 md:pl-0">
                    <div class="flex flex-col flex-wrap sm:flex-row ">



                        {{ $slot }}


                    </div>
                </div>
            </div>
        </div>



    </main>


</body>

</html>
