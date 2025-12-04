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
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-slate-900 via-[#0f172a] to-slate-900 relative overflow-hidden selection:bg-blue-500 selection:text-white">
            
            <!-- Decorative Background Elements -->
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl -translate-y-1/2 pointer-events-none"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl translate-y-1/2 pointer-events-none"></div>

            <div class="relative z-10 mb-6 animate-fade-in-down">
                <a href="/" class="flex flex-col items-center group">
                    <div class="transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3">
                        <x-application-logo class="w-auto h-32 fill-current text-white drop-shadow-2xl" style="height: 120px;" />
                    </div>
                    <span class="mt-4 text-2xl font-bold text-white tracking-wider opacity-0 group-hover:opacity-100 transition-opacity duration-500 -translate-y-2 group-hover:translate-y-0">USMBA</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-4 px-8 py-8 bg-white/90 backdrop-blur-xl border border-white/50 shadow-[0_8px_30px_rgb(0,0,0,0.12)] sm:rounded-2xl relative z-10 transition-all duration-300 hover:shadow-[0_20px_50px_rgb(0,0,0,0.2)]">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-slate-500 text-sm font-medium relative z-10">
                Système de Gestion Académique
            </div>
        </div>
        
        <style>
            @keyframes fadeInDown {
                from {
                    opacity: 0;
                    transform: translate3d(0, -20px, 0);
                }
                to {
                    opacity: 1;
                    transform: translate3d(0, 0, 0);
                }
            }
            .animate-fade-in-down {
                animation: fadeInDown 0.8s ease-out;
            }
        </style>
    </body>
</html>
