# INET - ATM (Aulas Talleres Móviles)
Programa de prácticas profesionalizantes para el desarrollo de aplicaciones web - línea de desarrollo 1: "Aulas Talleres Móviles".

<br/>

### Descripción
Se trata de una aplicación web para conocer la ubicación georreferenciadas de cada aula móvil, y su oferta formativa.
Fue desarrollada para ser <i> responsive </i> con un criterio <i>mobile-first</i> y bajo los lineamientos del “Manual de identidad visual INET para desarrollo de aplicaciones".

<br/>

<details>
  <summary><b>Tecnologías y librerías</b></summary>

### Tecnologías
<b>Frontend</b>
- HTML5
- CSS3
- Javascript
- Blade

<b> Backend </b>
- PHP 8.2
- Laravel 10
- MySQL

<br/>

### Librerías destacables
- Botman Studio 9 (Chatbot)
- OpenStreetMap
- Leaflet.js (librería JS open-source para mapas interactivos mobile-friendly)
</details>

<details>
  <summary><b>Guía de instalación</b></summary>
  
1\. Asegúrate de tener PHP 8.2 y MySQL instalados en tu sistema.

2\. Clona el repositorio:
```bash
git clone https://github.com/Nawho/INET-aulas-moviles-web
```

3\. Navega hasta el directorio del proyecto:
```bash
cd ./INET-aulas-moviles-web-main
```

4\. Instala las dependencias de Composer y NPM:
```bash
composer install
npm install
```
5\. Crea una copia del archivo .env:
```bash
cp .env.example .env
```

6\. Genera una clave de aplicación:
```bash
php artisan key:generate
```

7\. Hostea localmente tu base de datos MYSQL. Encontrarás las tablas y un par de datos de ejemplo en `database/base_db_creator.sql`. 

8\. Configura la base de datos en el archivo .env con las credenciales de tu base de datos.

9\. Inicia el servidor de desarrollo de Vite, así como artisan:
```bash
php artisan serve
npm run dev
```

10\. Visita http://localhost:8000 en tu navegador web para probar la aplicación.
</details>
