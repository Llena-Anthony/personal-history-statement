import './bootstrap';
import '../css/app.css';
import './confirmation-modal.js';
import './activity-logs.js';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
dayjs.extend(relativeTime);

// Add any custom JavaScript here
document.addEventListener('DOMContentLoaded', () => {
    // Initialize any JavaScript components here
    console.log('PHS Online System initialized');

    // Time ago logic for activity logs
    function updateTimeAgo() {
        document.querySelectorAll('.time-ago').forEach(el => {
            const timestamp = el.getAttribute('data-timestamp');
            if (timestamp) {
                el.textContent = dayjs(timestamp).fromNow();
            }
        });
    }
    updateTimeAgo();
    setInterval(updateTimeAgo, 60000); // Update every minute

    // Sibling dynamic add/remove logic
    function updateSiblingRemoveButtons() {
        const entries = document.querySelectorAll('#siblings-container .sibling-entry');
        const removeBtns = document.querySelectorAll('#siblings-container .remove-sibling');
        if (entries.length <= 1) {
            removeBtns.forEach(btn => btn.classList.add('hidden'));
        } else {
            removeBtns.forEach(btn => btn.classList.remove('hidden'));
        }
    }

    window.addSibling = function() {
        const container = document.getElementById('siblings-container');
        const template = document.getElementById('sibling-template');
        if (!container || !template) return;
        // Find the next index
        let index = 1;
        const entries = container.querySelectorAll('.sibling-entry');
        if (entries.length > 0) {
            // Find the highest index in the current entries
            const last = Array.from(entries).pop();
            const lastInputs = last.querySelectorAll('input, select, textarea');
            lastInputs.forEach(input => {
                const match = input.name && input.name.match(/siblings\[(\d+)\]/);
                if (match && parseInt(match[1]) >= index) {
                    index = parseInt(match[1]) + 1;
                }
            });
        }
        // Clone the template
        const clone = document.createElement('div');
        clone.innerHTML = template.innerHTML.replace(/__INDEX__/g, index);
        const siblingEntry = clone.firstElementChild;
        container.appendChild(siblingEntry);
        updateSiblingRemoveButtons();
    };

    // Event delegation for removing siblings
    const siblingsContainer = document.getElementById('siblings-container');
    if (siblingsContainer) {
        siblingsContainer.addEventListener('click', function(e) {
            const btn = e.target.closest('.remove-sibling');
            if (btn) {
                const entry = btn.closest('.sibling-entry');
                if (entry) entry.remove();
                updateSiblingRemoveButtons();
            }
        });
    }

    updateSiblingRemoveButtons();

    // --- Bank Autofill Logic ---
    window.bankList = [
        // Example static data; replace with AJAX call for dynamic data
        { name: 'Bank of Example', address: '123 Example St, City' },
        { name: 'Sample Savings', address: '456 Sample Ave, Town' },
        { name: 'Demo Bank', address: '789 Demo Blvd, Metro' },
    ];

    function handleBankNameInput(e) {
        const input = e.target;
        const value = input.value.trim().toLowerCase();
        const parent = input.closest('.credit-reference-entry');
        if (!parent) return;
        const addressInput = parent.querySelector('input.credit-reference-bank-address');
        if (!addressInput) return;
        const found = window.bankList.find(b => b.name.toLowerCase() === value);
        if (found) {
            addressInput.value = found.address;
        }
    }

    // Attach event listeners on DOMContentLoaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', attachBankAutofillListeners);
    } else {
        attachBankAutofillListeners();
    }
    function attachBankAutofillListeners() {
        document.querySelectorAll('.credit-reference-entry input.credit-reference-bank-name').forEach(input => {
            input.removeEventListener('blur', handleBankNameInput);
            input.addEventListener('blur', handleBankNameInput);
        });
    }
});
