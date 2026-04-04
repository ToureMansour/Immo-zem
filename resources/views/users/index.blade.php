@extends('layouts.navigation')

@section('title', 'Utilisateurs')

@section('content')

<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Gestion des Utilisateurs</h1>
    <p class="text-gray-600 mt-2">Gérez les comptes utilisateurs et leurs permissions</p>
</div>

<!-- Boutons d'action -->
<div class="flex justify-between items-center mb-6">
    <div class="flex items-center gap-4">
        <!-- Barre de recherche -->
        <div class="relative">
            <input type="text" 
                   placeholder="Rechercher un utilisateur..." 
                   class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#445f47] focus:border-transparent w-64">
            <i class="fa-solid fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
    </div>
    
    <a href="{{ route('users.create') }}" 
       class="bg-[#445f47] text-white px-4 py-2 rounded-lg hover:bg-[#3a5040] transition-colors flex items-center gap-2">
        <i class="fa-solid fa-plus"></i>
        Nouvel Utilisateur
    </a>
</div>

<!-- Carte principale -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200">
    
    <!-- En-tête du tableau -->
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800">Liste des Utilisateurs</h2>
        <p class="text-sm text-gray-600 mt-1">{{ $users->total() }} utilisateur(s) trouvé(s)</p>
    </div>
    
    <!-- Tableau -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Utilisateur
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Contact
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Rôles
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Statut
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Date de création
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-[#445f47] text-white flex items-center justify-center font-bold mr-3">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                            </div>
                        </div>
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
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $user->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('users.show', $user) }}" 
                               class="text-[#445f47] hover:text-[#3a5040] transition-colors" 
                               title="Voir">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('users.edit', $user) }}" 
                               class="text-blue-600 hover:text-blue-800 transition-colors" 
                               title="Modifier">
                                <i class="fa-solid fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline" 
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-800 transition-colors" 
                                        title="Supprimer">
                                    <i class="fa-solid fa-trash"></i>
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
    
    <!-- Pagination -->
    @if($users->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $users->links() }}
    </div>
    @endif
</div>

@endsection
