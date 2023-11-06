<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>INET- Aula móvil N°24 </title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel='stylesheet' href="{{ url('css/app.css') }}" type="text/css">
    <link rel='stylesheet' href="{{ url('css/app.css') }}" type="text/css">


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        h1 {
            text-align: center;
        }

        main {
            width: 100%;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2,
        h3,
        h4 {
            margin: 0;
        }

        p {
            text-align: center
        }

        .aulaInfoLines {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        .ult-actualizacion {
            margin-top: 60px;
            color: rgba(77, 77, 77, 0.833);
            font-weight: 300;
            font-size: small;
        }

        .aulaInfoLine {
            font-size: 0.8rem;
        }

        .contact {
            width: 600px;
            padding: 16px;
            margin: 20px 0px;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: var(--blue-inet);
            border-radius: 8px;
            color: white;
        }

        .contact-title {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .ofertaFormativa {
            margin-top: 20px;
            border: 3px solid var(--blue-inet);
            border-radius: 8px;
            padding: 12px;
            width: 600px;
        }

        #map {
            height: 300px;
            width: 600px;

            border: 3px solid var(--blue-inet);
            border-radius: 8px;
        }

        .mailAndTel {
            margin-top: 12px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .contactLine {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .contactLine svg {
            width: 20px !important;
            height: 20px !important;
        }


        @media screen and (max-width: 700px) {
            #map {
                height: 300px;
                width: 90vw;
            }

            .filtersSectionContainer {
                width: 90vw
            }

            .ofertaFormativa {
                width: 90vw;
            }

            .filtersContainer {
                flex-direction: column;
                align-items: center;
            }

            .contact {
                width: 90vw;
            }
        }
    </style>
</head>

<body class="antialiased">
    @include('components.header')
    @if ($datos_aula && isset($datos_aula->n_ATM))
        <main>
            <h1> Aula móvil {{ $datos_aula->n_ATM }} ({{ $datos_aula->estado == 1 ? 'Activa' : 'En receso' }})</h1>
            <div id="map"></div>
                @foreach ($datos_aula->ofertas_formativas as $oferta_formativa)
                    <div class="ofertaFormativa">
                        @if (isset($oferta_formativa))
                            <h2>{{ $oferta_formativa->nombre }}</h2>
                            <h4>{{ $oferta_formativa->familia_profesional }}</h4>
                            <p>{{ $oferta_formativa->descripcion }}</p>
                   
                            <div><b>Inicio:</b> {{$oferta_formativa->fecha_inicio}}</div>
                            <div><b>Fin:</b> {{$oferta_formativa->fecha_fin}}</div>
                        @else
                            <p>
                                No se encontraron datos de la oferta formativa de esta aula.
                            </p>
                        @endif
                    </div>
                @endforeach

                <div class="aulaInfoLines">
                    <div class="contact">
                        @if (isset($datos_aula->contact))
                        <div class="contact-title">Contacto</div>
                        <div class="mailAndTel">
                            @if (isset($datos_aula->contact->email))
                                <a class="contactLine" href="mailto:administracion_aula24@gmail.com">                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="white">
                                        <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                                    </svg>
                                    <span>{{ $datos_aula->contact->email }}</span>
                                </a>
                            @endif

                            @if (isset($datos_aula->contact->tel))
                                <a class="contactLine" href="tel:+54 9 11 1213-1415">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="white">
                                        <path
                                            d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                                    </svg>
                                    <span>{{ $datos_aula->contact->tel }}</span>
                                </a>
                            @endif
                        </div>

                        @else
                            <div class="contact-title">No se encontraron datos del contacto de esta aula</div>
                        @endif

                    </div>
                </div>

        </main>
    @else
        <div>
            <h1>No hay datos disponibles para este aula</h1>
        </div>
    @endif

    @include('components.footer')
    @include('widgets.chatbot-widget')
</body>

</html>

<script>
    const lat = "{{ isset($datos_aula->ubicaciones[0]->latitud) ? $datos_aula->ubicaciones[0]->latitud : 0 }}";
    const long = "{{ isset($datos_aula->ubicaciones[0]->longitud) ? $datos_aula->ubicaciones[0]->longitud : 0 }}";
    const state = "{{ isset($datos_aula->estado) ? $datos_aula->estado : 0 }}";

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

    const map = L.map('map').setView([long, lat], 8);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 100,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    const aulaMarker = L.marker([long || 0, lat || 0], {
        icon: state == 1 ? greenMaker : redMaker
    }).addTo(map)
</script>
