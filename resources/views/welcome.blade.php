<!DOCTYPE html>
<html >
    <head>
        <title>Laravel</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
       <livewire:ChatBox />
       @livewireScripts
    </body>
</html>
