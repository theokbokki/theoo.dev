<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['modules/common/resources/css/common.css', 'modules/common/resources/js/common.js'])
    </head>
    <body class="">
        <h1>theoo.dev</h1>
    </body>
</html>
