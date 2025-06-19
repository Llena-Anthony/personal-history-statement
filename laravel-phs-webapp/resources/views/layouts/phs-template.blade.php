<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title','Print PHS Document')</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Inter', system-ui, -apple-system, sans-serif;
                min-height: 100 vh;
                background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            }


        </style>
    </head>

    <body>
        <p id='confidential'>CONFIDENTIAL</p>
        <p id='vision'>AFP Vision 2028: A World-class Armed Forces, Source of National Pride</p>
        <p id='annex'>ANNEX A of AFPR G 200-054 dtd 22 September 2014, cont'n:</p>
        <p id='fnr'>File Nr:_______</p>
        <p id='ghq'>GHQ, OJ2</p>
        <p id='num-form'>200-054 Form</p>
        <p id='doc-title'>PERSONAL HISTORY STATEMENT</p>
        <p class='instruc'>INSTRUCTION</p>
        <ol class='instruc-list'>
            <li>Answer all questions completely; if question is not applicable, write "NA".write "Unknown"
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
    </body>
</html>
