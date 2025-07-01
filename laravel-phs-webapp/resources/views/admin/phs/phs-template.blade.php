@extends('layouts.admin')

@section('title', 'Print PHS Document')

@push('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/print-prev.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('public/build/assets/print-prev.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
    @media print {
        body *:not(#phs-print-section):not(#phs-print-section *) {
            display: none !important;
        }
        #phs-print-section, #phs-print-section * {
            display: block !important;
        }
    }
    </style>
@endpush

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Back Navigation -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.phs.index') }}" 
           class="inline-flex items-center text-[#1B365D] hover:text-[#2B4B7D] font-medium transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to List
        </a>
    </div>
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden">
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-[#1B365D]/10 to-[#2B4B7D]/10 px-8 py-6 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="p-3 rounded-xl bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] text-white shadow-lg">
                    <i class="fas fa-print text-xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Print PHS Template</h1>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="printPHSTemplate()" class="print-btn">
                    <i class="fas fa-print"></i> Print Template
                </button>
            </div>
        </div>
        <!-- Card Body -->
        <div class="phs-preview-container w-full flex justify-center items-start" id="phs-print-section">
            <div class="text-justify font-sans text-[11pt] bg-white">
                
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
                    <div class="section-title section-divider">INSTRUCTIONS</div>
                    <p class="mb-[10pt]"><span class="ml-[0.5in] mr-[0.5in]">1.</span>Answer all questions completely; if question is not applicable, write "NA".write "Unknown"
                        only if you do not know the answer and cannot obtain the answer from personal records.
                        Use the blank pages at the back of this form for extra details on any question for which you
                        do not have sufficient space.
                    </p>
                    <p><span class="ml-[0.5in] mr-[0.5in]">2.</span>Write carefully, Illegible or incomplete forms will not receive consideration.</p>
                    <div class="section-title section-divider">WARNING</div>
                    <p class="mb-[10pt]"><span class="ml-[0.5in] mr-[0.5in]">1.</span>The correctness of all statement of entries made herein will be investigated.</p>
                    <p class="mb-[10pt]"><span class="ml-[0.5in] mr-[0.5in]">2.</span>Any deliberate omission or distortion of material facts may give sufficient cause for denial of clearance.</p>
                    <p class="mb-[10pt]"><span class="ml-[0.5in] mr-[0.5in]">3.</span>The statements made herein are classified CONFIDENTIAL. Revelation or use for other than the authorized
                        purpose is prohibited by AFPR G-200-054.</p>
                    <div class="section-title section-divider">PERSONAL DETAIL</div>
                    {{-- Signature --}}
                    <div class="mt-[160pt] border-t-[2px] border-black w-[2.1in] text-center text-[10pt] font-bold -rotate-90 origin-top-left">
                        (Signature of Applicant)
                    </div>
                    {{-- Personal-A --}}
                    <div class="mt-[-170pt] flex ml-[0.6in]"><span class="mr-[0.5in]">A.</span>
                        Name:<div id="app-name" class="border-b border-black text-[11pt] text-left ml-auto w-[5.65in] pl-2"></div>
                    </div>
                    <div class="ml-[1.8in] text-center">
                        <span class="mr-[0.9in]">(Last Name)</span>
                        <span class="mr-[0.7in]">(First Name)</span>
                        <span>(Middle Name)</span>
                    </div>
                    {{-- Personal-B --}}
                    <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">B.</span>
                        Rank:<div id="app-rank" class="border-b border-black text-[11pt] text-center ml-auto w-[1.2in]"></div>
                        AFPSN:<div id="app-num" class="border-b border-black text-[11pt] text-center ml-auto w-[1.65in]"></div>
                        Br of Svc:<div id="app-branch" class="border-b border-black text-[11pt] text-center ml-auto w-[1.7in]"></div>
                    </div>
                    {{-- Personal-C --}}
                    <div  class="flex ml-[0.6in]"><span class="mr-[0.5in]">C.</span>Present Job/Assignment:
                        <div id="app-job" class="border-b border-black text-[11pt] text-left ml-auto w-[4.4in] pl-2"></div>
                    </div>
                    {{-- Personal-D --}}
                    <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">D.</span>Business or Duty Address:
                        <div id="app-job-addr" class="border-b border-black text-[11pt] text-left ml-auto w-[4.3in] pl-2"></div>
                    </div>
                    {{-- Personal-E --}}
                    <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">E.</span>Home Address:
                        <div id="app-home-addr" class="border-b border-black text-[11pt] text-left ml-auto w-[5.1in] pl-2"></div>
                    </div>
                    {{-- Personal-F --}}
                    <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">F.</span>
                        Birth Date:<div id="app-bdate" class="border-b border-black text-[11pt] text-left ml-auto w-[1.5in] pl-2"></div>
                        Place of Birth:<div id="app-bplace" class="border-b border-black text-[11pt] text-left ml-auto w-[2.95in] pl-2"></div>
                    </div>
                    {{-- Personal-G --}}
                    <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">G.</span>CHANGE IN NAME (If by Court Action, give details):
                        <div id="app-change-name" class="border-b border-black text-[11pt] text-left ml-auto w-[2.5in] pl-2"></div>
                    </div>
                    {{-- Personal-H --}}
                    <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">H.</span>
                        NICKNAMES: <div id="app-nickname" class="border-b border-black text-[11pt] text-left ml-auto w-[3in] pl-2"></div>
                        NATIONALITY:<div id="app-nationality" class="border-b border-black text-[11pt] text-left ml-auto w-[1.2in] pl-2"></div>
                    </div>
                    {{-- Personal-I --}}
                    <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">I.</span>
                        TAX IDENTIFICATION NR:<div class="app-tin border-b border-black text-[11pt] text-left ml-auto w-[2in] pl-2"></div>
                        RELIGION:<div id="app-religion" class="border-b border-black text-[11pt] text-left ml-auto w-[1.5in] pl-2"></div>
                    </div>
                    {{-- Personal-J --}}
                    <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">J.</span>
                        MOBILE NR:<div id="app-mobilenum" class="border-b border-black text-[11pt] text-left ml-auto w-[1.5in] pl-2"></div>
                        EMAIL ADDRESS:<div id="app-email" class="border-b border-black text-[11pt] text-left ml-auto w-[2.5in] pl-2"></div>
                    </div>
                    {{-- Personal-K --}}
                    <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">K.</span>
                        PASSPORT NR:<div id="app-pass" class="border-b border-black text-[11pt] text-left ml-auto w-[1.5in] pl-2"></div>
                        DATE OF EXPIRATION:<div id="app-pass-exp" class="border-b border-black text-[11pt] text-left ml-auto w-[1.9in] pl-2"></div>
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
                <br>
                {{-- Page 2 --}}
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
                    {{-- Section II-Personal Characteristics --}}
                    <div class="font-bold mt-[70pt] text-[12pt]"><span class="mr-[0.45in]"">II.</span>PERSONAL CHARACTERISTICS:</div>
                    {{-- Characteristics-A --}}
                    <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">A.</span>DESCRIPTION:
                        Sex: <div id="app-sex" class="border-b border-black text-[11pt] text-left ml-auto w-[1in] pl-2"></div>
                        Age: <div id="app-age" class="border-b border-black text-[11pt] text-left ml-auto w-[0.5in] pl-2"></div>
                        Height: (mtrs) <div id="app-ht" class="border-b border-black text-[11pt] text-left ml-auto w-[0.5in] pl-2"></div>
                        Weight: (kgs) <div id="app-wt" class="border-b border-black text-[11pt] text-left ml-auto w-[0.5in] pl-2"></div>
                    </div>
                    <div class="flex ml-[1.25in]">Body Build: (Heavy, Medium, Light)
                        <div id="app-build" class="border-b border-black text-[11pt] text-left ml-auto w-[3.75in] pl-2"></div>
                    </div>
                    <div class="flex ml-[1.25in]">Complexion: (Dark, Fair, Light)
                        <div id="app-complexion" class="border-b border-black text-[11pt] text-left ml-auto w-[1.5in] pl-2"></div>
                        Color of eyes:
                        <div id="app-eyecolor" class="border-b border-black text-[11pt] text-left ml-auto w-[1.5in] pl-2"></div>
                    </div>
                    <div class="flex ml-[1.25in]">
                        Color of Hair:<div id="app-haircolor" class="border-b border-black text-[11pt] text-left ml-auto w-[0.8in] mr-[0.05in] pl-2"></div>
                        Scar or Mark & Other distinguishing Feature:<div id="app-mark" class="border-b border-black text-[11pt] text-left ml-auto w-[1.3in] pl-2"></div>
                    </div>
                    {{-- Characteristics-B --}}
                    <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">B.</span>PHYSICAL CONDITION:</div>
                    <div class="flex ml-[1.25in]">Present state of health (Excellent, Good, Poor)
                        <div id="app-healthstat" class="border-b border-black text-[11pt] text-left ml-auto w-[3in] pl-2"></div>
                    </div>
                    <div class="flex ml-[1.25in]">Recent Serious Illness:
                        <div id="app-illness" class="border-b border-black text-[11pt] text-left ml-auto w-[4.6in] pl-2"></div>
                    </div>
                    <div class="flex ml-[1.25in]">Blood Type:
                        <div id="app-bloodtype" class="border-b border-black text-[11pt] text-left ml-auto w-[5.3in] pl-2"></div>
                    </div>
                    {{-- Section III-Marital Status --}}
                    <div class="font-bold text-[12pt]"><span class="mr-[0.4in]">III.</span>MARITAL STATUS:</div>
                    {{-- Marital-A --}}
                    <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">A.</span>MARITAL STATUS:
                        <div id="app-maritalstat" class="border-b border-black text-[11pt] text-left ml-auto w-[4.85in]"></div>
                    </div>
                    <div class="text-center ml-auto w-[4.85in]">(Single, Married, Separated or Widowed)</div>
                    {{-- Marital-B --}}
                    <div class="flex ml-[0.6in]">
                        <span class="mr-[0.5in]">B.</span>NAME OF SPOUSE:
                        <div id="spouse-name" class="border-b border-black text-[11pt] text-left ml-auto w-[4.7in]"></div>
                    </div>
                    <div class="text-center ml-auto w-[5in]">(Full Name)</div>
                    <div class="flex ml-[1.25in]">Date and Place of Marriage:<div id="marriage-detail" class="border-b border-black text-[11pt] text-left ml-auto w-[4.2in]"></div></div>
                    <div class="flex ml-[1.25in]">
                        Birth Date:<div id="spouse-bdate" class="border-b border-black text-[11pt] text-left ml-auto w-[1.5in] pl-2"></div>
                        Place of Birth:<div id="spouse-bplace" class="border-b border-black text-[11pt] text-left ml-auto w-[2.95in] pl-2"></div>
                    </div>
                    <div class="flex ml-[1.25in]">Occupation/Employer/Place of Employment:
                        <div class="border-b border-black text-[11pt] text-left ml-auto w-[3in]"></div>
                    </div>
                    <div id="spouse-jobdetail" class="ml-[1.25in] border-b border-black align-bottom text-[11pt] text-left h-[20pt]"></div>
                    <div class="ml-[1.25in] flex">
                        <div>Contact Number:
                            <div id="spouse-mobilenum" class="border-b border-black w-[1.15in] ml-[1.2in] pl-2 text-[11pt]"></div>
                        </div>
                        <div class="pl-2"> Citizenship:
                            <div id="spuse-citizenship" class="border-b border-black w-[1.2in] ml-[0.8in] pl-2 text-[11pt]"></div>
                        </div>
                        <div>If dual,
                            <div id="spouse-dual" class="border-b border-black w-[1.3in] ml-[0.5in] pl-2 text-[11pt]"></div>
                        </div>
                    </div>
                    <div class="ml-[6.15in]">(other Citizenship)</div>
                    {{-- Signature --}}
                    <div class="mt-[60pt] ml-[0.2in] border-t-[2px] border-black w-[2.37in] text-center text-[10pt] font-bold -rotate-90 origin-top-left">
                        (Signature of Applicant)
                    </div>
                    {{-- Marital-C --}}
                    <div class="flex ml-[0.6in] mt-[-80pt]"><span class="mr-[0.5in]">C.</span>CHILDREN:</div>
                    <div class="ml-[0.8in]">
                        <table id="child-table" class="border-collapse w-full">
                            <thead>
                                <tr>
                                    <th class="text-center w-1/4">Name</th>
                                    <th class="text-center w-1/4">Date of Birth</th>
                                    <th class="text-center w-1/4">Citizenship/Address</th>
                                    <th class="text-center w-1/4r">Name of Father/Mother</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                </tr>
                                <tr>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                </tr>
                                <tr>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                </tr>
                                <tr>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                </tr>
                                <tr>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                    <td class="pl-[0.05in] pr-[0.05in] border-b border-black h-[11.5pt] text-11pt text-left"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="ml-[0.6in] w-full text-center font-bold underline decoration-2">(Use back page for additional information)</div>
                    {{-- Section IV-Family History and Information --}}
                    <div class="font-bold text-[12pt]"><span class="mr-[0.4in]">IV.</span>FAMILY HISTORY AND INFORMATION:</div>
                    {{-- Family-Father --}}
                    <div class="flex ml-[0.6in]">
                        <span class="mr-[0.5in]">A.</span>
                        FATHER: <div id="father-name" class="border-b border-black text-[11pt] text-left ml-auto w-[5.4in]"></div>
                    </div>
                    <div class="text-center ml-[0.6in]">(Full Name)</div>
                    <div class="ml-[1.25in]">Date and Place of Birth:<div id="father-birth" class="border-b border-black text-[11pt] text-left ml-auto w-[4.5in]"></div></div>
                    <div class="ml-[1.25in]">Complete Address:<div id="father-addr" class="border-b border-black text-[11pt] text-left ml-auto w-[4.8in]"></div> </div>
                    <div class="ml-[1.25in]">Occupation/Employer/Place of Employment:
                        <div id="father-jobdetail" class="border-b border-black text-[11pt] text-left ml-auto w-[3.1in]"></div>
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
                <br>
                {{-- Page 3 --}}
                <div class="h-[10.5in] w-[7.5in] border-dashed border-gray border-[1px] relative">
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
                    </div>
                    <div class="section-name mt-[65pt]">
                        <div class="ml-[1.25in]">Citizenship: <span id="father-citizenship" class="inline-block border-b border-black w-32 align-bottom"> </span>
                            If dual, write both citizenship. If naturalized, give date and place where naturalized:
                            <span id="father-dual" class="inline-block border-b border-black w-[4.4in] align-bottom"> </span>
                        </div>
                        {{-- Family-Mother --}}
                        <div class="flex ml-[0.6in]">
                            <span class="mr-[0.5in]">B.</span>
                            Mother: <div id="mother-name" class="border-b border-black text-[11pt] text-left ml-auto w-[5.6in]"></div>
                        </div>
                        <div class="ml-[1.25in]">Date and Place of Birth:<div id="mother-birth" class="border-b border-black text-[11pt] text-left ml-auto w-[4.5in]"></div></div>
                        <div class="ml-[1.25in]">Complete Address:<div id="mother-addr" class="border-b border-black text-[11pt] text-left ml-auto w-[4.8in]"></div> </div>
                        <div class="ml-[1.25in]">Occupation/Employer/Place of Employment: <div id="mother-jobdetail" class="border-b border-black text-[11pt] text-left ml-auto w-[3.1in]"></div></div>
                        <div class="ml-[1.25in]">Citizenship: <span id="mother-citizenship" class="inline-block border-b border-black w-32 align-bottom"> </span>
                            If dual, write both citizenship. If naturalized, give date and place where naturalized:
                            <span id="mother-dual" class="inline-block border-b border-black w-[4.5in] align-bottom"> </span>
                        </div>
                        {{-- Family-Siblings --}}
                        <div class="mt-[10pt] mb-[10pt] ml-[0.6in]"><span class="mr-[0.5in]">C.</span>Brothers and Sisters:</div>
                        <table id="sibling-table" class="border-collapse w-full">
                            <thead>
                                <tr>
                                    <th class="border border-black align-top text-center w-[1.01in] pl-[0.05in] pr-[0.05in]">NAME</th>
                                    <th class="border border-black align-top text-center w-[1.08in] pl-[0.05in] pr-[0.05in]">DATE of BIRTH:</th>
                                    <th class="border border-black align-top text-center w-[1.19in] pl-[0.05in] pr-[0.05in]">CITIZENSHIP (IF DUAL WRITE BOTH)</th>
                                    <th class="border border-black align-top text-center w-[1.15in] pl-[0.05in] pr-[0.05in]">COMPLETE ADDRESS</th>
                                    <th class="border border-black align-top text-center w-[1.21in] pl-[0.05in] pr-[0.05in]">OCCUPATION</th>
                                    <th class="border border-black align-top text-center w-[1.78in] pl-[0.05in] pr-[0.05in]">EMPLOYER/ADDRESS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                </tr>
                                <tr>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                </tr>
                                <tr>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                </tr>
                                <tr>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                    <td class="border border-black h-[11.5pt] text-left"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-[10pt]">
                            <div>
                                <span class="mr-[0.5in] ml-[0.6in]">D.</span>
                                STEP-PARENT OR GUARDIAN: <div id="guardian-name" class="border-b border-black text-[11pt] text-left ml-auto w-[3.8in]"></div>
                                <div class="text-center ml-auto w-[4in]">(Full Name)</div>
                            </div>
                            <div class="ml-[1.35in]">Date and Place of Birth:<div id="guardian-birth" class="border-b border-black text-[11pt] text-left ml-auto w-[4.5in]"></div></div>
                            <div class="ml-[1.35in]">Complete Address:<div id="guardian-addr" class="border-b border-black text-[11pt] text-left ml-auto w-[4.8in]"></div> </div>
                            <div class="ml-[1.35in]">Occupation/Employer/Place of Employment: <div id="guardian-jobdetail" class="border-b border-black text-[11pt] text-left ml-auto w-[3.1in]"></div></div>
                            <div class="ml-[1.35in]">Citizenship: <span id="guardian-citizenship" class="inline-block border-b border-black w-32 align-bottom"> </span>
                                If dual, write both citizenship. If naturalized, give date and place where naturalized:
                                <span id="guardian-dual" class="inline-block border-b border-black w-[4.4in] align-bottom"> </span>
                            </div>
                        </div>
                        {{-- Signature --}}
                        <div class="ml-[0.25in] mt-[75pt] border-t-[2px] border-black w-[2.37in] text-center text-[10pt] font-bold -rotate-90 origin-top-left">
                            (Signature of Applicant)
                        </div>
                        {{-- Family-Father In Law --}}
                        <div class="mt-[-80pt] ml-[0.6in]">
                            <span class="mr-[0.5in]">E.</span>
                            FATHER-IN-LAW: <div id="fil-name" class="border-b border-black text-[11pt] text-left ml-auto w-[4.9in]"></div>
                            <div class="pl-[1in] ml-auto w-[4.5in]">(Full Name)</div>
                        </div>
                        <div class="ml-[1.35in]">Date and Place of Birth:<div id="fil-birth" class="border-b border-black text-[11pt] text-left ml-auto w-[4.5in]"></div></div>
                        <div class="ml-[1.35in]">Complete Address:<div id="fil-addr" class="border-b border-black text-[11pt] text-left ml-auto w-[4.8in]"></div> </div>
                        <div class="ml-[1.35in]">Occupation/Employer/Place of Employment: <div id="fil-jobdetail" class="border-b border-black text-[11pt] text-left ml-auto w-[3.1in]"></div></div>
                        <div class="ml-[1.35in]">Citizenship: <span id="fil-citizenship" class="inline-block border-b border-black w-32 align-bottom"> </span>
                            If dual, write both citizenship. If naturalized, give date and place where naturalized:
                            <span id="fil-dual" class="inline-block border-b border-black w-[4.4in] align-bottom"> </span>
                        </div>
                        {{-- Family-Mother In Law --}}
                        <div class="mt-[10pt] ml-[0.7in]">
                            <span class="mr-[0.5in]">F.</span>
                            MOTHER-IN-LAW: <div id="mil-name" class="border-b border-black text-[11pt] text-left ml-auto w-[4.8in]"></div>
                            <div class="pl-[1in] ml-auto w-[4.5in]">(Full Name)</div>
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
                <br>
                {{-- Page 4 --}}
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
                    <div class="mt-[53pt] ml-[1.35in]">
                        <div>Date and Place of Birth:
                            <div id="mil-birth" class="text-[11pt] text-left border-b border-black ml-auto w-[4.4in]"></div>
                        </div>
                        <div>Complete Address:
                            <div id="mil-addr" class="text-[11pt] text-left border-b border-black ml-auto w-[4.75in]"></div>
                        </div>
                        <div>Occupation/Employer/Place of Employment:
                            <div id="mil-jobdetail" class="text-[11pt] text-left border-b border-black ml-auto w-[3in]"></div>
                        </div>
                        <div>Citizenship: <span id="mil-citizenship" class="inline-block border-b border-black w-32 align-bottom"> </span>
                            If dual, write both citizenship. If naturalized, give date and place where naturalized:
                            <span id="mil-dual" class="inline-block border-b border-black w-[3in] align-bottom"> </span>
                        </div>
                    </div>
                    {{-- Section V-Educational Background --}}
                    <div class="font-bold text-[12pt]"><span class="mr-[0.5in]">V.</span>EDUCATIONAL BACKGROUND:</div>
                    {{-- Education-Elementary --}}
                    <table id="elementary-table" class="table-auto border-collapse w-full text-normal">
                        <thead>
                            <tr class="text-center">
                                <th class="pr-[0.2in] font-normal"><span class="mr-[0.5in]">A.</span>Elementary</th>
                                <th class="w-[2.5in] font-normal">Location</th>
                                <th class="w-[1in] font-normal">Date of Attendance</th>
                                <th class="w-[1in] font-normal">Year Graduated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Education-Highschool --}}
                    <table id="highschool-table" class="table-auto border-collapse w-full">
                        <thead>
                            <tr class="text-center">
                                <th class="text-left pl-[0.7in] font-normal"><span class="mr-[0.5in]">B.</span>High School</th>
                                <th class="w-[2.5in] font-normal">Location</th>
                                <th class="w-[1in] font-normal">Date of Attendance</th>
                                <th class="w-[1in] font-normal">Year Graduated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Education-College --}}
                    <table id="college-table" class="table-auto border-collapse w-full">
                        <thead>
                            <tr class="text-center">
                                <th class="pr-[0.35in] font-normal"><span class="mr-[0.5in]">C.</span>College</th>
                                <th class="w-[2.5in] font-normal">Location</th>
                                <th class="w-[1in] font-normal">Date of Attendance</th>
                                <th class="w-[1in] font-normal">Year Graduated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                <td class="border-[1px] border-black h-[12pt] p-2"></td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Education-Post Graduate --}}
                    <div class="ml-[0.75in]">
                        <table id="postgrad-table" class="table-auto border-collapse w-full">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-left font-normal"><span class="mr-[0.5in]">D.</span>Post Graduate</th>
                                    <th class="w-[2.5in] font-normal">Location</th>
                                    <th class="w-[1in] font-normal">Date of Attendance</th>
                                    <th class="w-[1in] font-normal">Year Graduated</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                    <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                    <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                    <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                </tr>
                                <tr>
                                    <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                    <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                    <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                    <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                </tr>
                                <tr>
                                    <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                    <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                    <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                    <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                </tr>
                                <tr>
                                    <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                    <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                    <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                    <td class="border-[1px] border-black h-[12pt] p-2"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- Education-Other Schools --}}
                    <div class="mt-4 ml-[0.6in]"><span class="mr-[0.5in]">E.</span>Other Schools/Training Attended and Date of Attendance: </div>
                    <div id="other-training" class="ml-[1.3in] text-[11pt] text-left">
                        <hr class="h-[11pt] border-none border-t border-black">
                        <hr class="h-[11pt] border-t border-black">
                        <hr class="h-[11pt] border-b border-black">
                    </div>
                    {{-- Education-Civil Service --}}
                    <div class="mt-4 ml-[0.6in]"><span class="mr-[0.5in]">F.</span>Civil Service, If any and other Similar Qualification Acquired: </div>
                    <div id="civil-service" class="ml-[1.3in] text-[11pt] text-left border-b border-black h-[11.5pt] w-[4in]">
                    </div>
                    {{-- Signature --}}
                    <div class="border-t-[2px] border-black w-[2.37in] text-center text-[10pt] font-bold -rotate-90 origin-top-left">
                        (Signature of Applicant)
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
                <br>
                {{-- Page 5 --}}
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
                    {{-- Section VI-Military History --}}
                    <div class="mt-[80pt] font-bold text-[12pt]"><span class="mr-[0.4in]">VI.</span>MILITARY HISTORY:</div>
                    {{-- Military-Date Enlisted --}}
                    <div class="ml-[0.6in]"><span class="mr-[0.5in]">A.</span>Date Enlisted in AFP:
                        <span id="date-enlisted" class="inline-block text-[11pt] border-b-[1px] border-black w-[4.75in] h-[11.5pt] align-middle text-center pl-[3px] leading-[11.5pt]"></span>
                    </div>
                    {{-- Military-Date Commissioned --}}
                    <div class="ml-[0.6in]"><span class="mr-[0.5in]">B.</span>Date of Commision:
                        <span id="start-comm" class="inline-block text-[11pt] border-b-[1px] border-black w-[2.3in] h-[11.5pt] align-middle text-center pl-[3px] leading-[11.5pt]"></span> :
                        <span id="end-comm" class="inline-block text-[11pt] border-b-[1px] border-black w-[2.4in] h-[11.5pt] align-middle text-center pl-[3px] leading-[11.5pt]"></span>
                    </div>
                    {{-- Military-Source of Commission --}}
                    <div class="ml-[0.6in]"><span class="mr-[0.5in]">C.</span>Source of Commission:
                        <span id="comm-source" class="inline-block text-[11pt] border-b-[1px] border-black w-[4.6in] h-[11.5pt] align-middle text-center pl-[3px] leading-[11.5pt]"></span>
                    </div>
                    {{-- Military-Unit Assignments --}}
                    <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">D.</span>Important Unit Assignment since enlisted/CAD</div>
                    <table id="assignment-table" class="w-full">
                        <thead>
                            <tr>
                                <th class="text-center border-black border-[1px]">INCLUSIVE DATES</th>
                                <th class="text-center border-black border-[1px]">UNIT/OFFICE</th>
                                <th class="text-center border-black border-[1px]">CO/CHIEF OF OFFICE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                        </tbody>
                    </table>
                    <div class="text-center mt-5pt">(Use Separate Sheet for Additional Information)</div>
                    {{-- Military-Military Schools --}}
                    <div class="ml-[0.6in]"><span class="mr-[0.5in]">E.</span>Military Schools Attended</div>
                    <div class="ml-14 mt-4">
                        <table id="military-school-table" class="w-full border-collapse">
                            <thead>
                                <tr>
                                    <th class="text-center border-black border-[1px]">School/Location</th>
                                    <th class="text-center border-black border-[1px]">Date of Attendance</th>
                                    <th  class="text-center border-black border-[1px]">Nature of Training</th>
                                    <th  class="text-center border-black border-[1px]">Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                                <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                                <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                                <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                                <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                                <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                                <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                                <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                                <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                                <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                                <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                                <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                                <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                                <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                                <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                                <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[11pt]"></td></tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- Signature --}}
                    <div class="border-t-[2px] border-black w-[2.37in] text-center text-[10pt] font-bold -rotate-90 origin-top-left">
                        (Signature of Applicant)
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
                <br>
                {{-- Page 6 --}}
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
                    {{-- Military-Decorations --}}
                    <div class="mt-[70pt]"><span class="mr-[0.5in]">F.</span>Decorations, Awards or Commendations Received: </div>
                    <table id="award-table" class="border-collapse w-full">
                        <tbody>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                        </tbody>
                    </table>
                    <div class="text-center mb-[5pt]"><span>(Use Separate Sheet for Additional Information)</span></div>
                    {{-- Section VII-Residence --}}
                    <div class="font-bold text-[12pt]"><span class="mr-[0.5in]">VII.</span>PLACES OF RESIDENCE SINCE BIRTH:</div>
                    <table id="residence-table" class="mb-[5pt] border-collapse w-full">
                        <tbody>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                            <tr><td class="border-black border-b-[1px] h-[11pt]"></td></tr>
                        </tbody>
                    </table>
                    {{-- Section VIII-Employment --}}
                    <div class="font-bold text-[12pt]"><span class="mr-[0.5in]">VIII.</span>EMPLOYMENT:</div>
                    <div>
                        <table id="employment table" class="ml-[0.5in] w-[7in] border-collapse">
                            <thead>
                                <tr>
                                    <th class="text-center border-black border-[1px]">Inclusive Dates</th>
                                    <th class="text-center border-black border-[1px]">Type of Employment</th>
                                    <th class="text-center border-black border-[1px]">Name/Address</th>
                                    <th class="text-center border-black border-[1px]">Reason for Leaving</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                </tr>
                                <tr>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                </tr>
                                <tr>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                </tr>
                                <tr>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                </tr>
                                <tr>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                </tr>
                                <tr>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- Signature --}}
                    <div class="mt-[80pt] border-t-[2px] border-black w-[2.37in] text-center text-[10pt] font-bold -rotate-90 origin-top-left">
                        (Signature of Applicant)
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
                <br>
                {{-- Page 7 --}}
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
                    {{-- Employment-Forced Resignation --}}
                    <div class="mt-[60pt] ml-[1in]">Have you been dismissed or forced to resign from a position?
                         No ( <span id="no-dismissal" class="inline-block text-[11pt] h-[11pt] align-middle text-center"></span> )
                         Yes (<span id="has-been-dismissed" class="inline-block text-[11pt] h-[11pt] align-middle text-center"></span> )
                         If Yes, explain:
                    </div>
                    <div id="dismissal-detail" class="w-[6.5in] ml-[1in] h-[23pt] indent-[0.3in] text-[11pt] leading-[15.3px] bg-[length:100%_15.3px] bg-repeat-y bg-[linear-gradient(to_bottom,_transparent_13.5px,_black_13.5px,_black_14.5px,_transparent_14.5px)]"></div>
                    {{-- Section IX-Visited Countries --}}
                    <div class="font-bold text[12pt]"><span class="mr-[0.4in]">IX.</span>FOREIGN COUNTRIES VISITED:</div>
                        <table id="foreign-country-table" class="border-collapse w-full">
                            <thead>
                                <tr>
                                    <th class="text-center border-black border-[1px]">Date of Visit</th>
                                    <th class="text-center border-black border-[1px]">Country Visited</th>
                                    <th class="text-center border-black border-[1px]">Purpose of visit</th>
                                    <th class="text-center border-black border-[1px]">Address Abroad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                </tr>
                                <tr>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                </tr>
                                <tr>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                </tr>
                                <tr>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                </tr>
                                <tr>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                    <td class="border-black border-[1px] h-[11pt]"></td>
                                </tr>
                            </tbody>
                        </table>
                    {{-- Section X-Credit Reputation --}}
                    <div class="font-bold text-[12pt]"><span class="mr-[0.4in]">X.</span>CREDIT REPUTATION:</div>
                    {{-- Credit Rep-Salary Dependent --}}
                    <div class="ml-[0.6in] text-[11pt] leading-tight">
                        <span class="mr-[0.5in] inline-block">A.</span>Are you entirely dependent on your salary?
                        Yes ( <span id="dependent" class="inline-block text-[11pt] h-[11pt] align-middle text-center"> </span> )
                        No ( <span id="not-dependent" class="inline-block text-[11pt] h-[11pt] align-middle text-center"></span> )
                        If no, State other source of income:
                    </div>
                    <div id="other-income" class="w-[6.5in] ml-[1in] h-[23pt] indent-[0.3in] text-[11pt] leading-[15.3px] bg-[length:100%_15.3px] bg-repeat-y bg-[linear-gradient(to_bottom,_transparent_13.5px,_black_13.5px,_black_14.5px,_transparent_14.5px)]"></div>
                    {{-- Credit Rep-Banks --}}
                    <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">B.</span>Name and address of Banks or other credit institutions with which you have accounts/loans:</div>
                    <div id="bank-account" class="w-[6.5in] ml-[1in] h-[23pt] indent-[0.3in] text-[11pt] leading-[15.3px] bg-[length:100%_15.3px] bg-repeat-y bg-[linear-gradient(to_bottom,_transparent_13.5px,_black_13.5px,_black_14.5px,_transparent_14.5px)]"></div>
                    {{-- Credit Rep-SALN --}}
                    <div class="ml-[0.6in] leading-tight"><span class="mr-[0.4in]">C.</span>Have you filed a statement of your Assets and Liabilities with any government agency?</div>
                    <div class="ml-[1.16in] leading-tight">
                        Yes ( <span id="filed-saln" class="inline-block text-[11pt] h-[11pt] align-middle text-center"></span> )
                        No ( <span id="not-filed-saln" class="inline-block text-[11pt] h-[11pt] align-middle text-center"> </span> )
                        If so, what agency and when?
                    </div>
                    <div id="saln-detail" class="w-[6.5in] ml-[1in] h-[23pt] indent-[0.3in] text-[11pt] leading-[15.3px] bg-[length:100%_15.3px] bg-repeat-y bg-[linear-gradient(to_bottom,_transparent_13.5px,_black_13.5px,_black_14.5px,_transparent_14.5px)]"></div>
                    {{-- Credit Rep-Income Tax --}}
                    <div class="ml-[0.6in]"><span class="mr-[0.4in]">D.</span>Have you filed your latest Income Tax Returns?
                        <span id="filed-itr" class="inline-block text-[11pt] border-b-[1px] border-black w-[2.9in] h-[11.5pt] align-middle text-center pl-[3px] leading-[11.5pt]"></span>
                    </div>
                    <div class="ml-[1.2in]">Amount paid for last Calendar Year:
                        <span id="amount-paid" class="inline-block text-[11pt] border-b-[1px] border-black w-[3.67in] h-[11.5pt] align-middle text-center pl-[3px] leading-[11.5pt]"></span>
                    </div>
                    {{-- Credit Rep-Credit Reference --}}
                    <div class="flex ml-[0.6in]"><span class="mr-[0.4in]">E.</span>Three (3) credit references in the Philippines:</div>
                    <div class="ml-[0.6in]">
                        <table id="credit-reference-table" class="border-collapse w-full">
                            <thead>
                                <tr>
                                    <th class="text-center border-black border-[1px]">Name</th>
                                    <th  class="text-center border-black border-[1px]">Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[22pt]"></td></tr>
                                <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[22pt]"></td></tr>
                                <tr><td class="border-black border-[1px] h-[11pt]"></td><td class="border-black border-[1px] h-[22pt]"></td></tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- Signature --}}
                    <div class="mt-20pt border-t-[2px] border-black w-[2.37in] text-center text-[10pt] font-bold -rotate-90 origin-top-left">
                        (Signature of Applicant)
                    </div>
                    {{-- Section XI-Arrest Record --}}
                    <div class="font-bold text-[12pt]"><span class="mr-[0.4in]">XI.</span>ARREST RECORD AND CONDUCT:</div>
                    {{-- Arrest Record-Self Investigation --}}
                    <div class="ml-[0.6in]"><span class="mr-[0.4in]">A.</span>Have you ever been investigated/arrested, Indicted or convicted for any violation of law?
                        No ( <span id="no-personal-arrest" class="inline-block text-[11pt] h-[11pt] align-middle text-center"></span> )
                        Yes ( <span id="personal-arrest" class="inline-block text-[11pt] h-[11pt] align-middle text-center"></span> )
                        If so, state name of court, nature of offense and disposition of case:
                    </div>
                    <div id="personal-arrest-detail" class="w-[6.9in] ml-[0.6in] h-[23pt] indent-[0.3in] text-[11pt] leading-[15.3px] bg-[length:100%_15.3px] bg-repeat-y bg-[linear-gradient(to_bottom,_transparent_13.5px,_black_13.5px,_black_14.5px,_transparent_14.5px)]"></div>
                    {{-- Arrest-Record-Family Investigation --}}
                    <div class="ml-[0.6in]"><span class="mr-[0.4in]">B.</span>Has any member of your family ever been investigated/arrested, indicted or convicted for any violation of law?
                        No ( <span id="no-fam-arrest" class="inline-block text-[11pt] h-[11pt] align-middle text-center"></span> )
                        Yes ( <span id="fam-arrest" class="inline-block text-[11pt] h-[11pt] align-middle text-center"></span> ) If so, state name of court, nature of offense and disposition of case:
                    </div>
                    <div id="fam-arrest-detail" class="w-[6.9in] ml-[0.6in] h-[23pt] indent-[0.3in] text-[11pt] leading-[15.3px] bg-[length:100%_15.3px] bg-repeat-y bg-[linear-gradient(to_bottom,_transparent_13.5px,_black_13.5px,_black_14.5px,_transparent_14.5px)]"></div>
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
                <br>
                {{-- Page 8 --}}
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
                    {{-- Arrest-Record-Admin Case --}}
                    <div class="ml-[0.6in] mt-[90pt]"><span class="mr-[0.4in]">C.</span>Have you ever been charge of any administrative case?
                        No ( <span id="no-admin-case" class="inline-block text-[11pt] h-[11pt] align-middle text-center"></span> )
                        Yes ( <span id="admin-case" class="inline-block text-[11pt] h-[11pt] align-middle text-center"></span> ) If so explain:
                    </div>
                    <div id="admin-case-detail" class="w-[6.9in] ml-[0.6in] h-[34.5pt] indent-[0.3in] text-[11pt] leading-[15.3px] bg-[length:100%_15.3px] bg-repeat-y bg-[linear-gradient(to_bottom,_transparent_13.5px,_black_13.5px,_black_14.5px,_transparent_14.5px)]"></div>
                    {{-- Arrest Record-1081 --}}
                    <div class="mt-3.5 ml-[0.6in]"><span class="mr-[0.4in]">D.</span>Have you ever been arrested or detained pursuant to the provisions of PD 1081 and its implementing orders
                        (GO, PD, LOI)?
                        No ( <span id="no-provison-arrest" class="inline-block text-[11pt] h-[11pt] align-middle text-center"></span> )
                        Yes ( <span id="provision-arrest" class="inline-block text-[11pt] h-[11pt] align-middle text-center"></span> )  If so, state the nature of offense and disposition of case.
                    </div>
                    <div id="provision-arrest-detail" class="w-[6.9in] ml-[0.6in] h-[23pt] indent-[0.3in] text-[11pt] leading-[15.3px] bg-[length:100%_15.3px] bg-repeat-y bg-[linear-gradient(to_bottom,_transparent_13.5px,_black_13.5px,_black_14.5px,_transparent_14.5px)]"></div>
                    {{-- Arrest Record-Liquor --}}
                    <div class="mt-3.5 ml-[0.6in]"><span class="mr-[0.5in]">E.</span>Do you take/use intoxicating liquor or narcotics?
                        No ( <span id="no-intake" class="inline-block text-[11pt] h-[11pt] align-middle text-center"></span> )
                        Yes ( <span id="do-intake" class="inline-block text-[11pt] h-[11pt] align-middle text-center"></span> ) If so, to what extent:
                    </div>
                    <div id="intake-extent" class="w-[6.9in] ml-[0.6in] h-[46pt] indent-[0.3in] text-[11pt] leading-[15.3px] bg-[length:100%_15.3px] bg-repeat-y bg-[linear-gradient(to_bottom,_transparent_13.5px,_black_13.5px,_black_14.5px,_transparent_14.5px)]"></div>
                    {{-- Section XII-Character --}}
                    <div class="font-bold text-[12pt]"><span class="mr-[0.5in]">XII.</span>CHARACTER AND REPUTATION:</div>
                    {{-- Character-Reference --}}
                    <div class="ml-[0.6in]"><span class="mr-[0.4in]">A.</span>Give five (5) character references (known for three (3) years or longer except your relatives):</div>
                    <table id="character-reference-table" class="border-collapse w-full mb-[5pt]">
                        <thead>
                            <tr>
                                <th class="text-center">NAME</th>
                                <th class="text-center">ADDRESS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Character-Neighbor --}}
                    <div class="mb-3.5 ml-[0.6in]"><span class="mr-[0.5in]">B.</span>List down three (3) neighbors at your present residence:</div>
                    <table id="neighbor-table" class="border-collapse w-full mb-[5pt]">
                        <thead>
                            <tr>
                                <th class="text-center">NAME</th>
                                <th class="text-center">ADDRESS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Section XIII-Organization --}}
                    <div class="font-bold text-[12pt]"><span class="mr-[0.5in]">XIII.</span>ORGANIZATION: </div>
                    {{-- Organization-Membership --}}
                    <div class="ml-[0.6in]"><span class="mr-[0.4in]">A.</span>List of organization or social groups, which you have been a member of:
                        <table id="organization-table" class="border-collapse w-full mb-[5pt]">
                            <thead>
                                <tr class="border-b border-black">
                                    <th class="text-center">Organization</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Date of Membership</th>
                                    <th class="text-center">Position held</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                </tr>
                                <tr>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                </tr>
                                <tr>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                </tr>
                                <tr>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                </tr>
                                <tr>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                    <td class="border-black border-b-[1px] h-[12pt] p-2"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- Signature --}}
                    <div class="mt-[70pt] border-t-[2px] border-black w-[2.37in] text-center text-[10pt] font-bold -rotate-90 origin-top-left">
                        (Signature of Applicant)
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
                <br>
                {{-- Page 9 --}}
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
                    <div class="mt-[60pt] w-[6.9in] ml-[0.6in] h-[23pt] indent-[0.3in] text-[11pt] leading-[15.3px] bg-[length:100%_15.3px] bg-repeat-y bg-[linear-gradient(to_bottom,_transparent_13.5px,_black_13.5px,_black_14.5px,_transparent_14.5px)]"></div>
                    {{-- Section XIV-Miscellaneous --}}
                    <div class="mt-[55pt] font-bold text-[12pt]"><span class="mr-[0.3in]">XIV.</span>MISCELLANEOUS:</div>
                    {{-- Miscellaneous-Hobbies --}}
                    <div class="ml-[0.6in]"><span class="mr-[0.4in]">A.</span>Hobbies, Sport and past time:</div>
                    <div id="hobbies" class="w-full h-[69pt] indent-[0.3in] text-[11pt] leading-[15.3px] bg-[length:100%_15.3px] bg-repeat-y bg-[linear-gradient(to_bottom,_transparent_13.5px,_black_13.5px,_black_14.5px,_transparent_14.5px)]"></div>
                    {{-- Miscellaneous-Language --}}
                    <div class="mt-[11pt]"><span class="mr-[0.5in]">B.</span>Language and Dialect (Indicate as <span class="underline">FLUENT</span>,
                        <span class="underline">FAIR</span>, or <span class="underline">POOR</span>):
                    </div>
                    <table id="language-table" class="mt-[5pt] border-collapse w-full mb-[5pt]">
                        <thead>
                            <tr>
                                <th class="text-bold text-center">Language/Dialect</th>
                                <th class="text-bold text-center">Speak</th>
                                <th class="text-bold text-center">Read</th>
                                <th class="text-bold text-center">Write</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-b-[1px] border-black p-2"></td>
                                <td class="border-b-[1px] border-black p-2"></td>
                                <td class="border-b-[1px] border-black p-2"></td>
                                <td class="border-b-[1px] border-black p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-b-[1px] border-black p-2"></td>
                                <td class="border-b-[1px] border-black p-2"></td>
                                <td class="border-b-[1px] border-black p-2"></td>
                                <td class="border-b-[1px] border-black p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-b-[1px] border-black p-2"></td>
                                <td class="border-b-[1px] border-black p-2"></td>
                                <td class="border-b-[1px] border-black p-2"></td>
                                <td class="border-b-[1px] border-black p-2"></td>
                            </tr>
                            <tr>
                                <td class="border-b-[1px] border-black p-2"></td>
                                <td class="border-b-[1px] border-black p-2"></td>
                                <td class="border-b-[1px] border-black p-2"></td>
                                <td class="border-b-[1px] border-black p-2"></td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Miscellaneous-Lie Detection Test --}}
                    <div class="ml-[0.6in]"><span class="mr-[0.4in]">C.</span>Are you willing to undergo periodic lie detection test?
                        <span  id="lie-detection" class="inline-block text-[11pt] border-b-[1px] border-black w-[2in] h-[11.5pt] align-middle text-center pl-[3px] leading-[11.5pt]"></span>
                    </div>
                    {{-- Miscellaneous-Text --}}
                    <div class="ml-[0.6in]"><span class="mr-[0.4in]">D.</span>Copy exactly the following paragraph in your own handwriting:</div>
                    <p class="mt-[5pt] indent-[1.2in]">As Luis Repaso II of 105th Xavier Ave, guzzled his way through three bottles
                    of brandy. Josephine Z Quanzing, a partner in law firm of San Diego and Ballesteros
                    located at 2879 Valley Forge St., Quezon City turned to Richard Ting, a Chinese food
                    expert from Q.W. Kwantung Company, Ltd., 346 Hadji Jairula Hussin Blvd., and said.
                    "I can't speak for my government but I'm quite sure your country and mine get together
                    for closer understanding"
                    </p>
                    <div class="w-full h-[110.5pt] indent-[0.3in] text-[11pt] leading-[15.3px] bg-[length:100%_15.3px] bg-repeat-y bg-[linear-gradient(to_bottom,_transparent_13.5px,_black_13.5px,_black_14.5px,_transparent_14.5px)]"></div>
                    {{-- Signature --}}
                    <div class="mt-[165pt] border-t-[2px] border-black w-[2.3in] text-center text-[10pt] font-bold -rotate-90 origin-top-left">
                        (Signature of Applicant)
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
                <br>
                {{-- Page 10 --}}
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
                    <p class="indent-[0.5in] mt-[110pt]">I certify that the foregoing answers are true and correct to the best of my
                        knowledge and belief and I agree that any misstatement or omission as to a material fact
                        will constitute ground for immediate denial of my application for clearance.
                    </p>
                    <p class="mt-[11pt] mb-[11pt]">Signed at <span class="border-b-[2px] w-[4.34in] border-black inline-block h-[11pt] align-text-bottom"></span>
                        Date <span class="border-b-[2px] w-[2in] border-black inline-block h-[11pt] align-text-bottom"></span></p>
                    <div class="flex ">
                        <div class="w-[2.5in] text-center border-t-[2px] border-black mt-[22pt]">(Witness)</div>
                        <div class="w-[2.5in] text-center border-t-[2px] border-black mt-[22pt] ml-auto">(Signature of Applicant)</div>
                    </div>
                    {{-- Thumbmarks / Picture --}}
                    <div class="grid grid-cols-2">
                        <div class="grid mr-auto items-center">
                            <div class="w-[2.5in] text-center border-t-[2px] border-black mt-[22pt]">(Witness)</div>
                            <div class="w-[2.36in] text-center mt-[18pt] mb-[7pt]">THUMBMARKS:</div>
                            <div class="flex">
                                <div class="border-[2px] border-black h-[1.55in] w-[1.07in] mr-[0.22in]"></div>
                                <div class="border-[2px] border-black h-[1.55in] w-[1.07in]"></div>
                            </div>
                        </div>
                        <div class="border-[2px] border-black w-[2in] h-[2in] flex justify-center items-center ml-auto text-[22pt] mt-[22pt]">2 X 2</div>
                    </div>
                    <div class="grid">
                        <div class="flex">
                            <div class="text-center text-[14pt] w-[1.07in] mr-[0.22in]">(Left)</div>
                            <div class="text-center text-[14pt] w-[1.07in]">(Right)</div>
                        </div>
                    </div>
                    <p class="mt-[20pt] indent-[0.5in]">SUBSCRIBED AND SWORN to before me this <span class="border-b-[2px] w-[1in] border-black inline-block align-baseline text-right leading-none">day</span> of
                        <span class="border-b-[2px] w-[2in] border-black inline-block h-[11pt] align-text-bottom"></span> Philippines,
                        Affiant exhibited to me his/her Community Tax Certificate Nr. <span class="border-b-[2px] w-[2in] border-black inline-block h-[11pt] align-baseline text-center leading-none"></span> Issued at
                        <span class="border-b-[2px] w-[3.5in] border-black inline-block h-[11pt] align-text-bottom"></span> on
                        <span class="border-b-[2px] w-[3in] border-black inline-block h-[11pt] align-text-bottom"></span>
                    </p>
                    <div class="flex mt-[30pt]">
                        <div class="grid ml-auto w-[3in] text-center">
                            <div class="w-full h-[50pt] indent-[0.3in] text-[11pt] leading-[20pt] bg-[length:100%_20pt] bg-repeat-y bg-[linear-gradient(to_bottom,_transparent_13.5px,_black_13.5px,_black_14.5px,_transparent_14.5px)]"></div>
                            (Administering Officer)
                        </div>
                    </div>
                    {{-- Signature --}}
                    <div class="mt-[110pt] border-t-[2px] border-black w-[2.37in] text-center text-[10pt] font-bold -rotate-90 origin-top-left">
                        (Signature of Applicant)
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
                <br>
                {{-- Page 11 --}}
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
                    <p class="font-bold text-center text-[12pt] mt-[150pt] mb-[550pt]">SKETCH OF THE LOCATION OF RESIDENCE</p>
                    {{-- Signature --}}
                    <div class="border-t-[2px] border-black w-[2.37in] text-center text-[10pt] font-bold -rotate-90 origin-top-left">
                        (Signature of Applicant)
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
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function printPHSTemplate() {
    const printContents = document.getElementById('phs-print-section').innerHTML;
    const originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    window.location.reload(); // reload to restore event handlers and scripts
}
</script>
@endpush
