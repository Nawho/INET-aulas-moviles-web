<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href='/app.css'>
    <link href="css/home.css" rel="stylesheet" type="text/css">

    <title>INET - Aulas móviles</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    <div class="bg"></div>
    @include('components.header')


    <main>
        <div class="initialBackground">
            <div class="centerHorizontally">
                <h1 class="mainTitle">Red de Aulas Talleres Móviles</h1>
                <h2 class="subTitle">Programa Federal de Educación Técnico Profesional</h2>
                <div class="textImage"><img src="/imgs/aulaMovilDesplegada.jpg" alt="Aula Móvil Desplegada"></div>
                <div class="card blue">
                    <h3 class="contentTitle">Nuestra historia</h3>
                    <p>
                        El Programa Federal Red de Aulas Talleres Móviles creado bajo Resolución N° 176/12 aprobada por
                        el
                        Consejo Federal de Educación (CFE), surgió en el año 2012 ante la necesidad de asegurar espacios
                        de
                        formación y capacitación a personas que residen alejadas de los centros urbanos (y que, de otra
                        manera,
                        no hubieran podido acceder, quedando fuera del sistema educativo y del trabajo); velando así por
                        el
                        aseguramiento de una educación inclusiva y de calidad en todo el territorio argentino.
                    </p>
                </div>

                <div class="card white">
                    <h3 class="contentTitle">¿Qué son las aulas móviles?</h3>
                    <p>
                        Las Aulas Talleres Móviles (ATM) refieren a una estructura transportable y desplazable, por vía
                        terrestre o acuática, que reproduce las características de un espacio de aula-taller y/o
                        laboratorio
                        para el desarrollo de actividades de capacitación, con las comodidades y el equipamiento
                        requeridos
                        para
                        tal fin, según la especialidad técnica atendida: 
                        <ol>
                            <li> Automatización industrial</li>
                            <li> Biotecnología vegetal</li>
                            <li> Energías Renovables y Alternativas </li>
                            <li> Gastronomía </li>
                            <li> Informática, redes y reparación de PC </li>
                            <li> Instalaciones domiciliarias </li>
                            <li> Metalmecánica</li>
                            <li> Refrigeración y Climatización </li>
                            <li> Reparación de autos y motos </li>
                            <li> Saberes Digitales</li>
                            <li> Sistemas Tecnológicos</li>
                            <li> Soldadura </li>
                            <li> Textil e indumentaria </li>
                        </ol>
                    </p>
                </div>

               
            </div>
        </div>
        <div class="backgroundGradient">
            <div class="centerHorizontally">
            <div class="card blue">
                <h3 class="contentTitle">Nuestra misión</h3>
                <p>
                    A 10 años de su creación y puesta en funcionamiento, la Red de Aulas Talleres Móviles corrobora
                    la
                    importancia de su rol educativo en la comunidad siendo evidenciada en los miles de egresados en
                    todo
                    el
                    país que hoy pueden desarrollar oficios de los más variados en la Industria Argentina; como así
                    también,
                    en los técnicas y técnicos, profesionales, docentes e instructores de la Educación Técnico
                    Profesional
                    que cursan diversos trayectos de formación continua, lo cual asegura el cumplimiento de la Ley
                    de
                    Educación de la República Argentina.
                </p>
            </div>

            <div class="card white">
                <h3 class="contentTitle">Distribución de las aulas móviles</h3>
                <p>
                    Actualmente, en todo el territorio argentino hay distribuidas más de 160 Aulas Talleres Móviles
                    -
                    cedidas en comodato por el Ministerio de Educación a través del INET a las 24 jurisdicciones -
                    y,
                    debido
                    al carácter evolutivo y la demanda social creciente vinculada a las ATMs y sus diversas ofertas
                    formativas, el Ministerio de Educación de la Nación amplió el presente programa.
                </p>
            </div>

            <div class="card blue">
                <h3 class="contentTitle">Impacto y Futuro del Programa</h3>
                <p>
                    Asimismo, el Programa Federal Red de ATM busca nuevas posibilidades de vinculación con planes y
                    programas nacionales o jurisdiccionales de desarrollo productivo y tecnológico, y de alianzas
                    estratégicas con organismos del ámbito científico tecnológico público, privado y/o del tercer sector
                    (ONGs, organizaciones sociales, fundaciones, o similares) que permitan potenciar el impacto
                    socio-productivo de las comunidades y las distintas regiones económicas del país.
                    <br>
                    Basado en el principio del trabajo mancomunado, la Comisión Federal de la ETP, integrado por
                    representantes de las 24 provincias, vela por una justa y fundamentada distribución territorial e
                    interjurisdiccional de las ATM, como así también, por el resguardo del patrimonio en cuestión,
                    estableciendo instrumentos de seguimiento que permitan realizar los ajustes necesarios para alcanzar
                    un
                    uso responsable del recurso existente y de las futuras nuevas 50 ATM en pronta licitación.

                </p>
            </div>
            
            </div>
        </div>
    </main>
    @include('components.footer')
    @include('widgets.chatbot-widget')
</body>

</html>
