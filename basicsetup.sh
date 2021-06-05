#!/bin/bash
php artisan migrate:fresh
cp .env.example .env
php artisan storage:link
php artisan key:generate
