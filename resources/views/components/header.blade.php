<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet" type="text/css">
<body>
    <header>
        <div class= "navBar">   
        <a class="logoContainer" href="/">
            <img id="imageLogo" src="imgs/LogoWhite.png" alt="Logo">
            <span class="title">Aulas móviles</span>
        </a>

        <ul class="navList">
            <li><a href="/map">Mapa</a></li>
            <li><a href="/list">Lista</a></li>
        </ul>
        <div class="toggleMobileMenu">
        <svg id='menu' class= 'hideIcon' xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
            <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
        </svg>
        <svg id='exit' class= 'hideIcon'  xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
        </div>
        </div>
        <div class="dropdownMenu open">
            <li><a href="/map">Mapa</a></li>
            <li><a href="/list">Lista</a></li>
        </div>
    </header>
</body>

<script>
    const toggleBtn = document.querySelector('.toggleMobileMenu');
    const BtnIconMenu = document.getElementById('menu');
    const BtnIconExit = document.getElementById('exit');
    const dropdownMenu = document.querySelector('.dropdownMenu');
    dropdownMenu.classList.toggle('open');
    BtnIconMenu.classList.toggle('hideIcon');


    toggleBtn.onclick = function(){
        dropdownMenu.classList.toggle('open');
        BtnIconExit.classList.toggle('hideIcon');
        BtnIconMenu.classList.toggle('hideIcon');
    }

</script>
</html>