@extends('layouts.navigation')

@section('title', 'Gestion des Biens Immobiliers')

@section('content')

<div class="w-full">

    <!-- En-tête de page -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-tight mb-4 sm:mb-0">LISTE DES BIENS</h2>
        
        <a href="{{ route('biens.create') }}" 
           class="px-5 py-2 bg-[#445f47] text-white rounded font-medium hover:bg-[#364b39] transition shadow-sm flex items-center text-sm">
            <i class="fas fa-plus mr-2"></i> NOUVEAU BIEN
        </a>
    </div>

    <!-- Zone de Filtres (Style Photo 2) -->
    <div class="bg-white p-5 mb-6 rounded shadow-sm border border-gray-200">
        <form action="{{ route('biens.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Filtre Recherche -->
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Recherche</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Titre, adresse..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600">
            </div>

            <!-- Filtre Type -->
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Type de bien</label>
                <select name="type" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600 bg-white">
                    <option value="">Tous les types</option>
                    <option value="appartement" {{ request('type') == 'appartement' ? 'selected' : '' }}>Appartement</option>
                    <option value="maison" {{ request('type') == 'maison' ? 'selected' : '' }}>Maison</option>
                    <option value="studio" {{ request('type') == 'studio' ? 'selected' : '' }}>Studio</option>
                    <option value="commerce" {{ request('type') == 'commerce' ? 'selected' : '' }}>Commerce</option>
                </select>
            </div>

            <!-- Filtre Statut -->
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Statut</label>
                <select name="statut" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600 bg-white">
                    <option value="">Tous les statuts</option>
                    <option value="disponible" {{ request('statut') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="loue" {{ request('statut') == 'loue' ? 'selected' : '' }}>Loué</option>
                    <option value="maintenance" {{ request('statut') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
            </div>
            
            <!-- Bouton Filtrer (visible sur mobile ou si besoin) -->
            <div class="md:hidden">
                <button type="submit" class="w-full py-2 bg-gray-100 text-gray-700 font-bold rounded border border-gray-300 hover:bg-gray-200">Filtrer</button>
            </div>
        </form>
    </div>

    <!-- TABLEAU STYLE "eSP-SNIF" -->
    <div class="bg-white shadow-sm border border-gray-200 overflow-hidden rounded-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <!-- En-tête Vert Solide -->
                <thead>
                    <tr class="bg-[#445f47] text-white">
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">Détails du Bien</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">Type</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">Adresse</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-right">Loyer (FCFA)</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-center">Statut</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="text-sm text-gray-700">
                    @forelse($biens as $bien)
                        <!-- Lignes alternées (Zebra) : bg-white / bg-gray-50 -->
                        <tr class="border-b border-gray-100 odd:bg-white even:bg-gray-50 hover:bg-green-50/50 transition-colors">
                            
                            <!-- Titre -->
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $bien->titre }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $bien->surface }}m² • {{ $bien->nombre_pieces ?? 0 }} pces</div>
                            </td>

                            <!-- Type -->
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-medium rounded border border-blue-200 bg-blue-50 text-blue-700">
                                    {{ ucfirst($bien->type) }}
                                </span>
                            </td>

                            <!-- Adresse -->
                            <td class="px-6 py-4 truncate max-w-[200px]" title="{{ $bien->adresse }}">
                                {{ $bien->adresse }}
                            </td>

                            <!-- Loyer -->
                            <td class="px-6 py-4 text-right font-medium">
                                {{ number_format($bien->loyer_mensuel, 0, ',', ' ') }}
                                @if($bien->caution)
                                    <div class="text-[10px] text-gray-400">Caution: {{ number_format($bien->caution, 0, ',', ' ') }}</div>
                                @endif
                            </td>

                            <!-- Statut -->
                            <td class="px-6 py-4 text-center">
                                @if($bien->statut == 'disponible')
                                    <span class="px-2 py-1 text-xs font-bold text-green-700 bg-green-50 border border-green-200 rounded">
                                        Disponible
                                    </span>
                                @elseif($bien->statut == 'loue')
                                    <span class="px-2 py-1 text-xs font-bold text-red-700 bg-red-50 border border-red-200 rounded">
                                        Loué
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-bold text-yellow-700 bg-yellow-50 border border-yellow-200 rounded">
                                        Maint.
                                    </span>
                                @endif
                            </td>

                            <!-- Actions (Boutons carrés outline) -->
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Voir -->
                                    <a href="{{ route('biens.show', $bien) }}" class="w-8 h-8 flex items-center justify-center rounded border border-blue-500 text-blue-500 hover:bg-blue-50 transition" title="Voir">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                    <!-- Modifier -->
                                    <a href="{{ route('biens.edit', $bien) }}" class="w-8 h-8 flex items-center justify-center rounded border border-yellow-500 text-yellow-500 hover:bg-yellow-50 transition" title="Modifier">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </a>
                                    <!-- Supprimer -->
                                    <form action="{{ route('biens.destroy', $bien) }}" method="POST" class="inline" id="deleteForm{{ $bien->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="w-8 h-8 flex items-center justify-center rounded border border-red-500 text-red-500 hover:bg-red-50 transition" onclick="showDeleteModal('Êtes-vous sûr de vouloir supprimer le bien immobilier {{ $bien->designation_bien }} ?', document.getElementById('deleteForm{{ $bien->id }}'))" title="Supprimer">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500 bg-white">
                                <i class="fa-solid fa-folder-open text-2xl mb-2 text-gray-300"></i>
                                <p>Aucun bien trouvé</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination (Style Photo 2) -->
        <div class="px-6 py-4 border-t border-gray-200 bg-white">
            {{ $biens->links() }}
        </div>
    </div>
</div>

@endsection