@extends('layouts.navigation')

@section('title', 'Gestion des Motos (Zem)')

@section('content')

<div class="w-full">

    <!-- En-tête de page -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-tight mb-4 sm:mb-0">LISTE DES MOTOS (ZEM)</h2>
        
        <a href="{{ route('motos.create') }}" 
           class="px-5 py-2 bg-[#445f47] text-white rounded font-medium hover:bg-[#364b39] transition shadow-sm flex items-center text-sm">
            <i class="fas fa-plus mr-2"></i> NOUVELLE MOTO
        </a>
    </div>

    <!-- Zone de Filtres (Style Photo 2) -->
    <div class="bg-white p-5 mb-6 rounded shadow-sm border border-gray-200">
        <form action="{{ route('motos.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Filtre Recherche -->
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Recherche</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Immatriculation, marque..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600">
            </div>

            <!-- Filtre Statut -->
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Statut</label>
                <select name="statut" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600 bg-white">
                    <option value="">Tous les statuts</option>
                    <option value="disponible" {{ request('statut') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="loue" {{ request('statut') == 'loue' ? 'selected' : '' }}>Louée</option>
                    <option value="maintenance" {{ request('statut') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
            </div>

            <!-- Filtre Marque -->
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Marque</label>
                <select name="marque" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600 bg-white">
                    <option value="">Toutes les marques</option>
                    <option value="honda" {{ request('marque') == 'honda' ? 'selected' : '' }}>Honda</option>
                    <option value="yamaha" {{ request('marque') == 'yamaha' ? 'selected' : '' }}>Yamaha</option>
                    <option value="suzuki" {{ request('marque') == 'suzuki' ? 'selected' : '' }}>Suzuki</option>
                    <option value="kawasaki" {{ request('marque') == 'kawasaki' ? 'selected' : '' }}>Kawasaki</option>
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
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">Info Moto</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-center">Type</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-right">Kilométrage</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-center">Statut</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-right">Prix Journalier</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="text-sm text-gray-700">
                    @forelse($motos as $moto)
                        <!-- Lignes alternées (Zebra) : bg-white / bg-gray-50 -->
                        <tr class="border-b border-gray-100 odd:bg-white even:bg-gray-50 hover:bg-green-50/50 transition-colors">
                            
                            <!-- Info Moto -->
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $moto->immatriculation }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $moto->marque }} {{ $moto->modele }} • {{ $moto->annee }}</div>
                            </td>

                            <!-- Type -->
                            <td class="px-6 py-4 text-center">
                                @switch($moto->type)
                                    @case('automatique')
                                        <span class="px-2 py-1 text-xs font-medium rounded border border-blue-200 bg-blue-50 text-blue-700">
                                            Auto
                                        </span>
                                        @break
                                    @case('manuelle')
                                        <span class="px-2 py-1 text-xs font-medium rounded border border-gray-200 bg-gray-50 text-gray-700">
                                            Manuelle
                                        </span>
                                        @break
                                    @default
                                        <span class="px-2 py-1 text-xs font-medium rounded border border-gray-200 bg-gray-50 text-gray-700">
                                            {{ $moto->type }}
                                        </span>
                                @endswitch
                            </td>

                            <!-- Kilométrage -->
                            <td class="px-6 py-4 text-right font-medium">
                                {{ number_format($moto->kilometrage, 0, ',', ' ') }} km
                            </td>

                            <!-- Statut -->
                            <td class="px-6 py-4 text-center">
                                @if($moto->statut == 'disponible')
                                    <span class="px-2 py-1 text-xs font-bold text-green-700 bg-green-50 border border-green-200 rounded">
                                        Disponible
                                    </span>
                                @elseif($moto->statut == 'loue')
                                    <span class="px-2 py-1 text-xs font-bold text-red-700 bg-red-50 border border-red-200 rounded">
                                        Louée
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-bold text-yellow-700 bg-yellow-50 border border-yellow-200 rounded">
                                        Maintenance
                                    </span>
                                @endif
                            </td>

                            <!-- Prix Journalier -->
                            <td class="px-6 py-4 text-right font-medium">
                                {{ number_format($moto->prix_journalier, 0, ',', ' ') }} FCFA
                            </td>

                            <!-- Actions (Boutons carrés outline) -->
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Voir -->
                                    <a href="{{ route('motos.show', $moto) }}" class="w-8 h-8 flex items-center justify-center rounded border border-blue-500 text-blue-500 hover:bg-blue-50 transition" title="Voir">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                    <!-- Modifier -->
                                    <a href="{{ route('motos.edit', $moto) }}" class="w-8 h-8 flex items-center justify-center rounded border border-yellow-500 text-yellow-500 hover:bg-yellow-50 transition" title="Modifier">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </a>
                                    <!-- Supprimer -->
                                    <form action="{{ route('motos.destroy', $moto) }}" method="POST" class="inline">
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
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500 bg-white">
                                <i class="fa-solid fa-folder-open text-2xl mb-2 text-gray-300"></i>
                                <p>Aucune moto trouvée</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination (Style Photo 2) -->
        <div class="px-6 py-4 border-t border-gray-200 bg-white">
            {{ $motos->links() }}
        </div>
    </div>
</div>

@endsection