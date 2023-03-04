# How to set this project on your local machine
- To set up this project on your local machine, follow the guide below

## Requirments
- "php": "^7.3|^8.0"
- "laravel/framework": "^8.75"
- MySql
- composer

## Installation
- Install all dependencies with ``` composer install ```
- Create a database with MySql
- navigate to the .env file, setup your db connection and include your FLUTTERWAVE_ENCRYPTION_KEY and FLUTTERWAVE_SECRET_KEY
- generate a default application key with ``` php artisan key:generate ```
- migrate database with ``` php artisan migrate ```
- load the database with some basic data ``` php artisan migrate --seed ```
- serve the application with ``` php artisan serve ```

## API collections and documentation 
https://documenter.getpostman.com/view/3821701/2s93JnU6nk