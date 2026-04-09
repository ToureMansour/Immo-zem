<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LLB Gestion Immo - Plateforme Administrative</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts (Inter pour un look pro et lisible) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-700 antialiased">

    <!-- Navbar (Simple et Pro) -->
    <nav class="fixed w-full z-50 bg-white/95 backdrop-blur-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            
            <!-- Logo Texte Simple -->
            <a href="/" class="text-2xl font-bold text-gray-800 tracking-tight">
                LLB <span class="text-[#445f47]">Gestion</span>
            </a>

            <!-- Menu Droite -->
            <div class="flex items-center gap-6">
                <!-- Liens de navigation simplifiés -->
                <div class="hidden md:flex gap-6 text-sm font-medium text-gray-500">
                    <a href="#fonctionnalites" class="hover:text-[#445f47] transition">Fonctionnalités</a>
                    <a href="#" class="hover:text-[#445f47] transition">Aide</a>
                </div>

                <!-- Bouton Connexion -->
                <a href="{{ route('login') }}" class="px-5 py-2.5 bg-[#445f47] hover:bg-[#364b39] text-white rounded-lg font-medium text-sm transition shadow-sm shadow-green-900/10 flex items-center">
                    <i class="fa-solid fa-lock mr-2"></i> Se connecter
                </a>
            </div>
        </div>
    </nav>

    <!-- Messages Flash -->
    @if (session('success'))
        <div class="fixed top-24 right-6 z-50 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-lg shadow-lg max-w-sm">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        
        <!-- Script pour masquer automatiquement le message -->
        <script>
            setTimeout(function() {
                const message = document.querySelector('.fixed.top-24');
                if (message) {
                    message.style.transition = 'opacity 0.5s ease-out';
                    message.style.opacity = '0';
                    setTimeout(() => message.remove(), 500);
                }
            }, 5000);
        </script>
    @endif

    <!-- HERO SECTION (Haut de page) -->
    <section class="pt-32 pb-20 lg:pt-40 lg:pb-28">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <!-- Texte -->
            <div class="space-y-6">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight">
                    Centralisez votre <br>
                    <span class="text-[#445f47]">Gestion Locative</span>
                </h1>
                
                <p class="text-lg text-gray-500 leading-relaxed max-w-lg">
                    Une plateforme unique pour administrer vos biens immobiliers, vos parcelles et suivre l'activité de votre flotte de motos taxis en temps réel.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ route('login') }}" class="px-8 py-3.5 bg-[#445f47] text-white rounded-xl font-bold shadow-lg shadow-green-900/20 hover:bg-[#364b39] hover:-translate-y-1 transition-all text-center">
                        Accéder à mon espace
                    </a>
                    <a href="#fonctionnalites" class="px-8 py-3.5 bg-white text-gray-700 border border-gray-200 rounded-xl font-bold hover:bg-gray-50 hover:border-gray-300 transition-all text-center">
                        Découvrir les modules
                    </a>
                </div>
            </div>

            <!-- Image d'illustration (Propre et Lumineuse) -->
            <div class="relative">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-gray-100">
                    <!-- Image de bureau moderne -->
                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069&auto=format&fit=crop" 
                         alt="Dashboard Illustration" 
                         class="w-full h-auto object-cover">
                    
                    <!-- Overlay subtil -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-[#445f47]/10 to-transparent"></div>
                </div>
                
                <!-- Élément décoratif arrière plan -->
                <div class="absolute -z-10 top-10 -right-10 w-full h-full bg-gray-50 rounded-3xl"></div>
            </div>

        </div>
    </section>

    <!-- SECTION CARTES (Harmonisée avec le haut) -->
    <section id="fonctionnalites" class="py-20 bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="text-center mb-16 max-w-2xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Vos outils de gestion</h2>
                <p class="text-gray-500">Sélectionnez un module pour accéder aux détails ou connectez-vous pour gérer l'ensemble.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Carte 1 : Immobilier -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-green-900/5 transition-all duration-300 overflow-hidden group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Immobilier" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center text-[#445f47] text-xl mb-4">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Immobilier</h3>
                        <p class="text-sm text-gray-500 mb-6 line-clamp-2">
                            Gestion complète des loyers, quittances, contrats de bail et maintenance des bâtiments.
                        </p>
                        <a href="{{ route('login') }}" class="text-[#445f47] font-semibold text-sm hover:underline flex items-center">
                            Gérer les biens <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Carte 2 : Parcelles -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-green-900/5 transition-all duration-300 overflow-hidden group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Terrains" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center text-[#445f47] text-xl mb-4">
                            <i class="fa-solid fa-map-location-dot"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Parcelles</h3>
                        <p class="text-sm text-gray-500 mb-6 line-clamp-2">
                            Suivi des terrains nus, lotissements, documentation foncière et titres de propriété.
                        </p>
                        <a href="{{ route('login') }}" class="text-[#445f47] font-semibold text-sm hover:underline flex items-center">
                            Voir les terrains <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Carte 3 : Motos -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-green-900/5 transition-all duration-300 overflow-hidden group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1558981403-c5f9899a28bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Motos" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center text-[#445f47] text-xl mb-4">
                            <i class="fa-solid fa-motorcycle"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Flotte Zem</h3>
                        <p class="text-sm text-gray-500 mb-6 line-clamp-2">
                            Gestion des motos-taxis, suivi des versements journaliers et contrats conducteurs.
                        </p>
                        <a href="{{ route('login') }}" class="text-[#445f47] font-semibold text-sm hover:underline flex items-center">
                            Gérer la flotte <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer Simple et Épuré -->
    <footer class="bg-white border-t border-gray-200 py-8">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray-500 text-sm font-medium">
                &copy; {{ date('Y') }} LLB Gestion. Tous droits réservés.
            </p>
            
            <div class="flex gap-6">
                <a href="#" class="text-gray-400 hover:text-[#445f47] transition text-sm">Mentions légales</a>
                <a href="#" class="text-gray-400 hover:text-[#445f47] transition text-sm">Confidentialité</a>
                <a href="#" class="text-gray-400 hover:text-[#445f47] transition text-sm">Contact</a>
            </div>
        </div>
    </footer>

</body>
</html>