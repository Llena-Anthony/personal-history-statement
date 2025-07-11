@php
    // Standardized section configuration
    $sectionTitle = $sectionTitle ?? 'Section Title';
    $sectionDescription = $sectionDescription ?? 'Please provide the required information';
    $sectionIcon = $sectionIcon ?? 'fas fa-file-alt';

    // Determine previous section based on current section
    $sectionOrder = [
        'personal-details',
        'personal-characteristics',
        'marital-status',
        'family-background',
        'educational-background',
        'military-history',
        'places-of-residence',
        'employment-history',
        'foreign-countries',
        'credit-reputation',
        'arrest-record',
        'character-and-reputation',
        'organization',
        'miscellaneous'
    ];

    $currentIndex = array_search($sectionName, $sectionOrder);
    $previousSection = $currentIndex > 0 ? $sectionOrder[$currentIndex - 1] : null;
    $formAction = route('phs.' . $sectionName . '.store');
    $nextSectionRoute = route('phs.' . $nextSection . '.create');
    $dashboardRoute = route('dashboard');
    $previousSectionRoute = $previousSection ? route('phs.' . $previousSection . '.create') : $dashboardRoute;
@endphp

@extends($layout)

@section('title', $sectionTitle)

@section('content')
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
            <a href="{{ $previousSectionRoute }}"
               class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                {{ $previousSection ? 'Back to Previous Section' : 'Back to Dashboard' }}
            </a>

            <div class="flex space-x-4">
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
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(form);
            const action = formData.get('action') || 'next';

            // Show loading state
            const submitButtons = form.querySelectorAll('button[type="submit"]');
            submitButtons.forEach(btn => {
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
            });

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (action === 'next' && data.next_route) {
                        // Navigate to next section
                        window.location.href = data.next_route;
                    } else {
                        // Show success message
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
                showNotification('An error occurred. Please try again.', 'error');
            })
            .finally(() => {
                // Reset button states
                submitButtons.forEach(btn => {
                    btn.disabled = false;
                    btn.innerHTML = 'Save & Continue<i class="fas fa-arrow-right ml-2"></i>';
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

// Philippines Address API Integration for Personal Details
async function loadRegions() {
    try {
        const response = await fetch('https://psgc.gitlab.io/api/regions/');
        const regions = await response.json();

        const birthRegionSelect = document.getElementById('birth_region');
        const homeRegionSelect = document.getElementById('home_region');
        const businessRegionSelect = document.getElementById('business_region');

        if (birthRegionSelect) {
            birthRegionSelect.innerHTML = '<option value="">Select Region</option>';
            regions.forEach(region => {
                const option = new Option(region.name, region.code);
                birthRegionSelect.add(option);
            });
        }

        if (homeRegionSelect) {
            homeRegionSelect.innerHTML = '<option value="">Select Region</option>';
            regions.forEach(region => {
                const option = new Option(region.name, region.code);
                homeRegionSelect.add(option);
            });
        }

        if (businessRegionSelect) {
            businessRegionSelect.innerHTML = '<option value="">Select Region</option>';
            regions.forEach(region => {
                const option = new Option(region.name, region.code);
                businessRegionSelect.add(option);
            });
        }
    } catch (error) {
        console.error('Error loading regions:', error);
        // Fallback: Add common regions manually
        const commonRegions = [
            'National Capital Region (NCR)',
            'Cordillera Administrative Region (CAR)',
            'Ilocos Region (Region I)',
            'Cagayan Valley (Region II)',
            'Central Luzon (Region III)',
            'CALABARZON (Region IV-A)',
            'MIMAROPA (Region IV-B)',
            'Bicol Region (Region V)',
            'Western Visayas (Region VI)',
            'Central Visayas (Region VII)',
            'Eastern Visayas (Region VIII)',
            'Zamboanga Peninsula (Region IX)',
            'Northern Mindanao (Region X)',
            'Davao Region (Region XI)',
            'SOCCSKSARGEN (Region XII)',
            'Caraga (Region XIII)',
            'Bangsamoro Autonomous Region in Muslim Mindanao (BARMM)'
        ];

        const birthRegionSelect = document.getElementById('birth_region');
        const homeRegionSelect = document.getElementById('home_region');
        const businessRegionSelect = document.getElementById('business_region');

        if (birthRegionSelect) {
            birthRegionSelect.innerHTML = '<option value="">Select Region</option>';
            commonRegions.forEach(region => {
                const option = new Option(region, region);
                birthRegionSelect.add(option);
            });
        }

        if (homeRegionSelect) {
            homeRegionSelect.innerHTML = '<option value="">Select Region</option>';
            commonRegions.forEach(region => {
                const option = new Option(region, region);
                homeRegionSelect.add(option);
            });
        }

        if (businessRegionSelect) {
            businessRegionSelect.innerHTML = '<option value="">Select Region</option>';
            commonRegions.forEach(region => {
                const option = new Option(region, region);
                businessRegionSelect.add(option);
            });
        }
    }
}

async function loadProvinces(type) {
    const regionSelect = document.getElementById(`${type}_region`);
    const provinceSelect = document.getElementById(`${type}_province`);
    const citySelect = document.getElementById(`${type}_city`);
    const barangaySelect = document.getElementById(`${type}_barangay`);

    if (!regionSelect || !provinceSelect || !citySelect || !barangaySelect) return;

    // Reset dependent dropdowns
    provinceSelect.innerHTML = '<option value="">Select Province</option>';
    citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

    if (!regionSelect.value) return;

    try {
        const response = await fetch(`https://psgc.gitlab.io/api/regions/${regionSelect.value}/provinces/`);
        const provinces = await response.json();

        provinces.forEach(province => {
            const option = new Option(province.name, province.code);
            provinceSelect.add(option);
        });
    } catch (error) {
        console.error('Error loading provinces:', error);
        // Fallback: Add common provinces for selected region
        const commonProvinces = getCommonProvinces(regionSelect.value);
        commonProvinces.forEach(province => {
            const option = new Option(province, province);
            provinceSelect.add(option);
        });
    }
}

async function loadCities(type) {
    const provinceSelect = document.getElementById(`${type}_province`);
    const citySelect = document.getElementById(`${type}_city`);
    const barangaySelect = document.getElementById(`${type}_barangay`);

    if (!provinceSelect || !citySelect || !barangaySelect) return;

    // Reset dependent dropdowns
    citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

    if (!provinceSelect.value) return;

    try {
        const response = await fetch(`https://psgc.gitlab.io/api/provinces/${provinceSelect.value}/cities-municipalities/`);
        const cities = await response.json();

        cities.forEach(city => {
            const option = new Option(city.name, city.code);
            citySelect.add(option);
        });
    } catch (error) {
        console.error('Error loading cities:', error);
        // Fallback: Add common cities
        const commonCities = ['City/Municipality 1', 'City/Municipality 2', 'City/Municipality 3'];
        commonCities.forEach(city => {
            const option = new Option(city, city);
            citySelect.add(option);
        });
    }
}

async function loadBarangays(type) {
    const citySelect = document.getElementById(`${type}_city`);
    const barangaySelect = document.getElementById(`${type}_barangay`);

    if (!citySelect || !barangaySelect) return;

    // Reset barangay dropdown
    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

    if (!citySelect.value) return;

    try {
        const response = await fetch(`https://psgc.gitlab.io/api/cities-municipalities/${citySelect.value}/barangays/`);
        const barangays = await response.json();

        barangays.forEach(barangay => {
            const option = new Option(barangay.name, barangay.code);
            barangaySelect.add(option);
        });
    } catch (error) {
        console.error('Error loading barangays:', error);
        // Fallback: Add common barangays
        const commonBarangays = ['Barangay 1', 'Barangay 2', 'Barangay 3', 'Barangay 4', 'Barangay 5'];
        commonBarangays.forEach(barangay => {
            const option = new Option(barangay, barangay);
            barangaySelect.add(option);
        });
    }
}

// Helper function for common provinces (fallback)
function getCommonProvinces(region) {
    const provinceMap = {
        'National Capital Region (NCR)': ['Metro Manila'],
        'Cordillera Administrative Region (CAR)': ['Abra', 'Apayao', 'Benguet', 'Ifugao', 'Kalinga', 'Mountain Province'],
        'Ilocos Region (Region I)': ['Ilocos Norte', 'Ilocos Sur', 'La Union', 'Pangasinan'],
        'Cagayan Valley (Region II)': ['Batanes', 'Cagayan', 'Isabela', 'Nueva Vizcaya', 'Quirino'],
        'Central Luzon (Region III)': ['Aurora', 'Bataan', 'Bulacan', 'Nueva Ecija', 'Pampanga', 'Tarlac', 'Zambales'],
        'CALABARZON (Region IV-A)': ['Batangas', 'Cavite', 'Laguna', 'Quezon', 'Rizal'],
        'MIMAROPA (Region IV-B)': ['Marinduque', 'Occidental Mindoro', 'Oriental Mindoro', 'Palawan', 'Romblon'],
        'Bicol Region (Region V)': ['Albay', 'Camarines Norte', 'Camarines Sur', 'Catanduanes', 'Masbate', 'Sorsogon'],
        'Western Visayas (Region VI)': ['Aklan', 'Antique', 'Capiz', 'Guimaras', 'Iloilo', 'Negros Occidental'],
        'Central Visayas (Region VII)': ['Bohol', 'Cebu', 'Negros Oriental', 'Siquijor'],
        'Eastern Visayas (Region VIII)': ['Biliran', 'Eastern Samar', 'Leyte', 'Northern Samar', 'Samar', 'Southern Leyte'],
        'Zamboanga Peninsula (Region IX)': ['Zamboanga del Norte', 'Zamboanga del Sur', 'Zamboanga Sibugay'],
        'Northern Mindanao (Region X)': ['Bukidnon', 'Camiguin', 'Lanao del Norte', 'Misamis Occidental', 'Misamis Oriental'],
        'Davao Region (Region XI)': ['Compostela Valley', 'Davao del Norte', 'Davao del Sur', 'Davao Occidental', 'Davao Oriental'],
        'SOCCSKSARGEN (Region XII)': ['Cotabato', 'Sarangani', 'South Cotabato', 'Sultan Kudarat'],
        'Caraga (Region XIII)': ['Agusan del Norte', 'Agusan del Sur', 'Dinagat Islands', 'Surigao del Norte', 'Surigao del Sur'],
        'Bangsamoro Autonomous Region in Muslim Mindanao (BARMM)': ['Basilan', 'Lanao del Sur', 'Maguindanao', 'Sulu', 'Tawi-Tawi']
    };

    return provinceMap[region] || ['Province 1', 'Province 2', 'Province 3'];
}

// Initialize place loading for personal details section
if (document.getElementById('birth_region')) {
    loadRegions();
}

// Initialize personal details section
window.initializePersonalDetails = function() {
    console.log('Personal Details section initialized');
    loadRegions();
};

// Auto-initialize if this is the personal details section
if (document.getElementById('birth_region')) {
    window.initializePersonalDetails();
}
</script>
@endsection
