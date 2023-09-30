<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>INET - Aulas móviles</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset( 'css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset( 'css/map.css') }}" rel="stylesheet" type="text/css">

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
    <div id="searchBarContainerHolder">
        <div action="/" id="searchBarContainer">
            <button class="searchBarButton filterButton" style="float: left"><svg xmlns="http://www.w3.org/2000/svg"
                    height="36px" viewBox="0 0 24 24" width="36px" fill="#0E68AF">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M3 17v2h6v-2H3zM3 5v2h10V5H3zm10 16v-2h8v-2h-8v-2h-2v6h2zM7 9v2H3v2h4v2h2V9H7zm14 4v-2H11v2h10zm-6-4h2V7h4V5h-4V3h-2v6z" />
                </svg></button>
            <input type="text" placeholder="Buscar" name="Buscar">
            <button type="submit" class="searchBarButton searchButton" style="float: right"><svg
                    xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px" fill="#0E68AF">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                </svg></button>
        </div>
    </div>
    <div class="mapContainer">
        <div id="map"></div>
    </div>
    @include('components.footer')
</body>

</html>
<script>
    var map = L.map('map').setView([-39.20, -65.43], 4);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 100,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);  

    var marker = L.marker([51.5, -0.09]).addTo(map);

    marker.bindPopup("<b>Aula 13!</b><br>Estado: Abierta <br> Materias: Detonación de explosivos químicos").openPopup();
</script>