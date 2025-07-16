// Miscellaneous Section Dynamic Language Entry Logic
window.initializeMiscellaneous = function() {
    const container = document.getElementById('languages-container');
    const addBtn = document.getElementById('add-language');

    if (!container || !addBtn) return;

    // Helper to get the next available index
    function getNextIndex() {
        const entries = container.querySelectorAll('.language-entry');
        let max = -1;
        entries.forEach(entry => {
            const idx = parseInt(entry.getAttribute('data-index'));
            if (!isNaN(idx) && idx > max) max = idx;
        });
        return max + 1;
    }

    // Template for a new language entry
    function createLanguageEntry(index) {
        return `
        <div class="language-entry p-4 border border-gray-200 rounded-lg mt-4 relative" data-index="${index}">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Language/Dialect</label>
                    <input type="text" name="languages[${index}][language]" placeholder="e.g., English, Tagalog, Spanish" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Speak</label>
                    <select name="languages[${index}][speak]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        <option value="">Select</option>
                        <option value="FLUENT">FLUENT</option>
                        <option value="FAIR">FAIR</option>
                        <option value="POOR">POOR</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Read</label>
                    <select name="languages[${index}][read]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        <option value="">Select</option>
                        <option value="FLUENT">FLUENT</option>
                        <option value="FAIR">FAIR</option>
                        <option value="POOR">POOR</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Write</label>
                    <select name="languages[${index}][write]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        <option value="">Select</option>
                        <option value="FLUENT">FLUENT</option>
                        <option value="FAIR">FAIR</option>
                        <option value="POOR">POOR</option>
                    </select>
                </div>
            </div>
            <button type="button" class="remove-language absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors">
                <i class="fas fa-times-circle"></i>
            </button>
        </div>
        `;
    }

    // Add new language entry
    addBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const nextIndex = getNextIndex();
        container.insertAdjacentHTML('beforeend', createLanguageEntry(nextIndex));
    });

    // Remove language entry (event delegation)
    container.addEventListener('click', function(e) {
        const btn = e.target.closest('.remove-language');
        if (btn) {
            const entry = btn.closest('.language-entry');
            if (entry) entry.remove();
        }
    });
}; 