@extends('layouts.navigation')

@section('title', 'Détails du propriétaire')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="{{ route('proprietaires.index') }}" class="text-green-600 hover:text-green-800 mr-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Retour
                    </a>
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900">{{ $proprietaire->getFullNameAttribute() }}</h1>
                        <p class="mt-1 text-sm text-gray-600">Détails du propriétaire immobilier</p>
                    </div>
                </div>
                @if(auth()->user()->hasRole(['Administrateur', 'Manager']))
                <div class="flex space-x-2">
                    <a href="{{ route('proprietaires.edit', $proprietaire) }}" 
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Modifier
                    </a>
                    <form action="{{ route('proprietaires.destroy', $proprietaire) }}" method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="showDeleteModal('Êtes-vous sûr de vouloir supprimer le propriétaire {{ $proprietaire->nom_proprietaire }} ?', document.getElementById('deleteForm'))"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Supprimer
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>

        <!-- Messages -->
        @if(session('success'))
            <div class="mb-4 bg-green-50 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Informations principales -->
            <div class="lg:col-span-1">
                <!-- Carte profil -->
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex flex-col items-center">
                        <div class="h-20 w-20 rounded-full bg-green-100 flex items-center justify-center mb-4">
                            <span class="text-green-600 font-bold text-2xl">{{ substr($proprietaire->nom, 0, 1) }}{{ substr($proprietaire->prenom, 0, 1) }}</span>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">{{ $proprietaire->getFullNameAttribute() }}</h3>
                        <span class="mt-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $proprietaire->statut === 'actif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $proprietaire->statut === 'actif' ? 'Actif' : 'Inactif' }}
                        </span>
                    </div>
                </div>

                <!-- Contact -->
                <div class="bg-white shadow rounded-lg p-6 mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Contact</h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-sm text-gray-900">{{ $proprietaire->telephone }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm text-gray-900">{{ $proprietaire->email }}</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-sm text-gray-900">{{ $proprietaire->adresse }}</span>
                        </div>
                    </div>
                </div>

                <!-- Informations bancaires -->
                @if($proprietaire->compte_bancaire)
                <div class="bg-white shadow rounded-lg p-6 mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informations Bancaires</h3>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        <span class="text-sm text-gray-900">{{ $proprietaire->compte_bancaire }}</span>
                    </div>
                </div>
                @endif
            </div>

            <!-- Détails complets -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Pièce d'identité -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Pièce d'Identité (CNI)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Numéro CNI</p>
                            <p class="text-sm text-gray-900">{{ $proprietaire->cni_numero }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Date de délivrance</p>
                            <p class="text-sm text-gray-900">{{ $proprietaire->cni_date_delivrance->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Lieu de délivrance</p>
                            <p class="text-sm text-gray-900">{{ $proprietaire->cni_lieu_delivrance }}</p>
                        </div>
                    </div>
                </div>

                <!-- Biens immobiliers -->
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Biens Immobiliers</h3>
                        <span class="text-sm text-gray-500">{{ $proprietaire->biensImmobiliers->count() }} bien(s)</span>
                    </div>
                    @if($proprietaire->biensImmobiliers->count() > 0)
                        <div class="space-y-3">
                            @foreach($proprietaire->biensImmobiliers as $bien)
                                <div class="bg-white rounded-lg p-4 hover:bg-gray-50">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-900">{{ $bien->titre }}</h4>
                                            <p class="text-sm text-gray-500">{{ $bien->type }} • {{ $bien->surface }} m² • {{ $bien->nombre_pieces }} pièce(s)</p>
                                            <p class="text-sm text-gray-500">{{ $bien->adresse }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-medium text-gray-900">{{ number_format($bien->loyer_mensuel, 0, ',', ' ') }} FCFA/mois</p>
                                            <span class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $bien->statut === 'disponible' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $bien->statut === 'disponible' ? 'Disponible' : 'Loué' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4 text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <p class="mt-2">Aucun bien immobilier enregistré</p>
                        </div>
                    @endif
                </div>

                <!-- Parcelles -->
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Parcelles</h3>
                        <span class="text-sm text-gray-500">{{ $proprietaire->parcelles->count() }} parcelle(s)</span>
                    </div>
                    @if($proprietaire->parcelles->count() > 0)
                        <div class="space-y-3">
                            @foreach($proprietaire->parcelles as $parcelle)
                                <div class="bg-white rounded-lg p-4 hover:bg-gray-50">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-900">{{ $parcelle->code_parcelle }}</h4>
                                            <p class="text-sm text-gray-500">{{ $parcelle->titre_foncier }}</p>
                                            <p class="text-sm text-gray-500">{{ $parcelle->surface }} m² • {{ $parcelle->type_terrain }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-medium text-gray-900">{{ number_format($parcelle->prix_achat, 0, ',', ' ') }} FCFA</p>
                                            <span class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $parcelle->statut_juridique }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4 text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                            </svg>
                            <p class="mt-2">Aucune parcelle enregistrée</p>
                        </div>
                    @endif
                </div>

                <!-- Notes -->
                @if($proprietaire->notes)
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Notes</h3>
                    <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $proprietaire->notes }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
