#!/bin/bash

# Crear symlink manual
ln -sfn /var/www/storage/app/public /var/www/public/storage

# Migraciones
php artisan migrate --force

# Iniciar servidor
php artisan serve --host=0.0.0.0 --port=8000
