<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href='css/app.css'>

        <title>INET- Aula móvil N°24 </title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ asset('css/aula_movil.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        @include('components.header')
        <h1>Aula móvil N°24 (Activa)</h1>

        <main >
                <div id="map" ></div>

                <div class="ofertaFormativa">
                    <h2>Instalciones eléctricas</h2>    
                    <p>En esta aula móvil damos cursos de formación de instalaciones eléctricas.
                       A través de este programa, podrás adquirir las habilidades esenciales para destacar en el campo de las instalaciones eléctricas y contribuir al desarrollo de tu comunidad</p>
                    <p>Horarios: Lunes a Viernes de 8:00 a 12:00 y de 13:00 a 17:00</p>
                </div>

                <div class="aulaInfoLines">
                    <div class="contact">
                        <div class="contact-title">Contacto</div> 
                        <div class="mailAndTel">
                            <a class="contactLine" href="mailto:administracion_aula24@gmail.com">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="white">
                                    <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                                </svg>
                                <span>admin_aula24@gmail.com</span>
                            </a>

                            <a class="contactLine" href="tel:+54 9 11 1213-1415">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="white">
                                    <path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
                                </svg>
                                <span>+54 9 11 1213-1415</span>
                            </a>
                        </div>
                    </div>
                    <div class="ult-actualizacion">Ult Actualización: 30/09/2023 - 16:00</div>
                </div>
        </main>

        @include('components.footer')
        @include('widgets.chatbot-widget')
    </body>
</html>

<script>
      const map = L.map('map').setView([-34.58290,-58.47923], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 100,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    const aula24 = L.marker([-34.58290,-58.47923]).addTo(map);
</script>