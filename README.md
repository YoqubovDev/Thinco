<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>



## Laravel 12 Loyihasi

Bu loyiha Laravel 12 asosida ishlab chiqilgan. Ushbu qo'llanma yordamida loyhani ishga tushurishingiz mumkin.

## Boshlanish

### 1. Loyihani klonlash

https://github.com/YoqubovDev/Thinco.git
cd Thinco

2. PHP kutubxonalarni o‘rnatish

composer install
3. .env faylini yaratish

cp .env.example .env
4. APP kalitini generatsiya qilish


php artisan key:generate

6. Ma’lumotlar bazasi sozlamalari
.env fayl ichida quyidagi joylarni to‘ldiring:

for exampl
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

6. Migratsiyalarni ishga tushirish

php artisan migrate

7. Frontendni sozlash (agar Breeze ishlatilgan bo‘lsa)
   
npm install
npm run dev

9. Serverni ishga tushirish

php artisan serve
Sayt ochiladi: http://localhost:8000

Talablar
PHP >= 8.2

Composer

Node.js & npm

MySQL yoki boshqa ma'lumotlar bazasi

