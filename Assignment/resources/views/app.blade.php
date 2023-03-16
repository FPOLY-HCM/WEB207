<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" ng-app="app">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/js/app.js', 'resources/sass/app.scss'])
    </head>
    <body>
        @include('partials.header')
        <main class="container my-4" ng-controller="MainController">
            <div ng-view></div>
        </main>
        @include('partials.footer')
    </body>
</html>
