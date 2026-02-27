@extends('layouts.navigation')

@section('title', 'Tableau de Bord')

@section('content')

<!-- 1. CARTES STATISTIQUES -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
    
    <!-- Carte 1 : Immo -->
    <div class="bg-white rounded-2xl p-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] flex items-center border border-gray-100 transition-transform hover:-translate-y-1">
        <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-xl mr-4">
            <i class="fa-solid fa-house"></i>
        </div>
        <div>
            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Biens Immobiliers</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ App\Models\BienImmobilier::count() }}</h3>
            <p class="text-xs text-green-600 font-bold mt-1 flex items-center">
                <i class="fa-solid fa-arrow-trend-up mr-1"></i> +12%
            </p>
        </div>
    </div>

    <!-- Carte 2 : Motos -->
    <div class="bg-white rounded-2xl p-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] flex items-center border border-gray-100 transition-transform hover:-translate-y-1">
        <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-xl mr-4">
            <i class="fa-solid fa-motorcycle"></i>
        </div>
        <div>
            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Motos (Zem)</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ App\Models\Moto::count() }}</h3>
            <p class="text-xs text-green-600 font-bold mt-1 flex items-center">
                <i class="fa-solid fa-arrow-trend-up mr-1"></i> +5%
            </p>
        </div>
    </div>

    <!-- Carte 3 : Contrats -->
    <div class="bg-white rounded-2xl p-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] flex items-center border border-gray-100 transition-transform hover:-translate-y-1">
        <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-xl mr-4">
            <i class="fa-regular fa-file-lines"></i>
        </div>
        <div>
            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Contrats Actifs</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">
                @php
                    $countMotos = class_exists('App\Models\LocationMoto') ? App\Models\LocationMoto::where('statut', 'en_cours')->count() : 0;
                    $countBiens = class_exists('App\Models\LocationBien') ? \Illuminate\Support\Facades\DB::table('locations_biens')->where('statut', 'en_cours')->count() : 0;
                    echo $countMotos + $countBiens; 
                @endphp
            </h3>
            <p class="text-xs text-gray-400 mt-1">En cours</p>
        </div>
    </div>

    <!-- Carte 4 : Revenus -->
    <div class="bg-white rounded-2xl p-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] flex items-center border border-gray-100 transition-transform hover:-translate-y-1">
        <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-xl mr-4">
            <i class="fa-solid fa-wallet"></i>
        </div>
        <div>
            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Revenus Totaux</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">0 FCFA</h3>
            <p class="text-xs text-green-600 font-bold mt-1 flex items-center">
                <i class="fa-solid fa-arrow-trend-up mr-1"></i> +18%
            </p>
        </div>
    </div>
</div>

<!-- 2. SECTION CENTRALE (Activités & Alertes) -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Colonne Gauche : Activités Récentes -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] p-6 border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-gray-800">Activités Récentes</h3>
            <button class="text-[#445f47] hover:bg-green-50 p-2 rounded-full transition-colors">
                <i class="fa-solid fa-ellipsis"></i>
            </button>
        </div>

        <div class="space-y-6">
            <!-- Item 1 -->
            <div class="flex items-start justify-between group cursor-pointer">
                <div class="flex items-start">
                    <div class="bg-green-50 p-2.5 rounded-full mr-4 text-green-600 group-hover:bg-green-100 transition-colors">
                        <i class="fa-solid fa-money-bill-wave"></i>
                    </div>
                    <div>
                        <p class="font-bold text-gray-800 text-sm">Paiement reçu - Loyer Villa A12</p>
                        <p class="text-xs text-gray-400 mt-0.5">Il y a 2 heures • Par Agent Kouassi</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-bold text-green-600 text-sm">+150 000 F</p>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-green-100 text-green-800">
                        Validé
                    </span>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="flex items-start justify-between group cursor-pointer">
                <div class="flex items-start">
                    <div class="bg-green-50 p-3 rounded-full mr-4 text-green-600 group-hover:bg-green-100 transition-colors">
                        <i class="fa-solid fa-motorcycle"></i>
                    </div>
                    <div>
                        <p class="font-bold text-gray-800 text-sm group-hover:text-green-600 transition-colors">Retour Moto - AB-1234</p>
                        <p class="text-xs text-gray-400">Il y a 5 heures • Par Garage Central</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-bold text-gray-600 text-sm">-</p>
                    <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold rounded bg-gray-100 text-gray-800">
                        Terminé
                    </span>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="flex items-start justify-between group cursor-pointer">
                <div class="flex items-start">
                    <div class="bg-green-50 p-2.5 rounded-full mr-4 text-green-600 group-hover:bg-green-100 transition-colors">
                        <i class="fa-solid fa-motorcycle"></i>
                    </div>
                    <div>
                        <p class="font-bold text-gray-800 text-sm group-hover:text-green-600 transition-colors">Nouvelle location Moto (Zem)</p>
                        <p class="text-xs text-gray-400">Il y a 4 heures • Client: M. Dosso</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-bold text-gray-600">Contrat #4092</p>
                    <span class="inline-flex px-2 py-0.5 text-[10px] font-bold rounded bg-green-100 text-green-700">
                        En cours
                    </span>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="flex items-start justify-between group cursor-pointer">
                <div class="flex items-start">
                    <div class="bg-green-50 p-3 rounded-full mr-4 text-green-600 group-hover:bg-green-100 transition-colors">
                        <i class="fa-solid fa-file-invoice"></i>
                    </div>
                    <div>
                        <p class="font-bold text-gray-800 text-sm group-hover:text-green-600 transition-colors">Facture émise - Maintenance</p>
                        <p class="text-xs text-gray-400">Hier • Réparation Moto AB-1234</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-bold text-gray-800">- 25,000 FCFA</p>
                    <span class="inline-flex px-2 py-0.5 text-[10px] font-bold rounded bg-gray-100 text-gray-600">
                        En attente
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Colonne Droite : Alertes -->
    <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] p-6 h-fit border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-gray-800">Alertes & Retards</h3>
            <span class="bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded-full">2</span>
        </div>

        <div class="space-y-4">
            <!-- Alerte Rouge -->
            <div class="bg-red-50 border border-red-100 rounded-xl p-4 flex items-start transition-colors hover:bg-red-100/80">
                <i class="fa-solid fa-circle-exclamation text-red-500 mt-1 mr-3 text-lg"></i>
                <div>
                    <p class="text-sm font-bold text-red-800">Retard de paiement</p>
                    <p class="text-xs text-red-600 mt-1">M. Koffi (Villa B4) - 5 jours de retard</p>
                </div>
            </div>

            <!-- Alerte Jaune -->
            <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-4 flex items-start transition-colors hover:bg-yellow-100/80">
                <i class="fa-solid fa-circle-info text-yellow-500 mt-1 mr-3 text-lg"></i>
                <div>
                    <p class="text-sm font-bold text-yellow-800">Contrat Zem expire bientôt</p>
                    <p class="text-xs text-yellow-600 mt-1">Moto AB-1234 - Expire dans 3 jours</p>
                </div>
            </div>
        </div>

        <div class="mt-6 text-center pt-4 border-t border-gray-50">
            <a href="#" class="text-sm font-bold text-[#445f47] hover:underline flex items-center justify-center">
                Voir toutes les alertes
                <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
            </a>
        </div>
    </div>

</div>

@endsection
