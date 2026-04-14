<!-- Modal pour les formulaires -->
<div id="formModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4">
        <!-- Fond semi-transparent -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
        
        <!-- Modal -->
        <div class="relative bg-white rounded-xl shadow-xl max-w-4xl w-full max-h-[90vh] overflow-hidden transform transition-all">
            <!-- En-tête -->
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-gray-50">
                <h3 id="modalTitle" class="text-lg font-semibold text-gray-900">Titre de la modal</h3>
                <button type="button" onclick="closeFormModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fa-solid fa-times text-xl"></i>
                </button>
            </div>
            
            <!-- Contenu du formulaire -->
            <div class="p-6 overflow-y-auto max-h-[calc(90vh-8rem)]">
                <div id="modalContent">
                    <!-- Le contenu sera injecté ici via JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let currentForm = null;

function showFormModal(title, content) {
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalContent').innerHTML = content;
    document.getElementById('formModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeFormModal() {
    document.getElementById('formModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    currentForm = null;
}

// Fermer la modal avec la touche Escape
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' && !document.getElementById('formModal').classList.contains('hidden')) {
        closeFormModal();
    }
});

// Fermer la modal en cliquant sur le fond
document.getElementById('formModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeFormModal();
    }
});

// Soumettre le formulaire
function submitFormModal(form) {
    form.submit();
}
</script>
