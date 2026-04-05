<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LLB Gestion Immo</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        /* Scrollbar personnalisée */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #c7c7c7; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #a0a0a0; }
    </style>
</head>
<body class="bg-[#F4F7FE] font-sans text-gray-700" x-data="{ sidebarOpen: true, mobileOpen: false }">

    <div class="flex h-screen overflow-hidden">

        <!-- OVERLAY MOBILE (Fond noir transparent sur mobile) -->
        <div x-show="mobileOpen" @click="mobileOpen = false" x-transition.opacity 
             class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"></div>

        <!-- ==================== SIDEBAR ==================== -->
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'" 
               class="fixed inset-y-0 left-0 z-30 flex flex-col transition-all duration-300 bg-[#445f47] shadow-xl lg:static lg:translate-x-0 transform"
               :class="mobileOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
            
            <!-- Logo -->
            <div class="flex items-center justify-center h-20 border-b border-green-600">
                <div class="flex items-center gap-2" x-show="sidebarOpen">
                    <span class="font-bold text-lg text-white">Gestion Immo</span>
                </div>
                <!-- Version réduite du logo -->
                <div x-show="!sidebarOpen" class="text-white p-1 rounded font-bold text-xl">GI</div>
            </div>

            <!-- MENU DE NAVIGATION -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                
                <!-- 1. Dashboard -->
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center px-4 py-3 rounded-xl transition-colors group
                   {{ request()->routeIs('dashboard') ? 'bg-white text-[#445f47] shadow-md' : 'text-green-100 hover:bg-green-600 hover:text-white' }}">
                    <i class="fa-solid fa-border-all w-6"></i>
                    <span x-show="sidebarOpen" class="font-medium ml-2">Tableau de bord</span>
                </a>

                <!-- 2. Propriétaires -->
                <a href="{{ route('proprietaires.index') }}" 
                   class="flex items-center px-4 py-3 rounded-xl transition-colors group
                   {{ request()->routeIs('proprietaires.*') ? 'bg-white text-[#445f47] shadow-md' : 'text-green-100 hover:bg-green-600 hover:text-white' }}">
                    <i class="fa-solid fa-user-tie w-6"></i>
                    <span x-show="sidebarOpen" class="font-medium ml-2">Propriétaires</span>
                </a>

                <!-- 3. Immobilier -->
                <a href="{{ route('biens.index') }}" 
                   class="flex items-center px-4 py-3 rounded-xl transition-colors group
                   {{ request()->routeIs('biens.*') ? 'bg-white text-[#445f47] shadow-md' : 'text-green-100 hover:bg-green-600 hover:text-white' }}">
                    <i class="fa-solid fa-house w-6"></i>
                    <span x-show="sidebarOpen" class="font-medium ml-2">Immobilier</span>
                </a>

                <!-- 4. Parcelles -->
                <a href="{{ route('parcelles.index') }}" 
                   class="flex items-center px-4 py-3 rounded-xl transition-colors group
                   {{ request()->routeIs('parcelles.*') ? 'bg-white text-[#445f47] shadow-md' : 'text-green-100 hover:bg-green-600 hover:text-white' }}">
                    <i class="fa-solid fa-map-marked-alt w-6"></i>
                    <span x-show="sidebarOpen" class="font-medium ml-2">Parcelles</span>
                </a>

                <!-- 4. Motos (Zem) -->
                <a href="{{ route('motos.index') }}" 
                   class="flex items-center px-4 py-3 rounded-xl transition-colors group
                   {{ request()->routeIs('motos.*') ? 'bg-white text-[#445f47] shadow-md' : 'text-green-100 hover:bg-green-600 hover:text-white' }}">
                    <i class="fa-solid fa-motorcycle w-6"></i>
                    <span x-show="sidebarOpen" class="font-medium ml-2">Motos (Zem)</span>
                </a>

                <!-- 5. Locations (Menu déroulant) -->
                <div class="relative" x-data="{ locationsOpen: false }">
                    <button @click="locationsOpen = !locationsOpen" 
                            class="flex items-center px-4 py-3 rounded-xl transition-colors group w-full
                            {{ request()->routeIs('locations_motos.*', 'locations_biens.*') ? 'bg-white text-[#445f47] shadow-md' : 'text-green-100 hover:bg-green-600 hover:text-white' }}">
                        <i class="fa-solid fa-handshake w-6"></i>
                        <span x-show="sidebarOpen" class="font-medium ml-2">Locations</span>
                        <i x-show="sidebarOpen" class="fas fa-chevron-down ml-auto text-xs transition-transform" 
                           :class="locationsOpen ? 'rotate-180' : ''"></i>
                    </button>
                    
                    <!-- Sous-menu Locations -->
                    <div x-show="locationsOpen" x-transition:enter="transition ease-out duration-200" 
                         x-transition:enter-start="opacity-0 transform -translate-y-2" 
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-150" 
                         x-transition:leave-start="opacity-100 transform translate-y-0" 
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="mt-1 ml-4 space-y-1" x-show="sidebarOpen">
                        
                        <!-- Locations Zem -->
                        <a href="{{ route('locations_motos.index') }}" 
                           class="flex items-center px-4 py-2 rounded-lg transition-colors text-sm
                           {{ request()->routeIs('locations_motos.*') ? 'bg-white text-[#445f47] font-medium' : 'text-green-100 hover:bg-green-700 hover:text-white' }}">
                            <i class="fa-solid fa-motorcycle w-4 mr-2"></i>
                            Locations Zem
                        </a>
                        
                        <!-- Locations Biens -->
                        <a href="{{ route('locations_biens.index') }}" 
                           class="flex items-center px-4 py-2 rounded-lg transition-colors text-sm
                           {{ request()->routeIs('locations_biens.*') ? 'bg-white text-[#445f47] font-medium' : 'text-green-100 hover:bg-green-700 hover:text-white' }}">
                            <i class="fa-solid fa-home w-4 mr-2"></i>
                            Locations Biens
                        </a>
                    </div>
                </div>

                <!-- 6. Paramètres -->
                <div class="relative" x-data="{ settingsOpen: false }">
                    <button @click="settingsOpen = !settingsOpen" 
                            class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-colors group text-green-100 hover:bg-green-600 hover:text-white">
                        <div class="flex items-center">
                            <i class="fa-solid fa-cog w-6"></i>
                            <span x-show="sidebarOpen" class="font-medium ml-2">Paramètres</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform" :class="settingsOpen ? 'rotate-180' : ''"></i>
                    </button>
                    
                    <!-- Sous-menu Paramètres -->
                    <div x-show="settingsOpen" x-transition:enter="transition ease-out duration-200" 
                         x-transition:enter-start="opacity-0 transform -translate-y-2" 
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-150" 
                         x-transition:leave-start="opacity-100 transform translate-y-0" 
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="mt-2 space-y-1">
                        
                        <!-- Utilisateurs -->
                        <a href="{{ route('users.index') }}" 
                           class="flex items-center px-4 py-2 rounded-lg transition-colors text-sm
                           {{ request()->routeIs('users.*') ? 'bg-white text-[#445f47] font-medium' : 'text-green-100 hover:bg-green-700 hover:text-white' }}">
                            <i class="fa-solid fa-users w-4 mr-2"></i>
                            Utilisateurs
                        </a>
                        
                        <!-- Journalisation -->
                        <a href="{{ route('journalisation.index') }}" 
                           class="flex items-center px-4 py-2 rounded-lg transition-colors text-sm
                           {{ request()->routeIs('journalisation.*') ? 'bg-white text-[#445f47] font-medium' : 'text-green-100 hover:bg-green-700 hover:text-white' }}">
                            <i class="fa-solid fa-clipboard-list w-4 mr-2"></i>
                            Journalisation
                        </a>
                    </div>
                </div>

            </nav>

            </aside>

        <!-- ==================== CONTENU PRINCIPAL ==================== -->
        <div class="flex-1 flex flex-col overflow-hidden relative">
            
            <!-- Header du haut -->
            <header class="flex items-center justify-between px-6 py-4 bg-[#F4F7FE] z-10">
                <div class="flex items-center">
                    <!-- Bouton Burger Mobile -->
                    <button @click="mobileOpen = !mobileOpen" class="text-gray-500 focus:outline-none lg:hidden mr-4">
                        <i class="fa-solid fa-bars text-2xl"></i>
                    </button>
                    <!-- Bouton Réduire Desktop -->
                    <button @click="sidebarOpen = !sidebarOpen" class="hidden lg:block text-gray-500 hover:text-[#445f47] mr-4 focus:outline-none">
                        <i class="fa-solid" :class="sidebarOpen ? 'fa-outdent' : 'fa-indent'"></i>
                    </button>
                    <!-- Titre Dynamique -->
                    <h1 class="text-2xl font-bold text-gray-800">@yield('title', 'Tableau de Bord')</h1>
                </div>
                
                <!-- Profil Utilisateur -->
                <div class="flex items-center gap-4">
                    <!-- Menu déroulant Profil -->
                    <div class="relative" x-data="{ profileOpen: false }">
                        <button @click="profileOpen = !profileOpen" 
                                class="flex items-center gap-3 pl-4 border-l border-gray-200 hover:bg-gray-50 rounded-lg px-2 py-1 transition-colors">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-bold text-gray-700">{{ Auth::user()->name ?? 'Utilisateur' }}</p>
                                <p class="text-xs text-gray-500">Administrateur</p>
                            </div>
                            <div class="h-10 w-10 rounded-full bg-[#445f47] text-white flex items-center justify-center font-bold shadow-sm">
                                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                            </div>
                            <i class="fas fa-chevron-down text-xs text-gray-500 ml-1"></i>
                        </button>
                        
                        <!-- Menu déroulant -->
                        <div x-show="profileOpen" x-transition:enter="transition ease-out duration-200" 
                             x-transition:enter-start="opacity-0 transform -translate-y-2" 
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-150" 
                             x-transition:leave-start="opacity-100 transform translate-y-0" 
                             x-transition:leave-end="opacity-0 transform -translate-y-2"
                             @click.away="profileOpen = false"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                            
                            <!-- Mon Profil -->
                            <a href="{{ route('profile.edit') }}" 
                               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                <i class="fa-solid fa-user mr-3 text-gray-400"></i>
                                Mon Profil
                            </a>
                            
                            <!-- Ligne de séparation -->
                            <hr class="my-2 border-gray-200">
                            
                            <!-- Déconnexion -->
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors text-left">
                                    <i class="fa-solid fa-right-from-bracket mr-3"></i>
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Zone de contenu où s'affichent tes pages (Propriétaires, Dashboard, etc.) -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto px-6 pb-6">
                <!-- Alertes de succès globales -->
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-sm" role="alert">
                        <span class="block sm:inline"><i class="fa-solid fa-check-circle mr-2"></i>{{ session('success') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false">
                            <i class="fa-solid fa-times cursor-pointer"></i>
                        </span>
                    </div>
                @endif

                <!-- Contenu injecté ici -->
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Modal de suppression -->
    @include('partials.delete-modal')
</body>
</html>