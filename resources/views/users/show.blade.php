@extends('layouts.navigation')

@section('title', 'Détails de l\'utilisateur')

@section('content')

<div class="mb-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('users.index') }}" class="text-gray-600 hover:text-[#445f47] transition-colors">
                <i class="fa-solid fa-arrow-left mr-2"></i>
                Retour aux utilisateurs
            </a>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('users.edit', $user) }}" 
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                <i class="fa-solid fa-edit"></i>
                Modifier
            </a>
        </div>
    </div>
</div>

<!-- Carte principale -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200">
    
    <!-- En-tête avec photo et infos principales -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-start gap-6">
            <!-- Avatar -->
            <div class="flex-shrink-0">
                <div class="h-20 w-20 rounded-full bg-[#445f47] text-white flex items-center justify-center font-bold text-2xl shadow-lg">
                    {{ substr($user->name, 0, 1) }}
                </div>
            </div>
            
            <!-- Informations principales -->
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
                    <span class="px-3 py-1 text-xs rounded-full {{ $user->statut == 'actif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $user->statut }}
                    </span>
                </div>
                
                <div class="space-y-1 text-gray-600">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-gray-400 w-4"></i>
                        <span>{{ $user->email }}</span>
                    </div>
                    @if($user->telephone)
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-phone text-gray-400 w-4"></i>
                        <span>{{ $user->telephone }}</span>
                    </div>
                    @endif
                    @if($user->adresse)
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-location-dot text-gray-400 w-4"></i>
                        <span>{{ $user->adresse }}</span>
                    </div>
                    @endif
                </div>
                
                <!-- Rôles -->
                <div class="mt-4">
                    <div class="text-sm text-gray-500 mb-2">Rôles assignés:</div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($user->roles as $role)
                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800 font-medium">
                                {{ ucfirst($role->name) }}
                            </span>
                        @endforeach
                        @if($user->roles->isEmpty())
                            <span class="text-sm text-gray-400">Aucun rôle assigné</span>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="flex flex-col gap-2">
                <a href="{{ route('users.edit', $user) }}" 
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
                    <i class="fa-solid fa-edit"></i>
                    Modifier
                </a>
                <form method="POST" action="{{ route('users.destroy', $user) }}" 
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center justify-center gap-2">
                        <i class="fa-solid fa-trash"></i>
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Détails supplémentaires -->
    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Informations personnelles -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fa-solid fa-user text-[#445f47] mr-2"></i>
                    Informations personnelles
                </h3>
                
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <div class="text-sm text-gray-500">Nom complet</div>
                            <div class="font-medium">{{ $user->name }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Email</div>
                            <div class="font-medium">{{ $user->email }}</div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <div class="text-sm text-gray-500">Téléphone</div>
                            <div class="font-medium">
                                {{ $user->telephone ?? 'Non renseigné' }}
                            </div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Statut</div>
                            <div class="font-medium">
                                <span class="px-2 py-1 text-xs rounded-full {{ $user->statut == 'actif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $user->statut }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="text-sm text-gray-500">Adresse</div>
                        <div class="font-medium">
                            {{ $user->adresse ?? 'Non renseignée' }}
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pièce d'identité -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fa-solid fa-id-card text-[#445f47] mr-2"></i>
                    Pièce d'identité
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <div class="text-sm text-gray-500">Numéro CNI</div>
                        <div class="font-medium">
                            {{ $user->cni_numero ?? 'Non renseigné' }}
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <div class="text-sm text-gray-500">Date de délivrance</div>
                            <div class="font-medium">
                                {{ $user->cni_date_delivrance ? $user->cni_date_delivrance->format('d/m/Y') : 'Non renseignée' }}
                            </div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Lieu de délivrance</div>
                            <div class="font-medium">
                                {{ $user->cni_lieu_delivrance ?? 'Non renseigné' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Informations système -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fa-solid fa-cog text-[#445f47] mr-2"></i>
                Informations système
            </h3>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div>
                    <div class="text-sm text-gray-500">ID Utilisateur</div>
                    <div class="font-medium">{{ $user->id }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500">Date de création</div>
                    <div class="font-medium">{{ $user->created_at->format('d/m/Y H:i') }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500">Dernière mise à jour</div>
                    <div class="font-medium">{{ $user->updated_at->format('d/m/Y H:i') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
