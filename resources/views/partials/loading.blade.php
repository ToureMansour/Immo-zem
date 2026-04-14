<!-- Composant de chargement -->
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
// Fonctions globales pour le chargement
window.showLoading = function(message = 'Chargement...', subtext = 'Veuillez patienter') {
    const overlay = document.getElementById('loadingOverlay');
    const messageEl = overlay.querySelector('p.text-gray-700');
    const subtextEl = overlay.querySelector('p.text-gray-500');
    
    messageEl.textContent = message;
    subtextEl.textContent = subtext;
    overlay.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
};

window.hideLoading = function() {
    const overlay = document.getElementById('loadingOverlay');
    overlay.classList.add('hidden');
    document.body.style.overflow = 'auto';
};

// Intercepter toutes les soumissions de formulaire
document.addEventListener('DOMContentLoaded', function() {
    // Intercepter les formulaires
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            // Ne pas afficher le chargement pour les formulaires avec data-no-loading
            if (!form.hasAttribute('data-no-loading')) {
                const submitButton = form.querySelector('button[type="submit"], input[type="submit"]');
                if (submitButton) {
                    const buttonText = submitButton.textContent || submitButton.value;
                    let message = 'Traitement en cours...';
                    let subtext = 'Veuillez patienter';
                    
                    // Messages personnalisés selon l'action
                    if (form.action.includes('store') || form.action.includes('create')) {
                        message = 'Création en cours...';
                        subtext = 'Ajout des informations';
                    } else if (form.action.includes('update') || form.action.includes('edit')) {
                        message = 'Modification en cours...';
                        subtext = 'Mise à jour des informations';
                    } else if (form.action.includes('destroy') || form.action.includes('delete')) {
                        message = 'Suppression en cours...';
                        subtext = 'Veuillez patienter';
                    } else if (form.action.includes('login')) {
                        message = 'Connexion en cours...';
                        subtext = 'Vérification de vos identifiants';
                    } else if (form.action.includes('password')) {
                        message = 'Traitement en cours...';
                        subtext = 'Opération sur le mot de passe';
                    }
                    
                    showLoading(message, subtext);
                }
            }
        });
    });
    
    // Intercepter les liens avec data-loading
    const loadingLinks = document.querySelectorAll('a[data-loading="true"]');
    loadingLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const message = link.getAttribute('data-loading-message') || 'Chargement...';
            const subtext = link.getAttribute('data-loading-subtext') || 'Veuillez patienter';
            showLoading(message, subtext);
        });
    });
    
    // Intercepter les liens de navigation principaux
    const navLinks = document.querySelectorAll('a[href*="/index"], a[href*="/create"], a[href*="/show"]');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Ignorer les liens externes, les ancres et les boutons de modal
            if (link.hostname === window.location.hostname && 
                !link.href.includes('#') && 
                !link.hasAttribute('data-no-loading') &&
                !link.onclick) {
                
                let message = 'Chargement...';
                let subtext = 'Veuillez patienter';
                
                if (link.href.includes('/create')) {
                    message = 'Ouverture du formulaire...';
                    subtext = 'Préparation de l\'interface';
                } else if (link.href.includes('/show')) {
                    message = 'Chargement des détails...';
                    subtext = 'Récupération des informations';
                }
                
                showLoading(message, subtext);
            }
        });
    });
});
</script>
