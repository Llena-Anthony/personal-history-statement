<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title','Print PHS Document')</title>

        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/print-prev.css'])

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('public/build/assets/print-prev.css') }}"
        {{-- <link rel="stylesheet" href="{{ asset('../css/print-prev.css') }}" --}}

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    </head>

    <body>
        <button onclick="printDiv()">Print</button>

		<div id="printable-area">
            {{-- Page 1 --}}
            <div class="page">

                <div class="header">
                    <p class='confidential'">
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class='vision'>AFP Vision 2028: A World-class Armed Forces, Source of National Pride</p>
                    <p id='annex'>ANNEX A of AFPR G 200-054 dtd 22 September 2014, cont’n:</p>
                </div>

                <p id='fnr'>File Nr:_______</p>
                <p id='ghq' class='up'>GHQ, OJ2</p>
                <p id='num-form' class='up'>200-054 Form</p>
                <p id='doc-title'>
                    <span>PERSONAL</span>
                    <span>HISTORY</span>
                    <span>STATEMENT</span>
                </p>
                <p class='instruc'>INSTRUCTIONS</p>
                <p><span class='list-num'>1.</span>Answer all questions completely; if question is not applicable, write “NA”.write “Unknown”
                    only if you do not know the answer and cannot obtain the answer from personal records.
                    Use the blank pages at the back of this form for extra details on any question for which you
                    do not have sufficient space.
                </p>
                <p><span class='list-num'>2.</span>Write carefully, Illegible or incomplete forms will not receive consideration.</p>
                <p class='instruc'>WARNING</p>
                <p><span class='list-num'>1.</span>The correctness of all statement of entries made herein will be investigated.</p>
                <p><span class='list-num'>2.</span>Any deliberate omission or distortion of material facts may give sufficient cause for denial of clearance.</p>
                <p><span class='list-num'>3.</span>The statements made herein are classified CONFIDENTIAL. Revelation or use for other than the authorized
                    purpose is prohibited by AFPR G-200-054.</p>

                <div class="section-name"><span class="list-rom">I.</span><span class="section-title">PERSONAL DETAIL</span>
                    <div class="signature mt-[180pt]" id="personal">
                        <span class="sign">(Signature of Applicant)</span>
                    </div>

                    <div class="mt-[-190pt] ml-[0.6in]"><span class="mr-[0.5in]">A.</span>
                        Name:<div class="border-b border-black text-[11pt] text-left ml-auto w-[5.65in] pl-2"></div>
                    </div>
                    <div class="ml-[1.8in] text-center">
                        <span class="mr-[0.9in]">(Last Name)</span>
                        <span class="mr-[0.7in]">(First Name)</span>
                        <span>(Middle Name)</span>
                    </div>
                    <div class="flex"><span class="mr-[0.5in]">B.</span>
                        Rank:<div class="border-b border-black text-[11pt] text-left ml-auto w-[1.2in] pl-2"></div>
                        AFPSN:<div class="border-b border-black text-[11pt] text-left ml-auto w-[1.65in] pl-2"></div>
                        Br of Svc:<div class="border-b border-black text-[11pt] text-left ml-auto w-[1.7in] pl-2"></div>
                    </div>
                    <div  class="flex"><span class="mr-[0.5in]">C.</span>Present Job/Assignment:
                        <div class="border-b border-black text-[11pt] text-left ml-auto w-[4.45in] pl-2"></div>
                    </div>
                    <div class="flex"><span class="mr-[0.5in]">D.</span>Business or Duty Address:
                        <div class="border-b border-black text-[11pt] text-left ml-auto w-[4.35in] pl-2"></div>
                    </div>
                    <div class="flex"><span class="mr-[0.5in]">E.</span>Home Address:
                        <div class="border-b border-black text-[11pt] text-left ml-auto w-[5.1in] pl-2"></div>
                    </div>
                    <div class="flex"><span class="mr-[0.5in]">F.</span>
                        Birth Date:<div class="border-b border-black text-[11pt] text-left ml-auto w-[1.5in] pl-2"></div>
                        Place of Birth:<div class="border-b border-black text-[11pt] text-left ml-auto w-[3in] pl-2"></div>
                    </div>
                    <div class="flex"><span class="mr-[0.5in]">G.</span>CHANGE IN NAME (If by Court Action, give details):
                        <div class="border-b border-black text-[11pt] text-left ml-auto w-[2.6in] pl-2"></div>
                    </div>
                    <div class="flex"><span class="mr-[0.5in]">H.</span>
                        NICKNAMES: <div class="border-b border-black text-[11pt] text-left ml-auto w-[3in] pl-2"></div>
                        NATIONALITY:<div class="border-b border-black text-[11pt] text-left ml-auto w-[1.2in] pl-2"></div>
                    </div>
                    <div class="flex"><span class="mr-[0.5in]">I.</span>
                        TAX IDENTIFICATION NR:<div class="border-b border-black text-[11pt] text-left ml-auto w-[2in] pl-2"></div>
                        RELIGION:<div class="border-b border-black text-[11pt] text-left ml-auto w-[1.5in] pl-2"></div>
                    </div>
                    <div class="flex"><span class="mr-[0.5in]">J.</span>
                        MOBILE NR:<div class="border-b border-black text-[11pt] text-left ml-auto w-[1.5in] pl-2"></div>
                        EMAIL ADDRESS:<div class="border-b border-black text-[11pt] text-left ml-auto w-[2.5in] pl-2"></div>
                    </div>
                    <div class="flex"><span class="mr-[0.5in]">K.</span>
                        PASSPORT NR:<div class="border-b border-black text-[11pt] text-left ml-auto w-[1.5in] pl-2"></div>
                        DATE OF EXPIRATION:<div class="border-b border-black text-[11pt] text-left ml-auto w-[1.9in] pl-2"></div>
                    </div>
                </div>

                <div class="footer">
                    <p class='confidential'>
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class="vision">AFP Core Values: Honor, Service, Patriotism</p>
                </div>
            </div>

            {{-- Page 2 --}}
            <div class="page">

                <div class="header">
                    <p class='confidential'">
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class='vision'>AFP Vision 2028: A World-class Armed Forces, Source of National Pride</p>
                    <p id='annex'>ANNEX A of AFPR G 200-054 dtd 22 September 2014, cont’n:</p>
                </div>

                <div class="section-name mt-[70pt]"><span class="list-rom">II.</span><span class="section-title">PERSONAL CHARACTERISTICS:</span>
                    <div class="flex"><span class="mr-[0.5in]">A.</span>DESCRIPTION:
                        Sex: <div class="border-b border-black text-[11pt] text-left ml-auto w-[1in] pl-2"></div>
                        Age: <div class="border-b border-black text-[11pt] text-left ml-auto w-[0.5in] pl-2"></div>
                        Height: (mtrs) <div class="border-b border-black text-[11pt] text-left ml-auto w-[0.5in] pl-2"></div>
                        Weight: (kgs) <div class="border-b border-black text-[11pt] text-left ml-auto w-[0.5in] pl-2"></div>
                    </div>
                    <div class="flex ml-[1.3in]">Body Build: (Heavy, Medium, Light)
                        <div class="border-b border-black text-[11pt] text-left ml-auto w-[3.75in] pl-2"></div>
                    </div>
                    <div class="flex ml-[1.3in]">Complexion: (Dark, Fair, Light)
                        <div class="border-b border-black text-[11pt] text-left ml-auto w-[1.5in] pl-2"></div>
                        Color of eyes:
                        <div class="border-b border-black text-[11pt] text-left ml-auto w-[1.5in] pl-2"></div>
                    </div>
                    <div class="flex ml-[1.3in]">
                        Color of Hair:<div class="border-b border-black text-[11pt] text-left ml-auto w-[0.8in] mr-[0.05in] pl-2"></div>
                        Scar or Mark & Other distinguishing Feature:<div class="border-b border-black text-[11pt] text-left ml-auto w-[1.3in] pl-2"></div>
                    </div>
                    <div><span class="mr-[0.5in]">B.</span>PHYSICAL CONDITION:</div>
                    <div class="flex ml-[1.3in]">Present state of health (Excellent, Good, Poor)
                        <div class="border-b border-black text-[11pt] text-left ml-auto w-[3in] pl-2"></div>
                    </div>
                    <div class="flex ml-[1.3in]">Recent Serious Illness:
                        <div class="border-b border-black text-[11pt] text-left ml-auto w-[4.6in] pl-2"></div>
                    </div>
                    <div class="flex ml-[1.3in]">Blood Type:
                        <div class="border-b border-black text-[11pt] text-left ml-auto w-[5.3in] pl-2"></div>
                    </div>
                </div>

                <div class="section-name"><span class="list-rom">III.</span><span class="section-title">MARITAL STATUS:</span>
                    <div><span class="mr-[0.5in]">A.</span>MARITAL STATUS:
                        <div class="border-b border-black text-[11pt] text-left ml-auto w-[4.8in]"></div>
                        <div class="text-center ml-auto w-[4.8in]">(Single, Married, Separated or Widowed)</div>
                    </div>
                    <div>
                        <div>
                            <span class="mr-[0.5in]">B.</span>NAME OF SPOUSE:
                            <div class="border-b border-black text-[11pt] text-left ml-auto w-[4.7in]"></div>
                            <div class="pl-[1in] ml-auto w-[5in]">(Full Name)</div>
                        </div>
                        <div class="ml-[1.35in]">Date and Place of Birth:<div class="border-b border-black text-[11pt] text-left ml-auto w-[4.5in]"></div></div>
                        <div class="ml-[1.35in]">Complete Address:<div class="border-b border-black text-[11pt] text-left ml-auto w-[4.8in]"></div> </div>
                        <div class="ml-[1.35in]">Occupation/Employer/Place of Employment:
                            <div class="border-b border-black text-[11pt] text-left ml-auto w-[3.1in]"></div>
                        </div>
                        <div class="ml-[1.35in] border-b border-black align-bottom text-[11pt] text-left h-[20pt]"></div>
                        <div class="ml-[1.35in] flex">
                            <div>Contact Number:
                                <div class="border-b border-black w-[1.15in] ml-[1.2in] pl-2 text-[11pt]"></div>
                            </div>
                            <div class="pl-2"> Citizenship:
                                <div class="border-b border-black w-[1.2in] ml-[0.8in] pl-2 text-[11pt]"></div>
                            </div>
                            <div>If dual,
                                <div class="border-b border-black w-[1.2in] ml-[0.5in] pl-2 text-[11pt]"></div>
                            </div>
                        </div>
                        <div class="ml-[6in]">(other Citizenship)</div>
                    </div>
                    <div class="signature mt-[60pt] ml-[0.4in]" id="marital">
                        <span class="sign">(Signature of Applicant)</span>
                    </div>
                    <div class="mt-[-80pt]"><span class="mr-[0.5in]">C.</span>CHILDREN:</div>
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
                    <div class="w-full text-center font-bold underline decoration-2">(Use back page for additional information)</div>
                </div>

                <div class="section-name"><span class="list-rom">IV.</span><span class="section-title">FAMILY HISTORY AND INFORMATION:</span>
                    <div>
                        <span class="mr-[0.5in]">A.</span>
                        FATHER: <div class="border-b border-black text-[11pt] text-left ml-auto w-[5.4in]"></div>
                        <div class="pl-[1in] ml-auto w-[5in]">(Full Name)</div>
                    </div>
                    <div class="ml-[1.35in]">Date and Place of Birth:<div class="border-b border-black text-[11pt] text-left ml-auto w-[4.5in]"></div></div>
                    <div class="ml-[1.35in]">Complete Address:<div class="border-b border-black text-[11pt] text-left ml-auto w-[4.8in]"></div> </div>
                    <div class="ml-[1.35in]">Occupation/Employer/Place of Employment:
                        <div class="border-b border-black text-[11pt] text-left ml-auto w-[3.1in]"></div>
                    </div>
                </div>

                <div class="footer">
                    <p class='confidential'>
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class="vision">AFP Core Values: Honor, Service, Patriotism</p>
                </div>
            </div>

            {{-- Page 3 --}}
            <div class="page">
                <div class="header">
                    <p class='confidential'">
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class='vision'>AFP Vision 2028: A World-class Armed Forces, Source of National Pride</p>
                    <p id='annex'>ANNEX A of AFPR G 200-054 dtd 22 September 2014, cont’n:</p>
                </div>

                <div class="section-name mt-[65pt]">
                    <div class="ml-[1.35in]">Citizenship: <span class="citizenship inline-block border-b border-black w-32 align-bottom"> </span>
                        If dual, write both citizenship. If naturalized, give date and place where naturalized:
                        <span class="citizenship inline-block border-b border-black w-[4.4in] align-bottom"> </span>
                    </div>

                    <div class="mt-10pt">
                        <div>
                            <span class="mr-[0.5in]">B.</span>
                            Mother: <div class="border-b border-black text-[11pt] text-left ml-auto w-[5.6in]"></div>
                            <div class="pl-[1in] ml-auto w-[5.6in]">(Full Name)</div>
                        </div>
                        <div class="ml-[1.35in]">Date and Place of Birth:<div class="border-b border-black text-[11pt] text-left ml-auto w-[4.5in]"></div></div>
                        <div class="ml-[1.35in]">Complete Address:<div class="border-b border-black text-[11pt] text-left ml-auto w-[4.8in]"></div> </div>
                        <div class="ml-[1.35in]">Occupation/Employer/Place of Employment: <div class="border-b border-black text-[11pt] text-left ml-auto w-[3.1in]"></div></div>
                        <div class="ml-[1.35in]">Citizenship: <span class="citizenship inline-block border-b border-black w-32 align-bottom"> </span>
                            If dual, write both citizenship. If naturalized, give date and place where naturalized:
                            <span class="citizenship inline-block border-b border-black w-[4.4in] align-bottom"> </span>
                        </div>
                    </div>
                    <div class="mt-[10pt] mb-[10pt]"><span class="mr-[0.5in]">C.</span>Brothers and Sisters:</div>
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
                            <span class="mr-[0.5in]">D.</span>
                            STEP-PARENT OR GUARDIAN: <div class="border-b border-black text-[11pt] text-left ml-auto w-[3.8in]"></div>
                            <div class="pl-[1in] ml-auto w-[4in]">(Full Name)</div>
                        </div>
                        <div class="ml-[1.35in]">Date and Place of Birth:<div class="border-b border-black text-[11pt] text-left ml-auto w-[4.5in]"></div></div>
                        <div class="ml-[1.35in]">Complete Address:<div class="border-b border-black text-[11pt] text-left ml-auto w-[4.8in]"></div> </div>
                        <div class="ml-[1.35in]">Occupation/Employer/Place of Employment: <div class="border-b border-black text-[11pt] text-left ml-auto w-[3.1in]"></div></div>
                        <div class="ml-[1.35in]">Citizenship: <span class="citizenship inline-block border-b border-black w-32 align-bottom"> </span>
                            If dual, write both citizenship. If naturalized, give date and place where naturalized:
                            <span class="citizenship inline-block border-b border-black w-[4.4in] align-bottom"> </span>
                        </div>
                    </div>
                    <div class="signature ml-[0.4in] mt-[75pt]" id="parent">
                        <span class="sign">(Signature of Applicant)</span>
                    </div>
                    <div class="mt-[-80pt]">
                        <span class="mr-[0.5in]">E.</span>
                        FATHER-IN-LAW: <div class="border-b border-black text-[11pt] text-left ml-auto w-[4.9in]"></div>
                        <div class="pl-[1in] ml-auto w-[4.5in]">(Full Name)</div>
                    </div>
                    <div class="ml-[1.35in]">Date and Place of Birth:<div class="border-b border-black text-[11pt] text-left ml-auto w-[4.5in]"></div></div>
                    <div class="ml-[1.35in]">Complete Address:<div class="border-b border-black text-[11pt] text-left ml-auto w-[4.8in]"></div> </div>
                    <div class="ml-[1.35in]">Occupation/Employer/Place of Employment: <div class="border-b border-black text-[11pt] text-left ml-auto w-[3.1in]"></div></div>
                    <div class="ml-[1.35in]">Citizenship: <span class="citizenship inline-block border-b border-black w-32 align-bottom"> </span>
                        If dual, write both citizenship. If naturalized, give date and place where naturalized:
                        <span class="citizenship inline-block border-b border-black w-[4.4in] align-bottom"> </span>
                    </div>
                    <div class="mt-[10pt]">
                        <span class="mr-[0.5in]">F.</span>
                        MOTHER-IN-LAW: <div class="border-b border-black text-[11pt] text-left ml-auto w-[4.8in]"></div>
                        <div class="pl-[1in] ml-auto w-[4.5in]">(Full Name)</div>
                    </div>
                </div>

                <div class="footer">
                    <p class='confidential'>
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class="vision">AFP Core Values: Honor, Service, Patriotism</p>
                </div>
            </div>

            {{-- Page 4 --}}
            <div class="page">

                <div class="header">
                    <p class='confidential'">
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class='vision'>AFP Vision 2028: A World-class Armed Forces, Source of National Pride</p>
                    <p id='annex'>ANNEX A of AFPR G 200-054 dtd 22 September 2014, cont’n:</p>
                </div>

                <div id="partial-inlaw">
                    <div>Date and Place of Birth:
                        <div id="m-inlaw-birth" class="text-[11pt] text-left border-b border-black ml-auto w-[4.4in]"></div>
                    </div>
                    <div>Complete Address:
                        <div id="m-inlaw-birth" class="text-[11pt] text-left border-b border-black ml-auto w-[4.75in]"></div>
                    </div>
                    <div>Occupation/Employer/Place of Employment:
                        <div id="m-inlaw-birth" class="text-[11pt] text-left border-b border-black ml-auto w-[3in]"></div>
                    </div>
                    <div>Citizenship: <span class="citizenship inline-block border-b border-black w-32 align-bottom"> </span>
                        If dual, write both citizenship. If naturalized, give date and place where naturalized:
                        <span class="citizenship inline-block border-b border-black w-2/3 align-bottom"> </span>
                    </div>
                </div>

                <div class="section-name"><span class="list-rom">V.</span><span class="section-title">EDUCATIONAL BACKGROUND:</span>
                    <div class="flex">
                        <span class="mr-[0.5in]">A.</span>
                        <div class="educ-level w-20 mr-32">Elementary</div>
                        <div class="'educ-addr w-20 mr-28">Location</div>
                        <div class="educ-attend w-14 mr-16">Date of Attendance</div>
                        <div class="educ-grad w-14">Year Graduated</div>
                    </div>

                    <table class="educ-table table-auto border-collapse w-full">
                        <tbody>
                            <tr>
                                <td class="w-2/5"></td>
                                <td class="w-[2.3in]"></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td class="w-2/5"></td>
                                <td class="w-[2.3in]"></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td class="w-2/5"></td>
                                <td class="w-[2.3in]"></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td class="w-2/5"></td>
                                <td class="w-[2.3in]"></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td class="w-2/5"></td>
                                <td class="w-[2.3in]"></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td class="w-2/5"></td>
                                <td class="w-[2.3in]"></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td class="w-2/5"></td>
                                <td class="w-[2.3in]"></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="flex mt-4">
                        <span class="mr-[0.5in]">B.</span>
                        <div class="educ-level w-32 mr-20">High School:</div>
                        <div class="'educ-addr w-20 mr-28">Location</div>
                        <div class="educ-attend w-14 mr-16">Date of Attendance</div>
                        <div class="educ-grad w-14">Year Graduated</div>
                    </div>

                    <table class="educ-table table-auto border-collapse w-full">
                        <tbody>
                            <tr>
                                <td class="w-2/5"></td>
                                <td class="w-[2.3in]"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-2/5"></td>
                                <td class="w-[2.3in]"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-2/5"></td>
                                <td class="w-[2.3in]"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-2/5"></td>
                                <td class="w-[2.3in]"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-2/5"></td>
                                <td class="w-[2.3in]"></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="flex mt-4">
                        <span class="mr-[0.5in]">C.</span>
                        <div class="educ-level w-20 mr-32">College:</div>
                        <div class="'educ-addr w-20 mr-28">Location</div>
                        <div class="educ-attend w-14 mr-16">Date of Attendance</div>
                        <div class="educ-grad w-14">Year Graduated</div>
                    </div>

                    <table class="educ-table table-auto border-collapse w-full">
                        <tbody>
                            <tr>
                                <td class="w-2/5"></td>
                                <td class="w-[2.3in]"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-2/5"></td>
                                <td class="w-[2.3in]"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-2/5"></td>
                                <td class="w-[2.3in]"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-2/5"></td>
                                <td class="w-[2.3in]"></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="flex mt-4">
                        <span class="mr-[0.5in]">D.</span>
                        <div class="educ-level w-32 mr-20">Post Graduate:</div>
                        <div class="'educ-addr w-20 mr-28">Location</div>
                        <div class="educ-attend w-14 mr-16">Date of Attendance</div>
                        <div class="educ-grad w-14">Year Graduated</div>
                    </div>

                    <div class="ml-[0.8in]">
                        <table class="educ-table table-auto border-collapse w-full">
                            <tbody>
                                <tr>
                                    <td class="w-2/5"></td>
                                    <td class="w-[2.3in]"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="w-2/5"></td>
                                    <td class="w-[2.3in]"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="w-2/5"></td>
                                    <td class="w-[2.3in]"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="w-2/5"></td>
                                    <td class="w-[2.3in]"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4"><span class="mr-[0.5in]">E.</span>Other Schools/Training Attended and Date of Attendance: </div>
                    <div id="other-school" class="ml-[1.3in] text-[11pt] text-left">
                        <hr class="h-[11pt] border-none border-t border-black">
                        <hr class="h-[11pt] border-t border-black">
                        <hr class="h-[11pt] border-b border-black">
                    </div>
                    <div class="mt-4"><span class="mr-[0.5in]">F.</span>Civil Service, If any and other Similar Qualification Acquired: </div>
                    <div id="civil-service" class="ml-[1.3in] text-[11pt] text-left border-b border-black h-[11.5pt] w-[4in]">
                    </div>
                    <div class="signature mt-[-6pt] ml-[0.3in]" id="educational">
                        <hr>
                        <span class="sign">(Signature of Applicant)</span>
                    </div>
                </div>

                <div class="footer">
                    <p class='confidential'>
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class="vision">AFP Core Values: Honor, Service, Patriotism</p>
                </div>
            </div>

            {{-- Page 5 --}}
            <div class="page">
                <div class="header">
                    <p class='confidential'">
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class='vision'>AFP Vision 2028: A World-class Armed Forces, Source of National Pride</p>
                    <p id='annex'>ANNEX A of AFPR G 200-054 dtd 22 September 2014, cont’n:</p>
                </div>

                <div class="section-name" id="military-hist"><span class="list-rom">VI.</span><span class="section-title">MILITARY HISTORY:</span>
                    <div><span class="mr-[0.5in]">A.</span>Date Enlisted in AFP: <div id="date-enlist"></div></div>
                    <div class="flex"><span class="mr-[0.5in]">B.</span>Date of Commision: <div class="date-comm"></div> <span>:</span> <div class="date-comm"></div> </div>
                    <div><span class="mr-[0.5in]">C.</span>Source of Commission: <div id="source-comm"></div> </div>
                    <div><span class="mr-[0.5in]">D.</span>Important Unit Assignment since enlisted/CAD</div>
                    <table class="unit-assign">
                        <thead>
                            <tr>
                                <th>INCLUSIVE DATES</th>
                                <th>UNIT/OFFICE</th>
                                <th>CO/CHIEF OF OFFICE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td></td><td></td><td></td></tr> <tr><td></td><td></td><td></td></tr>
                            <tr><td></td><td></td><td></td></tr> <tr><td></td><td></td><td></td></tr>
                            <tr><td></td><td></td><td></td></tr> <tr><td></td><td></td><td></td></tr>
                            <tr><td></td><td></td><td></td></tr> <tr><td></td><td></td><td></td></tr>
                            <tr><td></td><td></td><td></td></tr> <tr><td></td><td></td><td></td></tr>
                            <tr><td></td><td></td><td></td></tr> <tr><td></td><td></td><td></td></tr>
                            <tr><td></td><td></td><td></td></tr>
                        </tbody>
                    </table>
                    <div class="additional"><span>(Use Separate Sheet for Additional Information)</span></div>

                    <div><span class="mr-[0.5in]">E.</span>Military Schools Attended</div>
                    <div class="ml-14 mt-4">
                        <table class="military-school">
                            <thead>
                                <tr>
                                    <th>School/Location</th>
                                    <th>Date of Attendance</th>
                                    <th>Nature of Training</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td></td><td></td><td></td><td></td></tr> <tr><td></td><td></td><td></td><td></td></tr>
                                <tr><td></td><td></td><td></td><td></td></tr> <tr><td></td><td></td><td></td><td></td></tr>
                                <tr><td></td><td></td><td></td><td></td></tr> <tr><td></td><td></td><td></td><td></td></tr>
                                <tr><td></td><td></td><td></td><td></td></tr> <tr><td></td><td></td><td></td><td></td></tr>
                                <tr><td></td><td></td><td></td><td></td></tr> <tr><td></td><td></td><td></td><td></td></tr>
                                <tr><td></td><td></td><td></td><td></td></tr> <tr><td></td><td></td><td></td><td></td></tr>
                                <tr><td></td><td></td><td></td><td></td></tr> <tr><td></td><td></td><td></td><td></td></tr>
                                <tr><td></td><td></td><td></td><td></td></tr> <tr><td></td><td></td><td></td><td></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="signature" id="military">
                        <span class="sign">(Signature of Applicant)</span>
                    </div>
                </div>

                <div class="footer">
                    <p class='confidential'>
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class="vision">AFP Core Values: Honor, Service, Patriotism</p>
                </div>
            </div>

            {{-- Page 6 --}}
            <div class="page">

                <div class="header">
                    <p class='confidential'">
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class='vision'>AFP Vision 2028: A World-class Armed Forces, Source of National Pride</p>
                    <p id='annex'>ANNEX A of AFPR G 200-054 dtd 22 September 2014, cont’n:</p>
                </div>

                <div id="awards-div"><span class="mr-[0.5in]">F.</span>Decorations, Awards or Commendations Received: </div>
                <table id="awards-table">
                    <tbody>
                        <tr><td></td></tr><tr><td></td></tr>
                        <tr><td></td></tr><tr><td></td></tr>
                        <tr><td></td></tr><tr><td></td></tr>
                        <tr><td></td></tr><tr><td></td></tr>
                        <tr><td></td></tr><tr><td></td></tr>
                        <tr><td></td></tr><tr><td></td></tr>
                        <tr><td></td></tr><tr><td></td></tr>
                        <tr><td></td></tr><tr><td></td></tr>
                        <tr><td></td></tr><tr><td></td></tr>
                        <tr><td></td></tr><tr><td></td></tr>
                        <tr><td></td></tr><tr><td></td></tr>
                        <tr><td></td></tr><tr><td></td></tr>
                    </tbody>
                </table>
                <div class="additional"><span>(Use Separate Sheet for Additional Information)</span></div>
                <div class="section-name"><span class="list-rom">VII.</span><span class="section-title">PLACES OF RESIDENCE SINCE BIRTH:</span> </div>
                <table id="residence-table">
                    <tbody>
                        <tr class="border-t border-black"><td></td></tr><tr><td></td></tr>
                        <tr><td></td></tr><tr><td></td></tr>
                        <tr><td></td></tr><tr><td></td></tr>
                        <tr><td></td></tr><tr><td></td></tr>
                        <tr><td></td></tr>
                    </tbody>
                </table>

                <div class="section-name"><span class="list-rom">VIII.</span><span class="section-title">EMPLOYMENT:</span>
                    <table class="employment-table">
                        <thead>
                            <tr>
                                <th>Inclusive Dates</th>
                                <th>Type of Employment</th>
                                <th>Name/Address</th>
                                <th>Reason for Leaving</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-t border-black">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="signature" id="employ">
                    <span class="sign">(Signature of Applicant)</span>
                </div>
                <div class="footer">
                    <p class='confidential'>
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class="vision">AFP Core Values: Honor, Service, Patriotism</p>
                </div>
            </div>

            {{-- Page 7 --}}
            <div class="page">

                <div class="header">
                    <p class='confidential'">
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class='vision'>AFP Vision 2028: A World-class Armed Forces, Source of National Pride</p>
                    <p id='annex'>ANNEX A of AFPR G 200-054 dtd 22 September 2014, cont’n:</p>
                </div>
                <div>Have you been dismissed or forced to resign from a position? No ( ) Yes ( ) If Yes, Explain:</div>

                <div class="section-name"><span class="list-rom">IX.</span><span class="section-title">FOREIGN COUNTRIES VISITED:</span>
                    <table>
                        <thead>
                            <tr>
                                <th>Date of Visit</th>
                                <th>Country Visited</th>
                                <p>Purpose of visit</p>
                                <p>Address Abroad</p>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="section-name"><span class="list-rom">X.</span><span class="section-title">CREDIT REPUTATION:</span>
                    <div><span class="mr-[0.5in]">A.</span>Are you entirely dependent on your salary? Yes ( ) No ( ) If no, State other source of income: </div>
                    <div><span class="mr-[0.5in]">B.</span>Name and address of Banks or other credit institutions with which you have accounts/loans:</div>
                    <div><span class="mr-[0.5in]">C.</span>Have you filed a statementr of your Assets and Liabilities with any government Agency?
                        <p>Yes ( ) No ( ) If so, what Agency and when?</p>
                    </div>
                    <div><span class="mr-[0.5in]">D.</span>Have you filed your latest Income Tax Returns?</div>
                    <div>Amount paid for last Calendar Year:</div>
                    <div><span>E.</span>Three (3) credit references in the Philippines:
                        <table class="credit-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="signature" id="credit">
                        <hr>
                        <span class="sign">(Signature of Applicant)</span>
                    </div>
                </div>

                <div class="section-name"><span class="list-rom">XI.</span><span class="section-title">ARREST RECORD AND CONDUCT:</span>
                        <div><span class="mr-[0.5in]">A.</span>Have you ever been investigated/arrested, Indicted or convicted for any violation of law?
                            No ( ) Yes (  ) If so, state name of court, nature of offense and disposition of case:
                        </div>
                        <div><span class="mr-[0.5in]">B.</span>Has any member of your family ever been investigated/arrested, indicted or convicted for any violation of law?
                            No (  ) Yes (  ) If so, state name of court, nature of offense and disposition of case:
                        </div>
                </div>

                <div class="footer">
                    <p class='confidential'>
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class="vision">AFP Core Values: Honor, Service, Patriotism</p>
                </div>
            </div>

            {{-- Page 8 --}}
            <div class="page">

                <div class="header">
                    <p class='confidential'">
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class='vision'>AFP Vision 2028: A World-class Armed Forces, Source of National Pride</p>
                    <p id='annex'>ANNEX A of AFPR G 200-054 dtd 22 September 2014, cont’n:</p>
                </div>

                <div id="admin-case"><span class="mr-[0.5in]">C.</span>Have you ever been charge of any administrative case? No ( <span class="xmark"></span> ) Yes ( <span class="xmark"></span> ) If so explain:</div>
                <div class="list-hr"><hr><hr><hr></div>
                <div class="mt-3.5"><span class="mr-[0.5in]">D.</span>Have you ever been arrested or detained pursuant to the provisions of PD 1081 and its implementing orders
                    (GO, PD, LOI)? No ( <span class="xmark"></span> ) Yes ( <span class="xmark"></span> )  If so, state the nature of offense and disposition of case.
                </div>
                <div class="list-hr"><hr><hr></div>
                <div class="mt-3.5"><span class="mr-[0.5in]">E.</span>Do you take/use intoxicating liquor or narcotics? No ( <span class="xmark"></span> ) Yes ( <span class="xmark"></span> ) If so, to what extent:</div>
                <div class="list-hr"><hr><hr><hr><hr class="mb-3.5"></div>

                <div class="section-name"><span class="list-rom">XII.</span><span class="section-title">CHARACTER AND REPUTATION:</span>
                    <div><span class="mr-[0.5in]">A.</span>Give five (5) character references (known for three (3) years or longer except your relatives):</div>
                    <table class="reference-table">
                        <thead>
                            <tr>
                                <th>NAME</th>
                                <th>ADDRESS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mb-3.5"><span class="mr-[0.5in]">B.</span>List down three (3) neighbors at your present residence:
                        <table class="reference-table">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="section-name"><span class="list-rom">XIII.</span><span class="section-title">ORGANIZATION:</span>
                    <div><span class="mr-[0.5in]">A.</span>List of organization or social groups, which you have been a member of:
                        <table class="organization-table">
                            <thead>
                                <tr class="border-b border-black">
                                    <th>Organization</th>
                                    <th>Address</th>
                                    <th>Date of Membership</th>
                                    <th>Position held</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="signature" id="org">
                    <hr>
                    <span class="sign">(Signature of Applicant)</span>
                </div>

                <div class="footer">
                    <p class='confidential'>
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class="vision">AFP Core Values: Honor, Service, Patriotism</p>
                </div>
            </div>

            {{-- Page 9 --}}
            <div class="page">

                <div class="header">
                    <p class='confidential'">
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class='vision'>AFP Vision 2028: A World-class Armed Forces, Source of National Pride</p>
                    <p id='annex'>ANNEX A of AFPR G 200-054 dtd 22 September 2014, cont’n:</p>
                </div>
                <div id="misc-hr">
                    <hr>
                    <hr>
                </div>
                <div class="section-name"><span class="list-rom">XIV.</span><span class="section-title">MISCELLANEOUS:</span>
                    <div><span class="mr-[0.5in]">A.</span>Hobbies, Sport and past time:<div id="hobby-div"></div></div>
                    <div class="list-hr">
                        <hr><hr><hr><hr><hr><hr>
                    </div>
                    <div id="lang"><span class="mr-[0.5in]">B.</span>Language and Dialect (Indicate as <span class="fluency">FLUENT</span>,
                        <span class="fluency">FAIR</span>, or <span class="fluency">POOR</span>):

                    </div>
                    <table class="lang-table">
                        <thead>
                            <tr>
                                <th>Language/Dialect</th>
                                <th>Speak</th>
                                <th>Read</th>
                                <th>Write</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div><span class="mr-[0.5in]">C.</span>Are you willing to undergo periodic lie detection test?<div id="yn"></div></div>
                    <div><span class="mr-[0.5in]">D.</span>Copy exactly the following paragraph in your own handwriting:</div>
                </div>
                <p id="sample-text">As Luis Repaso II of 105th Xavier Ave, guzzled his way through three bottles
                of brandy. Josephine Z Quanzing, a partner in law firm of San Diego and Ballesteros
                located at 2879 Valley Forge St., Quezon City turned to Richard Ting, a Chinese food
                expert from Q.W. Kwantung Company, Ltd., 346 Hadji Jairula Hussin Blvd., and said.
                “I can’t speak for my government but I’m quite sure your country and mine get together
                for closer understanding”
                </p>
                <div class="list-hr">
                    <hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>
                </div>
                <div class="signature" id="misc">
                    <hr>
                    <span class="sign">(Signature of Applicant)</span>
                </div>

                <div class="footer">
                    <p class='confidential'>
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class="vision">AFP Core Values: Honor, Service, Patriotism</p>
                </div>
            </div>

            {{-- Page 10 --}}
            <div class="page">

                <div class="header">
                    <p class='confidential'">
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class='vision'>AFP Vision 2028: A World-class Armed Forces, Source of National Pride</p>
                    <p id='annex'>ANNEX A of AFPR G 200-054 dtd 22 September 2014, cont’n:</p>
                </div>

                <p id="certify">I certify that the foregoing answers are true and correct to the best of my
                    knowledge and belief and I agree that any misstatement or omission as to a material fact
                    will constitute ground for immediate denial of my application for clearance.
                </p>
                <p id="signed">Signed at _______________________________________ Date _______________________</p>
                <div id="signature-up">
                    <div class="witness">
                        <hr>
                        (Witness)
                    </div>
                    <div class="applicant">
                        <hr>
                        (Signature of Applicant)
                    </div>
                </div>

                <div class="print-mark">
                    <div id="left-print-mark">
                        <div class="witness">
                            <hr>
                            (Witness)
                        </div>
                        <span id="thumbmark">THUMBMARKS:</span>
                        <div class="thumb-print">
                            <div class="mark" id="left"></div>
                            <div class="mark" id="right"></div>
                        </div>
                    </div>

                    <div id="pfp">
                        <span id="size">2 X 2</span>
                    </div>
                </div>

                <div class="print-mark">
                    <div class="thumb-print">
                        <div><span id="left-label">(Left)</span></div>
                        <div><span id="right-label">(Right)</span></div>
                    </div>
                </div>

                <p id="subscribe">SUBSCRIBED AND SWORN to before me this ________ of _____________________ Philippines,
                    Affiant exhibited to me his/her Community Tax Certificate Nr. _____________ Issued at
                    _________________________________ on _______________________________.
                </p>
                <div id="admin-sign">
                    <div id="admin-officer">
                        <hr>
                        <hr>
                        <hr>
                        <span id="officer">(Administering Officer)</span>
                    </div>
                </div>

                <div class="signature" id="last">
                    <hr>
                    <span class="sign">(Signature of Applicant)</span>
                </div>

                <div class="footer">
                    <p class='confidential'>
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class="vision">AFP Core Values: Honor, Service, Patriotism</p>
                </div>
            </div>

            {{-- Page 11 --}}
            <div class="page">

                <div class="header">
                    <p class='confidential'">
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class='vision'>AFP Vision 2028: A World-class Armed Forces, Source of National Pride</p>
                    <p id='annex'>ANNEX A of AFPR G 200-054 dtd 22 September 2014, cont’n:</p>
                </div>

                <p id="sketch">SKETCH OF THE LOCATION OF RESIDENCE</p>
                <div class="signature" id="location">
                    <hr>
                    <span class="sign">(Signature of Applicant)</span>
                </div>

                <div class="footer">
                    <p class='confidential'>
                        <span>C</span>
                        <span>O</span>
                        <span>N</span>
                        <span>F</span>
                        <span>I</span>
                        <span>D</span>
                        <span>E</span>
                        <span>N</span>
                        <span>T</span>
                        <span>I</span>
                        <span>A</span>
                        <span>L</span>
                    </p>
                    <p class="vision">AFP Core Values: Honor, Service, Patriotism</p>
                </div>
            </div>
		</div>

        <script>
            function printDiv() {
                const printContent = document.getElementById('printable-area').innerHTML;
                const originalContent = document.body.innerHTML;

                document.body.innerHTML = printContent;
                window.print();
                document.body.innerHTML = originalContent;
                location.reload();
            }
        </script>
    </body>
</html>
