<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>INET - Aulas móviles</title>

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ asset( 'css/app.css') }}" rel="stylesheet" type="text/css">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <header class="app-header">
            INET - Información de aulas móviles
            <nav>
                
            </nav>
        </header>

        @include('widgets.chatbot-widget')
    </body>
</html>