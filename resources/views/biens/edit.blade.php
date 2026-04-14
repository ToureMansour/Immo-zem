@extends('layouts.navigation')

@section('title', 'Modifier le Bien Immobilier')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- En-tête avec bouton retour -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-medium text-gray-500">Modification du bien</h2>
            <p class="text-sm text-gray-400">Mettez à jour les informations du bien immobilier.</p>
        </div>
        <a href="{{ route('biens.index') }}" 
           class="flex items-center px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Retour
        </a>
    </div>

    <!-- Carte du formulaire -->
    <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] p-8">
        <form action="{{ route('biens.update', $bien) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                <!-- Code unique -->
                <div>
                    <label for="code_unique" class="block text-sm font-semibold text-gray-700 mb-2">Code unique <span class="text-red-500">*</span></label>
                    <input type="text" id="code_unique" name="code_unique" value="{{ old('code_unique', $bien->code_unique) }}" required placeholder="Ex: BIEN001"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    @error('code_unique')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Titre -->
                <div>
                    <label for="titre" class="block text-sm font-semibold text-gray-700 mb-2">Titre du bien <span class="text-red-500">*</span></label>
                    <input type="text" id="titre" name="titre" value="{{ old('titre', $bien->titre) }}" required placeholder="Ex: Appartement F3 Cocody"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    @error('titre')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type -->
                <div>
                    <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">Type de bien <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="type" name="type" required
                                class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none appearance-none transition-all">
                            <option value="">Sélectionner un type</option>
                            <option value="appartement" {{ old('type', $bien->type) == 'appartement' ? 'selected' : '' }}>Appartement</option>
                            <option value="maison" {{ old('type', $bien->type) == 'maison' ? 'selected' : '' }}>Maison</option>
                            <option value="studio" {{ old('type', $bien->type) == 'studio' ? 'selected' : '' }}>Studio</option>
                            <option value="villa" {{ old('type', $bien->type) == 'villa' ? 'selected' : '' }}>Villa</option>
                            <option value="commerce" {{ old('type', $bien->type) == 'commerce' ? 'selected' : '' }}>Commerce/Bureau</option>
                            <option value="terrain" {{ old('type', $bien->type) == 'terrain' ? 'selected' : '' }}>Terrain</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                    @error('type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Propriétaire -->
                <div>
                    <label for="proprietaire_id" class="block text-sm font-semibold text-gray-700 mb-2">Propriétaire <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="proprietaire_id" name="proprietaire_id" required
                                class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none appearance-none transition-all">
                            <option value="">Sélectionner un propriétaire</option>
                            @foreach(App\Models\Proprietaire::all() as $proprietaire)
                                <option value="{{ $proprietaire->id }}" {{ old('proprietaire_id', $bien->proprietaire_id) == $proprietaire->id ? 'selected' : '' }}>
                                    {{ $proprietaire->nom }} - {{ $proprietaire->email }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                    @error('proprietaire_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Surface -->
                <div>
                    <label for="surface" class="block text-sm font-semibold text-gray-700 mb-2">Surface (m²) <span class="text-red-500">*</span></label>
                    <input type="number" id="surface" name="surface" value="{{ old('surface', $bien->surface) }}" required step="0.01" min="0" placeholder="Ex: 85.5"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    @error('surface')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nombre de pièces -->
                <div>
                    <label for="nombre_pieces" class="block text-sm font-semibold text-gray-700 mb-2">Nombre de pièces</label>
                    <input type="number" id="nombre_pieces" name="nombre_pieces" value="{{ old('nombre_pieces', $bien->nombre_pieces) }}" min="0" placeholder="Ex: 3"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    @error('nombre_pieces')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Loyer mensuel -->
                <div>
                    <label for="loyer_mensuel" class="block text-sm font-semibold text-gray-700 mb-2">Loyer mensuel (FCFA) <span class="text-red-500">*</span></label>
                    <input type="number" id="loyer_mensuel" name="loyer_mensuel" value="{{ old('loyer_mensuel', $bien->loyer_mensuel) }}" required step="1000" min="0" placeholder="Ex: 150000"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    @error('loyer_mensuel')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Caution -->
                <div>
                    <label for="caution" class="block text-sm font-semibold text-gray-700 mb-2">Caution (FCFA)</label>
                    <input type="number" id="caution" name="caution" value="{{ old('caution', $bien->caution) }}" step="1000" min="0" placeholder="Ex: 300000"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    @error('caution')
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
                            <option value="disponible" {{ old('statut', $bien->statut) == 'disponible' ? 'selected' : '' }}>Disponible</option>
                            <option value="loue" {{ old('statut', $bien->statut) == 'loue' ? 'selected' : '' }}>Loué</option>
                            <option value="en_maintenance" {{ old('statut', $bien->statut) == 'en_maintenance' ? 'selected' : '' }}>En maintenance</option>
                            <option value="archive" {{ old('statut', $bien->statut) == 'archive' ? 'selected' : '' }}>Archivé</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                    @error('statut')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date de disponibilité -->
                <div>
                    <label for="date_disponibilite" class="block text-sm font-semibold text-gray-700 mb-2">Date de disponibilité</label>
                    <input type="date" id="date_disponibilite" name="date_disponibilite" value="{{ old('date_disponibilite', $bien->date_disponibilite) }}"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all text-gray-600">
                    @error('date_disponibilite')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Adresse (Largeur complète) -->
            <div class="mb-6">
                <label for="adresse" class="block text-sm font-semibold text-gray-700 mb-2">Adresse complète <span class="text-red-500">*</span></label>
                <textarea id="adresse" name="adresse" rows="3" placeholder="Quartier, Ville, Pays..."
                          class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">{{ old('adresse', $bien->adresse) }}</textarea>
                @error('adresse')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description (Largeur complète) -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description détaillée</label>
                <textarea id="description" name="description" rows="4" placeholder="Décrivez le bien, ses atouts, la proximité des commodités..."
                          class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">{{ old('description', $bien->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Équipements -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Équipements disponibles</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @php
                        $selectedEquipements = json_decode($bien->equipements ?? '[]') ?: [];
                    @endphp
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="equipements[]" value="Climatisation" 
                               {{ in_array('Climatisation', $selectedEquipements) ? 'checked' : '' }}
                               class="rounded text-[#445f47] focus:ring-[#445f47]">
                        <span class="text-sm text-gray-700">Climatisation</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="equipements[]" value="Parking" 
                               {{ in_array('Parking', $selectedEquipements) ? 'checked' : '' }}
                               class="rounded text-[#445f47] focus:ring-[#445f47]">
                        <span class="text-sm text-gray-700">Parking</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="equipements[]" value="Garde-corps" 
                               {{ in_array('Garde-corps', $selectedEquipements) ? 'checked' : '' }}
                               class="rounded text-[#445f47] focus:ring-[#445f47]">
                        <span class="text-sm text-gray-700">Garde-corps</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="equipements[]" value="Eau courante" 
                               {{ in_array('Eau courante', $selectedEquipements) ? 'checked' : '' }}
                               class="rounded text-[#445f47] focus:ring-[#445f47]">
                        <span class="text-sm text-gray-700">Eau courante</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="equipements[]" value="Électricité" 
                               {{ in_array('Électricité', $selectedEquipements) ? 'checked' : '' }}
                               class="rounded text-[#445f47] focus:ring-[#445f47]">
                        <span class="text-sm text-gray-700">Électricité</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="equipements[]" value="Sécurité 24/7" 
                               {{ in_array('Sécurité 24/7', $selectedEquipements) ? 'checked' : '' }}
                               class="rounded text-[#445f47] focus:ring-[#445f47]">
                        <span class="text-sm text-gray-700">Sécurité 24/7</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="equipements[]" value="Jardin" 
                               {{ in_array('Jardin', $selectedEquipements) ? 'checked' : '' }}
                               class="rounded text-[#445f47] focus:ring-[#445f47]">
                        <span class="text-sm text-gray-700">Jardin</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="equipements[]" value="Piscine" 
                               {{ in_array('Piscine', $selectedEquipements) ? 'checked' : '' }}
                               class="rounded text-[#445f47] focus:ring-[#445f47]">
                        <span class="text-sm text-gray-700">Piscine</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="equipements[]" value="Garage" 
                               {{ in_array('Garage', $selectedEquipements) ? 'checked' : '' }}
                               class="rounded text-[#445f47] focus:ring-[#445f47]">
                        <span class="text-sm text-gray-700">Garage</span>
                    </label>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-100">
                <a href="{{ route('biens.show', $bien) }}" class="px-6 py-2.5 rounded-lg text-gray-600 hover:bg-gray-100 font-medium transition-colors">
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
