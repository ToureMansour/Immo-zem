@extends('layouts.navigation')

@section('title', 'Gestion des Locations de Biens Immobiliers')

@section('content')

<div class="w-full">

    <!-- En-tête de page -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-tight mb-4 sm:mb-0">LISTE DES LOCATIONS BIENS</h2>
        
        <a href="{{ route('locations_biens.create') }}" 
           class="px-5 py-2 bg-[#445f47] text-white rounded font-medium hover:bg-[#364b39] transition shadow-sm flex items-center text-sm">
            <i class="fas fa-plus mr-2"></i> NOUVELLE LOCATION
        </a>
    </div>

    <!-- Zone de Filtres (Style Photo 2) -->
    <div class="bg-white p-5 mb-6 rounded shadow-sm border border-gray-200">
        <form action="{{ route('locations_biens.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Filtre Recherche -->
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Recherche</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="N° location, bien..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600">
            </div>

            <!-- Filtre Statut -->
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Statut</label>
                <select name="statut" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600 bg-white">
                    <option value="">Tous les statuts</option>
                    <option value="en_cours" {{ request('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                    <option value="terminee" {{ request('statut') == 'terminee' ? 'selected' : '' }}>Terminée</option>
                    <option value="annulee" {{ request('statut') == 'annulee' ? 'selected' : '' }}>Annulée</option>
                </select>
            </div>

            <!-- Filtre Type Bail -->
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Type de bail</label>
                <select name="type_bail" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600 bg-white">
                    <option value="">Tous les baux</option>
                    <option value="habitation" {{ request('type_bail') == 'habitation' ? 'selected' : '' }}>Habitation</option>
                    <option value="commercial" {{ request('type_bail') == 'commercial' ? 'selected' : '' }}>Commercial</option>
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
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">N° Location</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">Bien Immobilier</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">Locataire</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-center">Type Bail</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-center">Durée</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-right">Loyer Mensuel</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-center">Statut</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="text-sm text-gray-700">
                    @forelse($locations as $location)
                        <!-- Lignes alternées (Zebra) : bg-white / bg-gray-50 -->
                        <tr class="border-b border-gray-100 odd:bg-white even:bg-gray-50 hover:bg-green-50/50 transition-colors">
                            
                            <!-- Numéro Location -->
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $location->numero_location }}</div>
                                <div class="text-xs text-gray-500 mt-1">Du {{ $location->date_debut->format('d/m/Y') }}</div>
                            </td>

                            <!-- Bien Immobilier -->
                            <td class="px-6 py-4">
                                <div class="text-gray-600">{{ $location->bienImmobilier->titre }}</div>
                                <div class="text-xs text-gray-400 mt-1">{{ $location->bienImmobilier->surface }}m² • {{ $location->bienImmobilier->nombre_pieces }} pièces</div>
                            </td>

                            <!-- Locataire -->
                            <td class="px-6 py-4">
                                <div class="text-gray-600">{{ $location->locataire->nom }} {{ $location->locataire->prenom }}</div>
                                <div class="text-xs text-gray-400 mt-1">{{ $location->locataire->telephone }}</div>
                            </td>

                            <!-- Type Bail -->
                            <td class="px-6 py-4 text-center">
                                @switch($location->type_bail)
                                    @case('habitation')
                                        <span class="px-2 py-1 text-xs font-medium rounded border border-blue-200 bg-blue-50 text-blue-700">
                                            Habitation
                                        </span>
                                        @break
                                    @case('commercial')
                                        <span class="px-2 py-1 text-xs font-medium rounded border border-green-200 bg-green-50 text-green-700">
                                            Commercial
                                        </span>
                                        @break
                                    @default
                                        <span class="px-2 py-1 text-xs font-medium rounded border border-gray-200 bg-gray-50 text-gray-700">
                                            {{ $location->type_bail }}
                                        </span>
                                @endswitch
                            </td>

                            <!-- Durée -->
                            <td class="px-6 py-4 text-center">
                                <div class="text-gray-600">{{ $location->date_debut->format('d/m') }}</div>
                                <div class="text-xs text-gray-400 mt-1">
                                    @if($location->date_fin)
                                        au {{ $location->date_fin->format('d/m') }}
                                    @else
                                        En cours
                                    @endif
                                </div>
                            </td>

                            <!-- Loyer Mensuel -->
                            <td class="px-6 py-4 text-right font-medium">
                                {{ number_format($location->loyer_mensuel, 0, ',', ' ') }} FCFA
                            </td>

                            <!-- Statut -->
                            <td class="px-6 py-4 text-center">
                                @if($location->statut == 'en_cours')
                                    <span class="px-2 py-1 text-xs font-bold text-green-700 bg-green-50 border border-green-200 rounded">
                                        En cours
                                    </span>
                                @elseif($location->statut == 'terminee')
                                    <span class="px-2 py-1 text-xs font-bold text-blue-700 bg-blue-50 border border-blue-200 rounded">
                                        Terminée
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-bold text-red-700 bg-red-50 border border-red-200 rounded">
                                        Annulée
                                    </span>
                                @endif
                            </td>

                            <!-- Actions (Boutons carrés outline) -->
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Voir -->
                                    <a href="{{ route('locations_biens.show', $location) }}" class="w-8 h-8 flex items-center justify-center rounded border border-blue-500 text-blue-500 hover:bg-blue-50 transition" title="Voir">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                    <!-- Modifier -->
                                    <a href="{{ route('locations_biens.edit', $location) }}" class="w-8 h-8 flex items-center justify-center rounded border border-yellow-500 text-yellow-500 hover:bg-yellow-50 transition" title="Modifier">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </a>
                                    <!-- Supprimer -->
                                    <form action="{{ route('locations_biens.destroy', $location) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded border border-red-500 text-red-500 hover:bg-red-50 transition" onclick="return confirm('Confirmer la suppression ?')" title="Supprimer">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-gray-500 bg-white">
                                <i class="fa-solid fa-folder-open text-2xl mb-2 text-gray-300"></i>
                                <p>Aucune location trouvée</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination (Style Photo 2) -->
        <div class="px-6 py-4 border-t border-gray-200 bg-white">
            {{ $locations->links() }}
        </div>
    </div>
</div>

@endsection
