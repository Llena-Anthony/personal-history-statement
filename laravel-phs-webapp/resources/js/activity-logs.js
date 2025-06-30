// Activity Logs Enhancement Script
document.addEventListener('DOMContentLoaded', function() {
    // Initialize activity logs functionality
    initActivityLogs();
});

function initActivityLogs() {
    // Add loading states to buttons
    addLoadingStates();
    
    // Initialize tooltips
    initTooltips();
    
    // Add smooth scrolling for pagination
    addSmoothScrolling();
    
    // Initialize real-time updates (if needed)
    initRealTimeUpdates();
    
    // Add keyboard shortcuts
    addKeyboardShortcuts();
}

function addLoadingStates() {
    // Add loading state to search button
    const searchForm = document.querySelector('form[action*="activity-logs"]');
    if (searchForm) {
        searchForm.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Searching...';
                submitBtn.disabled = true;
            }
        });
    }
    
    // Add loading state to clear logs button
    const clearLogsForm = document.querySelector('form[action*="clear-old"]');
    if (clearLogsForm) {
        clearLogsForm.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Clearing...';
                submitBtn.disabled = true;
            }
        });
    }
}

function initTooltips() {
    // Initialize tooltips for truncated text
    const truncatedElements = document.querySelectorAll('[title]');
    truncatedElements.forEach(element => {
        if (element.scrollWidth > element.clientWidth) {
            element.classList.add('cursor-help');
        }
    });
}

function addSmoothScrolling() {
    // Smooth scroll to top when pagination is clicked
    const paginationLinks = document.querySelectorAll('.pagination a');
    paginationLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Don't prevent default, just add smooth scroll
            setTimeout(() => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }, 100);
        });
    });
}

function initRealTimeUpdates() {
    // This can be implemented for real-time activity log updates
    // For now, we'll just add a refresh button functionality
    const refreshBtn = document.querySelector('[onclick="refreshLogs()"]');
    if (refreshBtn) {
        refreshBtn.addEventListener('click', function(e) {
            e.preventDefault();
            refreshLogs();
        });
    }
}

function addKeyboardShortcuts() {
    // Add keyboard shortcuts for common actions
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + F to focus search
        if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
            e.preventDefault();
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput) {
                searchInput.focus();
                searchInput.select();
            }
        }
        
        // Ctrl/Cmd + R to refresh
        if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
            e.preventDefault();
            refreshLogs();
        }
        
        // Escape to close modals
        if (e.key === 'Escape') {
            closeAllModals();
        }
    });
}

function refreshLogs() {
    const refreshBtn = document.querySelector('[onclick="refreshLogs()"]');
    if (refreshBtn) {
        refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Refreshing...';
        refreshBtn.disabled = true;
    }
    
    // Reload the page
    window.location.reload();
}

function closeAllModals() {
    const modals = document.querySelectorAll('[id$="Modal"]');
    modals.forEach(modal => {
        if (!modal.classList.contains('hidden')) {
            modal.classList.add('hidden');
        }
    });
}

// Enhanced export functionality with preview
function exportLogs() {
    const exportBtn = document.querySelector('[onclick="exportLogs()"]');
    if (exportBtn) {
        exportBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Loading Preview...';
        exportBtn.disabled = true;
    }
    
    // Get current filters and search parameters
    const currentUrl = new URL(window.location.href);
    const previewUrl = new URL('/admin/activity-logs/export', window.location.origin);
    previewUrl.searchParams.set('preview', '1');
    
    // Copy all query parameters except pagination
    currentUrl.searchParams.forEach((value, key) => {
        if (key !== 'page' && key !== 'per_page') {
            previewUrl.searchParams.set(key, value);
        }
    });
    
    // Fetch preview data
    fetch(previewUrl.toString(), {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        showExportPreview(data);
        if (exportBtn) {
            exportBtn.innerHTML = '<i class="fas fa-download mr-2"></i>Export';
            exportBtn.disabled = false;
        }
    })
    .catch(error => {
        console.error('Error loading preview:', error);
        if (exportBtn) {
            exportBtn.innerHTML = '<i class="fas fa-download mr-2"></i>Export';
            exportBtn.disabled = false;
        }
        alert('Error loading preview. Please try again.');
    });
}

// Show export preview modal
function showExportPreview(data) {
    // Create modal HTML
    const modalHTML = `
        <div id="exportPreviewModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full z-50">
            <div class="relative top-10 mx-auto p-5 border w-11/12 max-w-6xl shadow-2xl rounded-2xl bg-white">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Export Preview</h3>
                    <button onclick="closeExportPreview()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                
                <div class="mb-6">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle text-blue-600 mr-3"></i>
                            <div>
                                <h4 class="font-semibold text-blue-900">Export Summary</h4>
                                <p class="text-blue-700 text-sm mt-1">
                                    ${data.total_records} records will be exported with the current filters applied.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h4 class="font-semibold text-gray-900 mb-3">Preview (First 10 records)</h4>
                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-200 rounded-lg">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">User</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Action</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Description</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                ${data.preview_data.map(record => `
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 text-sm">
                                            <div>
                                                <div class="font-medium text-gray-900">${record.user_name || 'N/A'}</div>
                                                <div class="text-gray-500">${record.username || 'N/A'}</div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                ${record.action}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-900 max-w-xs truncate" title="${record.description}">
                                            ${record.description}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                                ${record.status === 'success' ? 'bg-green-100 text-green-800' : 
                                                  record.status === 'warning' ? 'bg-yellow-100 text-yellow-800' : 
                                                  'bg-red-100 text-red-800'}">
                                                ${record.status}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-900">
                                            ${record.created_at}
                                        </td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="flex justify-end gap-3">
                    <button onclick="closeExportPreview()" 
                            class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                        Cancel
                    </button>
                    <button onclick="confirmExport()" 
                            class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-download mr-2"></i>Confirm Export
                    </button>
                </div>
            </div>
        </div>
    `;
    
    // Add modal to body
    document.body.insertAdjacentHTML('beforeend', modalHTML);
    
    // Store export data for confirmation
    window.exportData = data;
}

// Close export preview modal
function closeExportPreview() {
    const modal = document.getElementById('exportPreviewModal');
    if (modal) {
        modal.remove();
    }
    delete window.exportData;
}

// Confirm and execute export
function confirmExport() {
    const exportBtn = document.querySelector('[onclick="exportLogs()"]');
    if (exportBtn) {
        exportBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Exporting...';
        exportBtn.disabled = true;
    }
    
    // Get current filters and search parameters
    const currentUrl = new URL(window.location.href);
    const exportUrl = new URL('/admin/activity-logs/export', window.location.origin);
    
    // Copy all query parameters except pagination
    currentUrl.searchParams.forEach((value, key) => {
        if (key !== 'page' && key !== 'per_page') {
            exportUrl.searchParams.set(key, value);
        }
    });
    
    // Create a temporary form to submit the export request
    const form = document.createElement('form');
    form.method = 'GET';
    form.action = exportUrl.toString();
    form.target = '_blank';
    
    // Add all the current search parameters to the form
    currentUrl.searchParams.forEach((value, key) => {
        if (key !== 'page' && key !== 'per_page') {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = value;
            form.appendChild(input);
        }
    });
    
    // Append form to body, submit it, and remove it
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
    
    // Close modal
    closeExportPreview();
    
    // Reset button after a delay
    setTimeout(() => {
        if (exportBtn) {
            exportBtn.innerHTML = '<i class="fas fa-download mr-2"></i>Export';
            exportBtn.disabled = false;
        }
    }, 2000);
}

// Make exportLogs function globally available for inline onclick handlers
window.exportLogs = exportLogs;
window.closeExportPreview = closeExportPreview;
window.confirmExport = confirmExport;

// Enhanced modal functionality
function openClearLogsModal() {
    const modal = document.getElementById('clearLogsModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('animate-fade-in-scale');
        
        // Focus trap for accessibility
        const firstFocusable = modal.querySelector('button, input, select, textarea, a[href]');
        if (firstFocusable) {
            firstFocusable.focus();
        }
    }
}

function closeClearLogsModal() {
    const modal = document.getElementById('clearLogsModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('animate-fade-in-scale');
    }
}

// Add click outside to close modal
document.addEventListener('click', function(e) {
    const modals = document.querySelectorAll('[id$="Modal"]');
    modals.forEach(modal => {
        if (e.target === modal) {
            closeClearLogsModal();
        }
    });
});

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initActivityLogs();
}); 