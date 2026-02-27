@extends('layouts.navigation')

@section('title', 'Nouvelle Moto')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- En-tête avec bouton retour -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-medium text-gray-500">Formulaire d'enregistrement</h2>
            <p class="text-sm text-gray-400">Remplissez les informations ci-dessous pour ajouter une moto.</p>
        </div>
        <a href="{{ route('motos.index') }}" 
           class="flex items-center px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Retour
        </a>
    </div>

    <!-- Carte du formulaire -->
    <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] p-8">
        <form action="{{ route('motos.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                <!-- Immatriculation -->
                <div>
                    <label for="immatriculation" class="block text-sm font-semibold text-gray-700 mb-2">Immatriculation <span class="text-red-500">*</span></label>
                    <input type="text" id="immatriculation" name="immatriculation" value="{{ old('immatriculation') }}" required placeholder="Ex: ABJ-1234-CI"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all uppercase">
                    @error('immatriculation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Marque -->
                <div>
                    <label for="marque" class="block text-sm font-semibold text-gray-700 mb-2">Marque <span class="text-red-500">*</span></label>
                    <input type="text" id="marque" name="marque" value="{{ old('marque') }}" required placeholder="Ex: Honda, Yamaha, Kawasaki"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    @error('marque')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Modèle -->
                <div>
                    <label for="modele" class="block text-sm font-semibold text-gray-700 mb-2">Modèle <span class="text-red-500">*</span></label>
                    <input type="text" id="modele" name="modele" value="{{ old('modele') }}" required placeholder="Ex: CG 125, MT-07"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    @error('modele')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type de moto -->
                <div>
                    <label for="type_moto" class="block text-sm font-semibold text-gray-700 mb-2">Type de moto <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="type_moto" name="type_moto" required
                                class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none appearance-none transition-all">
                            <option value="">Sélectionner un type</option>
                            <option value="taxi" {{ old('type_moto') == 'taxi' ? 'selected' : '' }}>Taxi</option>
                            <option value="personnel" {{ old('type_moto') == 'personnel' ? 'selected' : '' }}>Personnel</option>
                            <option value="livraison" {{ old('type_moto') == 'livraison' ? 'selected' : '' }}>Livraison</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                    @error('type_moto')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Année -->
                <div>
                    <label for="annee" class="block text-sm font-semibold text-gray-700 mb-2">Année <span class="text-red-500">*</span></label>
                    <input type="number" id="annee" name="annee" value="{{ old('annee') }}" required min="1900" max="{{ date('Y') }}" placeholder="Ex: 2023"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    @error('annee')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Couleur -->
                <div>
                    <label for="couleur" class="block text-sm font-semibold text-gray-700 mb-2">Couleur <span class="text-red-500">*</span></label>
                    <input type="text" id="couleur" name="couleur" value="{{ old('couleur') }}" required placeholder="Ex: Rouge, Noir, Bleu"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    @error('couleur')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Prix journalier -->
                <div>
                    <label for="prix_journalier" class="block text-sm font-semibold text-gray-700 mb-2">Prix journalier (FCFA) <span class="text-red-500">*</span></label>
                    <input type="number" id="prix_journalier" name="prix_journalier" value="{{ old('prix_journalier') }}" required step="100" min="0" placeholder="Ex: 10000"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    @error('prix_journalier')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Prix avec crédit -->
                <div>
                    <label for="prix_avec_credit" class="block text-sm font-semibold text-gray-700 mb-2">Prix avec crédit (FCFA) <span class="text-red-500">*</span></label>
                    <input type="number" id="prix_avec_credit" name="prix_avec_credit" value="{{ old('prix_avec_credit') }}" required step="100" min="0" placeholder="Ex: 15000"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    @error('prix_avec_credit')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Prix location/vente -->
                <div>
                    <label for="prix_location_vente" class="block text-sm font-semibold text-gray-700 mb-2">Prix location/vente (FCFA) <span class="text-red-500">*</span></label>
                    <input type="number" id="prix_location_vente" name="prix_location_vente" value="{{ old('prix_location_vente') }}" required step="100" min="0" placeholder="Ex: 20000"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    @error('prix_location_vente')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Statut -->
                <div>
                    <label for="statut" class="block text-sm font-semibold text-gray-700 mb-2">Statut <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="statut" name="statut" required
                                class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none appearance-none transition-all">
                            <option value="">Sélectionner un statut</option>
                            <option value="disponible" {{ old('statut') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                            <option value="loue" {{ old('statut') == 'loue' ? 'selected' : '' }}>Louée</option>
                            <option value="reparation" {{ old('statut') == 'reparation' ? 'selected' : '' }}>En réparation</option>
                            <option value="hors_service" {{ old('statut') == 'hors_service' ? 'selected' : '' }}>Hors service</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                    @error('statut')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kilométrage -->
                <div>
                    <label for="kilometrage" class="block text-sm font-semibold text-gray-700 mb-2">Kilométrage <span class="text-red-500">*</span></label>
                    <input type="number" id="kilometrage" name="kilometrage" value="{{ old('kilometrage') }}" required min="0" placeholder="Ex: 25000"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    @error('kilometrage')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date dernière maintenance -->
                <div>
                    <label for="date_derniere_maintenance" class="block text-sm font-semibold text-gray-700 mb-2">Date dernière maintenance</label>
                    <input type="date" id="date_derniere_maintenance" name="date_derniere_maintenance" value="{{ old('date_derniere_maintenance') }}"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all text-gray-600">
                    @error('date_derniere_maintenance')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Numéro carte grise -->
                <div>
                    <label for="carte_grise_numero" class="block text-sm font-semibold text-gray-700 mb-2">Numéro carte grise <span class="text-red-500">*</span></label>
                    <input type="text" id="carte_grise_numero" name="carte_grise_numero" value="{{ old('carte_grise_numero') }}" required placeholder="Ex: CG-ABJ-123456"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all uppercase">
                    @error('carte_grise_numero')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date délivrance carte grise -->
                <div>
                    <label for="carte_grise_delivrance" class="block text-sm font-semibold text-gray-700 mb-2">Date délivrance carte grise <span class="text-red-500">*</span></label>
                    <input type="date" id="carte_grise_delivrance" name="carte_grise_delivrance" value="{{ old('carte_grise_delivrance') }}" required
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all text-gray-600">
                    @error('carte_grise_delivrance')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description (Largeur complète) -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description détaillée</label>
                <textarea id="description" name="description" rows="4" placeholder="Décrivez la moto, ses caractéristiques, son état..."
                          class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Boutons d'action -->
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-100">
                <a href="{{ route('motos.index') }}" class="px-6 py-2.5 rounded-lg text-gray-600 hover:bg-gray-100 font-medium transition-colors">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-[#445f47] text-white hover:bg-[#364b39] font-medium shadow-lg shadow-green-900/20 transition-all flex items-center">
                    <i class="fas fa-save mr-2"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
