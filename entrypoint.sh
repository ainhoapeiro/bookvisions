#!/bin/bash

echo "📂 Copiando archivos de storage a public..."
cp -r /var/www/storage/app/public/* /var/www/public/storage/

echo "📦 Ejecutando migraciones..."
php artisan migrate --force

echo "🚀 Iniciando servidor Laravel..."
exec php artisan serve --host=0.0.0.0 --port=8000
