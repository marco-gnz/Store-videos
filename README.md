# Backend - Store Videos

## Deploy in server

1. Tener instalado Docker
2. Si requiere hacer una configuración de dependencia debes editar el Dockerfile

### En contenedor de la app
1. Ejecutar composer install
2. Ejecutar npm install
3. Ejecutar npm run dev
4. Ejecutar cp .env.example .env para generar un nuevo archivo .env 
5. Ejecutar php artisan key:generate para generar una nueva key al archivo .env

### En contenedor de la bd
1. Crear bd
2. Ejecutar php artisan migrate en contenedor de la aplicación 
