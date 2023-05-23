# Configurar y ejecutar la API de Laravel

# Paso 1: Clonar el repositorio de la API de Laravel

Abre una terminal o línea de comandos en tu entorno local.

Navega hasta el directorio donde deseas clonar la API de Laravel.

# Ejecuta el siguiente comando para clonar el repositorio de la API:

$ git clone https://github.com/jlucorrea/api_laravel_sistema_ventas.git

Una vez completada la clonación, tendrás la API de Laravel lista para su configuración y ejecución.

# Paso 2: Configurar y ejecutar la API de Laravel

Accede al directorio de la API clonada:

$ cd api_laravel_sistema_ventas

# Crea un archivo .env basado en el archivo .env.example proporcionado:

Abre el archivo .env en un editor de texto y configura las variables de entorno relevantes, como la conexión a la base de datos y cualquier configuración específica que necesite tu entorno.

$ Genera una clave de aplicación ejecutando el siguiente comando:

$ php artisan key:generate

Ejecuta las migraciones para configurar la estructura de la base de datos:

$ php artisan migrate --seed

Si deseas cargar datos de prueba, puedes ejecutar los seeders:

$ php artisan serve

Esto iniciará el servidor en http://localhost:8000 de forma predeterminada.

La API de Laravel estará en funcionamiento y lista para recibir solicitudes desde el frontend.
