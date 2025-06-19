// Confirmation Modal functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all confirmation modals
    initializeConfirmationModals();
});

function initializeConfirmationModals() {
    // Find all confirmation modals
    const modals = document.querySelectorAll('[id$="Modal"]');
    
    modals.forEach(function(modal) {
        const modalId = modal.id;
        const confirmBtn = document.getElementById(modalId + '-confirm');
        const cancelBtn = document.getElementById(modalId + '-cancel');
        
        if (confirmBtn && cancelBtn) {
            // Close modal function
            function closeModal() {
                modal.classList.add('hidden');
            }
            
            // Cancel button event
            cancelBtn.addEventListener('click', closeModal);
            
            // Close modal when clicking outside
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });
            
            // Close modal on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });
            
            // Store the confirm callback
            window[modalId + '_confirmCallback'] = null;
            
            // Confirm button event
            confirmBtn.addEventListener('click', function() {
                if (window[modalId + '_confirmCallback']) {
                    window[modalId + '_confirmCallback']();
                }
                closeModal();
            });
        }
    });
}

// Global function to show confirmation modal
function showConfirmationModal(modalId, message, onConfirm) {
    const modal = document.getElementById(modalId);
    const messageElement = document.getElementById(modalId + '-message');
    
    if (modal && messageElement) {
        if (message) {
            messageElement.textContent = message;
        }
        
        window[modalId + '_confirmCallback'] = onConfirm;
        modal.classList.remove('hidden');
    } else {
        console.error('Modal not found:', modalId);
    }
} 