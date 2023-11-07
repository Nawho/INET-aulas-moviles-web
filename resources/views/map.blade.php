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
    const res = await fetch(`${BASE_URL}/api/aulas-moviles-overview-map`)
    if (!res.ok) reject("Error fetching aulas moviles list.")

    const jsonRes = await res.json()
    resolve(jsonRes)
})

const filters = {
    "especialidad": "",
    "provincia": "",
    "localidad": ""
}

const map = L.map('map').setView([-35.20, -65.43], 4);
const markersLayer = L.layerGroup()
markersLayer.addTo(map);


const greenMaker = new L.Icon({
  iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});

const redMaker = new L.Icon({
  iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});

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

function formatOfertasFormativas(ofertas_formativas) {
    if (ofertas_formativas.length == 0) return "Ahora mismo no hay ofertas disponibles para esta aula, revisa de nuevo más tarde."

    let ofertas_formativas_str = ""
    ofertas_formativas.forEach((oferta_formativa, index) => {
        if (index == ofertas_formativas.length - 1) {
            ofertas_formativas_str += oferta_formativa.familia_profesional
        } else {
            ofertas_formativas_str += oferta_formativa.familia_profesional + ", "
        }
    })
    return ofertas_formativas_str
}

function updateMap(aulasList) {
    markersLayer.clearLayers()

    const filteredAulasList = aulasList.filter((item) => {
        return (
            (formatOfertasFormativas(item.ofertas_formativas).toLowerCase().includes(filters.especialidad.toLowerCase()) || filters.especialidad == "") &&
            (item.ubicaciones[0]?.provincia.toLowerCase() == filters.provincia.toLowerCase() || filters.provincia == "") &&
            (item.ubicaciones[0]?.localidad.toLowerCase() == filters.localidad.toLowerCase() || filters.localidad == "")
        )
    })

    filteredAulasList.forEach((aulaMovil) => {
        if (aulaMovil.ubicaciones.length == 0) return

        const newAula = L.marker([aulaMovil.ubicaciones[0]?.longitud || 0, aulaMovil.ubicaciones[0]?.latitud || 0], {
            icon: aulaMovil.estado == 1 ? greenMaker : redMaker
        }).addTo(markersLayer)


        newAula.bindPopup(`
            <b>Aula: </b>${aulaMovil.n_ATM}<br>
            <b>Estado: </b>${aulaMovil.estado == 1 ? "En actividad" : "En receso"} <br>
            <b>Especialidad: </b>${capitalizeFirstLetter(formatOfertasFormativas(aulaMovil.ofertas_formativas))}<br>
            <b>Ubicación: </b>${aulaMovil.ubicaciones[0]?.localidad || "(localidad no especificada)"}, ${aulaMovil.ubicaciones[0]?.provincia || "(provincia no especificada)"} <br>
            <a href="/aula/${aulaMovil.n_ATM}">Más información</a>`).openPopup();
    })
}

function initalFiltersUpdate(especialidadSelector, provinciaSelector, localidadSelector, aulasList) {
    filters["especialidad"] = especialidadSelector.value;
    filters["provincia"] = provinciaSelector.value;
    filters["localidad"] = localidadSelector.value;

    updateMap(aulasList)
}

document.addEventListener('DOMContentLoaded', async () => {
    const especialidadSelector = document.querySelector('#especialidad-formativa-selector')
    const provinciaSelector = document.querySelector('#provincia-selector')
    const localidadSelector = document.querySelector('#localidad-selector')
    let aulasMovilesList = []

    function addChangeListener(selector, property) {
        selector.addEventListener('change', () => {
            filters[property] = selector.value;
            updateMap(aulasMovilesList);
        });
    }
        
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        id: 'osm-hot'
    }).addTo(map);

    getUserLocation()

    addChangeListener(especialidadSelector, 'especialidad');
    addChangeListener(provinciaSelector, 'provincia');
    addChangeListener(localidadSelector, 'localidad');
    
    aulasMovilesList = await getAulasOverview()

    initalFiltersUpdate(especialidadSelector, provinciaSelector, localidadSelector, aulasMovilesList)
})

</script>
