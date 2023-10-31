<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href='css/app.css'>

        <title>INET - Aulas móviles</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased" >
        @include('components.header')


        <main style="margin: 0px 60px;">
        <h1>Red de Aulas Talleres Móviles</h1>
 
            <p>

            El Programa Federal Red de Aulas Talleres Móviles creado bajo Resolución N° 176/12 aprobada por el Consejo Federal de Educación (CFE), surgió en el año 2012 ante la necesidad de asegurar espacios de formación y capacitación a personas que residen alejadas de los centros urbanos (y que, de otra manera, no hubieran podido acceder, quedando fuera del sistema educativo y del trabajo); velando así por el aseguramiento de una educación inclusiva y de calidad en todo el territorio argentino.
            <br>    
            Las Aulas Talleres Móviles (ATM) refieren a una estructura transportable y desplazable, por vía terrestre o acuática, que reproduce las características de un espacio de aula-taller y/o laboratorio para el desarrollo de actividades de capacitación, con las comodidades y el equipamiento requeridos para tal fin, según la especialidad técnica atendida: Instalaciones Domiciliarias; Reparación de Autos y Motos; Soldadura; Informática, Redes y Reparación de PC; Refrigeración y Climatización; Textil e Indumentaria; Gastronomía; Energías Renovables y Alternativas; Metalmecánica; Automatización Industrial; Agropecuaria; Saberes Digitales; Sistemas Tecnológicos, entre otras.
            <br>
            A 10 años de su creación y puesta en funcionamiento, la Red de Aulas Talleres Móviles corrobora la importancia de su rol educativo en la comunidad siendo evidenciada en los miles de egresados en todo el país que hoy pueden desarrollar oficios de los más variados en la Industria Argentina; como así también, en los técnicas y técnicos, profesionales, docentes e instructores de la Educación Técnico Profesional que cursan diversos trayectos de formación continua, lo cual asegura el cumplimiento de la Ley de Educación de la República Argentina.
            <br>
            Actualmente, en todo el territorio argentino hay distribuidas más de 160 Aulas Talleres Móviles – cedidas en comodato por el Ministerio de Educación a través del INET a las 24 jurisdicciones – y, debido al carácter evolutivo y la demanda social creciente vinculada a las ATMs y sus diversas ofertas formativas, el Ministerio de Educación de la Nación amplió el presente programa.
            <br>
            En este sentido, durante el Ciclo Lectivo 2022, el CFE aprobó una nueva resolución (Resolución CFE N° 422/22) que permite consolidar el Programa Federal Red de Aulas Talleres Móviles como una Política de Estado en materia educativa, velando por la actualización de ofertas formativas que respondan a la matriz productiva local y regional, a la incorporación de nuevas tecnologías educativas digitales y a la adecuación de las herramientas de gestión y administración;  dando así respuesta a necesidades de formación para adolescentes, jóvenes y adultos, contribuyendo directamente de forma más rápida y eficiente al desarrollo tecnológico – productivo de las comunidades de cada jurisdicción.
            <br>
            Asimismo, el Programa Federal Red de ATM busca nuevas posibilidades de vinculación con planes y programas nacionales o jurisdiccionales de desarrollo productivo y tecnológico, y de alianzas estratégicas con organismos del ámbito científico tecnológico público, privado y/o del tercer sector (ONGs, organizaciones sociales, fundaciones, o similares) que permitan potenciar el impacto socio-productivo de las comunidades y las distintas regiones económicas del país.
            <br>
            Basado en el principio del trabajo mancomunado, la Comisión Federal de la ETP, integrado por representantes de las 24 provincias, vela por una justa y fundamentada distribución territorial e interjurisdiccional de las ATM, como así también, por el resguardo del patrimonio en cuestión, estableciendo instrumentos de seguimiento que permitan realizar los ajustes necesarios para alcanzar un uso responsable del recurso existente y de las futuras nuevas 50 ATM en pronta licitación.
            </p>
        </main>

        @include('widgets.chatbot-widget')
    </body>
</html>