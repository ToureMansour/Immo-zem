@extends('layouts.navigation')

@section('title', 'Journalisation des Activités')

@section('content')

<div class="w-full">

    <!-- En-tête de page -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-tight mb-4 sm:mb-0">JOURNALISATION</h2>
    </div>

    <!-- Zone de Filtres (Style Photo 2) -->
    <div class="bg-white p-5 mb-6 rounded shadow-sm border border-gray-200">
        <form action="{{ route('journalisation.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Filtre Recherche -->
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Recherche</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Description, IP..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600">
            </div>

            <!-- Filtre Action -->
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Action</label>
                <select name="action" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600 bg-white">
                    <option value="">Toutes les actions</option>
                    <option value="connexion" {{ request('action') == 'connexion' ? 'selected' : '' }}>Connexion</option>
                    <option value="suppression" {{ request('action') == 'suppression' ? 'selected' : '' }}>Suppression</option>
                </select>
            </div>

            <!-- Filtre Date Début -->
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Date début</label>
                <input type="date" name="date_debut" value="{{ request('date_debut') }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600">
            </div>

            <!-- Filtre Date Fin -->
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Date fin</label>
                <input type="date" name="date_fin" value="{{ request('date_fin') }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600">
            </div>
            
            <!-- Boutons Filtrer -->
            <div class="flex gap-2">
                <button type="submit" class="flex-1 px-4 py-2 bg-[#445f47] text-white rounded font-medium hover:bg-[#364b39] transition">
                    <i class="fas fa-search mr-2"></i> Filtrer
                </button>
                <a href="{{ route('journalisation.index') }}" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded font-medium hover:bg-gray-200 transition text-center">
                    <i class="fas fa-undo mr-2"></i> Réinitialiser
                </a>
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
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">Date & Heure</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">Utilisateur</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-center">Action</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">Description</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-right">Adresse IP</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-center">Détails</th>
                    </tr>
                </thead>

                <tbody class="text-sm text-gray-700">
                    @forelse($logs as $log)
                        <!-- Lignes alternées (Zebra) : bg-white / bg-gray-50 -->
                        <tr class="border-b border-gray-100 odd:bg-white even:bg-gray-50 hover:bg-green-50/50 transition-colors">
                            
                            <!-- Date -->
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $log->created_at->format('d/m/Y') }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $log->created_at->format('H:i:s') }}</div>
                            </td>

                            <!-- Utilisateur -->
                            <td class="px-6 py-4">
                                @if($log->user)
                                    <div class="text-gray-600">{{ $log->user->name }}</div>
                                    <div class="text-xs text-gray-400 mt-1">{{ $log->user->email }}</div>
                                @else
                                    <div class="text-gray-400 italic">Système / Inconnu</div>
                                @endif
                            </td>

                            <!-- Action -->
                            <td class="px-6 py-4 text-center">
                                @if($log->action == 'connexion')
                                    <span class="px-2 py-1 text-xs font-medium rounded border border-green-200 bg-green-50 text-green-700">
                                        Connexion
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-medium rounded border border-red-200 bg-red-50 text-red-700">
                                        Suppression
                                    </span>
                                @endif
                            </td>

                            <!-- Description -->
                            <td class="px-6 py-4">
                                <div class="text-gray-600">{{ $log->description }}</div>
                            </td>

                            <!-- Adresse IP -->
                            <td class="px-6 py-4 text-right">
                                <div class="text-gray-600">{{ $log->ip_address ?? 'N/A' }}</div>
                            </td>

                            <!-- Actions (Boutons carrés outline) -->
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Voir -->
                                    <a href="{{ route('journalisation.show', $log) }}" class="w-8 h-8 flex items-center justify-center rounded border border-blue-500 text-blue-500 hover:bg-blue-50 transition" title="Voir les détails">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500 bg-white">
                                <i class="fa-solid fa-folder-open text-2xl mb-2 text-gray-300"></i>
                                <p>Aucune entrée trouvée</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination (Style Photo 2) -->
        <div class="px-6 py-4 border-t border-gray-200 bg-white">
            {{ $logs->links() }}
        </div>
    </div>
</div>

@endsection