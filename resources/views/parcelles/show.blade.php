@extends('layouts.navigation')

@section('title', 'Détails de la Parcelle')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- En-tête -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-medium text-gray-500">Détails de la parcelle</h2>
            <p class="text-sm text-gray-400">{{ $parcelle->code_parcelle }} - {{ $parcelle->titre_foncier }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('parcelles.edit', $parcelle) }}" 
               class="flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow-sm transition-colors">
                <i class="fas fa-edit mr-2"></i> Modifier
            </a>
            <a href="{{ route('parcelles.index') }}" 
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
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $parcelle->code_parcelle }}</h3>
                        <p class="text-gray-600 mb-3">{{ $parcelle->titre_foncier }}</p>
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @switch($parcelle->type_terrain)
                                    @case('residentiel') bg-blue-100 text-blue-800 @break
                                    @case('commercial') bg-green-100 text-green-800 @break
                                    @case('agricole') bg-green-100 text-green-800 @break
                                    @case('industriel') bg-orange-100 text-orange-800 @break
                                    @default bg-gray-100 text-gray-800
                                @endswitch">
                                {{ $parcelle->type_terrain_affiche }}
                            </span>
                            @if($parcelle->estVendue())
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Vendue
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @switch($parcelle->statut_juridique)
                                        @case('propriete') bg-green-100 text-green-800 @break
                                        @case('location') bg-yellow-100 text-yellow-800 @break
                                        @case('copropriete') bg-indigo-100 text-indigo-800 @break
                                        @default bg-gray-100 text-gray-800
                                    @endswitch">
                                    {{ $parcelle->statut_affiche }}
                                </span>
                            @endif
                        </div>
                    </div>
                    @if($parcelle->prix_achat)
                        <div class="text-right">
                            <p class="text-2xl font-bold text-[#445f47]">{{ number_format($parcelle->prix_achat, 0, ',', ' ') }} FCFA</p>
                            <p class="text-sm text-gray-500">Prix d'achat</p>
                            @if($parcelle->date_achat)
                                <p class="text-xs text-gray-400">{{ $parcelle->date_achat->format('d/m/Y') }}</p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                        <i class="fa-solid fa-ruler-combined text-[#445f47] mb-2"></i>
                        <p class="text-sm text-gray-500">Surface</p>
                        <p class="font-semibold">{{ number_format($parcelle->surface, 2, ',', ' ') }} m²</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                        <i class="fa-solid fa-map-marked-alt text-[#445f47] mb-2"></i>
                        <p class="text-sm text-gray-500">Type</p>
                        <p class="font-semibold">{{ $parcelle->type_terrain_affiche }}</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                        <i class="fa-solid fa-balance-scale text-[#445f47] mb-2"></i>
                        <p class="text-sm text-gray-500">Statut</p>
                        <p class="font-semibold">{{ $parcelle->statut_affiche }}</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                        <i class="fa-solid fa-file-contract text-[#445f47] mb-2"></i>
                        <p class="text-sm text-gray-500">Titre</p>
                        <p class="font-semibold text-xs">{{ $parcelle->titre_foncier }}</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <h4 class="font-semibold text-gray-700 mb-2">Description</h4>
                        <p class="text-gray-600">{{ $parcelle->description ?? 'Aucune description disponible.' }}</p>
                    </div>

                    <div>
                        <h4 class="font-semibold text-gray-700 mb-2">Adresse</h4>
                        <p class="text-gray-600 flex items-center">
                            <i class="fa-solid fa-map-marker-alt mr-2 text-[#445f47]"></i>
                            {{ $parcelle->adresse }}
                        </p>
                    </div>

                    @if($parcelle->documents_cadastraux)
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-2">Documents cadastraux</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach(json_decode($parcelle->documents_cadastraux) as $document)
                                    <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                                        <i class="fas fa-file-alt mr-1"></i> {{ $document }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Informations de vente -->
                    @if($parcelle->estVendue())
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <h4 class="font-semibold text-red-800 mb-2">
                                <i class="fas fa-handshake mr-2"></i>Informations de vente
                            </h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-red-600">Prix de vente</p>
                                    <p class="font-semibold text-red-800">{{ number_format($parcelle->prix_vente, 0, ',', ' ') }} FCFA</p>
                                </div>
                                <div>
                                    <p class="text-sm text-red-600">Date de vente</p>
                                    <p class="font-semibold text-red-800">{{ $parcelle->date_vente->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            @if($parcelle->acheteur)
                                <div class="mt-3 pt-3 border-t border-red-200">
                                    <p class="text-sm text-red-600">Acheteur</p>
                                    <p class="font-semibold text-red-800">{{ $parcelle->acheteur->nom }} - {{ $parcelle->acheteur->email }}</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Carte du propriétaire -->
            @if($parcelle->proprietaire)
                <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] p-6">
                    <h4 class="font-semibold text-gray-700 mb-4">Propriétaire</h4>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="h-12 w-12 rounded-full bg-[#445f47] text-white flex items-center justify-center font-bold mr-3">
                                {{ substr($parcelle->proprietaire->nom, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">{{ $parcelle->proprietaire->nom }}</p>
                                <p class="text-sm text-gray-500">{{ $parcelle->proprietaire->email }}</p>
                                <p class="text-sm text-gray-500">{{ $parcelle->proprietaire->telephone }}</p>
                            </div>
                        </div>
                        <a href="{{ route('proprietaires.show', $parcelle->proprietaire) }}" 
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
                    <a href="{{ route('parcelles.edit', $parcelle) }}" 
                       class="w-full flex items-center justify-center px-4 py-2 bg-[#445f47] hover:bg-[#364b39] text-white rounded-lg transition-colors">
                        <i class="fas fa-edit mr-2"></i> Modifier
                    </a>
                    
                    @if(!$parcelle->estVendue())
                        <button class="w-full flex items-center justify-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                            <i class="fas fa-handshake mr-2"></i> Vendre cette parcelle
                        </button>
                    @endif

                    <form action="{{ route('parcelles.destroy', $parcelle) }}" method="POST" class="w-full" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="w-full flex items-center justify-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors" 
                                onclick="showDeleteModal('Êtes-vous sûr de vouloir supprimer la parcelle {{ $parcelle->numero_parcelle }} ?', document.getElementById('deleteForm'))">
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
                        <span class="text-gray-500">Code parcelle</span>
                        <span class="font-medium">{{ $parcelle->code_parcelle }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Titre foncier</span>
                        <span class="font-medium text-xs">{{ $parcelle->titre_foncier }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Créée le</span>
                        <span class="font-medium">{{ $parcelle->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Modifiée le</span>
                        <span class="font-medium">{{ $parcelle->updated_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Carte de photos -->
            @if($parcelle->photos)
                <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] p-6">
                    <h4 class="font-semibold text-gray-700 mb-4">Photos</h4>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach(json_decode($parcelle->photos) as $photo)
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
@endsection
