<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mapa de aulas móviles</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet" type="text/css">
    <link href="css/map.css" rel="stylesheet" type="text/css">

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
    <div class="bg"></div>

    @include('components.header')
    @include('components.filter')

    <div class="centerHorizontally">
        <div class="loader">
            Cargando datos...
        </div>
    </div>

    <div class="verticalSpacer"></div>

    <div class="mapContainer" style="display:none;">
        <div class="innerMapContainer">
            <div class="mapFlapContainer">
                <div class="flap activeFlap" id="flap-active">Activas ahora</div>
                <div class="flap" id="flap-coming">Próximamente</div>
            </div>
            <div id="map"></div>
        </div>
    </div>

    <div class="centerHorizontally" style="padding: 20px;">
           <i>Permítenos el acceso a tu ubiación para poder mostrarte las aulas más cercanas a ti.</i>
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
    "localidad": "",
    "momentoActividad": "ahora"
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
                map.setView([lat, long], 8)
            },
            (error) => {
                console.warn("User rejected geolocation permission. Cannot center map on user location.");
            }
        )
    } else {
        console.error("Geolocation is not supported by this browser. Auto-centering map on Buenos Aires.");
        map.setView([-34.58290,-58.47923], 11)
    }
}

const getRelevantAulaLocations = (aula) => {
    let locationWithNearestStartDate = null
    let nextLocationWithNearestStartDate = null

    for (let i = 0; i < aula.ubicaciones.length; i++) {
        const ubicacion = aula.ubicaciones[i]
        const fecha_inicio = new Date(ubicacion.fecha_inicio)
        const fecha_fin = new Date(ubicacion.fecha_fin)
        const now = new Date()

        if (fecha_inicio <= now && fecha_fin >= now) {
            if (locationWithNearestStartDate) {
                if (dateDiffWithNowInDays(fecha_inicio) < dateDiffWithNowInDays(locationWithNearestStartDate)) {
                    locationWithNearestStartDate = ubicacion
                }
            } else {
                locationWithNearestStartDate = ubicacion
            }
        }

        if (fecha_inicio > now && fecha_fin > now) {
            if (nextLocationWithNearestStartDate) {
                if (dateDiffWithNowInDays(fecha_inicio) < dateDiffWithNowInDays(nextLocationWithNearestStartDate)) {
                    nextLocationWithNearestStartDate = ubicacion
                }
            } else {
                nextLocationWithNearestStartDate = ubicacion
            }
        }
    }

    return {
        currentLoc: JSON.parse(JSON.stringify(locationWithNearestStartDate)),
        nextLoc: JSON.parse(JSON.stringify(nextLocationWithNearestStartDate)),
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

    const filteredAulasList = aulasList.filter((aula) => {
        const aulaLocation =  filters.momentoActividad === "ahora" ? getRelevantAulaLocations(aula).currentLoc : getRelevantAulaLocations(aula).nextLoc
        if (!aulaLocation) return false
        aula["ubicacion_relevante"] = aulaLocation

        return (
            (filters.momentoActividad === "ahora" ? aula.estado === 1 : true) &&
            (formatOfertasFormativas(aula.ofertas_formativas).toLowerCase().includes(filters.especialidad.toLowerCase()) || filters.especialidad == "") &&
            (aulaLocation.provincia.toLowerCase() == filters.provincia.toLowerCase() || filters.provincia == "") &&
            (aulaLocation.localidad.toLowerCase() == filters.localidad.toLowerCase() || filters.localidad == "")
        )
    })

    filteredAulasList.forEach((aula) => {
        const loc = aula.ubicacion_relevante
        if (!loc) return false
        if (!loc.longitud || !loc.latitud) return false

        const newAula = L.marker([loc.longitud, loc.latitud], {
            icon: aula.estado == 1 ? greenMaker : redMaker
        }).addTo(markersLayer)

        newAula.bindPopup(`
            <b>Aula: </b>${aula.n_atm}<br>
            <b>Estado: </b>${aula.estado === 1 ? "En actividad" : "En receso"} <br>
            <b>Especialidad${aula.ofertas_formativas.length > 1 ? "es" : ""}: </b>${capitalizeFirstLetter(formatOfertasFormativas(aula.ofertas_formativas))}<br>
            <b>Ubicación: </b>${loc.localidad || "(localidad no especificada)"}, ${loc.provincia || "(provincia no especificada)"} <br>
            <a href="/aula/${aula.n_atm}">Detalles del aula</a>`
        ).openPopup();
    })
}

function updateLocalidades(aulasList) {
    const localidades = new Set()
    const localidadSelector = document.querySelector('#localidad-selector')

    aulasList.forEach(aula => {
        const loc = aula.ubicacion_relevante
        if (!loc) return false

        const ofertasIncludeEspecialidad = aula.ofertas_formativas.some(oferta => oferta.familia_profesional?.toLowerCase().includes(filters.especialidad.toLowerCase()))
        if ((ofertasIncludeEspecialidad || filters.especialidad === "") &&
            (loc.provincia?.trim().toLowerCase() === filters.provincia.trim().toLowerCase())) {
            localidades.add(loc.localidad)
        }
    })

    localidadSelector.innerHTML = '<option value="">Todas</option>'
    localidades.forEach(localidad => {
        localidadSelector.innerHTML += `<option value="${localidad}">${localidad}</option>`
    })
}

function initalFiltersUpdate(especialidadSelector, provinciaSelector, localidadSelector, aulasList) {
    filters["especialidad"] = especialidadSelector.value;
    filters["provincia"] = provinciaSelector.value;
    filters["localidad"] = localidadSelector.value;

    updateMap(aulasList)
    updateLocalidades(aulasList)
}

document.addEventListener('DOMContentLoaded', async () => {
    const especialidadSelector = document.querySelector('#especialidad-formativa-selector')
    const provinciaSelector = document.querySelector('#provincia-selector')
    const localidadSelector = document.querySelector('#localidad-selector')
    const loader = document.querySelector('.loader')
    const activeNowFlap = document.querySelector("#flap-active")
    const comingFlap = document.querySelector("#flap-coming")
    const mapContainer = document.querySelector('.mapContainer')
    
    getUserLocation()
    const aulasList = await getAulasOverview()

    function addChangeListener(selector, property) {
        selector.addEventListener('change', () => {
            filters[property] = selector.value;
            if (property === 'provincia' ||  property === 'especialidad') {
                filters['localidad'] = ''
                localidadSelector.value = ''
                updateLocalidades(aulasList)
            }

            updateMap(aulasList);
        });
    }
        
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        id: 'osm-hot'
    }).addTo(map);

    loader.style.display = 'none'
    mapContainer.style.display = 'flex'

    addChangeListener(especialidadSelector, 'especialidad');
    addChangeListener(provinciaSelector, 'provincia');
    addChangeListener(localidadSelector, 'localidad');

    activeNowFlap.addEventListener('click', () => {
        activeNowFlap.classList.add('activeFlap')
        comingFlap.classList.remove('activeFlap')
        filters.momentoActividad = "ahora"
        updateMap(aulasList);
    })

    comingFlap.addEventListener('click', () => {
        comingFlap.classList.add('activeFlap')
        activeNowFlap.classList.remove('activeFlap')
        filters.momentoActividad = "proximamente"
        updateMap(aulasList);
    })
    
    initalFiltersUpdate(especialidadSelector, provinciaSelector, localidadSelector, aulasList)
})

</script>
