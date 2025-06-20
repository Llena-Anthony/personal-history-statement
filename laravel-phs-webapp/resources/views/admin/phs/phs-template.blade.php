<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title','Print PHS Document')</title>

        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/print-prev.css'])

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        {{-- <link rel="stylesheet" href="{{ asset('build/assets/print-prev-l0sNRNKZ.js') }}" --}}

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: Arial, sans-serif;
                font-size: 12pt;
                min-height: 100 vh;
                background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
                margin: 10px;
            }

            .no-print {
                display: block;
            }

            .confidential {
                letter-spacing: 2px;
                margin-bottom: 10pt;
            }

            .confidential span {
                text-decoration: underline;
            }

            .vision {
                font-size: 10pt;
                font-style: italic;
            }

            #annex {
                font-size: 9pt;
                font-weight: bold;
                text-align: left;
                padding-left: 0.2in;
            }

            #fnr {
                font-size: 9pt;
                text-align: right;
            }

            .up {
                font-size: 9pt;
                text-align: left;
            }
            #doc-title {
                text-align: center;
            }
            #doc-title span {
                font-weight: bold;
                text-decoration: underline;
            }
            .instruc {
                font-weight: bold;
                letter-spacing: 3pt;
                text-decoration: underline;
                text-align: center;
                margin-top: 12pt;
                margin-bottom: 11pt;
            }
            .signature {
                width: 2.37in;
                height: 0.3in;
                text-align: center;
                font-weight: bold;
                font-size: 10pt;
            }
            .signature hr {
                border: none;
                border-top: 1px solid black;
            }

            ol {
                text-indent: 50px;
            }

            .instruc-list {
                list-style: decimal;
                list-style-position: inside;
            }

            #sections {
                list-style: upper-roman;
                list-style-position: outside;
            }

            .section-name ol {
                list-style: upper-alpha;
                list-style-position: inside;
            }

            p {
                text-indent: 50px;
            }

            li {
                text-indent: 50px;
            }

            main {
                position: block;
                left: 0;
                right: 0;
                background: white;
                text-align: justify;
                padding-left: 0.2in;
                padding-right: 0.2in;
            }

            header, footer {
                position: block;
                left: 0;
                right: 0;
                background: white;
                text-align: center;
            }

            header {
                margin-bottom: 1pt;
            }

            footer {
                margin-top: 12pt;
            }

            @media print {
                body * {
                    visibility: hidden;
                }

                #printable-area, #printable-area * {
                    visibility: visible;
                }
            }
        </style>
    </head>

    <body>
        <button onclick="print()">Print</button>

		<div id="printable-area">
            <header>
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
            </header>
            <main>
                <p id='fnr'>File Nr:_______</p>
                <p id='ghq' class='up'>GHQ, OJ2</p>
                <p id='num-form' class='up'>200-054 Form</p>
                <p id='doc-title'>
                    <span>PERSONAL</span>
                    <span>HISTORY</span>
                    <span>STATEMENT</span>
                </p>
                <p class='instruc'>INSTRUCTIONS</p>
                <ol class='instruc-list'">
                    <li>Answer all questions completely; if question is not applicable, write “NA”.write “Unknown”
                        only if you do not know the answer and cannot obtain the answer from personal records.
                        Use the blank pages at the back of this form for extra details on any question for which you
                        do not have sufficient space.
                    </li>
                    <li>Write carefully, Illegible or incomplete forms will not receive consideration.</li>
                </ol>
                <p class='instruc'>WARNING</p>
                <ol class='instruc-list'>
                    <li>The correctness of all statement of entries made herein will be investigated.</li>
                    <li>Any deliberate omission or distortion of material facts may give sufficient cause for denial of clearance.</li>
                    <li>The statements made herein are classified CONFIDENTIAL. Revelation or use for other than the authorized
                        purpose is prohibited by AFPR G-200-054.</li>
                </ol>

                <ol id="sections">
                    <li class="section-name">PERSONAL DETAIL
                        <div class="signature" id="personal">
                            <hr>
                            <span class="sign">(Signature of Applicant)</span>
                        </div>
                        <ol type="A">
                            <li>Name:</li>
                            <span>(Last Name)</span>
                            <span>(First Name)</span>
                            <span>(Middle Name)</span>
                            <li>Rank: AFPSN: Br of Svc: </li>
                            <li>Present Job/Assignment: </li>
                            <li>Business or Duty Address: </li>
                            <li>Home Address: </li>
                            <li>Birth Date: Place of Birth: </li>
                            <li>CHANGE IN NAME (If by Court Action, give details): </li>
                            <li>NICKNAMES: NATIONALITY:</li>
                            <li>TAX IDENTIFICATION NR: RELIGION: </li>
                            <li>PASSPORT NR: DATE OF EXPIRATION: </li>
                        </ol>
                    </li>

                    <li class="section-name">PERSONAL CHARACTERISTICS:
                        <ol type="A">
                            <li>DESCRIPTION: Sex: Age: Height: (mtrs) Weight: (kgs)
                                <p>Body Build: (Heavy, Medium, Light)</p>
                                <p>Complexion: (Dark, Fair, Light) Color of eyes: </p>
                                <p>Color of Hair: Scar or Mark & Other distinguishing Feature: </p>
                            </li>
                            <li>PHYSICAL CONDITION:
                                <p>Present state of health (Excellent, Good, Poor)</p>
                                <p>Recent Serious Illness:</p>
                                <p>Blood Type: </p>
                            </li>
                        </ol>
                    </li>

                    <li>MARITAL STATUS
                        <ol type="A">
                            <li>Marital Status
                            <span>(Single, Married, Separated or Widowed)</span>
                            </li>
                            <li>NAME OF SPOUSE:
                                <span>(Full Name)</span>
                                <p>Date and Place of Marriage: </p>
                                <p>Date of Birth: Place of Birth: </p>
                                <p>Occupation/Employer/Place of Employment: </p>
                                <p>Contact Number: Citizenship: If dual, </p>
                                <p>(other Citizenship)</p>
                            </li>
                            <div class="signature" id="marital">
                                <hr>
                                <span class="sign">(Signature of Applicant)</span>
                            </div>
                            <li>CHILDREN:
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
                            </li>
                            <span id="add-child">(Use back page for additional information)</span>
                        </ol>
                    </li>


                    <li class="section-name">FAMILY HISTORY AND INFORMATION:
                        <ol type="A">
                            <li>FATHER:
                                <span>(Full Name)</span>
                                <p>Date and Place of Birth:</p>
                                <p>Complete Address: </p>
                                <p>Occupation/Employer/Place of Employment: </p>
                                <p>Citizenship: If dual, write both citizenship. If naturalized, give date and place where naturalized: </p>
                            </li>
                            <li>Mother:
                                <span>(Full Name)</span>
                                <p>Date and Place of Birth:</p>
                                <p>Complete Address: </p>
                                <p>Occupation/Employer/Place of Employment: </p>
                                <p>Citizenship: If dual, write both citizenship. If naturalized, give date and place where naturalized: </p>
                            </li>
                            <li>Brothers and Sisters:
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
                            </li>
                            <li>STEP-PARENT OR GUARDIAN:
                                <span>(Full Name)</span>
                                <p>Date and Place of Birth:</p>
                                <p>Complete Address: </p>
                                <p>Occupation/Employer/Place of Employment: </p>
                                <p>Citizenship: If dual, write both citizenship. If naturalized, give date and place where naturalized: </p>
                            </li>
                            <div class="signature" id="parent">
                                <hr>
                                <span class="sign">(Signature of Applicant)</span>
                            </div>
                            <li>FATHER-IN-LAW:
                                <span>(Full Name)</span>
                                <p>Date and Place of Birth:</p>
                                <p>Complete Address: </p>
                                <p>Occupation/Employer/Place of Employment: </p>
                                <p>Citizenship: If dual, write both citizenship. If naturalized, give date and place where naturalized: </p>
                            </li>
                            <li>MOTHER-IN-LAW:
                                <span>(Full Name)</span>
                                <p>Date and Place of Birth:</p>
                                <p>Complete Address: </p>
                                <p>Occupation/Employer/Place of Employment: </p>
                                <p>Citizenship: If dual, write both citizenship. If naturalized, give date and place where naturalized: </p>
                            </li>
                        </ol>

                        <li>EDUCATIONAL BACKGROUND:
                            <ol type="A">
                                <li>
                                    <span class="educ-level">Elementary</span>
                                    <span class="'educ-addr">Location</span>
                                    <span class="educ-attend">Date of Attendance</span>
                                    <span class="educ-grad">Year Graduated</span>
                                    <table class="educ-table">

                                    </table>
                                </li>
                                <li>
                                    <span class="educ-level">High School</span>
                                    <span class="'educ-addr">Location</span>
                                    <span class="educ-attend">Date of Attendance</span>
                                    <span class="educ-grad">Year Graduated</span>
                                    <table class="educ-table">

                                    </table>
                                </li>
                                <li>
                                    <span class="educ-level">College</span>
                                    <span class="'educ-addr">Location</span>
                                    <span class="educ-attend">Date of Attendance</span>
                                    <span class="educ-grad">Year Graduated</span>
                                    <table class="educ-table">

                                    </table>
                                </li>
                                <li>
                                    <span class="educ-level">Elementary</span>
                                    <span class="'educ-addr">Location</span>
                                    <span class="educ-attend">Date of Attendance</span>
                                    <span class="educ-grad">Year Graduated</span>
                                    <table class="educ-table">

                                    </table>
                                </li>
                                <li>Other Schools/Training Attended and Date of Attendance: </li>
                                <li>Civil Service, If any and other Similar Qualification Acquired: </li>
                                <div class="signature" id="educational">
                                    <hr>
                                    <span class="sign">(Signature of Applicant)</span>
                                </div>
                            </ol>
                        </li>

                        <li>MILITARY HISTORY:
                            <ol type="A">
                                <li>Date Enlisted in AFP: </li>
                                <li>Date of Commision: _ : _ </li>
                                <li>Source of Commission: </li>
                                <li>Important Unit Assignment since enlisted/CAD
                                    <table class="unit-assign">
                                        <thead>
                                            <tr>
                                                <th>INCLUSIVE DATES</th>
                                                <th>UNIT/OFFICE</th>
                                                <th>CO/CHIEF OF OFFICE</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <p>(Use Separate Sheet for Additional Information)</p>
                                </li>
                                <li>Military Schools Attended
                                    <table class="military-school">
                                        <thead>
                                            <tr>
                                                <th>School/Location</th>
                                                <th>Date of Attendance</th>
                                                <th>Nature of Training</th>
                                                <th>Rating</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="signature" id="military">
                                        <hr>
                                        <span class="sign">(Signature of Applicant)</span>
                                    </div>
                                </li>
                                <li>Decorations, Awards or Commendations Received: </li>
                            </ol>
                        </li>

                        <li>PLACES OF RESIDENCE SINCE BIRTH: </li>

                        <li>EMPLOYMENT:
                            <table class="employment-table">
                                <thead>
                                    <tr>
                                        <th>Inclusive Dates</th>
                                        <th>Type of Employment</th>
                                        <th>Name/Address</th>
                                        <th>Reason for Leaving</th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="signature" id="employ">
                                <hr>
                                <span class="sign">(Signature of Applicant)</span>
                            </div>
                            <p>Have you been dismissed or forced to resign from a position? No ( ) Yes ( ) If Yes, Explain:</p>
                        </li>

                        <li>FOREIGN COUNTRIES VISITED:
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
                        </li>

                        <li>CREDIT REPUTATION:
                            <ol type="A">
                                <li>Are you entirely dependent on your salary? Yes ( ) No ( ) If no, State other source of income: </li>
                                <li>Name and address of Banks or other credit institutions with which you have accounts/loans:</li>
                                <li>Have you filed a statementr of your Assets and Liabilities with any government Agency?
                                    <p>Yes ( ) No ( ) If so, what Agency and when?</p>
                                </li>
                                <li>Have you filed your latest Income Tax Returns?</li>
                                <li>Amount paid for last Calendar Year:</li>
                                <li>Three (3) credit references in the Philippines:
                                    <table class="credit-table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </li>
                                <div class="signature" id="credit">
                                    <hr>
                                    <span class="sign">(Signature of Applicant)</span>
                                </div>
                            </ol>
                        </li>

                        <li>ARREST RECORD AND CONDUCT:
                            <ol type="A">
                                <li>Have you ever been investigated/arrested, Indicted or convicted for any violation of law?
                                    No ( ) Yes (  ) If so, state name of court, nature of offense and disposition of case:
                                </li>
                                <li>Has any member of your family ever been investigated/arrested, indicted or convicted for any violation of law?
                                    No (  ) Yes (  ) If so, state name of court, nature of offense and disposition of case:
                                </li>
                                <li>Have you ever been charge of any administrative case? No ( ) Yes (  ) If so explain:</li>
                                <li>Have you ever been arrested or detained pursuant to the provisions of PD 1081 and its implementing orders
                                    (GO, PD, LOI)? No ( ) Yes (  )  If so, state the nature of offense and disposition of case.
                                </li>
                                <li>Do you take/use intoxicating liquor or narcotics? No ( ) Yes (  ) If so, to what extent:</li>
                            </ol>
                        </li>

                        <li>CHARACTER AND REPUTATION:
                            <ol type="A">
                                <li>Give five (5) character references (known for three (3) years or longer except your relatives):
                                    <table class="reference-table">
                                        <thead>
                                            <tr>
                                                <th>NAME</th>
                                                <th>ADDRESS</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </li>
                                <li>List down three (3) neighbors at your present residence:
                                    <table class="reference-table">
                                        <thead>
                                            <tr>
                                                <th>NAME</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </li>
                            </ol>
                        </li>

                        <li>ORGANIZATION:
                            <ol type="A">
                                <li>List of organization or social groups, which you have been a member of:
                                    <table class="organization-table">
                                        <thead>
                                            <tr>
                                                <th>Organization</th>
                                                <th>Address</th>
                                                <th>Date of Membership</th>
                                                <th>Position held</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </li>
                                <div class="signature" id="org">
                                    <hr>
                                    <span class="sign">(Signature of Applicant)</span>
                                </div>
                            </ol>
                        </li>

                        <li>MISCELLANEOUS:
                            <ol type="A">
                                <li>Hobbies, Sport and past time:</li>
                                <li>Language and Dialect (Indicate as <span class="fluency">FLUENT</span>,
                                    <span class="fluency">FAIR</span>, or <span class="fluency">POOR</span>):
                                    <table class="lang-table">
                                        <thead>
                                            <tr>
                                                <th>Language/Dialect</th>
                                                <th>Speak</th>
                                                <th>Read</th>
                                                <th>Write</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </li>
                                <li>Are you willing to undergo periodic lie detection test?</li>
                                <li>Copy exactly the following paragraph in your own handwriting:</li>
                            </ol>
                        </li>
                    </li>
                </ol>
                <p id="sample-text">As Luis Repaso II of 105th Xavier Ave, guzzled his way through three bottles
                of brandy. Josephine Z Quanzing, a partner in law firm of San Diego and Ballesteros
                located at 2879 Valley Forge St., Quezon City turned to Richard Ting, a Chinese food
                expert from Q.W. Kwantung Company, Ltd., 346 Hadji Jairula Hussin Blvd., and said.
                “I can’t speak for my government but I’m quite sure your country and mine get together
                for closer understanding”
                </p>
                <hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>
                <div class="signature" id="misc">
                    <hr>
                    <span class="sign">(Signature of Applicant)</span>
                </div>
                <p id="certify">I certify that the foregoing answers are true and correct to the best of my
                    knowledge and belief and I agree that any misstatement or omission as to a material fact
                    will constitute ground for immediate denial of my application for clearance.
                </p>
                <p>Signed at __________________________________________________ Date _______________________</p>
                <p>______________________________<span>______________________________</span></p>
                <p><span id="witness">(Witness)</span><span id="sign-last">(Signature of Applicant)</span></p>
                <p>______________________________</p>
                p><span id="witness">(Witness)</span></p>
                <span id="thumbmark">THUMBMARKS:</span>
                <div class="mark" id="left"></div>
                <div class="mark" id="right"></div>
                <span id="left">(Left)</span><span id="right">(Right)</span>
                <div id="pfp">
                    <span id="size">2 X 2</span>
                </div>
                <p id="subscribe">SUBSCRIBED AND SWORN to before me this ________ of _______________________________ Philippines,
                    Affiant exhibited to me his/her Community Tax Certificate Nr. ____________________________. Issued at
                    _____________________________________on _______________________________.
                </p>
                <div id="admin-officer">
                    <hr>
                    <hr>
                    <hr>
                    <span id="officer">(Administering Officer)</span>
                </div>
                <div class="signature" id="last">
                    <hr>
                    <span class="sign">(Signature of Applicant)</span>
                </div>
                <p>SKETCH OF THE LOCATION OF RESIDENCE</p>
                <div class="signature" id="location">
                    <hr>
                    <span class="sign">(Signature of Applicant)</span>
                </div>
            </main>
            <footer>
                <p class='confidential' class="flex justify-center items-center h-screen">
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
            </footer>
		</div>

        <script>
            function print() {
                window.print();
            }
        </script>
    </body>
</html>
