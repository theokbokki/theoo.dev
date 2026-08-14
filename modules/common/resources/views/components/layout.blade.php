<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['modules/common/resources/css/common.scss', 'modules/common/resources/js/common.js'])
    </head>
    <body class="{{ $baseClass }}">
        <script>
            document.body.classList.add("js-loading");
        </script>
        {{ $slot }}
    </body>
</html>
