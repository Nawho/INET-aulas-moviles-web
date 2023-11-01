<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>INET - Aulas móviles</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/list.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/table.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script
        src="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-1.13.6/cr-1.7.0/fh-3.4.0/r-2.5.0/rg-1.4.1/sc-2.2.0/datatables.min.js">
    </script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>

</head>

<body class="antialiased">
    @include('components.header')
    @include('components.filter ')

    <div class="centerHorizontally">
        <table id="tableList" class="dataTable hover row-border stripe cell-border">
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>Ubicación</th>
                    <th>Especialidad</th>
                    <th>Oferta Formativa</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Prácticas mecánicas de reparación de bugías de Fiat 600s</td>
                    <td>Buenos Aires</td>
                    <td>Baradero</td>
                    <td>INGENIERIA MECANICA</td>
                </tr>
                <tr>
                    <td>Instruccion en nuevas energias naturales</td>
                    <td>Chaco</td>
                    <td>Nueva Pompeya</td>
                    <td>ENERGÍAS RENOVABLES Y ALTERNATIVAS</td>
                </tr>
                <tr>
                    <td>Tecnicatura en instalacion y reparacion de equipos refrigerantes</td>
                    <td>Santa Fe</td>
                    <td>Esteban Rams</td>
                    <td>REFRIGERACIÓN Y CLIMATIZACIÓN</td>
                </tr>
            </tbody>
        </table>
    </div>

    @include('components.footer')
    @include('widgets.chatbot-widget')
</body>

</html>

<script>
    const BASE_URL = "{{ url('/') }}"

    const DATA_TABLE_PRESET = {
        scrollX: true,
        sort: 0,
        lengthMenu: [
            [20, 30, 50, -1],
            [20, 30, 50, 'All']
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
        },
        "columns": [{
                "data": "n_ATM"
            },
            {
                "data": "ubicaciones.0.ubicacion"
            },
            {
                "data": "especialidad_formativa"
            },
            {
                "data": "especialidad_formativa"
            }
        ]
    }

    const userLocation = {
        lat: 0,
        long: 0
    };


    const getAulasOverview = () => new Promise(async (resolve, reject) => {
        const res = await fetch(`${BASE_URL}/api/aulas-moviles-overview`)
        if (!res.ok) reject("Error fetching classrooms list.")

        const jsonRes = await res.json()
        resolve(jsonRes)
    })

    const updateTable = (aulasList, filters, table) => {
        const filteredAulasList = aulasList.filter((item) => {
            return (item.especialidad_formativa.toLowerCase().includes(filters.especialidad
                .toLowerCase()) || filters.especialidad == "") &&
                (item.ubicaciones[0].provincia.toLowerCase() == filters.provincia.toLowerCase() || filters
                    .provincia == "") &&
                (item.ubicaciones[0].localidad.toLowerCase() == filters.localidad.toLowerCase() || filters
                    .localidad == "")
        })

        table.DataTable().destroy()
        table.DataTable({
            ...DATA_TABLE_PRESET,
            data: filteredAulasList
        })
        table.DataTable().draw()
    }

    const filters = {
        "especialidad": "",
        "provincia": "",
        "localidad": ""
    }

    function addUbicacionField(auxaulasList) {
        const modifiedAulasList = auxaulasList.forEach((aula) => {
            const ubicacion = aula.ubicaciones[0]
            aula.ubicaciones[0]["ubicacion"] = ubicacion.localidad + ", " + ubicacion.provincia
        })
    }
    // LOCATION FILTER

    const getUserLocation = () => new Promise((resolve, reject) => {
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const lat = position.coords.latitude;
                    const long = position.coords.longitude;
                    console.log(`Latitude: ${lat}, longitude: ${long}`); 

                    userLocation.lat = lat 
                    userLocation.long = long
                    resolve({lat,long})
                },
                (error) => {
                    console.error("Error getting user location:", error);
                    reject(`Error getting user location: ${error}`)
                }
            )
        } else {
            console.error("Geolocation is not supported by this browser.");
            reject(`Geolocation is not supported by this browser`)
        }
    })

    function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
        var R = 6371; // Radius of the earth in km
        var dLat = deg2rad(lat2 - lat1); // deg2rad below
        var dLon = deg2rad(lon2 - lon1);
        var a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        var d = R * c; // Distance in km
        return d; // distance returned
    }

    function deg2rad(deg) {
        return deg * (Math.PI / 180)
    }

    function getDistanceFromArray(lat, long, aulasList) {
        for (let i = 0; i < aulasList.length; i++) {
            let distance = getDistanceFromLatLonInKm(parseInt(lat),
                parseInt(long), aulasList[i].ubicaciones[0].latitud,
                aulasList[i].ubicaciones[0].longitud);
            //Attaching returned distance from function to array elements
            aulasList[i].ubicaciones[0].distancia = distance;
        }
        console.log(aulasList);
    }

    function sortByDistance(aulasList) {
        aulasList.sort(function(a, b) {
            return a.ubicaciones[0].distancia - b.ubicaciones[0].distancia
        });
        console.log(aulasList);
    }


    jQuery(document).ready(async ($) => {
        const table = $('#tableList')
        const especialidadSelector = document.querySelector('#especialidad-formativa-selector')
        const provinciaSelector = document.querySelector('#provincia-selector')
        const localidadSelector = document.querySelector('#localidad-selector')

        const aulasList = await getAulasOverview()
        addUbicacionField(aulasList)
        console.log(aulasList);

        let filteredAulasList = []
        table.DataTable({
            ...DATA_TABLE_PRESET,
            data: aulasList
        })

        function addChangeListener(selector, property) {
            selector.addEventListener('change', () => {
                filters[property] = selector.value;
                updateTable(aulasList, filters, table);
            });
        }

        addChangeListener(especialidadSelector, 'especialidad');
        addChangeListener(provinciaSelector, 'provincia');
        addChangeListener(localidadSelector, 'localidad');

        console.log("LOCATION: ", userLocation)
        await getUserLocation();
        getDistanceFromArray(userLocation.lat, userLocation.long, aulasList);
        sortByDistance(aulasList);
        updateTable(aulasList, filters, table)

    });
</script>
