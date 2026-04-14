<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérifier le code - LLB Gestion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
        .code-input {
            letter-spacing: 0.5em;
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen w-full">

        <!-- Partie GAUCHE : Image -->
        <div class="hidden lg:flex w-2/3 bg-gradient-to-br from-[#445f47] to-[#364b39] relative">
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white p-8">
                    <i class="fas fa-shield-halved text-6xl mb-6 opacity-80"></i>
                    <h2 class="text-3xl font-bold mb-4">LLB Gestion</h2>
                    <p class="text-lg opacity-90">Vérification de sécurité</p>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/60 to-transparent p-12 text-white">
                <p class="text-lg font-semibold">Vérification en cours</p>
                <p class="text-xl font-bold">Entrez votre code à 5 chiffres</p>
                <p class="text-sm mt-2">Le code expirera dans 1 heure</p>
            </div>
        </div>

        <!-- Partie DROITE : Formulaire -->
        <div class="w-full lg:w-1/3 bg-white flex flex-col justify-center items-center px-8 py-12 shadow-lg">
            
            <div class="w-full max-w-md">
                <!-- Titre -->
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-[#445f47]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-halved text-2xl text-[#445f47]"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Vérifier le code</h1>
                    <p class="text-gray-500 text-sm">Entrez le code à 5 chiffres reçu par email</p>
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

                <!-- Email masqué -->
                @if (session('email'))
                    <input type="hidden" name="email" value="{{ session('email') }}" required>
                    <div class="mb-6 p-3 bg-gray-50 rounded-lg text-center">
                        <p class="text-sm text-gray-600">Code envoyé à :</p>
                        <p class="font-semibold text-gray-800">{{ session('email') }}</p>
                    </div>
                @endif

                <!-- Formulaire -->
                <form action="{{ route('password.verify') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Code à 5 chiffres -->
                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Code de vérification</label>
                        <div class="relative">
                            <input type="text" name="code" id="code" maxlength="5" pattern="[0-9]{5}" 
                                   class="w-full px-4 py-4 text-center code-input rounded-md bg-blue-50 border border-blue-100 focus:outline-none focus:ring-2 focus:ring-[#445f47] text-gray-700 placeholder-gray-400"
                                   placeholder="00000" required>
                        </div>
                        @error('code')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Bouton Vérifier -->
                    <button type="submit" 
                            class="w-full bg-[#445f47] hover:bg-[#364b39] text-white font-bold py-3 px-4 rounded transition duration-200 flex items-center justify-center">
                        <i class="fas fa-check mr-2"></i>
                        Vérifier le code
                    </button>
                </form>

                <!-- Liens bas -->
                <div class="mt-8 text-center space-y-4">
                    <a href="{{ route('password.request') }}" class="block text-sm text-[#445f47] hover:underline mb-2">
                        <i class="fa-solid fa-redo mr-2"></i> Renvoyer un nouveau code
                    </a>
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

    <!-- Animation de chargement -->
    <div id="loadingOverlay" class="fixed inset-0 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen bg-black/50 backdrop-blur-sm">
            <div class="bg-white rounded-xl p-8 shadow-2xl flex flex-col items-center">
                <!-- Animation de chargement -->
                <div class="relative w-16 h-16 mb-4">
                    <div class="absolute inset-0 border-4 border-gray-200 rounded-full"></div>
                    <div class="absolute inset-0 border-4 border-[#445f47] rounded-full border-t-transparent animate-spin"></div>
                    <div class="absolute inset-2 flex items-center justify-center">
                        <i class="fas fa-shield-halved text-[#445f47] text-xl"></i>
                    </div>
                </div>
                
                <!-- Texte de chargement -->
                <p class="text-gray-700 font-medium">Vérification...</p>
                <p class="text-gray-500 text-sm mt-1">Veuillez patienter</p>
            </div>
        </div>
    </div>

    <!-- Script pour auto-focus et formatage du code -->
    <script>
        // Fonctions de chargement
        function showLoading(message = 'Chargement...', subtext = 'Veuillez patienter') {
            const overlay = document.getElementById('loadingOverlay');
            const messageEl = overlay.querySelector('p.text-gray-700');
            const subtextEl = overlay.querySelector('p.text-gray-500');
            
            messageEl.textContent = message;
            subtextEl.textContent = subtext;
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function hideLoading() {
            const overlay = document.getElementById('loadingOverlay');
            overlay.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Intercepter la soumission du formulaire
            const form = document.querySelector('form[action*="reset-code.verify"]');
            if (form) {
                form.addEventListener('submit', function(e) {
                    showLoading('Vérification du code...', 'Validation en cours');
                });
            }
            
            const codeInput = document.getElementById('code');
            
            // Auto-focus sur le champ code
            codeInput.focus();
            
            // Formater automatiquement le code (5 chiffres)
            codeInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, ''); // Supprimer les non-chiffres
                if (value.length > 5) {
                    value = value.slice(0, 5);
                }
                e.target.value = value;
            });
        });
    </script>

    <!-- Animation de chargement -->
    <div id="loadingOverlay" class="fixed inset-0 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen bg-black/50 backdrop-blur-sm">
            <div class="bg-white rounded-xl p-8 shadow-2xl flex flex-col items-center">
                <!-- Animation de chargement -->
                <div class="relative w-16 h-16 mb-4">
                    <div class="absolute inset-0 border-4 border-gray-200 rounded-full"></div>
                    <div class="absolute inset-0 border-4 border-[#445f47] rounded-full border-t-transparent animate-spin"></div>
                    <div class="absolute inset-2 flex items-center justify-center">
                        <i class="fas fa-home text-[#445f47] text-xl"></i>
                    </div>
                </div>
                
                <!-- Texte de chargement -->
                <p class="text-gray-700 font-medium">Chargement...</p>
                <p class="text-gray-500 text-sm mt-1">Veuillez patienter</p>
            </div>
        </div>
    </div>

    <script>
        // Fonctions de chargement
        function showLoading(message = 'Chargement...', subtext = 'Veuillez patienter') {
            const overlay = document.getElementById('loadingOverlay');
            const messageEl = overlay.querySelector('p.text-gray-700');
            const subtextEl = overlay.querySelector('p.text-gray-500');
            
            messageEl.textContent = message;
            subtextEl.textContent = subtext;
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function hideLoading() {
            const overlay = document.getElementById('loadingOverlay');
            overlay.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Intercepter toutes les soumissions de formulaire
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitButton = form.querySelector('button[type="submit"], input[type="submit"]');
                    if (submitButton) {
                        let message = 'Traitement en cours...';
                        let subtext = 'Veuillez patienter';
                        
                        if (form.action.includes('verify')) {
                            message = 'Vérification en cours...';
                            subtext = 'Validation du code de sécurité';
                        }
                        
                        showLoading(message, subtext);
                    }
                });
            });
        });
    </script>
</body>
</html>
