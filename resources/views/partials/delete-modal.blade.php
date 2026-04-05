<!-- Modal de confirmation de suppression -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4">
        <!-- Fond semi-transparent -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
        
        <!-- Modal -->
        <div class="relative bg-white rounded-xl shadow-xl max-w-md w-full p-6 transform transition-all">
            <!-- Icône de confirmation -->
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                <i class="fa-solid fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            
            <!-- Titre et message -->
            <div class="text-center">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Confirmer la suppression</h3>
                <p class="text-sm text-gray-600 mb-6" id="deleteMessage">
                    Êtes-vous sûr de vouloir supprimer cet élément ? Cette action est irréversible.
                </p>
            </div>
            
            <!-- Boutons d'action -->
            <div class="flex gap-3">
                <button type="button" 
                        onclick="closeDeleteModal()"
                        class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                    Annuler
                </button>
                <button type="button" 
                        id="confirmDeleteBtn"
                        class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                    Supprimer
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let deleteForm = null;

function showDeleteModal(message, form) {
    deleteForm = form;
    document.getElementById('deleteMessage').textContent = message;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    deleteForm = null;
}

// Confirmer la suppression
document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    if (deleteForm) {
        deleteForm.submit();
    }
});

// Fermer la modal avec la touche Escape
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeDeleteModal();
    }
});

// Fermer la modal en cliquant sur le fond
document.getElementById('deleteModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeDeleteModal();
    }
});
</script>
