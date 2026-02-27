@extends('layouts.navigation')

@section('title', 'Détail du Log')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- En-tête -->
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('journalisation.index') }}" class="text-gray-500 hover:text-[#445f47]">
            <i class="fas fa-arrow-left mr-2"></i>Retour
        </a>
        <div>
            <h2 class="text-lg font-medium text-gray-500">Détail du Log</h2>
            <p class="text-sm text-gray-400">Référence : {{ $log->reference }}</p>
        </div>
    </div>

    <!-- Détails du log -->
    <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Action -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Action</label>
                <div class="px-4 py-3 rounded-lg bg-gray-50 border border-gray-200">
                    @switch($log->action)
                        @case('connexion')
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-sign-in-alt mr-1"></i> Connexion
                            </span>
                            @break
                        @case('deconnexion')
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                <i class="fas fa-sign-out-alt mr-1"></i> Déconnexion
                            </span>
                            @break
                        @case('echec_connexion')
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                <i class="fas fa-exclamation-triangle mr-1"></i> Échec connexion
                            </span>
                            @break
                        @case('creation')
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                <i class="fas fa-plus mr-1"></i> Création
                            </span>
                            @break
                        @case('modification')
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-edit mr-1"></i> Modification
                            </span>
                            @break
                        @case('suppression')
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                <i class="fas fa-trash mr-1"></i> Suppression
                            </span>
                            @break
                    @endswitch
                </div>
            </div>

            <!-- Utilisateur -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Utilisateur</label>
                <div class="px-4 py-3 rounded-lg bg-gray-50 border border-gray-200">
                    {{ $log->user ? $log->user->name : 'Inconnu' }}
                </div>
            </div>

            <!-- Date -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Date</label>
                <div class="px-4 py-3 rounded-lg bg-gray-50 border border-gray-200">
                    {{ $log->created_at->format('d/m/Y H:i:s') }}
                </div>
            </div>

            <!-- Adresse IP -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Adresse IP</label>
                <div class="px-4 py-3 rounded-lg bg-gray-50 border border-gray-200">
                    {{ $log->ip_address }}
                </div>
            </div>

            <!-- User Agent -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">User Agent</label>
                <div class="px-4 py-3 rounded-lg bg-gray-50 border border-gray-200">
                    {{ $log->user_agent }}
                </div>
            </div>

            <!-- Description -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                <div class="px-4 py-3 rounded-lg bg-gray-50 border border-gray-200">
                    {{ $log->description }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
