<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>INET - Aulas móviles</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/map.css') }}" rel="stylesheet" type="text/css">

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


    @include('components.filter')


    <div class="mapContainer">
        <div id="map"></div>
    </div>
    @include('components.footer')
    @include('widgets.chatbot-widget')
</body>

</html>
<script>
const BASE_URL = "{{url('/')}}"

const getAulasOverview = () => new Promise(async (resolve, reject) => {
    const res = await fetch(`${BASE_URL}/api/aulas-moviles-overview`)
    if (!res.ok) reject("Error fetching classrooms list.")

    const jsonRes = await res.json()
    resolve(jsonRes)
})

const filters = {
    "especialidad": "",
    "provincia": "",
    "localidad": ""
}

const map = L.map('map').setView([-39.20, -65.43], 4);

function capitalizeFirstLetter(str) {
    return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
}

function getUserLocation() {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude;
                const long = position.coords.longitude;
                map.setView([lat, long], 11)
            },
            (error) => {
                console.error("Error getting user location:", error);
            }
        )
    } else {
        console.error("Geolocation is not supported by this browser. Auto-centering map on Buenos Aires.");
        map.setView([-34.58290,-58.47923], 11)
    }
}

document.addEventListener('DOMContentLoaded', async () => {
    const especialidadSelector = document.querySelector('#especialidad-formativa-selector')
    const provinciaSelector = document.querySelector('#provincia-selector')
    const localidadSelector = document.querySelector('#localidad-selector')

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 100,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    getUserLocation()
    
    const aulasMovilesList = await getAulasOverview()
    aulasMovilesList.forEach((aulaMovil) => {
        const newAula = L.marker([aulaMovil.ubicaciones[0]?.longitud || 0, aulaMovil.ubicaciones[0]?.latitud || 0]).addTo(map);
        newAula.bindPopup(`
            <b>Aula ${aulaMovil.n_ATM}</b><br>
            Estado: ${aulaMovil.estado == 1 ? "En actividad" : "En receso"} <br>
            Especialidad: ${capitalizeFirstLetter(aulaMovil.especialidad_formativa)}<br>
            ubicación: ${aulaMovil.ubicaciones[0]?.localidad || ""}, ${aulaMovil.ubicaciones[0]?.provincia || ""} <br>
            <a href="/aula/${aulaMovil.n_ATM}">Más información</a>`).openPopup();
    })
})

</script>
