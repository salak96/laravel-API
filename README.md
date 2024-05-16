
# Belajar Membuat Api di Laravel 11
    
Belajar API (Application Programming Interface) bisa menyenangkan dan membuka banyak kesempatan untuk pengembangan aplikasi! 


## Installation 


```bash
composer create-project laravel/laravel example-app
```


## Environment Variables

Sebelum membuat api konfigurasi database mysql dan nama database

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=belajarapi
DB_USERNAME=root
DB_PASSWORD=
```


## Generate key
```bash
php artisan generate:key
```

# Membuat data Model,Migrasi dan Controller di Laravel

```bash
php artisan make:model Namamodel -m -c --resource
```

# Kirim data Model dan migrasi di database
```bash
php artisan migrate
```
# Membuat Controller resourse api
```bash
php artisan make:resource PostResource
```
# Instal api
```bash
php artisan install:api
```
# Cek Route api list di laravel
```bash
php artisan route:list
```

# Running serve Laravel   
```bash
php artisan serve
```