@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center">
                <a href="{{ route('proprietaires.index') }}" class="text-green-600 hover:text-green-800 mr-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Retour
                </a>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">Modifier {{ $proprietaire->getFullNameAttribute() }}</h1>
                    <p class="mt-1 text-sm text-gray-600">Mettre à jour les informations du propriétaire</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('proprietaires.update', $proprietaire) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Messages d'erreur -->
                    @if ($errors->any())
                        <div class="mb-4 bg-red-50 text-red-700 px-4 py-3 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Informations Personnelles -->
                        <div class="col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informations Personnelles</h3>
                        </div>

                        <div>
                            <label for="nom" class="block text-sm font-medium text-gray-700">Nom *</label>
                            <input type="text" name="nom" id="nom" value="{{ old('nom', $proprietaire->nom) }}" required
                                   class="mt-1 block w-full px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom *</label>
                            <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $proprietaire->prenom) }}" required
                                   class="mt-1 block w-full px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone *</label>
                            <input type="tel" name="telephone" id="telephone" value="{{ old('telephone', $proprietaire->telephone) }}" required
                                   class="mt-1 block w-full px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $proprietaire->email) }}" required
                                   class="mt-1 block w-full px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div class="col-span-2">
                            <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse *</label>
                            <textarea name="adresse" id="adresse" rows="3" required
                                      class="mt-1 block w-full px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">{{ old('adresse', $proprietaire->adresse) }}</textarea>
                        </div>

                        <!-- Pièce d'Identité -->
                        <div class="col-span-2 mt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Pièce d'Identité (CNI)</h3>
                        </div>

                        <div>
                            <label for="cni_numero" class="block text-sm font-medium text-gray-700">Numéro CNI *</label>
                            <input type="text" name="cni_numero" id="cni_numero" value="{{ old('cni_numero', $proprietaire->cni_numero) }}" required
                                   class="mt-1 block w-full px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label for="cni_date_delivrance" class="block text-sm font-medium text-gray-700">Date de délivrance *</label>
                            <input type="date" name="cni_date_delivrance" id="cni_date_delivrance" 
                                   value="{{ old('cni_date_delivrance', 
                                       $proprietaire->cni_date_delivrance ? 
                                           (is_string($proprietaire->cni_date_delivrance) ? 
                                               \Carbon\Carbon::parse($proprietaire->cni_date_delivrance)->format('Y-m-d') : 
                                               $proprietaire->cni_date_delivrance->format('Y-m-d')) : 
                                           '') }}" 
                                   required
                                   class="mt-1 block w-full px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label for="cni_lieu_delivrance" class="block text-sm font-medium text-gray-700">Lieu de délivrance *</label>
                            <input type="text" name="cni_lieu_delivrance" id="cni_lieu_delivrance" value="{{ old('cni_lieu_delivrance', $proprietaire->cni_lieu_delivrance) }}" required
                                   class="mt-1 block w-full px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label for="compte_bancaire" class="block text-sm font-medium text-gray-700">Compte Bancaire</label>
                            <input type="text" name="compte_bancaire" id="compte_bancaire" value="{{ old('compte_bancaire', $proprietaire->compte_bancaire) }}"
                                   class="mt-1 block w-full px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        </div>

                        <!-- Statut et Notes -->
                        <div class="col-span-2 mt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Statut et Notes</h3>
                        </div>

                        <div>
                            <label for="statut" class="block text-sm font-medium text-gray-700">Statut *</label>
                            <select name="statut" id="statut" required
                                    class="mt-1 block w-full px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                <option value="actif" {{ old('statut', $proprietaire->statut) == 'actif' ? 'selected' : '' }}>Actif</option>
                                <option value="inactif" {{ old('statut', $proprietaire->statut) == 'inactif' ? 'selected' : '' }}>Inactif</option>
                            </select>
                        </div>

                        <div class="col-span-2">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                            <textarea name="notes" id="notes" rows="4"
                                      class="mt-1 block w-full px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">{{ old('notes', $proprietaire->notes) }}</textarea>
                            <p class="mt-1 text-sm text-gray-500">Notes supplémentaires sur le propriétaire</p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-8 flex justify-end">
                        <a href="{{ route('proprietaires.show', $proprietaire) }}" 
                           class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-4">
                            Annuler
                        </a>
                        <button type="submit" 
                                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
