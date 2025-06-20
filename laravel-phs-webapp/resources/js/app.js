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
});
