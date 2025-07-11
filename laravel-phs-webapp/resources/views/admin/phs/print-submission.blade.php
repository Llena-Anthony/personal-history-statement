@extends('layouts.admin')

@section('title', 'PHS Submission - ' . $submission->user->first_name)

@push('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/print-prev.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('public/build/assets/print-prev.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body, .print-container, .print-header, .submission-info, .info-label, .info-value {
            font-family: 'Inter', 'Times New Roman', Times, serif !important;
        }
        body {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%) !important;
        }
        .print-container {
            background: #f9fafb;
            border-radius: 1.25rem;
            box-shadow: 0 8px 32px rgba(44,62,80,0.10), 0 1.5px 6px rgba(44,62,80,0.08);
            padding: 2.5rem 2rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
        .phs-form-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 16px rgba(44,62,80,0.08);
            border: 1px solid #e5e7eb;
            padding: 2rem 1.5rem;
            margin-bottom: 2rem;
        }
        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1B365D;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .section-divider {
            border-top: 2px solid #e5e7eb;
            margin: 2rem 0 1.5rem 0;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.25rem;
        }
        .info-item {
            display: flex;
            flex-direction: column;
            background: #f3f4f6;
            border-radius: 0.5rem;
            padding: 1rem 1.25rem;
            border: 1px solid #e5e7eb;
        }
        .info-label {
            font-size: 0.95rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.25rem;
        }
        .info-value {
            font-size: 1.08rem;
            color: #1B365D;
            font-weight: 600;
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.35rem 1rem;
            border-radius: 9999px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            box-shadow: 0 2px 8px rgba(44,62,80,0.08);
        }
        .status-pending {
            background-color: #FEF3C7;
            color: #92400E;
            border: 1px solid #F59E0B;
        }
        .status-reviewed {
            background-color: #DBEAFE;
            color: #1E40AF;
            border: 1px solid #3B82F6;
        }
        .status-approved {
            background-color: #D1FAE5;
            color: #065F46;
            border: 1px solid #10B981;
        }
        .status-rejected {
            background-color: #FEE2E2;
            color: #991B1B;
            border: 1px solid #EF4444;
        }
        .admin-notes {
            margin-top: 1.5rem;
            padding: 1.25rem;
            background: #fffbe6;
            border: 1px solid #ffe58f;
            border-radius: 0.75rem;
        }
        .admin-notes-title {
            font-size: 1rem;
            font-weight: 700;
            color: #b45309;
            margin-bottom: 0.5rem;
        }
        .admin-notes-content {
            font-size: 0.98rem;
            color: #92400E;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                margin: 0;
                padding: 0;
                background: white !important;
            }
            .print-container {
                margin: 0;
                padding: 0;
                background: white !important;
            }
            .print-header, .submission-info {
                box-shadow: none !important;
                border-radius: 0 !important;
                background: white !important;
            }
            .print-header {
                border-bottom: 3px solid #1B365D !important;
            }
        }
        .print-header {
            background: linear-gradient(90deg, #1B365D 0%, #2B4B7D 100%);
            color: white;
            padding: 1.25rem 1.5rem 1rem 1.5rem;
            margin-bottom: 2rem;
            border-radius: 0.5rem 0.5rem 0 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 4px solid #C9B037;
        }
        .pma-logo {
            height: 64px;
            width: 64px;
            margin-right: 1.5rem;
            background: white;
            border-radius: 50%;
            border: 2px solid #C9B037;
            box-shadow: 0 2px 8px rgba(44,62,80,0.10);
            object-fit: contain;
        }
        .print-header-title {
            flex: 1;
            text-align: left;
        }
        .print-header-details {
            text-align: right;
            color: #C9B037;
        }
        .print-header .confidential {
            font-size: 1.1rem;
            font-weight: bold;
            letter-spacing: 0.2em;
            color: #C9B037;
            margin-top: 0.25rem;
        }
        .print-footer {
            width: 100%;
            text-align: center;
            font-size: 10pt;
            color: #1B365D;
            border-top: 2px solid #C9B037;
            margin-top: 2rem;
            padding-top: 0.5rem;
        }
        .print-actions {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1000;
            display: flex;
            gap: 0.5rem;
        }
        .print-btn {
            background: linear-gradient(135deg, #1B365D 0%, #2B4B7D 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .print-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .back-btn {
            background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            color: white;
        }
    </style>
@endpush

@section('content')
    <!-- Print Actions -->
    <div class="print-actions no-print">
        <a href="{{ route('admin.phs.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to List
        </a>
        <button onclick="window.print()" class="print-btn">
            <i class="fas fa-print mr-2"></i>
            Print PHS
        </button>
    </div>

    <div class="print-container max-w-7xl mx-auto p-6">
        <!-- Print Header -->
        <div class="print-header">
            <img src="{{ asset('images/Philippine_Military_Academy_logo.png') }}" alt="PMA Logo" class="pma-logo">
            <div class="print-header-title">
                <h1 class="text-2xl font-bold mb-0">Personal History Statement</h1>
                <div class="confidential">CONFIDENTIAL</div>
                <div class="text-[10pt] italic text-white">AFP Vision 2028: A World-class Armed Forces, Source of National Pride</div>
            </div>
            <div class="print-header-details">
                <div class="text-sm">Generated on</div>
                    <div class="font-semibold">{{ now()->format('M d, Y h:i A') }}</div>
            </div>
        </div>

        <!-- Submission Information -->
        <div class="submission-info">
            <div class="section-title"><i class="fas fa-user-circle text-[#1B365D]"></i>Applicant Information</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Applicant Name</span>
                    <span class="info-value">{{ $submission->user->first_name ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Username</span>
                    <span class="info-value">{{ $submission->user->username ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Email Address</span>
                    <span class="info-value">{{ $submission->user->email ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Submission Status</span>
                    <span class="status-badge status-{{ $submission->status }}">
                        <i class="fas 
                            @if($submission->status === 'pending') fa-clock
                            @elseif($submission->status === 'reviewed') fa-eye
                            @elseif($submission->status === 'approved') fa-check-circle
                            @else fa-times-circle
                            @endif"></i>
                        {{ ucfirst($submission->status) }}
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Submitted Date</span>
                    <span class="info-value">{{ $submission->created_at ? $submission->created_at->format('M d, Y h:i A') : 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Last Updated</span>
                    <span class="info-value">{{ $submission->updated_at ? $submission->updated_at->format('M d, Y h:i A') : 'N/A' }}</span>
                </div>
            </div>
            
            @if($submission->admin_notes)
            <div class="admin-notes">
                <div class="admin-notes-title">Admin Notes</div>
                <div class="admin-notes-content">{{ $submission->admin_notes }}</div>
            </div>
            @endif
        </div>
        <div class="section-divider"></div>
        <!-- PHS Form Content -->
        <div class="phs-form-card">
            {{-- Page 1 --}}
            <div class="h-[10.5in] w-[7.5in] border-dashed border-gray border-[1px] relative">

                {{-- Header --}}
                <div class="w-full left-0 right-0 top-0 z-[1000] text-center bg-white absolute">
                    <p class="text-[12pt] mt-0 mb-[10pt] tracking-[2px]">
                        <span class="underline">C</span>
                        <span class="underline">O</span>
                        <span class="underline">N</span>
                        <span class="underline">F</span>
                        <span class="underline">I</span>
                        <span class="underline">D</span>
                        <span class="underline">E</span>
                        <span class="underline">N</span>
                        <span class="underline">T</span>
                        <span class="underline">I</span>
                        <span class="underline">A</span>
                        <span class="underline">L</span>
                    </p>
                    <p class='text-[10pt] italic'>AFP Vision 2028: A World-class Armed Forces, Source of National Pride</p>
                    <p class="text-[9pt] text-left font-bold underline decoration-[2px]">ANNEX A of AFPR G 200-054 dtd 22 September 2014, cont'n:</p>
                </div>

                {{-- Title --}}
                <p class="text-[9pt] text-right mt-[60pt]">File Nr:_______</p>
                <p class="text-[9pt] text-left">GHQ, OJ2</p>
                <p class="text-[9pt] text-left">200-054 Form</p>
                <p class="text-[12pt] font-bold text-center">
                    <span class="underline">PERSONAL</span>
                    <span class="underline">HISTORY</span>
                    <span class="underline">STATEMENT</span>
                </p>

                {{-- Personal-A --}}
                <div class="mt-[-170pt] flex ml-[0.6in]"><span class="mr-[0.5in]">A.</span>
                    Name:<div id="app-name" class="border-b border-black text-[11pt] text-left ml-auto w-[5.65in] pl-2">
                        {{ $submission->user->first_name ?? 'N/A' }}
                    </div>
                </div>
                <div class="ml-[1.8in] text-center">
                    <span class="mr-[0.9in]">(Last Name)</span>
                    <span class="mr-[0.7in]">(First Name)</span>
                    <span>(Middle Name)</span>
                </div>

                {{-- Personal-B --}}
                <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">B.</span>
                    Rank:<div id="app-rank" class="border-b border-black text-[11pt] text-center ml-auto w-[1.2in]">
                        {{ $submission->user->militaryHistory->rank ?? 'N/A' }}
                    </div>
                    AFPSN:<div id="app-num" class="border-b border-black text-[11pt] text-center ml-auto w-[1.65in]">
                        {{ $submission->user->militaryHistory->afpsn ?? 'N/A' }}
                    </div>
                    Br of Svc:<div id="app-branch" class="border-b border-black text-[11pt] text-center ml-auto w-[1.7in]">
                        {{ $submission->user->militaryHistory->service_branch ?? 'N/A' }}
                    </div>
                </div>

                {{-- Personal-C --}}
                <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">C.</span>Present Job/Assignment:
                    @php $employment = $submission->user->employmentHistory && $submission->user->employmentHistory->first() ? $submission->user->employmentHistory->first() : null; @endphp
                    <div id="app-job" class="border-b border-black text-[11pt] text-left ml-auto w-[4.4in] pl-2">
                        {{ $employment ? $employment->position : 'N/A' }}
                    </div>
                </div>

                {{-- Personal-D --}}
                <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">D.</span>Business or Duty Address:
                    <div id="app-job-addr" class="border-b border-black text-[11pt] text-left ml-auto w-[4.3in] pl-2">
                        {{ $employment ? $employment->address : 'N/A' }}
                    </div>
                </div>

                {{-- Personal-E --}}
                <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">E.</span>Home Address:
                    <div id="app-home-addr" class="border-b border-black text-[11pt] text-left ml-auto w-[5.1in] pl-2">
                        {{ $submission->user->addressDetails->address ?? 'N/A' }}
                    </div>
                </div>

                {{-- Personal-F --}}
                <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">F.</span>
                    Date of Birth:<div id="app-birth" class="border-b border-black text-[11pt] text-left ml-auto w-[1.5in] pl-2">
                        {{ $submission->user->birthDetails->date_of_birth ?? 'N/A' }}
                    </div>
                    Place of Birth:<div id="app-birth-place" class="border-b border-black text-[11pt] text-left ml-auto w-[2.9in] pl-2">
                        {{ $submission->user->birthDetails->place_of_birth ?? 'N/A' }}
                    </div>
                </div>

                {{-- Personal-G --}}
                <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">G.</span>
                    Citizenship:<div id="app-citizen" class="border-b border-black text-[11pt] text-left ml-auto w-[2.5in] pl-2">
                        {{ $submission->user->personalInfo->citizenship ?? 'N/A' }}
                    </div>
                    Civil Status:<div id="app-civil" class="border-b border-black text-[11pt] text-left ml-auto w-[2.5in] pl-2">
                        {{ $submission->user->personalInfo->civil_status ?? 'N/A' }}
                    </div>
                </div>

                {{-- Personal-H --}}
                <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">H.</span>
                    Height:<div id="app-height" class="border-b border-black text-[11pt] text-left ml-auto w-[1.5in] pl-2">
                        {{ $submission->user->personalInfo->height ?? 'N/A' }}
                    </div>
                    Weight:<div id="app-weight" class="border-b border-black text-[11pt] text-left ml-auto w-[1.5in] pl-2">
                        {{ $submission->user->personalInfo->weight ?? 'N/A' }}
                    </div>
                    Blood Type:<div id="app-blood" class="border-b border-black text-[11pt] text-left ml-auto w-[1.5in] pl-2">
                        {{ $submission->user->personalInfo->blood_type ?? 'N/A' }}
                    </div>
                </div>

                {{-- Personal-I --}}
                <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">I.</span>
                    Religion:<div id="app-religion" class="border-b border-black text-[11pt] text-left ml-auto w-[3.5in] pl-2">
                        {{ $submission->user->personalInfo->religion ?? 'N/A' }}
                    </div>
                    Sex:<div id="app-sex" class="border-b border-black text-[11pt] text-left ml-auto w-[2.5in] pl-2">
                        {{ $submission->user->personalInfo->sex ?? 'N/A' }}
                    </div>
                </div>

                {{-- Personal-J --}}
                <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">J.</span>
                    GSIS ID NR:<div id="app-gsis" class="border-b border-black text-[11pt] text-left ml-auto w-[2.5in] pl-2">
                        {{ $submission->user->personalInfo->gsis_id ?? 'N/A' }}
                    </div>
                    PAG-IBIG ID NR:<div id="app-pagibig" class="border-b border-black text-[11pt] text-left ml-auto w-[2.5in] pl-2">
                        {{ $submission->user->personalInfo->pagibig_id ?? 'N/A' }}
                    </div>
                </div>

                {{-- Personal-K --}}
                <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">K.</span>
                    PASSPORT NR:<div id="app-pass" class="border-b border-black text-[11pt] text-left ml-auto w-[1.5in] pl-2">
                        {{ $submission->user->personalInfo->passport_number ?? 'N/A' }}
                    </div>
                    DATE OF EXPIRATION:<div id="app-pass-exp" class="border-b border-black text-[11pt] text-left ml-auto w-[1.9in] pl-2">
                        {{ $submission->user->personalInfo->passport_expiry ?? 'N/A' }}
                    </div>
                </div>

                {{-- Footer --}}
                <div class="w-full left-0 right-0 bottom-0 z-[1000] text-center bg-white absolute">
                    <p class='text-[12pt] mt-0 mb-[10pt] tracking-[2px]'>
                        <span class="underline">C</span>
                        <span class="underline">O</span>
                        <span class="underline">N</span>
                        <span class="underline">F</span>
                        <span class="underline">I</span>
                        <span class="underline">D</span>
                        <span class="underline">E</span>
                        <span class="underline">N</span>
                        <span class="underline">T</span>
                        <span class="underline">I</span>
                        <span class="underline">A</span>
                        <span class="underline">L</span>
                    </p>
                    <p class="text-[10pt] italic">AFP Core Values: Honor, Service, Patriotism</p>
                </div>
            </div>

            <!-- Additional pages would go here with more PHS content -->
            <!-- For brevity, showing just the first page structure -->
            
        </div>

        <!-- Add a print footer for PMA motto -->
        <div class="print-footer">
            AFP Core Values: Honor, Service, Patriotism &nbsp;|&nbsp; Philippine Military Academy
        </div>
    </div>

    <script>
        // Print functionality
        function printPHS() {
            window.print();
        }
        
        // Auto-print on page load (optional)
        // window.onload = function() {
        //     setTimeout(function() {
        //         window.print();
        //     }, 1000);
        // };
    </script>
@endsection 