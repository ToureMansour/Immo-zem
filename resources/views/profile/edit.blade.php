@extends('layouts.navigation')

@section('title', 'Mon Profil')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- En-tête -->
    <div class="mb-6">
        <h2 class="text-lg font-medium text-gray-500">Mon Profil</h2>
        <p class="text-sm text-gray-400">Gérez vos informations personnelles</p>
    </div>

    <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] p-8">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PATCH')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Nom -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nom complet</label>
                    <input type="text" name="name" value="{{ $user->name }}" required
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" required
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none">
                </div>

                <!-- Téléphone -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Téléphone</label>
                    <input type="tel" name="telephone" value="{{ $user->telephone }}"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none">
                </div>

                <!-- Adresse -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Adresse</label>
                    <input type="text" name="adresse" value="{{ $user->adresse }}"
                           class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[#445f47] focus:ring-2 focus:ring-[#445f47]/20 outline-none">
                </div>
            </div>

            <div class="flex justify-between gap-4 pt-6 border-t border-gray-100">
                <a href="{{ url()->previous() }}" class="px-6 py-2.5 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 font-medium transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Retour
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-[#445f47] text-white hover:bg-[#364b39] font-medium transition-all">
                    <i class="fas fa-save mr-2"></i>Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
