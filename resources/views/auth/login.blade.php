<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion Immo</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen w-full">

        <!-- Partie GAUCHE : Image (Masqué sur mobile, visible sur grand écran) -->
        <div class="hidden lg:flex w-2/3 bg-cover bg-center relative" 
             style="background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80');">
            <!-- Image moderne de bâtiments immobiliers pour Gestion Immo -->
            
            <!-- Overlay sombre pour le texte en bas -->
            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/80 to-transparent p-12 text-white">
                <p class="text-lg font-semibold">Besoin d'assistance ? Contactez le service technique</p>
                <p class="text-xl font-bold">(+225) 07 00 00 00 00</p>
            </div>
        </div>

        <!-- Partie DROITE : Formulaire -->
        <div class="w-full lg:w-1/3 bg-white flex flex-col justify-center items-center px-8 py-12 shadow-lg">
            
            <div class="w-full max-w-md">
                <!-- Titre simple sans logo - décalé vers le milieu -->
                <div class="text-center mb-12 mt-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Gestion Immo</h1>
                    <p class="text-gray-500 text-sm">Bienvenue sur le portail administratif</p>
                    <p class="text-gray-400 text-xs mt-1">Connectez-vous pour gérer les services numériques</p>
                </div>

                <!-- Formulaire -->
                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse email</label>
                        <input type="email" name="email" id="email" 
                               class="w-full px-4 py-3 rounded-md bg-blue-50 border border-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 placeholder-gray-400"
                               placeholder="exemple@email.com" value="admin@gestion-immo.com" required>
                    </div>

                    <!-- Mot de passe -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" 
                                   class="w-full px-4 py-3 rounded-md bg-blue-50 border border-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 placeholder-gray-400"
                                   placeholder="•••••••••••" required>
                            <!-- Icône oeil -->
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700">
                                <i class="fa-regular fa-eye" id="eye-icon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Bouton Connexion -->
                    <button type="submit" 
                            class="w-full bg-[#445f47] hover:bg-[#364b39] text-white font-bold py-3 px-4 rounded transition duration-200">
                        Connexion
                    </button>
                </form>

                <!-- Liens bas -->
                <div class="mt-6 text-center space-y-4">
                    <a href="#" class="block text-sm text-[#445f47] hover:underline">Mot de passe oublié ?</a>
                    
                    <a href="/" class="inline-flex items-center text-sm font-bold text-[#445f47] hover:underline">
                        <i class="fa-solid fa-house mr-2"></i> Retour a l'accueil
                    </a>
                </div>
            </div>

            <!-- Footer bas de page (copyright, version, etc. si besoin) -->
            <div class="mt-auto pt-8 text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} Gestion Immo. Tous droits réservés.
            </div>
        </div>
    </div>

    <!-- Script simple pour voir/cacher le mot de passe -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>