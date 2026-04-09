@extends('layouts.navigation')

@section('title', 'Détails de la Location - ' . $location->numero_location)

@section('content')

<div class="max-w-6xl mx-auto">
    <!-- En-tête -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Location {{ $location->numero_location }}</h2>
                <p class="text-gray-600 mt-1">Détails complets de la location de bien immobilier</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('locations_biens.index') }}" 
                   class="flex items-center px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Retour
                </a>
            </div>
        </div>
    </div>

    <!-- Cartes Principales -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        
        <!-- Carte Bien Immobilier -->
        <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
                <h3 class="text-white font-semibold flex items-center">
                    <i class="fas fa-home mr-2"></i> Bien Immobilier
                </h3>
            </div>
            <div class="p-6">
                <div class="text-center mb-4">
                    <p class="text-3xl font-bold text-gray-900">{{ $location->bienImmobilier->code_unique }}</p>
                    <p class="text-gray-600">{{ $location->bienImmobilier->type }} - {{ $location->bienImmobilier->surface }}m²</p>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Localisation:</span>
                        <span class="font-medium text-sm">{{ $location->bienImmobilier->adresse }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Nombre de pièces:</span>
                        <span class="font-medium">{{ $location->bienImmobilier->nombre_pieces }} pièces</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Statut:</span>
                        <span class="px-2 py-1 text-xs font-bold rounded-lg bg-blue-100 text-blue-700">
                            {{ ucfirst($location->bienImmobilier->statut) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Locataire -->
        <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-green-600 p-4">
                <h3 class="text-white font-semibold flex items-center">
                    <i class="fas fa-user mr-2"></i> Locataire
                </h3>
            </div>
            <div class="p-6">
                <div class="text-center mb-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $location->locataire->nom }} {{ $location->locataire->prenom }}</p>
                    <p class="text-gray-600">{{ $location->locataire->telephone }}</p>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Email:</span>
                        <span class="font-medium text-sm">{{ $location->locataire->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">CNI:</span>
                        <span class="font-medium text-sm">{{ $location->locataire->cni_numero }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Adresse:</span>
                        <span class="font-medium text-sm">{{ $location->locataire->adresse }}</span>
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
                            <span class="px-4 py-2 inline-flex text-sm font-bold rounded-lg bg-green-100 text-green-700 border border-green-200">
                                <i class="fas fa-clock mr-2"></i> En Attente
                            </span>
                            @break
                        @case('en_cours')
                            <span class="px-3 py-1 inline-flex text-xs font-bold rounded-lg bg-green-100 text-green-700 border border-green-200">Commercial</span>
                            <i class="fas fa-play-circle mr-2"></i> En Cours
                            </span>
                            @break
                        @case('terminee')
                            <span class="px-4 py-2 inline-flex text-sm font-bold rounded-lg bg-green-100 text-green-700 border border-green-200">
                                <i class="fas fa-check-circle mr-2"></i> Terminée
                            </span>
                            @break
                        @case('resiliee')
                            <span class="px-4 py-2 inline-flex text-sm font-bold rounded-lg bg-red-100 text-red-700 border border-red-200">
                                <i class="fas fa-times-circle mr-2"></i> Résiliée
                            </span>
                            @break
                    @endswitch
                </div>

                <!-- Actions Rapides -->
                <div class="space-y-3">
                    @if($location->statut === 'en_cours')
                        <form action="{{ route('locations_biens.resilier', $location) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg transition-colors"
                                    onclick="return confirm('Êtes-vous sûr de vouloir résilier cette location ?')">
                                <i class="fas fa-times-circle mr-2"></i> Résilier
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('locations_biens.edit', $location) }}" 
                       class="w-full flex items-center justify-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors">
                        <i class="fas fa-edit mr-2"></i> Modifier
                    </a>

                    <form action="{{ route('locations_biens.destroy', $location) }}" method="POST" class="w-full" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="w-full flex items-center justify-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors"
                                onclick="showDeleteModal('Êtes-vous sûr de vouloir supprimer la location du bien n°{{ $location->id }} ?', document.getElementById('deleteForm'))">
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
                        <p class="text-sm text-gray-500">Type Bail</p>
                        <p class="font-bold text-gray-900">{{ ucfirst($location->type_bail) }}</p>
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
                        <p class="font-bold text-gray-900">{{ $location->duree_mois }} mois</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Date Création</p>
                        <p class="font-bold text-gray-900">{{ $location->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Mois Restants</p>
                        <p class="font-bold text-gray-900">{{ $location->mois_restants }} mois</p>
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
                        <span class="text-gray-600">Loyer Mensuel</span>
                        <span class="text-xl font-bold text-gray-900">{{ number_format($location->montant_loyer_mensuel, 0, ',', ' ') }} F</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Charges Mensuelles</span>
                        <span class="font-medium text-blue-600">{{ number_format($location->charges_mensuelles, 0, ',', ' ') }} F</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Mensuel</span>
                        <span class="font-bold text-green-600">{{ number_format($location->loyer_total_mensuel, 0, ',', ' ') }} F</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Dépôt Garantie</span>
                        <span class="font-medium text-green-600">{{ number_format($location->depot_garantie, 0, ',', ' ') }} F</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Loyer Premier Mois</span>
                        <span class="font-medium text-orange-600">{{ number_format($location->loyer_premier_mois, 0, ',', ' ') }} F</span>
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t">
                        <span class="text-gray-800 font-semibold">Total Garantie</span>
                        <span class="text-xl font-bold text-green-900">{{ number_format($location->montant_total_garantie, 0, ',', ' ') }} F</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- État des Lieux -->
    <div class="mt-6 bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] overflow-hidden">
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-4">
            <h3 class="text-white font-semibold flex items-center">
                <i class="fas fa-clipboard-check mr-2"></i> État des Lieux
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- À l'Entrée -->
                <div>
                    <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-sign-in-alt text-green-500 mr-2"></i> À l'Entrée
                    </h4>
                    <div class="space-y-3">
                        @if($location->observations_entree)
                            <div>
                                <p class="text-gray-600 mb-2">Observations:</p>
                                <p class="text-sm bg-gray-50 p-3 rounded-lg">{{ $location->observations_entree }}</p>
                            </div>
                        @endif
                        
                        @if($location->etat_lieux_entre)
                            <div>
                                <p class="text-gray-600 mb-2">État des Lieux:</p>
                                <div class="space-y-2">
                                    @if($location->etat_lieux_entre['murs'] ?? false)
                                        <div class="flex items-center text-sm">
                                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                            <span>Murs en bon état</span>
                                        </div>
                                    @endif
                                    @if($location->etat_lieux_entre['sol'] ?? false)
                                        <div class="flex items-center text-sm">
                                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                            <span>Sol en bon état</span>
                                        </div>
                                    @endif
                                    @if($location->etat_lieux_entre['plomberie'] ?? false)
                                        <div class="flex items-center text-sm">
                                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                            <span>Plomberie fonctionnelle</span>
                                        </div>
                                    @endif
                                    @if($location->etat_lieux_entre['electricite'] ?? false)
                                        <div class="flex items-center text-sm">
                                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                            <span>Électricité fonctionnelle</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- À la Sortie -->
                <div>
                    <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-sign-out-alt text-blue-500 mr-2"></i> À la Sortie
                    </h4>
                    <div class="space-y-3">
                        @if($location->observations_sortie)
                            <div>
                                <p class="text-gray-600 mb-2">Observations:</p>
                                <p class="text-sm bg-gray-50 p-3 rounded-lg">{{ $location->observations_sortie }}</p>
                            </div>
                        @else
                            <p class="text-gray-500 italic">Non encore renseigné</p>
                        @endif
                        
                        @if($location->etat_lieux_sortie)
                            <div>
                                <p class="text-gray-600 mb-2">État des Lieux:</p>
                                <div class="space-y-2">
                                    @if($location->etat_lieux_sortie['murs'] ?? false)
                                        <div class="flex items-center text-sm">
                                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                            <span>Murs en bon état</span>
                                        </div>
                                    @endif
                                    @if($location->etat_lieux_sortie['sol'] ?? false)
                                        <div class="flex items-center text-sm">
                                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                            <span>Sol en bon état</span>
                                        </div>
                                    @endif
                                    @if($location->etat_lieux_sortie['plomberie'] ?? false)
                                        <div class="flex items-center text-sm">
                                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                            <span>Plomberie fonctionnelle</span>
                                        </div>
                                    @endif
                                    @if($location->etat_lieux_sortie['electricite'] ?? false)
                                        <div class="flex items-center text-sm">
                                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                            <span>Électricité fonctionnelle</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500 italic">Non encore renseigné</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informations de Résiliation (si applicable) -->
    @if($location->statut === 'resiliee')
        <div class="mt-6 bg-red-50 rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] overflow-hidden">
            <div class="bg-gradient-to-r from-red-500 to-red-600 p-4">
                <h3 class="text-white font-semibold flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i> Informations de Résiliation
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Date de Résiliation</p>
                        <p class="font-bold text-red-700">{{ $location->date_resiliation->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Motif</p>
                        <p class="font-bold text-red-700">{{ $location->motif_resiliation }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@endsection
