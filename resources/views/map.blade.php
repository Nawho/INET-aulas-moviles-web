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
    <!--div id="searchBarContainerHolder">
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
    </div-->
    
    <div class="centerHorizontally">
        <div class="filtersSectionContainer">
            <!--div class="filtersTitle"><b>Filtros</b></div-->

            <!--div class="centerHorizontally" style="height: 3px; width: 100%;">
                <hr style="height: 3px; width: 100%; background-color: var(--blue-inet);">
            </div-->

            <div class="filtersContainer">
                <div class="filter">
                    <label for="especialidad-formativa-selector"><b>Especialidad formativa</b></label>
                    <select id="especialidad-formativa-selector">
                        <option value="ALL" selected>Todas</option>
                        <option value="AUTOMATIZACION INDUSTRIAL">Automatización industrial</option>
                        <option value="BIOTECNOLOGIA VEGETAL">Biotecnología vegetal</option>
                        <option value="ENERGÍAS RENOVABLES Y ALTERNATIVAS">Energías renovables y alternativas</option>
                        <option value="GENERICA">Genérica</option>
                        <option value="INFORMATICA, REDES Y REPARACION DE PC">Informática, redes y reparación de PC</option>
                        <option value="INSTALACIONES DOMICILIARIAS">Instalaciones domiciliarias</option>
                        <option value="METALMECANICA">Metlamecánica</option>
                        <option value="REFRIGERACION Y CLIMATIZACION">Refrigeración y climatización</option>
                        <option value="REPARACION DE AUTOS Y MOTOS">Reparación de autos y motos</option>
                        <option value="SABERES DIGITALES">Saberes digitales</option>
                        <option value="SISTEMAS TECNOLOGICOS">Sistemas tecnológicos</option>
                        <option value="TEXTIL E INDUMENTARIA">Textil e indumentaria</option>
                    </select>
                </div>

                <div class="filter">
                    <label for="provincia-selector"><b>Provincia</b></label>
                    <select id="provincia-selector">
                        <option value="ALL" selected>Todas</option>
                        <option value="BUENOS AIRES">Buenos Aires</option>
                        <option value="CATAMARCA">Catamarca</option>
                        <option value="CHACO">Chaco</option>
                        <option value="CHUBUT">Chubut</option>
                        <option value="CÓRDOBA">Córdoba</option>
                        <option value="CORRIENTES">Corrientes</option>
                        <option value="ENTRE RÍOS">Entre Ríos</option>
                        <option value="FORMOSA">Formosa</option>
                        <option value="JUJUY">Jujuy</option>
                        <option value="LA PAMPA">La Pampa</option>
                        <option value="LA RIOJA">La Rioja</option>
                        <option value="MENDOZA">Mendoza</option>
                        <option value="MISIONES">Misiones</option>
                        <option value="NEUQUÉN">Neuquén</option>
                        <option value="RÍO NEGRO">Río Negro</option>
                        <option value="SALTA">Salta</option>
                        <option value="SAN JUAN">San Juan</option>
                        <option value="SAN LUIS">San Luis</option>
                        <option value="SANTA CRUZ">Santa Cruz</option>
                        <option value="SANTA FE">Santa Fe</option>
                        <option value="SANTIAGO DEL ESTERO">Santiago del Estero</option>
                        <option value="TIERRA DEL FUEGO">Tierra del Fuego</option>
                        <option value="TUCUMÁN">Tucumán</option>     
                    </select>
                </div>

                <div class="filter">
                    <label for="localidad-selector"><b>Localidad</b></label>
                    <select id="localidad-selector">
                        <option value="ALL" selected>Todas</option>
                        <option value="BUENOS AIRES">Buenos Aires</option>
                        <option value="CATAMARCA">Catamarca</option>
                        <option value="CHACO">Chaco</option>
                        <option value="CHUBUT">Chubut</option>
                        <option value="CÓRDOBA">Córdoba</option>
                        <option value="CORRIENTES">Corrientes</option>
                        <option value="ENTRE RÍOS">Entre Ríos</option>
                        <option value="FORMOSA">Formosa</option>
                        <option value="JUJUY">Jujuy</option>
                        <option value="LA PAMPA">La Pampa</option>
                        <option value="LA RIOJA">La Rioja</option>
                        <option value="MENDOZA">Mendoza</option>
                        <option value="MISIONES">Misiones</option>
                        <option value="NEUQUÉN">Neuquén</option>
                        <option value="RÍO NEGRO">Río Negro</option>
                        <option value="SALTA">Salta</option>
                        <option value="SAN JUAN">San Juan</option>
                        <option value="SAN LUIS">San Luis</option>
                        <option value="SANTA CRUZ">Santa Cruz</option>
                        <option value="SANTA FE">Santa Fe</option>
                        <option value="SANTIAGO DEL ESTERO">Santiago del Estero</option>
                        <option value="TIERRA DEL FUEGO">Tierra del Fuego</option>
                        <option value="TUCUMÁN">Tucumán</option>     
                    </select>
                </div>
            </div>
        </div>
    </div>


    <div class="mapContainer">
        <div id="map"></div>
    </div>
    @include('components.footer')
    @include('widgets.chatbot-widget')

</body>

</html>
<script>

    
    const map = L.map('map').setView([-39.20, -65.43], 4);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 100,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    /*
    const aula24 = L.marker([-34.58290,-58.47923]).addTo(map);
    aula24.bindPopup(`
        <b>Aula 24</b><br>
        Estado: En actividad <br>
        Especialidad: Instalaciones domiciliarias<br>
        Localidad: Parque Chas <br>
        <a href="/aula-movil-demo">Más información</a>`).openPopup();
    
    const aula71 = L.marker([-34.70664,-58.37149]).addTo(map);
    aula71.bindPopup("<b>Aula 71</b><br>Estado: En receso <br> Especialidad: Genérica <br>Localidad: Lanús Este<br><a href='/aula-movil-demo'>Más información</a>").openPopup();
    */

    function capitalizeFirstLetter(str) {
        return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
    }

    function getAulasOverview() {
        fetch('{{ url('/aulas-moviles-overview') }}')
        .then(response => {
            if (!response.ok) {
                console.log(response)
                throw new Error('Data request failed.');
            }
            return response.json();
        })
        .then(aulasMovilesList => {
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
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    }


    function getUserLocation() {
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const lat = position.coords.latitude;
                    const long = position.coords.longitude;

                    console.log(`Latitude: ${lat}, longitude: ${long}`);
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

document.addEventListener('DOMContentLoaded', function() {
    getUserLocation()
    getAulasOverview()
})

</script>
