<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen" style="background-color: rgb(226 240 255 / 86%);">
            @include('layouts.navigation')

            <div class="fixed inset-x-0 top-[80px] z-60 flex justify-center pointer-events-none">
                    <div class="w-full max-w-md px-4 pointer-events-auto">
                        @include('components.flash-messages')
                    </div>
                </div>

            <!-- Page Content -->
            <main class="pt-24 [&>*]:shadow-md [&>*]:rounded-lg">
                <!-- Ajoute des ombres portu00e9es et des coins arrondis u00e0 tous les u00e9lu00e9ments enfants directs du main -->
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
