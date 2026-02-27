@extends('layouts.navigation')

@section('title', 'Détails du Bien Immobilier')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- En-tête -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-medium text-gray-500">Détails du bien</h2>
            <p class="text-sm text-gray-400">{{ $bien->titre }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('biens.edit', $bien) }}" 
               class="flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow-sm transition-colors">
                <i class="fas fa-edit mr-2"></i> Modifier
            </a>
            <a href="{{ route('biens.index') }}" 
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
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $bien->titre }}</h3>
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ ucfirst($bien->type) }}
                            </span>
                            @if($bien->statut == 'disponible')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Disponible
                                </span>
                            @elseif($bien->statut == 'loue')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Loué
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    En maintenance
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-[#445f47]">{{ number_format($bien->loyer_mensuel, 0, ',', ' ') }} FCFA</p>
                        <p class="text-sm text-gray-500">/ mois</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                        <i class="fa-solid fa-ruler-combined text-[#445f47] mb-2"></i>
                        <p class="text-sm text-gray-500">Surface</p>
                        <p class="font-semibold">{{ $bien->surface }} m²</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                        <i class="fa-solid fa-door-open text-[#445f47] mb-2"></i>
                        <p class="text-sm text-gray-500">Pièces</p>
                        <p class="font-semibold">{{ $bien->nombre_pieces ?? 0 }}</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                        <i class="fa-solid fa-shield-alt text-[#445f47] mb-2"></i>
                        <p class="text-sm text-gray-500">Caution</p>
                        <p class="font-semibold">{{ number_format($bien->caution, 0, ',', ' ') }} FCFA</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                        <i class="fa-solid fa-calendar text-[#445f47] mb-2"></i>
                        <p class="text-sm text-gray-500">Disponibilité</p>
                        <p class="font-semibold">{{ $bien->date_disponibilite ? $bien->date_disponibilite->format('d/m/Y') : 'Immédiate' }}</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <h4 class="font-semibold text-gray-700 mb-2">Description</h4>
                        <p class="text-gray-600">{{ $bien->description ?? 'Aucune description disponible.' }}</p>
                    </div>

                    <div>
                        <h4 class="font-semibold text-gray-700 mb-2">Adresse</h4>
                        <p class="text-gray-600 flex items-center">
                            <i class="fa-solid fa-map-marker-alt mr-2 text-[#445f47]"></i>
                            {{ $bien->adresse }}
                        </p>
                    </div>

                    @if($bien->equipements)
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-2">Équipements</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach(json_decode($bien->equipements) as $equipement)
                                    <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                                        {{ $equipement }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Carte du propriétaire -->
            @if($bien->proprietaire)
                <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] p-6">
                    <h4 class="font-semibold text-gray-700 mb-4">Propriétaire</h4>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="h-12 w-12 rounded-full bg-[#445f47] text-white flex items-center justify-center font-bold mr-3">
                                {{ substr($bien->proprietaire->nom, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">{{ $bien->proprietaire->nom }}</p>
                                <p class="text-sm text-gray-500">{{ $bien->proprietaire->email }}</p>
                                <p class="text-sm text-gray-500">{{ $bien->proprietaire->telephone }}</p>
                            </div>
                        </div>
                        <a href="{{ route('proprietaires.show', $bien->proprietaire) }}" 
                           class="text-[#445f47] hover:text-[#364b39] text-sm font-medium">
                            Voir le profil →
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Carte d'actions -->
            <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] p-6">
                <h4 class="font-semibold text-gray-700 mb-4">Actions</h4>
                <div class="space-y-3">
                    <a href="{{ route('biens.edit', $bien) }}" 
                       class="w-full flex items-center justify-center px-4 py-2 bg-[#445f47] hover:bg-[#364b39] text-white rounded-lg transition-colors">
                        <i class="fas fa-edit mr-2"></i> Modifier
                    </a>
                    
                    @if($bien->statut == 'disponible')
                        <button class="w-full flex items-center justify-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors">
                            <i class="fas fa-handshake mr-2"></i> Louer ce bien
                        </button>
                    @endif

                    <form action="{{ route('biens.destroy', $bien) }}" method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors" 
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce bien ?')">
                            <i class="fas fa-trash mr-2"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>

            <!-- Carte d'informations système -->
            <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] p-6">
                <h4 class="font-semibold text-gray-700 mb-4">Informations</h4>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Code unique</span>
                        <span class="font-medium">{{ $bien->code_unique }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Créé le</span>
                        <span class="font-medium">{{ $bien->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Modifié le</span>
                        <span class="font-medium">{{ $bien->updated_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
