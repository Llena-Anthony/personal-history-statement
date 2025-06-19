@props([
    'id' => 'confirmationModal',
    'title' => 'Confirm Action',
    'message' => 'Are you sure you want to proceed?',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'confirmClass' => 'bg-red-600 hover:bg-red-700',
    'cancelClass' => 'bg-gray-300 hover:bg-gray-400 text-gray-700'
])

<!-- Confirmation Modal -->
<div id="{{ $id }}" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            {{ $title }}
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500" id="{{ $id }}-message">
                                {{ $message }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="{{ $id }}-confirm" 
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium text-white {{ $confirmClass }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    {{ $confirmText }}
                </button>
                <button type="button" id="{{ $id }}-cancel"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 text-base font-medium {{ $cancelClass }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    {{ $cancelText }}
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('{{ $id }}');
    const confirmBtn = document.getElementById('{{ $id }}-confirm');
    const cancelBtn = document.getElementById('{{ $id }}-cancel');
    
    if (modal && confirmBtn && cancelBtn) {
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
        window['{{ $id }}_confirmCallback'] = null;
        
        // Confirm button event
        confirmBtn.addEventListener('click', function() {
            if (window['{{ $id }}_confirmCallback']) {
                window['{{ $id }}_confirmCallback']();
            }
            closeModal();
        });
    }
});

// Function to show confirmation modal
function showConfirmationModal(modalId, message, onConfirm) {
    const modal = document.getElementById(modalId);
    const messageElement = modal.querySelector('.text-sm.text-gray-500');
    
    if (messageElement) {
        messageElement.textContent = message;
    }
    
    window[modalId + '_confirmCallback'] = onConfirm;
    modal.classList.remove('hidden');
}
</script> 