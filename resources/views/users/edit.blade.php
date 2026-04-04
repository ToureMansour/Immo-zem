@extends('layouts.navigation')

@section('title', 'Modifier l\'utilisateur')

@section('content')

<div class="mb-6">
    <div class="flex items-center gap-4 mb-4">
        <a href="{{ route('users.index') }}" class="text-gray-600 hover:text-[#445f47] transition-colors">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Retour aux utilisateurs
        </a>
    </div>
    <h1 class="text-3xl font-bold text-gray-800">Modifier l'utilisateur</h1>
    <p class="text-gray-600 mt-2">Mettez à jour les informations de {{ $user->name }}</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200">
    <div class="p-6">
        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                <!-- Colonne de gauche -->
                <div class="space-y-6">
                    
                    <!-- Informations de base -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-user text-[#445f47] mr-2"></i>
                            Informations de base
                        </h3>
                        
                        <div class="space-y-4">
                            <!-- Nom -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nom complet <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $user->name) }}"
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#445f47] focus:border-transparent"
                                       placeholder="Entrez le nom complet">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                    Adresse email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $user->email) }}"
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#445f47] focus:border-transparent"
                                       placeholder="exemple@email.com">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Téléphone -->
                            <div>
                                <label for="telephone" class="block text-sm font-medium text-gray-700 mb-1">
                                    Téléphone
                                </label>
                                <input type="tel" 
                                       id="telephone" 
                                       name="telephone" 
                                       value="{{ old('telephone', $user->telephone) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#445f47] focus:border-transparent"
                                       placeholder="+228 00 00 00 00">
                                @error('telephone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Adresse -->
                            <div>
                                <label for="adresse" class="block text-sm font-medium text-gray-700 mb-1">
                                    Adresse
                                </label>
                                <textarea id="adresse" 
                                          name="adresse" 
                                          rows="2"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#445f47] focus:border-transparent"
                                          placeholder="Entrez l'adresse">{{ old('adresse', $user->adresse) }}</textarea>
                                @error('adresse')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
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
                            <!-- Numéro CNI -->
                            <div>
                                <label for="cni_numero" class="block text-sm font-medium text-gray-700 mb-1">
                                    Numéro CNI
                                </label>
                                <input type="text" 
                                       id="cni_numero" 
                                       name="cni_numero" 
                                       value="{{ old('cni_numero', $user->cni_numero) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#445f47] focus:border-transparent"
                                       placeholder="Numéro de la carte d'identité">
                                @error('cni_numero')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Date de délivrance -->
                                <div>
                                    <label for="cni_date_delivrance" class="block text-sm font-medium text-gray-700 mb-1">
                                        Date de délivrance
                                    </label>
                                    <input type="date" 
                                           id="cni_date_delivrance" 
                                           name="cni_date_delivrance" 
                                           value="{{ old('cni_date_delivrance', $user->cni_date_delivrance?->format('Y-m-d')) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#445f47] focus:border-transparent">
                                    @error('cni_date_delivrance')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Lieu de délivrance -->
                                <div>
                                    <label for="cni_lieu_delivrance" class="block text-sm font-medium text-gray-700 mb-1">
                                        Lieu de délivrance
                                    </label>
                                    <input type="text" 
                                           id="cni_lieu_delivrance" 
                                           name="cni_lieu_delivrance" 
                                           value="{{ old('cni_lieu_delivrance', $user->cni_lieu_delivrance) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#445f47] focus:border-transparent"
                                           placeholder="Lieu de délivrance">
                                    @error('cni_lieu_delivrance')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Colonne de droite -->
                <div class="space-y-6">
                    
                    <!-- Sécurité -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-lock text-[#445f47] mr-2"></i>
                            Sécurité
                        </h3>
                        
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                            <p class="text-sm text-blue-800">
                                <i class="fa-solid fa-info-circle mr-1"></i>
                                Laissez les champs du mot de passe vides pour ne pas le modifier.
                            </p>
                        </div>
                        
                        <div class="space-y-4">
                            <!-- Mot de passe -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nouveau mot de passe
                                </label>
                                <input type="password" 
                                       id="password" 
                                       name="password" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#445f47] focus:border-transparent"
                                       placeholder="Entrez le nouveau mot de passe">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Confirmation du mot de passe -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                                    Confirmer le nouveau mot de passe
                                </label>
                                <input type="password" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#445f47] focus:border-transparent"
                                       placeholder="Confirmez le nouveau mot de passe">
                                @error('password_confirmation')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Rôles et permissions -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-user-shield text-[#445f47] mr-2"></i>
                            Rôles et permissions
                        </h3>
                        
                        <!-- Statut -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Statut du compte <span class="text-red-500">*</span>
                            </label>
                            <div class="flex gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="statut" value="actif"
                                           {{ old('statut', $user->statut) == 'actif' ? 'checked' : '' }}
                                           class="mr-2 text-[#445f47] focus:ring-[#445f47]">
                                    <span class="text-sm">Actif</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="statut" value="inactif"
                                           {{ old('statut', $user->statut) == 'inactif' ? 'checked' : '' }}
                                           class="mr-2 text-[#445f47] focus:ring-[#445f47]">
                                    <span class="text-sm">Inactif</span>
                                </label>
                            </div>
                            @error('statut')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Rôles -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Rôles assignés
                            </label>
                            <div class="space-y-2">
                                @foreach($roles as $role)
                                <label class="flex items-center">
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                           class="mr-2 text-[#445f47] focus:ring-[#445f47] rounded"
                                           {{ old('roles', $user->roles->pluck('name')->toArray()) && in_array($role->name, old('roles', $user->roles->pluck('name')->toArray())) ? 'checked' : '' }}>
                                    <span class="text-sm">{{ ucfirst($role->name) }}</span>
                                </label>
                                @endforeach
                            </div>
                            @error('roles')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Boutons d'action -->
            <div class="mt-8 flex justify-end gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('users.index') }}" 
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-[#445f47] text-white rounded-lg hover:bg-[#3a5040] transition-colors flex items-center gap-2">
                    <i class="fa-solid fa-save"></i>
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
