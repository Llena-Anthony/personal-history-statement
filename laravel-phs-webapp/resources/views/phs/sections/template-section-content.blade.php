@php
    // Standardized section configuration
    $formAction = route('phs.' . $sectionName . '.store');
    $dashboardRoute = route('client.dashboard');
    $sectionTitle = $sectionTitle ?? 'Section Title';
    $sectionDescription = $sectionDescription ?? 'Please provide the required information';
    $sectionIcon = $sectionIcon ?? 'fas fa-file-alt';
@endphp

<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="{{ $sectionIcon }} text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">{{ $sectionTitle }}</h1>
                <p class="text-gray-600">{{ $sectionDescription }}</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ $formAction }}" class="space-y-8" id="phs-form">
        @csrf

        <!-- Form content will be included here -->
        @yield('form-content')

        <!-- Navigation Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <a href="{{ $dashboardRoute }}"
               class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Dashboard
            </a>

            <div class="flex space-x-4">
                <button type="submit" name="action" value="save"
                        class="btn-secondary">
                    <i class="fas fa-save mr-2"></i>
                    Save Only
                </button>

                <button type="submit" name="action" value="next"
                        class="btn-primary">
                    Save & Continue
                    <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('phs-form');
    console.log("saving.....");
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(form);
            console.log("submitting");
            const action = formData.get('action') || 'next';

            // Show loading state
            const submitButtons = form.querySelectorAll('button[type="submit"]');
            submitButtons.forEach(btn => {
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
            });
            console.log("loading...");

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (action === 'next' && data.next_route) {
                        console.log("redirecting to ", data.next_route);
                        // Navigate to next section
                        window.location.href = data.next_route;
                    } else {
                        // Show success message for save only
                        showNotification('Information saved successfully!', 'success');
                    }
                } else if (data.errors) {
                    // Display validation errors
                    displayErrors(data.errors);
                } else {
                    showNotification('An error occurred. Please try again.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Data not saved. An error occurred. Please try again.', 'error');
            })
            .finally(() => {
                // Reset button states
                submitButtons.forEach(btn => {
                    btn.disabled = false;
                    if (btn.name === 'action' && btn.value === 'save') {
                        btn.innerHTML = '<i class="fas fa-save mr-2"></i>Save Only';
                    } else {
                        btn.innerHTML = 'Save & Continue<i class="fas fa-arrow-right ml-2"></i>';
                    }
                });
            });
        });
    }
});

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 transition-all duration-300 transform translate-x-full`;

    if (type === 'success') {
        notification.className += ' bg-green-500 text-white';
    } else if (type === 'error') {
        notification.className += ' bg-red-500 text-white';
    } else {
        notification.className += ' bg-blue-500 text-white';
    }

    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'exclamation-triangle' : 'info'} mr-2"></i>
            <span>${message}</span>
        </div>
    `;

    document.body.appendChild(notification);

    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);

    // Remove after 3 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

function displayErrors(errors) {
    // Clear previous errors
    document.querySelectorAll('.error-message').forEach(el => el.remove());
    document.querySelectorAll('.border-red-500').forEach(el => {
        el.classList.remove('border-red-500');
        el.classList.add('border-gray-300');
    });

    // Display new errors
    Object.keys(errors).forEach(field => {
        const input = document.querySelector(`[name="${field}"]`);
        if (input) {
            input.classList.remove('border-gray-300');
            input.classList.add('border-red-500');

            const errorDiv = document.createElement('p');
            errorDiv.className = 'error-message text-red-500 text-sm mt-1';
            errorDiv.textContent = errors[field][0];

            input.parentNode.appendChild(errorDiv);
        }
    });

    showNotification('Please correct the errors above.', 'error');
}
</script>

{{-- This template is for the form content only --}}
{{-- Each section will extend this and provide its specific form fields --}}

@section('form-content')
    {{-- Form content will be provided by each section --}}
    @yield('section-form-content')
@endsection
