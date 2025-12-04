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
    <body class="font-sans antialiased bg-slate-50 text-slate-900">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Flash Messages Area -->
            <div class="fixed inset-x-0 top-20 z-50 flex justify-center pointer-events-none">
                <div class="w-full max-w-xl px-4 pointer-events-auto transition-all duration-300">
                    @include('components.flash-messages')
                </div>
            </div>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow-sm border-b border-slate-200 sticky top-16 z-30">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="animate-fade-in-up">
                    {{ $slot }}
                </div>
            </main>

            <footer class="bg-white border-t border-slate-200 mt-auto">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <p class="text-center text-sm text-slate-500">
                        &copy; {{ date('Y') }} USMBA - Gestion de Parcours. Tous droits réservés.
                    </p>
                </div>
            </footer>
        </div>

        <style>
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translate3d(0, 20px, 0);
                }
                to {
                    opacity: 1;
                    transform: translate3d(0, 0, 0);
                }
            }
            .animate-fade-in-up {
                animation: fadeInUp 0.5s ease-out;
            }
        </style>
    </body>
</html>
