<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lista de aulas móviles</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet" type="text/css">
    <link href="css/list.css" rel="stylesheet" type="text/css">
    <link href="css/table.css" rel="stylesheet" type="text/css">
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
    <div class="bg"></div>
    @include('components.header')
    @include('components.filter')

    <div class="centerHorizontally">
        <div class="tableContainer" style="opacity: 0;">
            <div class="listFlapContainer">
                <div class="flap activeFlap" id="flap-active">Activas ahora</div>
                <div class="flap" id="flap-coming">Próximamente</div>
            </div>
            <div class="tableBody">
                <table id="tableList" class="dataTable hover row-border stripe cell-border">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ubicación</th>
                            <th>Oferta formativa</th>
                            <th>Familia profesional</th>
                            <th>Inicio y fin</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="centerHorizontally">
        <div class="loader">
            Cargando datos...
        </div>
    </div>

    <div class="centerHorizontally" style="padding: 20px;">
           <i>Permítenos el acceso a tu ubicación para poder mostrarte las aulas más cercanas a ti.</i>
    </div>

    @include('components.footer')
    @include('widgets.chatbot-widget')
</body>

</html>

<script>
    const BASE_URL = "{{ url('/') }}"

    const filters = {
        "especialidad": "",
        "provincia": "",
        "localidad": "",
        "momentoActividad": "ahora"
    }

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
                "data": "n_atm"
            },
            {
                "data": "ubicacion_relevante.ubicacion"
            },
            {
                "data": "nombre"
            },
            {
                "data": "familia_profesional"
            },
            {
                "data": "ubicacion_relevante.desde_hasta"
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
        resolve(jsonRes)
    })

    function dateDiffWithNowInDays(a) {
        const _MS_PER_DAY = 1000 * 60 * 60 * 24;
        const utc1 = Date.UTC(a.getFullYear(), a.getMonth(), a.getDate());
        const now = Date.UTC(new Date());
        return Math.floor((now - utc1) / _MS_PER_DAY);
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

    const formatDate = (inputDate) => {
        const dateArray = inputDate.split("-");
        const transformedDate = dateArray[2] + "/" + dateArray[1] + "/" + dateArray[0];
        return transformedDate;
    }   

    const addRelevantLocations = (aulasList) => {
        aulasList.forEach((aula) => {
            const aulaLocation =  filters.momentoActividad === "ahora" ? getRelevantAulaLocations(aula).currentLoc : getRelevantAulaLocations(aula).nextLoc
            aula["ubicacion_relevante"] = aulaLocation || undefined
            if (aulaLocation) aulaLocation["ubicacion"] = aulaLocation.localidad + ", " + aulaLocation.provincia
            if (aulaLocation?.fecha_inicio && aulaLocation?.fecha_fin) aulaLocation.desde_hasta = `${formatDate(aulaLocation.fecha_inicio)} <br/>${formatDate(aulaLocation.fecha_fin)}` 
        })
    }

    const updateTable = async (aulasList, filters, table) => {
        addRelevantLocations(aulasList)

        const filteredAulasList = aulasList.filter((aula) => {
            const aulaLocation = aula["ubicacion_relevante"] 
            if (!aulaLocation || aulaLocation === undefined ) return false

            return (
                (filters.momentoActividad === "ahora" ? aula.estado === 1 : true) &&
                (aula.familia_profesional?.toLowerCase().includes(filters.especialidad
                    .toLowerCase()) || filters.especialidad == "") &&
                (aulaLocation.provincia.toLowerCase() == filters.provincia.toLowerCase() ||
                    filters.provincia == "") &&
                (aulaLocation.localidad.toLowerCase() == filters.localidad.toLowerCase() ||
                    filters.localidad == "")
            )
        })

        if (dbInitalized) table.DataTable().destroy()
        table.DataTable({
            ...DATA_TABLE_PRESET,
            data: filteredAulasList
        })
        table.DataTable().draw()
        if (!dbInitalized) dbInitalized = true

        updateLocalidades(aulasList)
    }

    const getUserLocation = () => new Promise(async (resolve, reject) => {
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const lat = position.coords.latitude;
                    const long = position.coords.longitude;

                    userLocation.lat = lat
                    userLocation.long = long
                    resolve({
                        lat,
                        long
                    })
                },
                (error) => {
                    console.warn("User rejected geolocation permission. Cannot center map on user location.");
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
            const loc = aula.ubicacion_relevante
            if (!loc) return false

            if ((aula.familia_profesional.toLowerCase().includes(filters.especialidad.toLowerCase()) || filters.especialidad === "") &&
                (loc.provincia?.trim().toLowerCase() === filters.provincia.trim().toLowerCase())) {
                localidades.add(loc.localidad)
            }
        })

        localidadSelector.innerHTML = '<option value="">Todas</option>'
        localidades.forEach(localidad => {
            localidadSelector.innerHTML += `<option value="${localidad}">${localidad}</option>`
        })
    }

    function capitalizeFirstLetter(str) {
        return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
    }

    function createMonthSelectorOptions() {
        const months = []
        for (let i = 0; i < 12; i++) {
            const month = new Date().getMonth() + 1 + i
            let year = new Date().getFullYear()
            year = month > 12 ? year + 1 : year

            months.push(`${capitalizeFirstLetter(new Date(year, month, 0).toLocaleString('es', {
                month: 'long'
            }))} (${year})`)
        }

        const monthSelector = document.querySelector('#month-selector')
        months.forEach((month, index) => {
            monthSelector.innerHTML += `<option value="${index}">${month}</option>`
        })    
    }


    jQuery(document).ready(async ($) => {
        const table = $('#tableList')
        const especialidadSelector = document.querySelector('#especialidad-formativa-selector')
        const provinciaSelector = document.querySelector('#provincia-selector')
        const localidadSelector = document.querySelector('#localidad-selector')
        const tableContainer = document.querySelector('.tableContainer')
        const activeNowFlap = document.querySelector("#flap-active")
        const comingFlap = document.querySelector("#flap-coming")
        const permissionsInfo = document.querySelector("#permissionsInfo")
        const loader = document.querySelector('.loader')
        const customHeaders = ['id', 'ubicacion', 'especialidad', 'familia profesional'];
        const filteredAulasList = []

        //supress datatable false alerts
        var originalAlert = window.alert;
        window.alert = function(message) { 
            if (!message.includes("DataTables warning")) originalAlert(message)
        }

        const aulasList = await getAulasOverview()
        addRelevantLocations(aulasList)

        getUserLocation().then(data => {
            getDistanceFromArray(userLocation.lat, userLocation.long, aulasList);
            sortByDistance(aulasList);
            updateTable(aulasList, filters, table);
        }).catch(err => {})


        function createAulaLinks() {
            $('#tableList tbody').on('click', 'tr', function() {
                var data = table.DataTable().row(this).data();
                window.location.href = 'aula/' + data.n_atm;
            });
        }

        tableContainer.style.opacity = 1
        loader.style.display = 'none'

        function addChangeListener(selector, property) {
            selector.addEventListener('change', () => {
                filters[property] = selector.value;
                if (property === 'provincia' || property === 'especialidad') {
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

        activeNowFlap.addEventListener('click', () => {
            activeNowFlap.classList.add('activeFlap')
            comingFlap.classList.remove('activeFlap')
            filters.momentoActividad = "ahora"
            updateTable(aulasList, filters, table);
        })

        comingFlap.addEventListener('click', () => {
            comingFlap.classList.add('activeFlap')
            activeNowFlap.classList.remove('activeFlap')
            filters.momentoActividad = "proximamente"
            updateTable(aulasList, filters, table);
        })

        initalFiltersUpdate(especialidadSelector, provinciaSelector, localidadSelector, aulasList, table)
        createAulaLinks()
    });
</script>
