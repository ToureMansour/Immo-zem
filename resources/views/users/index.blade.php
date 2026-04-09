@extends('layouts.navigation')

@section('title', 'Utilisateurs')

@section('content')

<div class="w-full">

    <!-- En-tête de page -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-tight mb-4 sm:mb-0">UTILISATEURS</h2>
        
        <a href="{{ route('users.create') }}" 
           class="bg-[#445f47] text-white px-4 py-2 hover:bg-[#3a5040] transition-colors flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            Nouvel Utilisateur
        </a>
    </div>

<!-- Zone de Filtres (Style Photo 2) -->
<div class="bg-white p-5 mb-6 rounded shadow-sm border border-gray-200">
    <form action="{{ route('users.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <!-- Filtre Recherche -->
        <div>
            <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Recherche</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nom, email, rôle..." 
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
        
        <!-- Filtre Rôle -->
        <div>
            <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Rôle</label>
            <select name="role" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#445f47] focus:ring-1 focus:ring-[#445f47] text-sm text-gray-600 bg-white">
                <option value="">Tous les rôles</option>
                <option value="administrateur" {{ request('role') == 'administrateur' ? 'selected' : '' }}>Administrateur</option>
                <option value="manager" {{ request('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                <option value="utilisateur" {{ request('role') == 'utilisateur' ? 'selected' : '' }}>Utilisateur</option>
            </select>
        </div>
        
        <!-- Bouton Filtrer -->
        <div class="flex items-end">
            <button type="submit" class="w-full px-4 py-2 bg-[#445f47] text-white rounded font-medium hover:bg-[#364b39] transition">
                <i class="fas fa-search mr-2"></i> Filtrer
            </button>
        </div>
        
        <!-- Bouton Réinitialiser -->
        <div class="flex items-end">
            <a href="{{ route('users.index') }}" class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded font-medium hover:bg-gray-200 transition text-center">
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
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">Nom & Prénom</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">Email</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">Contact</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">Rôles</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none">Statut</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-none text-center">Actions</th>
                    </tr>
                </thead>
            <tbody class="text-sm text-gray-700">
                    @forelse($users as $user)
                        <!-- Lignes alternées (Zebra) : bg-white / bg-gray-50 -->
                        <tr class="border-b border-gray-100 odd:bg-white even:bg-gray-50 hover:bg-green-50/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $user->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            @if($user->telephone)
                                <i class="fa-solid fa-phone text-gray-400 mr-1"></i> {{ $user->telephone }}
                            @else
                                <span class="text-gray-400">Non renseigné</span>
                            @endif
                        </div>
                        @if($user->adresse)
                            <div class="text-xs text-gray-500 mt-1">
                                <i class="fa-solid fa-location-dot text-gray-400 mr-1"></i> {{ $user->adresse }}
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-wrap gap-1">
                            @foreach($user->roles as $role)
                                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        </div>
                        @if($user->roles->isEmpty())
                            <span class="text-sm text-gray-400">Aucun rôle</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs rounded-full {{ $user->statut == 'actif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $user->statut }}
                        </span>
                    </td>
                    <!-- Actions (Boutons carrés outline) -->
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Voir -->
                                    <a href="{{ route('users.show', $user) }}" class="w-8 h-8 flex items-center justify-center rounded border border-blue-500 text-blue-500 hover:bg-blue-50 transition" title="Voir les détails">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                    <!-- Modifier -->
                                    <a href="{{ route('users.edit', $user) }}" class="w-8 h-8 flex items-center justify-center rounded border border-yellow-500 text-yellow-500 hover:bg-yellow-50 transition" title="Modifier">
                                        <i class="fa-solid fa-edit text-xs"></i>
                                    </a>
                                    <!-- Supprimer -->
                                    <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline" id="deleteForm{{ $user->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                onclick="showDeleteModal('Êtes-vous sûr de vouloir supprimer l\'utilisateur {{ $user->name }} ?', document.getElementById('deleteForm{{ $user->id }}'))"
                                                class="w-8 h-8 flex items-center justify-center rounded border border-red-500 text-red-500 hover:bg-red-50 transition" 
                                                title="Supprimer">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fa-solid fa-users text-gray-300 text-5xl mb-4"></i>
                            <p class="text-gray-500 text-lg font-medium">Aucun utilisateur trouvé</p>
                            <p class="text-gray-400 text-sm mt-2">Commencez par ajouter un nouvel utilisateur</p>
                            <a href="{{ route('users.create') }}" 
                               class="mt-4 bg-[#445f47] text-white px-4 py-2 rounded-lg hover:bg-[#3a5040] transition-colors">
                                <i class="fa-solid fa-plus mr-2"></i>
                                Ajouter un utilisateur
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
            </table>
        </div>

        <!-- Pagination (Style Photo 2) -->
        <div class="px-6 py-4 border-t border-gray-200 bg-white">
            {{ $users->links() }}
        </div>
    </div>
</div>

@endsection
