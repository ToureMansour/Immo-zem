<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié - LLB Gestion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen w-full">

        <!-- Partie GAUCHE : Image -->
        <div class="hidden lg:flex w-2/3 bg-cover bg-center relative" 
             style="background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d40e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80');">
            
            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/80 to-transparent p-12 text-white">
                <p class="text-lg font-semibold">Mot de passe oublié ?</p>
                <p class="text-xl font-bold">LLB Gestion</p>
                <p class="text-sm mt-2">Application de Gestion Immobilière</p>
            </div>
        </div>

        <!-- Partie DROITE : Formulaire -->
        <div class="w-full lg:w-1/3 bg-white flex flex-col justify-center items-center px-8 py-12 shadow-lg">
            
            <div class="w-full max-w-md">
                <!-- Titre -->
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-[#445f47]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-key text-2xl text-[#445f47]"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Mot de passe oublié</h1>
                    <p class="text-gray-500 text-sm">Entrez votre email pour recevoir un code à 5 chiffres</p>
                </div>

                <!-- Messages Flash -->
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <span class="text-green-700 text-sm">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                            <span class="text-red-700 text-sm">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Formulaire -->
                <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse email</label>
                        <div class="relative">
                            <input type="email" name="email" id="email" 
                                   class="w-full px-4 py-3 pl-11 rounded-md bg-blue-50 border border-blue-100 focus:outline-none focus:ring-2 focus:ring-[#445f47] text-gray-700 placeholder-gray-400"
                                   placeholder="exemple@email.com" required>
                            <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Bouton Envoyer -->
                    <button type="submit" 
                            class="w-full bg-[#445f47] hover:bg-[#364b39] text-white font-bold py-3 px-4 rounded transition duration-200 flex items-center justify-center">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Envoyer le code de réinitialisation
                    </button>
                </form>

                <!-- Liens bas -->
                <div class="mt-8 text-center space-y-4">
                    <a href="{{ route('login') }}" class="inline-flex items-center text-sm font-bold text-[#445f47] hover:underline">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Retour à la connexion
                    </a>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-auto pt-8 text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} LLB Gestion. Tous droits réservés.
            </div>
        </div>
    </div>

</body>
</html>
