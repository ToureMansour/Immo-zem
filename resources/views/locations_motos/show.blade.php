@extends('layouts.navigation')

@section('title', 'Détails de la Location - ' . $location->numero_location)

@section('content')

<div class="max-w-6xl mx-auto">
    <!-- En-tête -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Location {{ $location->numero_location }}</h2>
                <p class="text-gray-600 mt-1">Détails complets de la location de moto</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('locations_motos.edit', $location) }}" 
                   class="flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors">
                    <i class="fas fa-edit mr-2"></i> Modifier
                </a>
                <a href="{{ route('locations_motos.index') }}" 
                   class="flex items-center px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Retour
                </a>
            </div>
        </div>
    </div>

    <!-- Cartes Principales -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        
        <!-- Carte Moto -->
        <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
                <h3 class="text-white font-semibold flex items-center">
                    <i class="fas fa-motorcycle mr-2"></i> Moto Louée
                </h3>
            </div>
            <div class="p-6">
                <div class="text-center mb-4">
                    <p class="text-3xl font-bold text-gray-900">{{ $location->moto->immatriculation }}</p>
                    <p class="text-gray-600">{{ $location->moto->marque }} {{ $location->moto->modele }}</p>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Année:</span>
                        <span class="font-medium">{{ $location->moto->annee }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Couleur:</span>
                        <span class="font-medium">{{ $location->moto->couleur }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Type:</span>
                        <span class="px-2 py-1 text-xs font-bold rounded-lg bg-blue-100 text-blue-700">
                            {{ ucfirst($location->moto->type_moto) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Kilométrage:</span>
                        <span class="font-medium">{{ number_format($location->moto->kilometrage, 0, ',', ' ') }} km</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Conducteur -->
        <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-green-600 p-4">
                <h3 class="text-white font-semibold flex items-center">
                    <i class="fas fa-user mr-2"></i> Conducteur
                </h3>
            </div>
            <div class="p-6">
                <div class="text-center mb-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $location->conducteur->nom }} {{ $location->conducteur->prenom }}</p>
                    <p class="text-gray-600">{{ $location->conducteur->telephone }}</p>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Email:</span>
                        <span class="font-medium text-sm">{{ $location->conducteur->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Adresse:</span>
                        <span class="font-medium text-sm">{{ $location->conducteur->adresse }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">CNI:</span>
                        <span class="font-medium text-sm">{{ $location->conducteur->cni_numero }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Permis:</span>
                        <span class="font-medium text-sm">{{ $location->conducteur->permis_numero }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Statut & Actions -->
        <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-4">
                <h3 class="text-white font-semibold flex items-center">
                    <i class="fas fa-cog mr-2"></i> Statut & Actions
                </h3>
            </div>
            <div class="p-6">
                <div class="text-center mb-6">
                    @switch($location->statut)
                        @case('en_attente')
                            <span class="px-4 py-2 inline-flex text-sm font-bold rounded-lg bg-yellow-100 text-yellow-700 border border-yellow-200">
                                <i class="fas fa-clock mr-2"></i> En Attente
                            </span>
                            @break
                        @case('en_cours')
                            <span class="px-4 py-2 inline-flex text-sm font-bold rounded-lg bg-blue-100 text-blue-700 border border-blue-200">
                                <i class="fas fa-play-circle mr-2"></i> En Cours
                            </span>
                            @break
                        @case('terminee')
                            <span class="px-4 py-2 inline-flex text-sm font-bold rounded-lg bg-green-100 text-green-700 border border-green-200">
                                <i class="fas fa-check-circle mr-2"></i> Terminée
                            </span>
                            @break
                        @case('annulee')
                            <span class="px-4 py-2 inline-flex text-sm font-bold rounded-lg bg-red-100 text-red-700 border border-red-200">
                                <i class="fas fa-times-circle mr-2"></i> Annulée
                            </span>
                            @break
                    @endswitch
                </div>

                <!-- Actions Rapides -->
                <div class="space-y-3">
                    @if($location->statut === 'en_cours')
                        <form action="{{ route('locations_motos.terminer', $location) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors"
                                    onclick="return confirm('Êtes-vous sûr de vouloir terminer cette location ?')">
                                <i class="fas fa-check mr-2"></i> Terminer la Location
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('locations_motos.edit', $location) }}" 
                       class="w-full flex items-center justify-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors">
                        <i class="fas fa-edit mr-2"></i> Modifier
                    </a>

                    <form action="{{ route('locations_motos.destroy', $location) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette location ?')">
                            <i class="fas fa-trash mr-2"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Détails Complets -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Informations de Location -->
        <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 p-4">
                <h3 class="text-white font-semibold flex items-center">
                    <i class="fas fa-info-circle mr-2"></i> Informations de Location
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Numéro Location</p>
                        <p class="font-bold text-gray-900">{{ $location->numero_location }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Type Location</p>
                        <p class="font-bold text-gray-900">{{ ucfirst($location->type_location) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Date Début</p>
                        <p class="font-bold text-gray-900">{{ $location->date_debut->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Date Fin</p>
                        <p class="font-bold text-gray-900">
                            {{ $location->date_fin ? $location->date_fin->format('d/m/Y') : 'Non définie' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Durée</p>
                        <p class="font-bold text-gray-900">{{ $location->duree_jours }} jour(s)</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Date Création</p>
                        <p class="font-bold text-gray-900">{{ $location->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informations Financières -->
        <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-green-600 p-4">
                <h3 class="text-white font-semibold flex items-center">
                    <i class="fas fa-money-bill-wave mr-2"></i> Informations Financières
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-3 border-b">
                        <span class="text-gray-600">Montant Total</span>
                        <span class="text-xl font-bold text-gray-900">{{ number_format($location->montant_total, 0, ',', ' ') }} F</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Acompte Versé</span>
                        <span class="font-medium text-green-600">{{ number_format($location->acompte, 0, ',', ' ') }} F</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Caution</span>
                        <span class="font-medium text-blue-600">{{ number_format($location->caution, 0, ',', ' ') }} F</span>
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t">
                        <span class="text-gray-800 font-semibold">Reste à Payer</span>
                        <span class="text-xl font-bold text-orange-600">{{ number_format($location->reste_a_payer, 0, ',', ' ') }} F</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- État de la Moto -->
    <div class="mt-6 bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] overflow-hidden">
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-4">
            <h3 class="text-white font-semibold flex items-center">
                <i class="fas fa-tachometer-alt mr-2"></i> État de la Moto
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Au Départ -->
                <div>
                    <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-sign-out-alt text-green-500 mr-2"></i> Au Départ
                    </h4>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Kilométrage:</span>
                            <span class="font-medium">{{ number_format($location->kilometrage_depart, 0, ',', ' ') }} km</span>
                        </div>
                        @if($location->observations_depart)
                            <div>
                                <p class="text-gray-600 mb-2">Observations:</p>
                                <p class="text-sm bg-gray-50 p-3 rounded-lg">{{ $location->observations_depart }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Au Retour -->
                <div>
                    <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-sign-in-alt text-blue-500 mr-2"></i> Au Retour
                    </h4>
                    <div class="space-y-3">
                        @if($location->kilometrage_retour)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kilométrage:</span>
                                <span class="font-medium">{{ number_format($location->kilometrage_retour, 0, ',', ' ') }} km</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Distance Parcourue:</span>
                                <span class="font-medium text-blue-600">
                                    {{ number_format($location->kilometrage_retour - $location->kilometrage_depart, 0, ',', ' ') }} km
                                </span>
                            </div>
                        @else
                            <p class="text-gray-500 italic">Non encore retournée</p>
                        @endif
                        @if($location->observations_retour)
                            <div>
                                <p class="text-gray-600 mb-2">Observations:</p>
                                <p class="text-sm bg-gray-50 p-3 rounded-lg">{{ $location->observations_retour }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
