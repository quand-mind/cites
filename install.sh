#!/bin/sh

sudo apt install php php-cli php-fpm php-json php-pdo php-mysql php-zip php-gd  php-mbstring php-curl php-xml php-pear php-bcmath

echo "Installing php dependencies with composer..."
composer install
composer update

echo "Laravel app setting up..."
php artisan key:generate
php artisan storage:link

echo "Running migrations..."
php artisan migrate:fresh
php artisan db:seed --class=AdminSeeder
php artisan db:seed --class=PagesTableSeeder
php artisan db:seed --class=QuestionsTableSeeder
