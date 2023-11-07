<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>INET - Aulas móviles</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet" type="text/css">
    <link href="css/list.css" rel="stylesheet" type="text/css">
    <link href="css/table.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script src="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-1.13.6/cr-1.7.0/fh-3.4.0/r-2.5.0/rg-1.4.1/sc-2.2.0/datatables.min.js">
    </script>   


    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>

</head>

<body class="antialiased">
    @include('components.header')
    @include('components.filter')

    <div class="centerHorizontally">
    <label>
            <input type="checkbox" id="sort_by_closeness" value="true" /> Ordenar por cercanía
    </label>
    </div>

    <div class="centerHorizontally">
        <table id="tableList" class="dataTable hover row-border stripe cell-border">    
        <thead>
                <tr>
                    <th>ID</th>
                    <th>Ubicación</th>
                    <th>Nombre oferta</th>
                    <th>Familia profesional</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="centerHorizontally">
        <div class="loader">
            Cargando datos...
        </div>
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
                "data": "nombre"
            },
            {
                "data": "familia_profesional"
            }
        ],
    }

    const userLocation = {
        lat: 0,
        long: 0
    };

    let dbInitalized = false

    const getAulasOverview = () => new Promise(async (resolve, reject) => {
        const res = await fetch(`${BASE_URL}/api/aulas-moviles-overview-list`)
        if (!res.ok) reject("Error fetching classrooms list.")

        const jsonRes = await res.json()
        console.log(jsonRes)
        resolve(jsonRes)
    })

    const updateTable = async (aulasList, filters, table) => {
        const checkbox = document.querySelector("#sort_by_closeness")
        if (checkbox.checked) {
            const loader = document.querySelector('.loader')
            loader.style.display = 'block'
            loader.innerText = 'Obteniendo ubicación...'
            
            getUserLocation().then(data => {
                getDistanceFromArray(userLocation.lat, userLocation.long, aulasList);
                sortByDistance(aulasList);
            }).catch(err => { })
            loader.style.display = 'none'
            loader.innerText = 'Cargando datos...'
        }

        const filteredAulasList = aulasList.filter((item) => {
            return (
                (item.familia_profesional?.toLowerCase().includes(filters.especialidad
                .toLowerCase()) || filters.especialidad == "") &&
                (item.ubicaciones[0]?.provincia.toLowerCase() == filters.provincia.toLowerCase() || filters
                    .provincia == "") &&
                (item.ubicaciones[0]?.localidad.toLowerCase() == filters.localidad.toLowerCase() || filters
                    .localidad == "")
            )
        })


        if (dbInitalized) table.DataTable().destroy()
        table.DataTable({
            ...DATA_TABLE_PRESET,
            data: filteredAulasList
        })
        table.DataTable().draw()
        if (!dbInitalized) dbInitalized = true
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

    const getUserLocation = () => new Promise((resolve, reject) => {
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const lat = position.coords.latitude;
                    const long = position.coords.longitude;

                    userLocation.lat = lat 
                    userLocation.long = long
                    resolve({lat,long})
                },
                (error) => {
                    console.warn("Error getting user location:", error);
                    reject(`Error getting user location: ${error}`)
                }
            )
        } else {
            console.warn("Geolocation is not supported by this browser.");
            reject(`Geolocation is not supported by this browser`)
        }
    })

    function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
        const R = 6371; // Radius of the earth in km
        const dLat = deg2rad(lat2 - lat1); // deg2rad below
        const dLon = deg2rad(lon2 - lon1);
        const a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        const d = R * c; // Distance in km
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
    }

    function sortByDistance(aulasList) {
        aulasList.sort(function(a, b) {
            return a.ubicaciones[0].distancia - b.ubicaciones[0].distancia
        });
    }

    function initalFiltersUpdate(especialidadSelector, provinciaSelector, localidadSelector, aulasList, table) {
        filters["especialidad"] = especialidadSelector.value;
        filters["provincia"] = provinciaSelector.value;
        filters["localidad"] = localidadSelector.value;

        updateTable(aulasList, filters, table)
    }

    function updateLocalidades(aulasList) {
        const localidades = new Set()
        const localidadSelector = document.querySelector('#localidad-selector')

        aulasList.forEach(aula => {
            console.log(aula.ubicaciones[0].provincia, filters.provincia)
            if (aula.ubicaciones[0].provincia.trim().toLowerCase() === filters.provincia.trim().toLowerCase() &&
                (aula.familia_profesional.toLowerCase().includes(filters.especialidad.toLowerCase()) || filters.especialidad == "")) {
                localidades.add(aula.ubicaciones[0].localidad)
            }
        })

        localidadSelector.innerHTML = '<option value="">Todas</option>'
        localidades.forEach(localidad => {
            localidadSelector.innerHTML += `<option value="${localidad}">${localidad}</option>`
        })
    }

    jQuery(document).ready(async ($) => {
        const table = $('#tableList')
        const especialidadSelector = document.querySelector('#especialidad-formativa-selector')
        const provinciaSelector = document.querySelector('#provincia-selector')
        const localidadSelector = document.querySelector('#localidad-selector')
        const loader = document.querySelector('.loader')
        const customHeaders = ['id', 'ubicacion', 'especialidad', 'familia profesional']; 
        const sortByClosestDistance = document.querySelector('#sort_by_closeness')

        const aulasList = await getAulasOverview()

        function createAulaLinks() {
            $('#tableList tbody').on('click', 'tr', function () {
                var data = table.DataTable().row(this).data();
                window.location.href = 'aula/' + data.n_ATM;
            });
        }

        loader.style.display = 'none'
        addUbicacionField(aulasList)

        let filteredAulasList = []

        function addChangeListener(selector, property) {
            selector.addEventListener('change', () => {
                filters[property] = selector.value;
                if (property === 'provincia' ||  property === 'especialidad') {
                    filters['localidad'] = ''
                    localidadSelector.value = ''
                    updateLocalidades(aulasList)
                }

                updateTable(aulasList, filters, table);
                createAulaLinks()
            });
        }

        addChangeListener(especialidadSelector, 'especialidad');
        addChangeListener(provinciaSelector, 'provincia');
        addChangeListener(localidadSelector, 'localidad');

        initalFiltersUpdate(especialidadSelector, provinciaSelector, localidadSelector, aulasList, table)
        createAulaLinks()
});
</script>
