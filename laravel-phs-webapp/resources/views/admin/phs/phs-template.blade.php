@extends('layouts.phs-template')
@extends('layouts.admin')

@section('title', 'Print PHS Document')

@section('content')

    <!-- Back Navigation and Card Header (hidden on print) -->
    <div class="no-print">
        <div class="flex items-center justify-between mb-4">
            <a href="{{ route('admin.phs.index') }}" 
               class="inline-flex items-center text-[#1B365D] hover:text-[#2B4B7D] font-medium transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to List
            </a>
        </div>
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-[#1B365D]/10 to-[#2B4B7D]/10 px-8 py-6 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] text-white shadow-lg">
                        <i class="fas fa-print text-xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900">Print PHS Template</h1>
                </div>
                <div class="flex items-center gap-3">
                    <button onclick="printPHSForm()" class="print-btn">
                        <i class="fas fa-print"></i> Print Form
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div class="phs-page text-justify font-sans text-[11pt] bg-white">
        {{-- Title --}}
        <p class="text-[9pt] text-right mt-[60pt]">File Nr:_______</p>
        <p class="text-[9pt] text-left">GHQ, OJ2</p>
        <p class="text-[9pt] text-left">200-054 Form</p>
        <p class="text-[12pt] font-bold text-center">
            <span class="underline">PERSONAL</span>
            <span class="underline">HISTORY</span>
            <span class="underline">STATEMENT</span>
        </p>

        {{-- Instruction --}}
        <p class="text-[12pt] font-bold tracking-[3px] text-center underline mt-[12pt] mb-[11pt]">INSTRUCTIONS</p>
        <p class="mb-[10pt]"><span class="ml-[0.5in] mr-[0.5in]">1.</span>Answer all questions completely; if question is not applicable, write "NA".write "Unknown"
            only if you do not know the answer and cannot obtain the answer from personal records.
            Use the blank pages at the back of this form for extra details on any question for which you
            do not have sufficient space.
        </p>
        <p><span class="ml-[0.5in] mr-[0.5in]">2.</span>Write carefully, Illegible or incomplete forms will not receive consideration.</p>

        {{-- Warning --}}
        <p class="text-[12pt] font-bold tracking-[3px] text-center underline mt-[12pt] mb-[11pt]">WARNING</p>
        <p class="mb-[10pt]"><span class="ml-[0.5in] mr-[0.5in]">1.</span>The correctness of all statement of entries made herein will be investigated.</p>
        <p class="mb-[10pt]"><span class="ml-[0.5in] mr-[0.5in]">2.</span>Any deliberate omission or distortion of material facts may give sufficient cause for denial of clearance.</p>
        <p class="mb-[10pt]"><span class="ml-[0.5in] mr-[0.5in]">3.</span>The statements made herein are classified CONFIDENTIAL. Revelation or use for other than the authorized
            purpose is prohibited by AFPR G-200-054.</p>

        {{-- Section I - Personal Detail --}}
        <div class="font-bold"><span class="mr-[0.5in]">I.</span><span>PERSONAL DETAIL</span></div>

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
        <div class="flex ml-[0.6in]"><span class="mr-[0.5in]">C.</span>Present Job/Assignment:
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
    </div>

    
@endsection

@section('page2')
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
                </div>
@endsection

@section('page3')
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
@endsection

{{-- <script>
let hasPrinted = false;
function printPHSForm() {
    if (hasPrinted) return;
    hasPrinted = true;
    // Hide all UI except print content
    const noPrintEls = document.querySelectorAll('.no-print, .print-btn');
    noPrintEls.forEach(el => el.style.display = 'none');
    document.body.classList.add('phs-printing');
    window.print();
    setTimeout(() => {
        noPrintEls.forEach(el => el.style.display = '');
        document.body.classList.remove('phs-printing');
    }, 500);
}
</script> --}}

<style>
@media print {
    body.phs-printing > *:not(.phs-header):not(.phs-footer):not(.phs-page) {
        display: none !important;
    }
    .phs-header, .phs-footer, .phs-page {
        display: block !important;
    }
    .print-btn {
        display: none !important;
    }
}
</style>