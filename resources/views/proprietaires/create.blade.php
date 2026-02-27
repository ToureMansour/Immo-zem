@extends('layouts.navigation')

@section('title', 'Nouveau Propriétaire')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- En-tête avec bouton retour -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-medium text-gray-500">Formulaire d'enregistrement</h2>
            <p class="text-sm text-gray-400">Remplissez les informations ci-dessous pour ajouter un propriétaire.</p>
        </div>
        <a href="{{ route('proprietaires.index') }}" 
           class="flex items-center px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Retour
        </a>
    </div>

    <!-- Carte du formulaire -->
    <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] p-8">
        <form action="{{ route('proprietaires.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                <!-- Nom complet -->
                <div>
                    <label for="nom" class="block text-sm font-semibold text-gray-700 mb-2">Nom complet <span class="text-red-500">*</span></label>
                    <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required placeholder="Ex: Jean Kouassi"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all @error('nom') border-red-500 @enderror">
                    @error('nom')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Adresse Email <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="exemple@mail.com"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Téléphone -->
                <div>
                    <label for="telephone" class="block text-sm font-semibold text-gray-700 mb-2">Téléphone <span class="text-red-500">*</span></label>
                    <input type="tel" id="telephone" name="telephone" value="{{ old('telephone') }}" required placeholder="+225 07..."
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all @error('telephone') border-red-500 @enderror">
                    @error('telephone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Statut -->
                <div>
                    <label for="statut" class="block text-sm font-semibold text-gray-700 mb-2">Statut du compte <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="statut" name="statut" required
                                class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none appearance-none transition-all">
                            <option value="">Sélectionner un statut</option>
                            <option value="actif" {{ old('statut') == 'actif' ? 'selected' : '' }}>Actif</option>
                            <option value="inactif" {{ old('statut') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                    @error('statut')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Adresse (Largeur complète) -->
            <div class="mb-6">
                <label for="adresse" class="block text-sm font-semibold text-gray-700 mb-2">Adresse de résidence</label>
                <textarea id="adresse" name="adresse" rows="3" placeholder="Quartier, Ville, Rue..."
                          class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">{{ old('adresse') }}</textarea>
                @error('adresse')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Section CNI -->
            <div class="border-t border-gray-100 pt-6 mt-6">
                <h3 class="text-sm font-bold text-[#445f47] uppercase tracking-wider mb-4">Informations d'identité (CNI)</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Numéro CNI -->
                    <div>
                        <label for="cni_numero" class="block text-sm font-medium text-gray-700 mb-2">Numéro de pièce <span class="text-red-500">*</span></label>
                        <input type="text" id="cni_numero" name="cni_numero" value="{{ old('cni_numero') }}" required
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    </div>

                    <!-- Date Délivrance -->
                    <div>
                        <label for="cni_date_delivrance" class="block text-sm font-medium text-gray-700 mb-2">Date de délivrance <span class="text-red-500">*</span></label>
                        <input type="date" id="cni_date_delivrance" name="cni_date_delivrance" value="{{ old('cni_date_delivrance') }}" required
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all text-gray-600">
                    </div>

                    <!-- Lieu Délivrance -->
                    <div>
                        <label for="cni_lieu_delivrance" class="block text-sm font-medium text-gray-700 mb-2">Lieu de délivrance <span class="text-red-500">*</span></label>
                        <input type="text" id="cni_lieu_delivrance" name="cni_lieu_delivrance" value="{{ old('cni_lieu_delivrance') }}" required
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-100">
                <a href="{{ route('proprietaires.index') }}" class="px-6 py-2.5 rounded-lg text-gray-600 hover:bg-gray-100 font-medium transition-colors">
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