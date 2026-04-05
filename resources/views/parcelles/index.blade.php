@extends('layouts.navigation')

@section('title', 'Gestion des Parcelles')

@section('content')

<div class="w-full">

    <!-- En-tête de page -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-tight mb-4 sm:mb-0">LISTE DES PARCELLES</h2>
        
        <a href="{{ route('parcelles.create') }}" 
           class="px-5 py-2 bg-[#445f47] text-white rounded font-medium hover:bg-[#364b39] transition shadow-sm flex items-center text-sm">
            <i class="fas fa-plus mr-2"></i> NOUVELLE PARCELLE
        </a>
    </div>

    <!-- Zone de Filtres (Style Photo 2) -->
    <div class="bg-white p-5 mb-6 rounded shadow-sm border border-gray-200">
        <form action="{{ route('parcelles.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Filtre Recherche -->
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Recherche</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Code, titre foncier..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600">
            </div>

            <!-- Filtre Type -->
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Type de terrain</label>
                <select name="type" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600 bg-white">
                    <option value="">Tous les types</option>
                    <option value="residentiel" {{ request('type') == 'residentiel' ? 'selected' : '' }}>Résidentiel</option>
                    <option value="commercial" {{ request('type') == 'commercial' ? 'selected' : '' }}>Commercial</option>
                    <option value="agricole" {{ request('type') == 'agricole' ? 'selected' : '' }}>Agricole</option>
                </select>
            </div>

            <!-- Filtre Statut Juridique -->
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Statut juridique</label>
                <select name="statut_juridique" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600 bg-white">
                    <option value="">Tous les statuts</option>
                    <option value="titre_definitif" {{ request('statut_juridique') == 'titre_definitif' ? 'selected' : '' }}>Titre définitif</option>
                    <option value="titre_provisoire" {{ request('statut_juridique') == 'titre_provisoire' ? 'selected' : '' }}>Titre provisoire</option>
                    <option value="en_cours" {{ request('statut_juridique') == 'en_cours' ? 'selected' : '' }}>En cours</option>
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
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">Info Parcelle</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">Propriétaire</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-center">Type</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-right">Surface</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-center">Statut</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-right">Prix Achat</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="text-sm text-gray-700">
                    @forelse($parcelles as $parcelle)
                        <!-- Lignes alternées (Zebra) : bg-white / bg-gray-50 -->
                        <tr class="border-b border-gray-100 odd:bg-white even:bg-gray-50 hover:bg-green-50/50 transition-colors">
                            
                            <!-- Info Parcelle -->
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $parcelle->code_parcelle }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $parcelle->titre_foncier }}</div>
                            </td>

                            <!-- Propriétaire -->
                            <td class="px-6 py-4">
                                <div class="text-gray-600">{{ $parcelle->proprietaire->nom ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-400 mt-1">{{ $parcelle->proprietaire->telephone ?? '' }}</div>
                            </td>

                            <!-- Type -->
                            <td class="px-6 py-4 text-center">
                                @switch($parcelle->type_terrain)
                                    @case('residentiel')
                                        <span class="px-2 py-1 text-xs font-medium rounded border border-blue-200 bg-blue-50 text-blue-700">
                                            Résidentiel
                                        </span>
                                        @break
                                    @case('commercial')
                                        <span class="px-2 py-1 text-xs font-medium rounded border border-green-200 bg-green-50 text-green-700">
                                            Commercial
                                        </span>
                                        @break
                                    @default
                                        <span class="px-2 py-1 text-xs font-medium rounded border border-gray-200 bg-gray-50 text-gray-700">
                                            {{ $parcelle->type_terrain }}
                                        </span>
                                @endswitch
                            </td>

                            <!-- Surface -->
                            <td class="px-6 py-4 text-right font-medium">
                                {{ number_format($parcelle->surface, 2, ',', ' ') }} m²
                            </td>

                            <!-- Statut -->
                            <td class="px-6 py-4 text-center">
                                <span class="px-2 py-1 text-xs font-bold text-green-700 bg-green-50 border border-green-200 rounded">
                                    {{ $parcelle->statut_juridique }}
                                </span>
                            </td>

                            <!-- Prix Achat -->
                            <td class="px-6 py-4 text-right font-medium">
                                {{ number_format($parcelle->prix_achat, 0, ',', ' ') }} FCFA
                            </td>

                            <!-- Actions (Boutons carrés outline) -->
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Voir -->
                                    <a href="{{ route('parcelles.show', $parcelle) }}" class="w-8 h-8 flex items-center justify-center rounded border border-blue-500 text-blue-500 hover:bg-blue-50 transition" title="Voir">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                    <!-- Modifier -->
                                    <a href="{{ route('parcelles.edit', $parcelle) }}" class="w-8 h-8 flex items-center justify-center rounded border border-yellow-500 text-yellow-500 hover:bg-yellow-50 transition" title="Modifier">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </a>
                                    <!-- Supprimer -->
                                    <form action="{{ route('parcelles.destroy', $parcelle) }}" method="POST" class="inline" id="deleteForm{{ $parcelle->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="w-8 h-8 flex items-center justify-center rounded border border-red-500 text-red-500 hover:bg-red-50 transition" onclick="showDeleteModal('Êtes-vous sûr de vouloir supprimer la parcelle {{ $parcelle->numero_parcelle }} ?', document.getElementById('deleteForm{{ $parcelle->id }}'))" title="Supprimer">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500 bg-white">
                                <i class="fa-solid fa-folder-open text-2xl mb-2 text-gray-300"></i>
                                <p>Aucune parcelle trouvée</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination (Style Photo 2) -->
        <div class="px-6 py-4 border-t border-gray-200 bg-white">
            {{ $parcelles->links() }}
        </div>
    </div>
</div>

@endsection