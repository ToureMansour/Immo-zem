@extends('layouts.navigation')

@section('title', 'Nouvelle Location de Bien Immobilier')

@section('content')

<div class="max-w-4xl mx-auto">
    <!-- En-tête -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Nouvelle Location de Bien</h2>
                <p class="text-gray-600 mt-1">Démarrer une nouvelle location de bien immobilier pour un locataire</p>
            </div>
            <a href="{{ route('locations_biens.index') }}" 
               class="flex items-center px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Retour
            </a>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] overflow-hidden">
        <form action="{{ route('locations_biens.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <!-- Informations de la Location -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-[#445f47] mr-2"></i>
                    Informations de la Location
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Bien Immobilier -->
                    <div>
                        <label for="bien_immobilier_id" class="block text-sm font-semibold text-gray-700 mb-2">Bien Immobilier <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select id="bien_immobilier_id" name="bien_immobilier_id" required
                                    class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none appearance-none transition-all">
                                <option value="">Sélectionner un bien</option>
                                @foreach($biens as $bien)
                                    <option value="{{ $bien->id }}">
                                        {{ $bien->code_unique }} - {{ $bien->type }} ({{ $bien->surface }}m²) - {{ number_format($bien->montant_loyer_mensuel, 0, ',', ' ') }} F/mois
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                        @error('bien_immobilier_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Locataire -->
                    <div>
                        <label for="locataire_id" class="block text-sm font-semibold text-gray-700 mb-2">Locataire <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select id="locataire_id" name="locataire_id" required
                                    class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none appearance-none transition-all">
                                <option value="">Sélectionner un locataire</option>
                                @foreach($proprietaires as $proprietaire)
                                    <option value="{{ $proprietaire->id }}">
                                        {{ $proprietaire->nom }} {{ $proprietaire->prenom }} - {{ $proprietaire->telephone }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                        @error('locataire_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Détails du Bail -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-file-contract text-[#445f47] mr-2"></i>
                    Détails du Bail
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Type de Bail -->
                    <div>
                        <label for="type_bail" class="block text-sm font-semibold text-gray-700 mb-2">Type de Bail <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select id="type_bail" name="type_bail" required
                                    class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none appearance-none transition-all">
                                <option value="">Sélectionner un type</option>
                                <option value="habitation">Habitation</option>
                                <option value="commercial">Commercial</option>
                                <option value="professionnel">Professionnel</option>
                                <option value="meuble">Meublé</option>
                                <option value="non_meuble">Non meublé</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                        @error('type_bail')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Durée -->
                    <div>
                        <label for="duree_mois" class="block text-sm font-semibold text-gray-700 mb-2">Durée (mois) <span class="text-red-500">*</span></label>
                        <input type="number" id="duree_mois" name="duree_mois" required
                               value="{{ old('duree_mois', 12) }}" min="1" max="120"
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                        @error('duree_mois')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date de Début -->
                    <div>
                        <label for="date_debut" class="block text-sm font-semibold text-gray-700 mb-2">Date de Début <span class="text-red-500">*</span></label>
                        <input type="date" id="date_debut" name="date_debut" required
                               value="{{ old('date_debut', now()->format('Y-m-d')) }}"
                               min="{{ now()->format('Y-m-d') }}"
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                        @error('date_debut')
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
                    <!-- Loyer Mensuel -->
                    <div>
                        <label for="montant_loyer_mensuel" class="block text-sm font-semibold text-gray-700 mb-2">Loyer Mensuel <span class="text-red-500">*</span></label>
                        <input type="number" id="montant_loyer_mensuel" name="montant_loyer_mensuel" required
                               value="{{ old('montant_loyer_mensuel') }}" min="0" step="100"
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                        @error('montant_loyer_mensuel')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Charges Mensuelles -->
                    <div>
                        <label for="charges_mensuelles" class="block text-sm font-semibold text-gray-700 mb-2">Charges Mensuelles <span class="text-red-500">*</span></label>
                        <input type="number" id="charges_mensuelles" name="charges_mensuelles" required
                               value="{{ old('charges_mensuelles', 0) }}" min="0" step="100"
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                        @error('charges_mensuelles')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Dépôt de Garantie -->
                    <div>
                        <label for="depot_garantie" class="block text-sm font-semibold text-gray-700 mb-2">Dépôt de Garantie <span class="text-red-500">*</span></label>
                        <input type="number" id="depot_garantie" name="depot_garantie" required
                               value="{{ old('depot_garantie', 50000) }}" min="0" step="100"
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                        @error('depot_garantie')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Loyer Premier Mois -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="loyer_premier_mois" class="block text-sm font-semibold text-gray-700 mb-2">Loyer Premier Mois <span class="text-red-500">*</span></label>
                        <input type="number" id="loyer_premier_mois" name="loyer_premier_mois" required
                               value="{{ old('loyer_premier_mois') }}" min="0" step="100"
                               class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all">
                        @error('loyer_premier_mois')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Total Garantie (calculé) -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Total Garantie</label>
                        <div class="w-full px-4 py-3 rounded-lg bg-gray-100 border border-gray-300 text-gray-700 font-bold">
                            <span id="total-garantie">0</span> F
                        </div>
                    </div>
                </div>

                <!-- Total Mensuel (calculé) -->
                <div class="mt-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Total Mensuel (Loyer + Charges)</label>
                    <div class="w-full px-4 py-3 rounded-lg bg-green-50 border border-green-200 text-green-700 font-bold">
                        <span id="total-mensuel">0</span> F
                    </div>
                </div>
            </div>

            <!-- État des Lieux -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-clipboard-check text-[#445f47] mr-2"></i>
                    État des Lieux à l'Entrée
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Observations -->
                    <div>
                        <label for="observations_entree" class="block text-sm font-semibold text-gray-700 mb-2">Observations</label>
                        <textarea id="observations_entree" name="observations_entree" rows="4"
                                  class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none transition-all resize-none"
                                  placeholder="État général du bien, travaux à prévoir, etc.">{{ old('observations_entree') }}</textarea>
                        @error('observations_entree')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- État des Lieux (JSON) -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">État des Lieux Détailé</label>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <input type="checkbox" id="etat_murs" name="etat_lieux_entre[murs]" value="bons" 
                                       {{ old('etat_lieux_entre.murs') == 'bons' ? 'checked' : '' }}
                                       class="mr-2">
                                <label for="etat_murs" class="text-sm">Murs en bon état</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="etat_sol" name="etat_lieux_entre[sol]" value="bons" 
                                       {{ old('etat_lieux_entre.sol') == 'bons' ? 'checked' : '' }}
                                       class="mr-2">
                                <label for="etat_sol" class="text-sm">Sol en bon état</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="etat_plomberie" name="etat_lieux_entre[plomberie]" value="fonctionnelle" 
                                       {{ old('etat_lieux_entre.plomberie') == 'fonctionnelle' ? 'checked' : '' }}
                                       class="mr-2">
                                <label for="etat_plomberie" class="text-sm">Plomberie fonctionnelle</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="etat_electricite" name="etat_lieux_entre[electricite]" value="fonctionnelle" 
                                       {{ old('etat_lieux_entre.electricite') == 'fonctionnelle' ? 'checked' : '' }}
                                       class="mr-2">
                                <label for="etat_electricite" class="text-sm">Électricité fonctionnelle</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boutons d'Action -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('locations_biens.index') }}" 
                   class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-[#445f47] hover:bg-[#364b39] text-white rounded-lg transition-colors font-medium shadow-md shadow-green-900/10">
                    <i class="fas fa-check mr-2"></i>
                    Démarrer la Location
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script pour calculer les totaux -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const loyerMensuelInput = document.getElementById('montant_loyer_mensuel');
    const chargesMensuellesInput = document.getElementById('charges_mensuelles');
    const depotGarantieInput = document.getElementById('depot_garantie');
    const loyerPremierMoisInput = document.getElementById('loyer_premier_mois');
    const totalMensuelSpan = document.getElementById('total-mensuel');
    const totalGarantieSpan = document.getElementById('total-garantie');

    function calculerTotaux() {
        const loyerMensuel = parseFloat(loyerMensuelInput.value) || 0;
        const chargesMensuelles = parseFloat(chargesMensuellesInput.value) || 0;
        const depotGarantie = parseFloat(depotGarantieInput.value) || 0;
        const loyerPremierMois = parseFloat(loyerPremierMoisInput.value) || 0;

        const totalMensuel = loyerMensuel + chargesMensuelles;
        const totalGarantie = depotGarantie + loyerPremierMois;

        totalMensuelSpan.textContent = totalMensuel.toLocaleString('fr-FR');
        totalGarantieSpan.textContent = totalGarantie.toLocaleString('fr-FR');
    }

    // Écouter les changements
    loyerMensuelInput.addEventListener('input', calculerTotaux);
    chargesMensuellesInput.addEventListener('input', calculerTotaux);
    depotGarantieInput.addEventListener('input', calculerTotaux);
    loyerPremierMoisInput.addEventListener('input', calculerTotaux);

    // Calcul initial
    calculerTotaux();
});
</script>

@endsection
