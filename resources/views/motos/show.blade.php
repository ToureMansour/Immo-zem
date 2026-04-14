@extends('layouts.navigation')

@section('title', 'Détails de la Moto')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- En-tête -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-medium text-gray-500">Détails de la moto</h2>
            <p class="text-sm text-gray-400">{{ $moto->immatriculation }} - {{ $moto->marque }} {{ $moto->modele }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('motos.index') }}" 
               class="flex items-center px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Retour
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informations principales -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Carte d'informations générales -->
            <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $moto->immatriculation }}</h3>
                        <p class="text-gray-600 mb-3">{{ $moto->marque }} {{ $moto->modele }}</p>
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @switch($moto->type_moto)
                                    @case('taxi') bg-yellow-100 text-yellow-800 @break
                                    @case('personnel') bg-blue-100 text-blue-800 @break
                                    @case('livraison') bg-green-100 text-green-800 @break
                                    @default bg-gray-100 text-gray-800
                                @endswitch">
                                {{ ucfirst($moto->type_moto) }}
                            </span>
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @switch($moto->statut)
                                    @case('disponible') bg-green-100 text-green-800 @break
                                    @case('loue') bg-blue-100 text-blue-800 @break
                                    @case('reparation') bg-orange-100 text-orange-800 @break
                                    @case('hors_service') bg-red-100 text-red-800 @break
                                    @default bg-gray-100 text-gray-800
                                @endswitch">
                                {{ ucfirst($moto->statut) }}
                            </span>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-[#445f47]">{{ number_format($moto->prix_journalier, 0, ',', ' ') }} F</p>
                        <p class="text-sm text-gray-500">/ jour</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                        <i class="fa-solid fa-calendar text-[#445f47] mb-2"></i>
                        <p class="text-sm text-gray-500">Année</p>
                        <p class="font-semibold">{{ $moto->annee }}</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                        <i class="fa-solid fa-palette text-[#445f47] mb-2"></i>
                        <p class="text-sm text-gray-500">Couleur</p>
                        <p class="font-semibold">{{ ucfirst($moto->couleur) }}</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                        <i class="fa-solid fa-tachometer-alt text-[#445f47] mb-2"></i>
                        <p class="text-sm text-gray-500">Kilométrage</p>
                        <p class="font-semibold">{{ number_format($moto->kilometrage, 0, ',', ' ') }} km</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                        <i class="fa-solid fa-id-card text-[#445f47] mb-2"></i>
                        <p class="text-sm text-gray-500">Carte grise</p>
                        <p class="font-semibold text-xs">{{ $moto->carte_grise_numero }}</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <h4 class="font-semibold text-gray-700 mb-2">Description</h4>
                        <p class="text-gray-600">{{ $moto->description ?? 'Aucune description disponible.' }}</p>
                    </div>

                    <div>
                        <h4 class="font-semibold text-gray-700 mb-2">Tarifs</h4>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-sm text-gray-500">Journalier</p>
                                <p class="font-semibold text-[#445f47]">{{ number_format($moto->prix_journalier, 0, ',', ' ') }} F</p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-sm text-gray-500">Avec crédit</p>
                                <p class="font-semibold text-[#445f47]">{{ number_format($moto->prix_avec_credit, 0, ',', ' ') }} F</p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-sm text-gray-500">Location/Vente</p>
                                <p class="font-semibold text-[#445f47]">{{ number_format($moto->prix_location_vente, 0, ',', ' ') }} F</p>
                            </div>
                        </div>
                    </div>

                    @if($moto->date_derniere_maintenance)
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-2">Dernière maintenance</h4>
                            <p class="text-gray-600 flex items-center">
                                <i class="fa-solid fa-wrench mr-2 text-[#445f47]"></i>
                                {{ $moto->date_derniere_maintenance->format('d/m/Y') }}
                            </p>
                        </div>
                    @endif

                    <div>
                        <h4 class="font-semibold text-gray-700 mb-2">Carte grise</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Numéro</p>
                                    <p class="font-semibold">{{ $moto->carte_grise_numero }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Date délivrance</p>
                                    <p class="font-semibold">{{ $moto->carte_grise_delivrance->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Photos -->
                    @if($moto->photos)
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-2">Photos</h4>
                            <div class="grid grid-cols-3 gap-3">
                                @foreach(json_decode($moto->photos) as $photo)
                                    <div class="aspect-square bg-gray-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-2xl"></i>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Carte d'informations système -->
            <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] p-6">
                <h4 class="font-semibold text-gray-700 mb-4">Informations</h4>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Immatriculation</span>
                        <span class="font-medium">{{ $moto->immatriculation }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Type</span>
                        <span class="font-medium">{{ ucfirst($moto->type_moto) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Créée le</span>
                        <span class="font-medium">{{ $moto->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Modifiée le</span>
                        <span class="font-medium">{{ $moto->updated_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Carte de location actuelle -->
            @if($moto->locationActuelle)
                <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] p-6">
                    <h4 class="font-semibold text-gray-700 mb-4">Location actuelle</h4>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-blue-600">En cours depuis</p>
                                <p class="font-semibold text-blue-800">{{ $moto->locationActuelle->date_debut->format('d/m/Y') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-blue-600">Chauffeur</p>
                                <p class="font-semibold text-blue-800">{{ $moto->locationActuelle->chauffeur ?? 'Non assigné' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
