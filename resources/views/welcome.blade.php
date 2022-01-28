<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        img {
            margin: auto;
            display: block;
        }
        a {
            background: darkblue;
            color: #fff !important;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
<h1 class="text-center text-indigo-700 mt-3  text-xl">Sistema de votação</h1>
<div class="mt-3 text-center">
    <img src="./undraw_election_day_w842.svg" class="w-64 inline"/>
    <br>
    <a href="./login">Login</a> ou <a href="./register">Registre-se</a>
</div>

</button>
</body>
</html>