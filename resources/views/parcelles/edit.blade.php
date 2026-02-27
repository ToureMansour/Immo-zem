@extends('layouts.navigation')

@section('title', 'Modifier la Parcelle')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- En-tête avec bouton retour -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-medium text-gray-500">Modification de la parcelle</h2>
            <p class="text-sm text-gray-400">Mettez à jour les informations de la parcelle.</p>
        </div>
        <a href="{{ route('parcelles.show', $parcelle) }}" 
           class="flex items-center px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Retour
        </a>
    </div>

    <!-- Carte du formulaire -->
    <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] p-8">
        <form action="{{ route('parcelles.update', $parcelle) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                <!-- Code parcelle -->
                <div>
                    <label for="code_parcelle" class="block text-sm font-semibold text-gray-700 mb-2">Code parcelle <span class="text-red-500">*</span></label>
                    <input type="text" id="code_parcelle" name="code_parcelle" value="{{ old('code_parcelle', $parcelle->code_parcelle) }}" required placeholder="Ex: PAR001"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    @error('code_parcelle')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Titre foncier -->
                <div>
                    <label for="titre_foncier" class="block text-sm font-semibold text-gray-700 mb-2">Titre foncier <span class="text-red-500">*</span></label>
                    <input type="text" id="titre_foncier" name="titre_foncier" value="{{ old('titre_foncier', $parcelle->titre_foncier) }}" required placeholder="Ex: TF-ABJ-2023-001"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    @error('titre_foncier')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type de terrain -->
                <div>
                    <label for="type_terrain" class="block text-sm font-semibold text-gray-700 mb-2">Type de terrain <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="type_terrain" name="type_terrain" required
                                class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none appearance-none transition-all">
                            <option value="">Sélectionner un type</option>
                            <option value="residentiel" {{ old('type_terrain', $parcelle->type_terrain) == 'residentiel' ? 'selected' : '' }}>Résidentiel</option>
                            <option value="commercial" {{ old('type_terrain', $parcelle->type_terrain) == 'commercial' ? 'selected' : '' }}>Commercial</option>
                            <option value="agricole" {{ old('type_terrain', $parcelle->type_terrain) == 'agricole' ? 'selected' : '' }}>Agricole</option>
                            <option value="industriel" {{ old('type_terrain', $parcelle->type_terrain) == 'industriel' ? 'selected' : '' }}>Industriel</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                    @error('type_terrain')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Statut juridique -->
                <div>
                    <label for="statut_juridique" class="block text-sm font-semibold text-gray-700 mb-2">Statut juridique <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="statut_juridique" name="statut_juridique" required
                                class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none appearance-none transition-all">
                            <option value="">Sélectionner un statut</option>
                            <option value="propriete" {{ old('statut_juridique', $parcelle->statut_juridique) == 'propriete' ? 'selected' : '' }}>Propriété</option>
                            <option value="location" {{ old('statut_juridique', $parcelle->statut_juridique) == 'location' ? 'selected' : '' }}>Location</option>
                            <option value="copropriete" {{ old('statut_juridique', $parcelle->statut_juridique) == 'copropriete' ? 'selected' : '' }}>Copropriété</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                    @error('statut_juridique')
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
                                <option value="{{ $proprietaire->id }}" {{ old('proprietaire_id', $parcelle->proprietaire_id) == $proprietaire->id ? 'selected' : '' }}>
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
                    <input type="number" id="surface" name="surface" value="{{ old('surface', $parcelle->surface) }}" required step="0.01" min="0" placeholder="Ex: 500.50"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    @error('surface')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Prix d'achat -->
                <div>
                    <label for="prix_achat" class="block text-sm font-semibold text-gray-700 mb-2">Prix d'achat (FCFA)</label>
                    <input type="number" id="prix_achat" name="prix_achat" value="{{ old('prix_achat', $parcelle->prix_achat) }}" step="1000" min="0" placeholder="Ex: 5000000"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    @error('prix_achat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date d'achat -->
                <div>
                    <label for="date_achat" class="block text-sm font-semibold text-gray-700 mb-2">Date d'achat</label>
                    <input type="date" id="date_achat" name="date_achat" value="{{ old('date_achat', $parcelle->date_achat) }}"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all text-gray-600">
                    @error('date_achat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Prix de vente -->
                <div>
                    <label for="prix_vente" class="block text-sm font-semibold text-gray-700 mb-2">Prix de vente (FCFA)</label>
                    <input type="number" id="prix_vente" name="prix_vente" value="{{ old('prix_vente', $parcelle->prix_vente) }}" step="1000" min="0" placeholder="Ex: 8000000"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    @error('prix_vente')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date de vente -->
                <div>
                    <label for="date_vente" class="block text-sm font-semibold text-gray-700 mb-2">Date de vente</label>
                    <input type="date" id="date_vente" name="date_vente" value="{{ old('date_vente', $parcelle->date_vente) }}"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all text-gray-600">
                    @error('date_vente')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Acheteur -->
                <div>
                    <label for="acheteur_id" class="block text-sm font-semibold text-gray-700 mb-2">Acheteur</label>
                    <div class="relative">
                        <select id="acheteur_id" name="acheteur_id"
                                class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none appearance-none transition-all">
                            <option value="">Sélectionner un acheteur (si vendue)</option>
                            @foreach(App\Models\Proprietaire::all() as $proprietaire)
                                <option value="{{ $proprietaire->id }}" {{ old('acheteur_id', $parcelle->acheteur_id) == $proprietaire->id ? 'selected' : '' }}>
                                    {{ $proprietaire->nom }} - {{ $proprietaire->email }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                    @error('acheteur_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Adresse (Largeur complète) -->
            <div class="mb-6">
                <label for="adresse" class="block text-sm font-semibold text-gray-700 mb-2">Adresse complète <span class="text-red-500">*</span></label>
                <textarea id="adresse" name="adresse" rows="3" placeholder="Quartier, Ville, Pays..."
                          class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">{{ old('adresse', $parcelle->adresse) }}</textarea>
                @error('adresse')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description (Largeur complète) -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description détaillée</label>
                <textarea id="description" name="description" rows="4" placeholder="Décrivez la parcelle, ses caractéristiques, son environnement..."
                          class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">{{ old('description', $parcelle->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Documents cadastraux -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Documents cadastraux</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @php
                        $selectedDocuments = json_decode($parcelle->documents_cadastraux ?? '[]') ?: [];
                    @endphp
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="documents_cadastraux[]" value="Titre foncier" 
                               {{ in_array('Titre foncier', $selectedDocuments) ? 'checked' : '' }}
                               class="rounded text-[#445f47] focus:ring-[#445f47]">
                        <span class="text-sm text-gray-700">Titre foncier</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="documents_cadastraux[]" value="Plan cadastral" 
                               {{ in_array('Plan cadastral', $selectedDocuments) ? 'checked' : '' }}
                               class="rounded text-[#445f47] focus:ring-[#445f47]">
                        <span class="text-sm text-gray-700">Plan cadastral</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="documents_cadastraux[]" value="Certificat de propriété" 
                               {{ in_array('Certificat de propriété', $selectedDocuments) ? 'checked' : '' }}
                               class="rounded text-[#445f47] focus:ring-[#445f47]">
                        <span class="text-sm text-gray-700">Certificat de propriété</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="documents_cadastraux[]" value="Acte de vente" 
                               {{ in_array('Acte de vente', $selectedDocuments) ? 'checked' : '' }}
                               class="rounded text-[#445f47] focus:ring-[#445f47]">
                        <span class="text-sm text-gray-700">Acte de vente</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="documents_cadastraux[]" value="Permis de construire" 
                               {{ in_array('Permis de construire', $selectedDocuments) ? 'checked' : '' }}
                               class="rounded text-[#445f47] focus:ring-[#445f47]">
                        <span class="text-sm text-gray-700">Permis de construire</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="documents_cadastraux[]" value="Déclaration d'impôt" 
                               {{ in_array('Déclaration d\'impôt', $selectedDocuments) ? 'checked' : '' }}
                               class="rounded text-[#445f47] focus:ring-[#445f47]">
                        <span class="text-sm text-gray-700">Déclaration d'impôt</span>
                    </label>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-100">
                <a href="{{ route('parcelles.show', $parcelle) }}" class="px-6 py-2.5 rounded-lg text-gray-600 hover:bg-gray-100 font-medium transition-colors">
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
