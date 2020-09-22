#!/bin/sh

echo "Installing php dependencies with composer..."
composer install

echo "Laravel app setting up..."
php artisan key:generate
php artisan storage:link

echo "Running migrations..."
php artisan migrate:fresh
php artisan db:seed --class=AdminSeeder
php artisan db:seed --class=PagesTableSeeder
php artisan db:seed --class=QuestionsTableSeeder
