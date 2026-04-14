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
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
    
    <!-- Animation de chargement -->
    <div id="loadingOverlay" class="fixed inset-0 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen bg-black/50 backdrop-blur-sm">
            <div class="bg-white rounded-xl p-8 shadow-2xl flex flex-col items-center">
                <!-- Animation de chargement -->
                <div class="relative w-16 h-16 mb-4">
                    <div class="absolute inset-0 border-4 border-gray-200 rounded-full"></div>
                    <div class="absolute inset-0 border-4 border-[#445f47] rounded-full border-t-transparent animate-spin"></div>
                    <div class="absolute inset-2 flex items-center justify-center">
                        <i class="fas fa-shield-halved text-[#445f47] text-xl"></i>
                    </div>
                </div>
                
                <!-- Texte de chargement -->
                <p class="text-gray-700 font-medium">Chargement...</p>
                <p class="text-gray-500 text-sm mt-1">Veuillez patienter</p>
            </div>
        </div>
    </div>

    <script>
        // Fonctions de chargement
        function showLoading(message = 'Chargement...', subtext = 'Veuillez patienter') {
            const overlay = document.getElementById('loadingOverlay');
            const messageEl = overlay.querySelector('p.text-gray-700');
            const subtextEl = overlay.querySelector('p.text-gray-500');
            
            messageEl.textContent = message;
            subtextEl.textContent = subtext;
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function hideLoading() {
            const overlay = document.getElementById('loadingOverlay');
            overlay.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Intercepter les formulaires
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                if (!form.hasAttribute('data-no-loading')) {
                    form.addEventListener('submit', function(e) {
                        showLoading('Traitement en cours...', 'Veuillez patienter');
                    });
                }
            });
        });
    </script>
</html>
