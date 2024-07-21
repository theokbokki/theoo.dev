<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ env('APP_NAME') }}</title>

        @vite(['resources/js/app.js'])

        <!-- Reset -->
        <style>
            /* http://meyerweb.com/eric/tools/css/reset/
               v2.0 | 20110126
               License: none (public domain)
            */

            html, body, div, span, applet, object, iframe,
            h1, h2, h3, h4, h5, h6, p, blockquote, pre,
            a, abbr, acronym, address, big, cite, code,
            del, dfn, em, img, ins, kbd, q, s, samp,
            small, strike, strong, sub, sup, tt, var,
            b, u, i, center,
            dl, dt, dd, ol, ul, li,
            fieldset, form, label, legend,
            table, caption, tbody, tfoot, thead, tr, th, td,
            article, aside, canvas, details, embed,
            figure, figcaption, footer, header, hgroup,
            menu, nav, output, ruby, section, summary,
            time, mark, audio, video {
                margin: 0;
                padding: 0;
                border: 0;
                font-size: 100%;
                font: inherit;
                vertical-align: baseline;
            }
            /* HTML5 display-role reset for older browsers */
            article, aside, details, figcaption, figure,
            footer, header, hgroup, menu, nav, section {
                display: block;
            }
            body {
                line-height: 1;
            }
            ol, ul {
                list-style: none;
            }
            blockquote, q {
                quotes: none;
            }
            blockquote:before, blockquote:after,
            q:before, q:after {
                content: '';
                content: none;
            }
            table {
                border-collapse: collapse;
                border-spacing: 0;
            }
        </style>

        <!-- Fonts -->
        <style>
            @font-face {
                font-family: 'Gohu';
                src:url('{{ Vite::asset('resources/fonts/Gohu.woff') }}') format('woff'),
                    url('{{ Vite::asset('resources/fonts/Gohu.woff2') }}') format('woff2'),
                    url('{{ Vite::asset('resources/fonts/Gohu.svg') }}') format('svg'),
                    url('{{ Vite::asset('resources/fonts/Gohu.eot') }}'),
                    url('{{ Vite::asset('resources/fonts/Gohu.eot') }}') format('embedded-opentype'),
                    url('{{ Vite::asset('resources/fonts/Gohu.ttf') }}') format('truetype');

                font-weight: normal;
                font-style: normal;
            }

            @font-face {
                font-family: 'Geist';
                src:url('{{ Vite::asset('resources/fonts/Geist-Regular.woff') }}') format('woff'),
                    url('{{ Vite::asset('resources/fonts/Geist-Regular.woff2') }}') format('woff2'),
                    url('{{ Vite::asset('resources/fonts/Geist-Regular.eot') }}'),
                    url('{{ Vite::asset('resources/fonts/Geist-Regular.eot') }}') format('embedded-opentype'),
                    url('{{ Vite::asset('resources/fonts/Geist-Regular.otf') }}') format('truetype');

                font-weight: normal;
                font-style: normal;
            }


            :root {
                --sans: "Geist", ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                --pixel: "Gohu", var(--sans);
            }
        </style>

        <!-- Colors -->
        <style>
            :root {
                --white: 255, 255, 255;
                --background: 250, 250, 250;
                --black: 32, 32, 34;
                --grey: 107, 105, 105;
                --light-grey: 233, 229, 226;
                --orange: 251, 90, 31;
            }
        </style>

        <!-- Utils -->
        <style>
            .sro {
                position: absolute;
                width: 1px;
                height: 1px;
                padding: 0;
                margin: -1px;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
                white-space: nowrap;
                border-width: 0;
            }
        </style>

        <!-- Base -->
        <style>
            :root {
                background: rgb(var(--background));
            }

            .app {
                display: grid;
                row-gap: 5rem;
                width: 87.2%;
                margin: 2.5rem auto 1.5rem;
                max-width: 50rem;
                font-family: var(--sans);
                color: rgb(var(--black));

                @media screen and (min-width: 60rem) {
                    margin: 5rem auto 2.5rem;
                    row-gap: 7.5rem;
                }
            }

            .app__content {
                display: grid;
                row-gap: 4rem;
            }
        </style>
        @stack('styles')
    </head>
    <body class="app">
        <h1 class="sro">{{ $title }}</h1>

        <header class="app_header">
            {{ $nav }}
        </header>

        <main class="app__content">
            {{ $slot }}
        </main>
    </body>

    @stack('scripts')
</html>
