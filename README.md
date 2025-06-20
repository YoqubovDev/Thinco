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


## Docker-based Development / Docker-ga asoslangan ishlab chiqish

### Prerequisites / Talablar
- Docker
- Docker Compose

### Setup / O'rnatish
1. Build and start containers / Konteynerlarni yaratish va ishga tushirish:
    ```
    docker compose up -d --build
    ```

2. The application will be available at / Ilova quyidagi manzilda ishlaydi:
    - Main application / Asosiy ilova: http://localhost:9000
    - Development server / Ishlab chiqish serveri: http://localhost:5173

## Working with Artisan / Artisan bilan ishlash

All Artisan commands should be executed through the Docker container / Barcha Artisan buyruqlari Docker konteyner orqali bajarilishi kerak:

```bash
docker exec thinko_app php artisan <command>
```

Common examples / Umumiy misollar:

```bash
# Run migrations / Migratsiyalarni ishga tushirish
docker exec thinko_app php artisan migrate

# Fresh migrations with seeding / Migratsiyalarni qayta ishga tushirish va ma'lumotlarni to'ldirish
docker exec thinko_app php artisan migrate:fresh --seed

# Start queue worker / Navbat ishchisini ishga tushirish
docker exec thinko_app php artisan queue:work
```

## Troubleshooting / Muammolarni hal qilish

If you encounter any issues / Agar muammolarga duch kelsangiz:

1. Check container status / Konteyner holatini tekshiring:
    ```bash
    docker ps
    ```

2. Verify environment variables / Muhit o'zgaruvchilarini tekshiring:
    - Check .env file matches docker-compose.yml
    - Ensure DB_HOST=thinko_db

3. View container logs / Konteyner loglarini ko'ring:
    ```bash
    docker logs thinko_app
    docker logs thinko_db
    ```

4. Restart containers if needed / Zarur bo'lsa, konteynerlarni qayta ishga tushiring:
    ```bash
    docker compose down
    docker compose up -d
    ```
