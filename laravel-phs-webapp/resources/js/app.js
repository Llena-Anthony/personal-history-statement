import './bootstrap';
import '../css/app.css';
import './confirmation-modal.js';
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
        // Show the remove button for dynamic siblings
        const removeBtn = siblingEntry.querySelector('.remove-sibling');
        if (removeBtn) {
            removeBtn.classList.remove('hidden');
            removeBtn.addEventListener('click', function() {
                siblingEntry.remove();
            });
        }
        container.appendChild(siblingEntry);
    };

    // Attach remove event to existing dynamic siblings (if any)
    document.querySelectorAll('.remove-sibling').forEach(btn => {
        btn.addEventListener('click', function() {
            const entry = btn.closest('.sibling-entry');
            if (entry) entry.remove();
        });
    });
});
