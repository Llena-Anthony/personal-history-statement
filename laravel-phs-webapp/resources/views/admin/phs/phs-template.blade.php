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
                    <div class="signature" id="personal">
                        <hr>
                        <span class="sign">(Signature of Applicant)</span>
                    </div>
                        <p><span class="list-alpha">A.</span>Name:<hr></p>
                        <span>(Last Name)</span>
                        <span>(First Name)</span>
                        <span>(Middle Name)</span>
                        <p><span class="list-alpha">B.</span>Rank: AFPSN: Br of Svc: </p>
                        <p><span class="list-alpha">C.</span>Present Job/Assignment: </p>
                        <p><span class="list-alpha">D.</span>Business or Duty Address: </p>
                        <p><span class="list-alpha">E.</span>Home Address: </p>
                        <p><span class="list-alpha">F.</span>Birth Date: Place of Birth: </p>
                        <p><span class="list-alpha">G.</span>CHANGE IN NAME (If by Court Action, give details): </p>
                        <p><span class="list-alpha">H.</span>NICKNAMES: NATIONALITY:</p>
                        <p><span class="list-alpha">I.</span>TAX IDENTIFICATION NR: RELIGION: </p>
                        <p><span class="list-alpha">J.</span>MOBILE NR: EMAIL ADDRESS</p>
                        <p><span class="list-alpha">K.</span>PASSPORT NR: DATE OF EXPIRATION: </p>
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

                <div class="section-name"><span class="list-rom">II.</span><span class="section-title">PERSONAL CHARACTERISTICS:</span>
                    <div><span class="list-alpha">A.</span>DESCRIPTION: Sex: Age: Height: (mtrs) Weight: (kgs)
                        <p>Body Build: (Heavy, Medium, Light)</p>
                        <p>Complexion: (Dark, Fair, Light) Color of eyes: </p>
                        <p>Color of Hair: Scar or Mark & Other distinguishing Feature: </p>
                    </div>
                    <div><span class="list-alpha">B.</span>PHYSICAL CONDITION:
                        <p>Present state of health (Excellent, Good, Poor)</p>
                        <p>Recent Serious Illness:</p>
                        <p>Blood Type: </p>
                    </div>
                </div>

                <div class="section-name"><span class="list-rom">III.</span><span class="section-title">MARITAL STATUS:</span>
                    <div><span>A.</span>Marital Status
                    <span>(Single, Married, Separated or Widowed)</span>
                    </div>
                    <div><span class="list-alpha">B.</span>NAME OF SPOUSE:
                        <span>(Full Name)</span>
                        <p>Date and Place of Marriage: </p>
                        <p>Date of Birth: Place of Birth: </p>
                        <p>Occupation/Employer/Place of Employment: </p>
                        <p>Contact Number: Citizenship: If dual, </p>
                        <p>(other Citizenship)</p>
                    </div>
                    <div class="signature" id="marital">
                        <hr>
                        <span class="sign">(Signature of Applicant)</span>
                    </div>
                    <div><span class="list-alpha">C.</span>CHILDREN:
                        <table id="child-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date of Birth</th>
                                    <th>Citizenship/Address</th>
                                    <th>Name of Father/Mother</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <span id="add-child">(Use back page for additional information)</span>
                </div>

                <div class="section-name"><span class="list-rom">IV.</span><span class="section-title">FAMILY HISTORY AND INFORMATION:</span>
                    <div><span class="list-alpha">A.</span>FATHER:
                        <span>(Full Name)</span>
                        <p>Date and Place of Birth:</p>
                        <p>Complete Address: </p>
                        <p>Occupation/Employer/Place of Employment: </p>
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

                <div class="section-name">
                    <div>
                        <p>Citizenship: If dual, write both citizenship. If naturalized, give date and place where naturalized: </p>
                    </div>
                    <div><span class="list-alpha">B.</span>Mother:
                        <span>(Full Name)</span>
                        <p>Date and Place of Birth:</p>
                        <p>Complete Address: </p>
                        <p>Occupation/Employer/Place of Employment: </p>
                        <p>Citizenship: If dual, write both citizenship. If naturalized, give date and place where naturalized: </p>
                    </div>
                    <div><span class="list-alpha">C.</span>Brothers and Sisters:
                        <table id="sibling-table">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>Date of BIRTH:</th>
                                    <th>CITIZENSHIP (IF DUAL WRITE BOTH)</th>
                                    <th>COMPLETE ADDRESS</th>
                                    <th>OCCUPATION</th>
                                    <th>EMPLOYER/ADDRESS</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div><span class="list-alpha">D.</span>STEP-PARENT OR GUARDIAN:
                        <span>(Full Name)</span>
                        <p>Date and Place of Birth:</p>
                        <p>Complete Address: </p>
                        <p>Occupation/Employer/Place of Employment: </p>
                        <p>Citizenship: If dual, write both citizenship. If naturalized, give date and place where naturalized: </p>
                    </div>
                    <div class="signature" id="parent">
                        <hr>
                        <span class="sign">(Signature of Applicant)</span>
                    </div>
                    <div><span class="list-alpha">E.</span>FATHER-IN-LAW:
                        <span>(Full Name)</span>
                        <p>Date and Place of Birth:</p>
                        <p>Complete Address: </p>
                        <p>Occupation/Employer/Place of Employment: </p>
                        <p>Citizenship: If dual, write both citizenship. If naturalized, give date and place where naturalized: </p>
                    </div>
                    <div><span class="list-alpha">F.</span>MOTHER-IN-LAW:
                        <span>(Full Name)</span>
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
                    <p>Date and Place of Birth:</p>
                    <p>Complete Address: </p>
                    <p>Occupation/Employer/Place of Employment: </p>
                    <p>Citizenship:</p> <span> <div class="citizenship"></div> </span><span>If dual, write both citizenship. If naturalized, give date and place where naturalized: </span>
                </div>

                <div class="section-name"><span class="list-rom">V.</span><span class="section-title">EDUCATIONAL BACKGROUND:</span>
                    <div>
                        <span class="list-alpha">A.</span><span class="educ-level">Elementary</span>
                        <span class="'educ-addr">Location</span>
                        <span class="educ-attend">Date of Attendance</span>
                        <span class="educ-grad">Year Graduated</span>
                        <table class="educ-table">

                        </table>
                    </div>
                    <div>
                        <span class="list-alpha">B.</span><span class="educ-level">High School</span>
                        <span class="'educ-addr">Location</span>
                        <span class="educ-attend">Date of Attendance</span>
                        <span class="educ-grad">Year Graduated</span>
                        <table class="educ-table">

                        </table>
                    </div>
                    <div>
                        <span class="list-alpha">C.</span><span class="educ-level">College</span>
                        <span class="'educ-addr">Location</span>
                        <span class="educ-attend">Date of Attendance</span>
                        <span class="educ-grad">Year Graduated</span>
                        <table class="educ-table">

                        </table>
                    </div>
                    <div>
                        <span class="list-alpha">D.</span><span class="educ-level">Post Graduate</span>
                        <span class="'educ-addr">Location</span>
                        <span class="educ-attend">Date of Attendance</span>
                        <span class="educ-grad">Year Graduated</span>
                        <table class="educ-table">

                        </table>
                    </div>
                    <div><span class="list-alpha">E.</span>Other Schools/Training Attended and Date of Attendance: </div>
                    <div><span class="list-alpha">F.</span>Civil Service, If any and other Similar Qualification Acquired: </div>
                    <div class="signature" id="educational">
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
                    <div><span class="list-alpha">A.</span>Date Enlisted in AFP: <div id="date-enlist"></div></div>
                    <div class="flex"><span class="list-alpha">B.</span>Date of Commision: <div class="date-comm"></div> <span>:</span> <div class="date-comm"></div> </div>
                    <div><span class="list-alpha">C.</span>Source of Commission: <div id="source-comm"></div> </div>
                    <div><span class="list-alpha">D.</span>Important Unit Assignment since enlisted/CAD</div>
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

                    <div><span class="list-alpha">E.</span>Military Schools Attended</div>
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

                <div id="awards-div"><span class="list-alpha">F.</span>Decorations, Awards or Commendations Received: </div>
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
                    <div><span class="list-alpha">A.</span>Are you entirely dependent on your salary? Yes ( ) No ( ) If no, State other source of income: </div>
                    <div><span class="list-alpha">B.</span>Name and address of Banks or other credit institutions with which you have accounts/loans:</div>
                    <div><span class="list-alpha">C.</span>Have you filed a statementr of your Assets and Liabilities with any government Agency?
                        <p>Yes ( ) No ( ) If so, what Agency and when?</p>
                    </div>
                    <div><span class="list-alpha">D.</span>Have you filed your latest Income Tax Returns?</div>
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
                        <div><span class="list-alpha">A.</span>Have you ever been investigated/arrested, Indicted or convicted for any violation of law?
                            No ( ) Yes (  ) If so, state name of court, nature of offense and disposition of case:
                        </div>
                        <div><span class="list-alpha">B.</span>Has any member of your family ever been investigated/arrested, indicted or convicted for any violation of law?
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

                <div id="admin-case"><span class="list-alpha">C.</span>Have you ever been charge of any administrative case? No ( <span class="xmark"></span> ) Yes ( <span class="xmark"></span> ) If so explain:</div>
                <div class="list-hr"><hr><hr><hr></div>
                <div class="mt-3.5"><span class="list-alpha">D.</span>Have you ever been arrested or detained pursuant to the provisions of PD 1081 and its implementing orders
                    (GO, PD, LOI)? No ( <span class="xmark"></span> ) Yes ( <span class="xmark"></span> )  If so, state the nature of offense and disposition of case.
                </div>
                <div class="list-hr"><hr><hr></div>
                <div class="mt-3.5"><span class="list-alpha">E.</span>Do you take/use intoxicating liquor or narcotics? No ( <span class="xmark"></span> ) Yes ( <span class="xmark"></span> ) If so, to what extent:</div>
                <div class="list-hr"><hr><hr><hr><hr class="mb-3.5"></div>

                <div class="section-name"><span class="list-rom">XII.</span><span class="section-title">CHARACTER AND REPUTATION:</span>
                    <div><span class="list-alpha">A.</span>Give five (5) character references (known for three (3) years or longer except your relatives):</div>
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

                    <div class="mb-3.5"><span class="list-alpha">B.</span>List down three (3) neighbors at your present residence:
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
                    <div><span class="list-alpha">A.</span>List of organization or social groups, which you have been a member of:
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
                    <div><span class="list-alpha">A.</span>Hobbies, Sport and past time:<div id="hobby-div"></div></div>
                    <div class="list-hr">
                        <hr><hr><hr><hr><hr><hr>
                    </div>
                    <div id="lang"><span class="list-alpha">B.</span>Language and Dialect (Indicate as <span class="fluency">FLUENT</span>,
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
                    <div><span class="list-alpha">C.</span>Are you willing to undergo periodic lie detection test?<div id="yn"></div></div>
                    <div><span class="list-alpha">D.</span>Copy exactly the following paragraph in your own handwriting:</div>
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
