<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal History Statement - PMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        .input {
            @apply border border-gray-300 rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            overflow-y: auto;
        }

        .modal-content {
            position: relative;
            background-color: #fff;
            margin: 50px auto;
            padding: 20px;
            width: 90%;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            display: none;
        }
    </style>
</head>
<body>
    <!-- PHS Instructions Modal -->
    <div id="phsModal" class="modal">
        <div class="modal-content">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-[#1B365D]">PERSONAL HISTORY STATEMENT (PHS)</h2>
                <p class="text-gray-600 mt-2">Please read the instructions carefully before proceeding</p>
            </div>

            <div class="text-left mb-6">
                <h3 class="font-semibold text-lg text-[#1B365D] mb-3">Instructions</h3>
                <ol class="list-decimal list-inside space-y-2 text-gray-700">
                    <li>Answer all questions completely; if question is not applicable, write "NA", write "Unknown" only if you do not know the answer and cannot obtain the answer from your personal records.</li>
                    <li>Write carefully. Illegible or incomplete forms will not receive consideration.</li>
                </ol>
            </div>

            <div class="text-left mb-8">
                <h3 class="font-semibold text-lg text-[#1B365D] mb-3">Warning</h3>
                <ol class="list-decimal list-inside space-y-2 text-gray-700">
                    <li>The correctness of all statement of entries made herein will be investigated.</li>
                    <li>Any deliberate omission or distortion of material facts may give sufficient cause for denial of clearance.</li>
                    <li class="font-bold text-red-600">CONFIDENTIAL.</li>
                </ol>
            </div>

            <div class="text-center">
                <button onclick="acceptInstructions()" class="btn-primary inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
                    <i class="fas fa-check-circle mr-2"></i>
                    I Understand and Agree to Proceed
                </button>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="flex h-screen bg-gray-100">
        <!-- Left Sidebar - Fixed -->
        <aside class="w-64 bg-gray-50 border-r border-gray-200 flex-shrink-0">
            <div class="p-6">
                <!-- Profile Box -->
                <div class="flex flex-col items-center mb-8">
                    <div class="h-20 w-20 bg-gray-300 rounded-full mb-2"></div>
                    <div class="text-center">
                        <div class="text-sm font-semibold">Gregorio</div>
                        <div class="text-sm font-semibold">Del Pilar</div>
                        <div class="mt-1 text-xs px-2 py-0.5 bg-gray-200 text-gray-600 rounded">Civilian</div>
                    </div>
                    <div class="mt-2 flex space-x-1">
                        <div class="h-2 w-2 rounded-full bg-black"></div>
                        <div class="h-2 w-2 rounded-full bg-gray-400"></div>
                    </div>
                </div>
                
                <!-- Navigation Links -->
                <nav class="space-y-4 text-sm font-medium">
                    <div class="flex items-center space-x-2">
                        <div class="h-5 w-5 rounded-full bg-orange-500 flex items-center justify-center text-white text-xs font-bold">I</div>
                        <span class="text-gray-700">Personal Information</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="h-5 w-5 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs font-bold">II</div>
                        <span class="text-gray-500">Family Background</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="h-5 w-5 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs font-bold">III</div>
                        <span class="text-gray-500">Educational Background</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="h-5 w-5 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs font-bold">IV</div>
                        <span class="text-gray-500">Civil Service Eligibility</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="h-5 w-5 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs font-bold">V</div>
                        <span class="text-gray-500">Work Experience</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="h-5 w-5 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs font-bold">VI</div>
                        <span class="text-gray-500">Voluntary Work</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="h-5 w-5 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs font-bold">VII</div>
                        <span class="text-gray-500">Learning and Development</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="h-5 w-5 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs font-bold">VIII</div>
                        <span class="text-gray-500">Other Information</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="h-5 w-5 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs font-bold">IX</div>
                        <span class="text-gray-500">References</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="h-5 w-5 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs font-bold">X</div>
                        <span class="text-gray-500">Declaration</span>
                    </div>
                </nav>
            </div>
        </aside>

        <!-- Main Form Area - Scrollable -->
        <main class="flex-1 overflow-y-auto bg-white">
            <div class="p-8">
                <h1 class="text-2xl font-bold mb-6">I: Personal Information</h1>
                
                <form method="POST" action="{{ route('phs.store') }}" class="space-y-10">
                    @csrf
                    <!-- Section 1 - Basic Information -->
                    <div class="space-y-6 bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-700">Basic Information</h2>
                        <div class="grid grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">First Name *</label>
                                <input type="text" name="first_name" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name *</label>
                                <input type="text" name="middle_name" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Last Name *</label>
                                <input type="text" name="last_name" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Suffix</label>
                                <input type="text" name="suffix" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="e.g., Sr., IV" />
                            </div>
                        </div>

                        <div class="grid grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth *</label>
                                <input type="date" name="date_of_birth" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                            </div>
                            <div class="col-span-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Place of Birth *</label>
                                <input type="text" name="place_of_birth" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                            </div>
                        </div>

                        <div class="grid grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Gender *</label>
                                <select name="gender" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Civil Status *</label>
                                <select name="civil_status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="">Select Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separated">Separated</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Height (m)</label>
                                <input type="text" name="height" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="e.g., 1.75" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Weight (kg)</label>
                                <input type="text" name="weight" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="e.g., 70" />
                            </div>
                        </div>

                        <div class="grid grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Blood Type</label>
                                <input type="text" name="blood_type" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="e.g., O+" />
                            </div>
                        </div>
                    </div>

                    <!-- Section 2 - Government IDs -->
                    <div class="space-y-6 bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-700">Government IDs</h2>
                        <div class="grid grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">GSIS ID NO.</label>
                                <input type="text" name="gsis_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">PHILHEALTH NO.</label>
                                <input type="text" name="philhealth_no" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">TIN NO.</label>
                                <input type="text" name="tin_no" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">PAG-IBIG ID NO.</label>
                                <input type="text" name="pagibig_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">SSS NO.</label>
                                <input type="text" name="sss_no" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">AGENCY EMPLOYEE NO.</label>
                                <input type="text" name="agency_employee_no" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                        </div>
                    </div>

                    <!-- Section 3 - Citizenship -->
                    <div class="space-y-6 bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-700">Citizenship</h2>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Citizenship *</label>
                                <select name="citizenship" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="">Please Select</option>
                                    <option value="Filipino">Filipino</option>
                                    <option value="Dual Citizenship">Dual Citizenship</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">If holder of Dual Citizenship please indicate the details</label>
                                <div class="space-y-2">
                                    <label class="flex items-center gap-2">
                                        <input type="checkbox" name="dual_citizenship_by_birth" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" />
                                        by birth
                                    </label>
                                    <label class="flex items-center gap-2">
                                        <input type="checkbox" name="dual_citizenship_by_naturalization" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" />
                                        by naturalization
                                    </label>
                                    <select name="dual_citizenship_country" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pls. Indicate Country</option>
                                        <option value="USA">United States of America</option>
                                        <option value="UK">United Kingdom</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Australia">Australia</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4 - Residential Address -->
                    <div class="space-y-6 bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-700">Residential Address</h2>
                        <div class="grid grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">House/Block/Lot No.</label>
                                <input type="text" name="residential_house_no" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Street</label>
                                <input type="text" name="residential_street" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Subdivision/Village</label>
                                <input type="text" name="residential_subdivision" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Barangay</label>
                                <input type="text" name="residential_barangay" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">City Municipality</label>
                                <input type="text" name="residential_city" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                                <input type="text" name="residential_province" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Zip Code</label>
                                <input type="text" name="residential_zip" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                        </div>
                    </div>

                    <!-- Section 5 - Permanent Address -->
                    <div class="space-y-6 bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-700">Permanent Address</h2>
                        <div class="grid grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">House/Block/Lot No.</label>
                                <input type="text" name="permanent_house_no" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Street</label>
                                <input type="text" name="permanent_street" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Subdivision/Village</label>
                                <input type="text" name="permanent_subdivision" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Barangay</label>
                                <input type="text" name="permanent_barangay" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">City Municipality</label>
                                <input type="text" name="permanent_city" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                                <input type="text" name="permanent_province" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Zip Code</label>
                                <input type="text" name="permanent_zip" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                        </div>
                    </div>

                    <!-- Section 6 - Contact Information -->
                    <div class="space-y-6 bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-700">Contact Information</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Telephone No.</label>
                                <input type="text" name="telephone" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Mobile No.</label>
                                <input type="text" name="mobile" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">E-mail Address *</label>
                                <input type="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                            </div>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="text-right">
                        <button type="submit" class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800 transition">Next Section</button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        // Show modal when page loads
        window.onload = function() {
            document.getElementById('phsModal').style.display = 'block';
        }

        // Function to handle accepting instructions
        function acceptInstructions() {
            document.getElementById('phsModal').style.display = 'none';
            document.getElementById('formContainer').style.display = 'block';
        }
    </script>
</body>
</html> 