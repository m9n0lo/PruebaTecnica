# PruebaTecnica

# REQUISITOS TECNOLOGICOS
Laravel ^12
PHP ^8.2
Livewire ^3.6
Filament ^4.0
Tailwinds ^4.0

# INSTALAR DEPEDENCIAS
composer install
npm install

# Generacion de KEY
php artisan Key:generate

# Configuracion Storage Link
php artisan storage:link

# BD y migraciones base y llenado de la BD
php artisan migrate
php artisan db:seed

# Creacion usuario Filament
php artisan make:filament-user


# Correr aplicativo
npm run dev
php artisan serve

#RUTAS
/tienda => es la pagina publica donde estas los productos con cards
/admin => es el dashboard de filament
