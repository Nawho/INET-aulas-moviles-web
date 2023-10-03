<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet" type="text/css">
<body>
    <header>
        <a class="logoContainer" href="/">
            <img id="imageLogo" src="imgs/LogoWhite.png" alt="Logo">
            <span class="title">Aulas móviles</span>
        </a>

        <div class="mobileMenu">
            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
            </svg>
        </div>

        <nav class="navHeader">
            <ul class="navList">
                <li><a href="/map">Mapa</a></li>
                <li><a href="/lista">Lista</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>