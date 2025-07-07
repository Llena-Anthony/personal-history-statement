<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Print PHS Document')</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <style>
            @page {
                size: A4;
                margin-top: 0.2in;
                margin-bottom: 0.3in;
                margin-left: 0.5in;
                margin-right: 0.5in;
            }
            body {
                font-family: 'Inter', system-ui, -apple-system, sans-serif;
                background: #fff;
                margin: 0;
                padding: 0;
            }
            .phs-page {
                position: relative;
                page-break-after: always;
                break-after: page;
            }
            .phs-header, .phs-footer {
                position: fixed;
                left: 0;
                right: 0;
                width: 100%;
            }
            .phs-header {
                top: 0;
            }
            .phs-footer {
                bottom: 0;
            }
            @media print {
                body {
                    background: #fff !important;
                }
                .phs-page {
                    page-break-after: always;
                    break-after: page;
                }
                .phs-header, .phs-footer {
                    position: fixed;
                    left: 0;
                    right: 0;
                    width: 100%;
                }
                .phs-header {
                    top: 0;
                }
                .phs-footer {
                    bottom: 0;
                }
            }
        </style>
    </head>

    <body>
        <div class="phs-header">
            {{-- PHS Print Header Fragment --}}
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
        </div>
        
        @php use Illuminate\Support\Facades\View; @endphp
        @php
            $pages = collect([
                'content',
                'page2',
                'page3',
                'page4',
                'page5',
                'page6',
                'page7',
                'page8',
                'page9',
                'page10',
            ])->filter(fn($section) => trim(View::getSection($section)) !== '')->values();
        @endphp
        @foreach ($pages as $i => $page)
            <div class="phs-page" style="{{ $i === $pages->count() - 1 ? 'page-break-after: auto; break-after: auto;' : '' }}">
                <div class="phs-content">@yield($page)</div>
            </div>
        @endforeach
        
        <div class="phs-footer">
            {{-- PHS Print Footer Fragment --}}
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
    </body>
</html>
