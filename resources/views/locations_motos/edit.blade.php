@extends('layouts.navigation')

@section('title', 'Modifier Location - ' . $location->numero_location)

@section('content')

<div class="max-w-4xl mx-auto">
    <!-- En-tête -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Modifier Location {{ $location->numero_location }}</h2>
                <p class="text-gray-600 mt-1">Mettre à jour les informations de la location</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('locations_motos.show', $location) }}" 
                   class="flex items-center px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Retour
                </a>
            </div>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] overflow-hidden">
        <form action="{{ route('locations_motos.update', $location) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Informations de la Location -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-[#445f47] mr-2"></i>
                    Informations de la Location
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Moto -->
                    <div>
                        <label for="moto_id" class="block text-sm font-semibold text-gray-700 mb-2">Moto <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select id="moto_id" name="moto_id" required
                                    class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none appearance-none transition-all">
                                <option value="">Sélectionner une moto</option>
                                @foreach($motos as $moto)
                                    <option value="{{ $moto->id }}" 
                                            {{ old('moto_id', $location->moto_id) == $moto->id ? 'selected' : '' }}
                                            data-prix="{{ $moto->prix_journalier }}"
                                            data-prix-vente="{{ $moto->prix_location_vente }}">
                                        {{ $moto->immatriculation }} - {{ $moto->marque }} {{ $moto->modele }} ({{ number_format($moto->prix_journalier, 0, ',', ' ') }} F/jour)
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                        @error('moto_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Conducteur -->
                    <div>
                        <label for="conducteur_id" class="block text-sm font-semibold text-gray-700 mb-2">Conducteur <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select id="conducteur_id" name="conducteur_id" required
                                    class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none appearance-none transition-all">
                                <option value="">Sélectionner un conducteur</option>
                                @foreach($conducteurs as $conducteur)
                                    <option value="{{ $conducteur->id }}" 
                                            {{ old('conducteur_id', $location->conducteur_id) == $conducteur->id ? 'selected' : '' }}>
                                        {{ $conducteur->nom }} {{ $conducteur->prenom }} - {{ $conducteur->telephone }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                        @error('conducteur_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Détails de la Location -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-calendar-days text-[#445f47] mr-2"></i>
                    Détails de la Location
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Type de Location -->
                    <div>
                        <label for="type_location" class="block text-sm font-semibold text-gray-700 mb-2">Type de Location <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select id="type_location" name="type_location" required
                                    class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none appearance-none transition-all">
                                <option value="">Sélectionner un type</option>
                                <option value="journaliere" {{ old('type_location', $location->type_location) == 'journaliere' ? 'selected' : '' }}>Journalière</option>
                                <option value="hebdomadaire" {{ old('type_location', $location->type_location) == 'hebdomadaire' ? 'selected' : '' }}>Hebdomadaire</option>
                                <option value="mensuelle" {{ old('type_location', $location->type_location) == 'mensuelle' ? 'selected' : '' }}>Mensuelle</option>
                                <option value="credit_bail" {{ old('type_location', $location->type_location) == 'credit_bail' ? 'selected' : '' }}>Crédit-bail</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                        @error('type_location')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date de Début -->
                    <div>
                        <label for="date_debut" class="block text-sm font-semibold text-gray-700 mb-2">Date de Début <span class="text-red-500">*</span></label>
                        <input type="date" id="date_debut" name="date_debut" required
                               value="{{ old('date_debut', $location->date_debut->format('Y-m-d')) }}"
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                        @error('date_debut')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Durée en Jours -->
                    <div>
                        <label for="duree_jours" class="block text-sm font-semibold text-gray-700 mb-2">Durée (jours) <span class="text-red-500">*</span></label>
                        <input type="number" id="duree_jours" name="duree_jours" required
                               value="{{ old('duree_jours', $location->duree_jours) }}" min="1" max="365"
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                        @error('duree_jours')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Informations Financières -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-money-bill-wave text-[#445f47] mr-2"></i>
                    Informations Financières
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Caution -->
                    <div>
                        <label for="caution" class="block text-sm font-semibold text-gray-700 mb-2">Caution <span class="text-red-500">*</span></label>
                        <input type="number" id="caution" name="caution" required
                               value="{{ old('caution', $location->caution) }}" min="0" step="100"
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                        @error('caution')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Acompte -->
                    <div>
                        <label for="acompte" class="block text-sm font-semibold text-gray-700 mb-2">Acompte <span class="text-red-500">*</span></label>
                        <input type="number" id="acompte" name="acompte" required
                               value="{{ old('acompte', $location->acompte) }}" min="0" step="100"
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                        @error('acompte')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Montant Total (calculé) -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Montant Total</label>
                        <div class="w-full px-4 py-3 rounded-lg bg-gray-100 border border-gray-300 text-gray-700 font-bold">
                            <span id="montant-total">{{ number_format($location->montant_total, 0, ',', ' ') }}</span> F
                        </div>
                    </div>
                </div>

                <!-- Reste à Payer -->
                <div class="mt-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Reste à Payer</label>
                    <div class="w-full px-4 py-3 rounded-lg bg-yellow-50 border border-yellow-200 text-yellow-700 font-bold">
                        <span id="reste-a-payer">{{ number_format($location->reste_a_payer, 0, ',', ' ') }}</span> F
                    </div>
                </div>
            </div>

            <!-- État de la Moto -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-tachometer-alt text-[#445f47] mr-2"></i>
                    État de la Moto
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kilométrage au Départ -->
                    <div>
                        <label for="kilometrage_depart" class="block text-sm font-semibold text-gray-700 mb-2">Kilométrage au Départ <span class="text-red-500">*</span></label>
                        <input type="number" id="kilometrage_depart" name="kilometrage_depart" required
                               value="{{ old('kilometrage_depart', $location->kilometrage_depart) }}" min="0"
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                        @error('kilometrage_depart')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kilométrage au Retour -->
                    <div>
                        <label for="kilometrage_retour" class="block text-sm font-semibold text-gray-700 mb-2">Kilométrage au Retour</label>
                        <input type="number" id="kilometrage_retour" name="kilometrage_retour"
                               value="{{ old('kilometrage_retour', $location->kilometrage_retour) }}" min="0"
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                        @error('kilometrage_retour')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Observations Départ -->
                    <div>
                        <label for="observations_depart" class="block text-sm font-semibold text-gray-700 mb-2">Observations Départ</label>
                        <textarea id="observations_depart" name="observations_depart" rows="3"
                                  class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all resize-none"
                                  placeholder="État général, rayures, etc.">{{ old('observations_depart', $location->observations_depart) }}</textarea>
                        @error('observations_depart')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Observations Retour -->
                    <div>
                        <label for="observations_retour" class="block text-sm font-semibold text-gray-700 mb-2">Observations Retour</label>
                        <textarea id="observations_retour" name="observations_retour" rows="3"
                                  class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all resize-none"
                                  placeholder="État au retour, dégâts éventuels, etc.">{{ old('observations_retour', $location->observations_retour) }}</textarea>
                        @error('observations_retour')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Boutons d'Action -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('locations_motos.show', $location) }}" 
                   class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-[#445f47] hover:bg-[#364b39] text-white rounded-lg transition-colors font-medium shadow-md shadow-green-900/10">
                    <i class="fas fa-save mr-2"></i>
                    Enregistrer les Modifications
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script pour calculer le montant total -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const motoSelect = document.getElementById('moto_id');
    const typeLocationSelect = document.getElementById('type_location');
    const dureeJoursInput = document.getElementById('duree_jours');
    const acompteInput = document.getElementById('acompte');
    const montantTotalSpan = document.getElementById('montant-total');
    const resteAPayerSpan = document.getElementById('reste-a-payer');

    function calculerMontant() {
        const selectedMoto = motoSelect.options[motoSelect.selectedIndex];
        const typeLocation = typeLocationSelect.value;
        const dureeJours = parseInt(dureeJoursInput.value) || 0;
        const acompte = parseInt(acompteInput.value) || 0;

        let prixJournalier = 0;
        let prixVente = 0;

        if (selectedMoto) {
            prixJournalier = parseFloat(selectedMoto.dataset.prix) || 0;
            prixVente = parseFloat(selectedMoto.dataset.prixVente) || 0;
        }

        let montantTotal = 0;

        switch(typeLocation) {
            case 'journaliere':
                montantTotal = prixJournalier * dureeJours;
                break;
            case 'hebdomadaire':
                montantTotal = prixJournalier * 7 * dureeJours;
                break;
            case 'mensuelle':
                montantTotal = prixJournalier * 30 * dureeJours;
                break;
            case 'credit_bail':
                montantTotal = prixVente * dureeJours;
                break;
        }

        montantTotalSpan.textContent = montantTotal.toLocaleString('fr-FR');
        resteAPayerSpan.textContent = Math.max(0, montantTotal - acompte).toLocaleString('fr-FR');
    }

    // Écouter les changements
    motoSelect.addEventListener('change', calculerMontant);
    typeLocationSelect.addEventListener('change', calculerMontant);
    dureeJoursInput.addEventListener('input', calculerMontant);
    acompteInput.addEventListener('input', calculerMontant);

    // Calcul initial
    calculerMontant();
});
</script>

@endsection
