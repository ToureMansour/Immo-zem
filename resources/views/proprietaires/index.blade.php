@extends('layouts.navigation')

@section('title', 'Gestion des Propriétaires')

@section('content')

<div class="w-full">

    <!-- En-tête de page -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-tight mb-4 sm:mb-0">LISTE DES PROPRIÉTAIRES</h2>
        
        <a href="{{ route('proprietaires.create') }}" 
           class="px-5 py-2 bg-[#445f47] text-white rounded font-medium hover:bg-[#364b39] transition shadow-sm flex items-center text-sm">
            <i class="fas fa-plus mr-2"></i> NOUVEAU PROPRIÉTAIRE
        </a>
    </div>

    <!-- Zone de Filtres (Style Photo 2) -->
    <div class="bg-white p-5 mb-6 rounded shadow-sm border border-gray-200">
        <form action="{{ route('proprietaires.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Filtre Recherche -->
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Recherche</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Nom, prénom, email..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600">
            </div>

            <!-- Filtre Statut -->
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Statut</label>
                <select name="statut" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600 bg-white">
                    <option value="">Tous les statuts</option>
                    <option value="actif" {{ request('statut') == 'actif' ? 'selected' : '' }}>Actif</option>
                    <option value="inactif" {{ request('statut') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                </select>
            </div>

            <!-- Filtre Date -->
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Date d'ajout</label>
                <input type="date" name="date" value="{{ request('date') }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600">
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
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">Propriétaire</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">Contact</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">Adresse</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-center">Statut</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="text-sm text-gray-700">
                    @forelse($proprietaires as $proprietaire)
                        <!-- Lignes alternées (Zebra) : bg-white / bg-gray-50 -->
                        <tr class="border-b border-gray-100 odd:bg-white even:bg-gray-50 hover:bg-green-50/50 transition-colors">
                            
                            <!-- Propriétaire -->
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-green-50 text-green-600 flex items-center justify-center font-bold mr-3 text-xs">
                                        {{ substr($proprietaire->nom, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-800">{{ $proprietaire->nom }} {{ $proprietaire->prenom }}</div>
                                        <div class="text-xs text-gray-500 mt-1">Ajouté le {{ $proprietaire->created_at->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Contact -->
                            <td class="px-6 py-4">
                                <div class="text-gray-600">{{ $proprietaire->telephone }}</div>
                                <div class="text-xs text-gray-400 mt-1">{{ $proprietaire->email }}</div>
                            </td>

                            <!-- Adresse -->
                            <td class="px-6 py-4 truncate max-w-[200px]" title="{{ $proprietaire->adresse }}">
                                {{ $proprietaire->adresse }}
                            </td>

                            <!-- Statut -->
                            <td class="px-6 py-4 text-center">
                                @if($proprietaire->statut == 'actif')
                                    <span class="px-2 py-1 text-xs font-bold text-green-700 bg-green-50 border border-green-200 rounded">
                                        Actif
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-bold text-red-700 bg-red-50 border border-red-200 rounded">
                                        Inactif
                                    </span>
                                @endif
                            </td>

                            <!-- Actions (Boutons carrés outline) -->
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Voir -->
                                    <a href="{{ route('proprietaires.show', $proprietaire) }}" class="w-8 h-8 flex items-center justify-center rounded border border-blue-500 text-blue-500 hover:bg-blue-50 transition" title="Voir">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                    <!-- Modifier -->
                                    <a href="{{ route('proprietaires.edit', $proprietaire) }}" class="w-8 h-8 flex items-center justify-center rounded border border-yellow-500 text-yellow-500 hover:bg-yellow-50 transition" title="Modifier">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </a>
                                    <!-- Supprimer -->
                                    <form action="{{ route('proprietaires.destroy', $proprietaire) }}" method="POST" class="inline" id="deleteForm{{ $proprietaire->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="w-8 h-8 flex items-center justify-center rounded border border-red-500 text-red-500 hover:bg-red-50 transition" onclick="showDeleteModal('Êtes-vous sûr de vouloir supprimer le propriétaire {{ $proprietaire->nom_proprietaire }} ?', document.getElementById('deleteForm{{ $proprietaire->id }}'))" title="Supprimer">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500 bg-white">
                                <i class="fa-solid fa-folder-open text-2xl mb-2 text-gray-300"></i>
                                <p>Aucun propriétaire trouvé</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination (Style Photo 2) -->
        <div class="px-6 py-4 border-t border-gray-200 bg-white">
            {{ $proprietaires->links() }}
        </div>
    </div>
</div>

@endsection