# Vanhack Dev Test - Inkbox
> Algorithm to take incoming orders and populate printing sheets

## Usage

This assumes that you already configured your database on .env file

```bash
cd print_sheet
php artisan migrate
php artisan db:seed
php -S localhost:8000 -t public
```
or

```bash
cd print_sheet
php artisan migrate:fresh --seed
php -S localhost:8000 -t public
```

## Test

You can test accessing **[http://localhost:8000/orders/](http://localhost:8000/orders/)**



This project was created with [Lumen PHP Framework](https://lumen.laravel.com/docs).
