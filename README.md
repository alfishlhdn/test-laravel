<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## Inventory Management API with Docker – Laravel 11
Hai, ini adalah hasil pengerjaan tes seleksi dari ID-GROW untuk posisi Software Engineer.
Project ini dibuat menggunakan Laravel 11 dan sudah disiapkan untuk berjalan menggunakan Docker.

## Fitur & Tujuan Project
Project ini dibuat berdasarkan ketentuan tes sebagai berikut:
- 4 Model utama: User, Produk, Lokasi, Mutasi
- Relasi Many-to-Many antara Produk dan Lokasi, dengan pivot stok
- Mutasi mengelola stok keluar / masuk
- Autentikasi token-based menggunakan Laravel Sanctum
- Full REST API (CRUD + history)
- Semua endpoint dilindungi token Bearer
- Project dapat dijalankan via Docker
- Dokumentasi endpoint disediakan melalui Postman

## Cara Menjalankan dengan Docker
1. Clone repository
    git clone https://github.com/alfishlhdn/test-laravel.git
    cd test-laravel
2. Copy dan edit environment
    cp .env.example .env , Edit bagian .env jika perlu (misal untuk koneksi database):
3. Build dan jalankan container
    docker-compose up -d --build
4. Akses container dan setup Laravel
    docker exec -it app bash
    composer install
    php artisan key:generate
    php artisan migrate
5. Akses project
    API URL: http://localhost:8000/api
    Laravel home: http://localhost:8000


## Dokumentasi API (Postman)
📎 Link dokumentasi API:
👉 https://galactic-moon-948563.postman.co/workspace/My-Workspace~524ede91-381a-4696-861c-c4328cbc52e7/collection/38891552-544c3a75-10e2-4e13-ad15-527f4621a691?action=share&creator=38891552


## Struktur Database
✅ Model dan Relasi:
User
nama, email, password

Produk
nama_produk, kode_produk, kategori, satuan

Lokasi
kode_lokasi, nama_lokasi

ProdukLokasi (Pivot)
produk_id, lokasi_id, stok

Mutasi
produk_lokasi_id, user_id, tanggal, jenis_mutasi, jumlah, keterangan

## Struktur Folder Penting
| Folder                     | Keterangan                         |
| -------------------------- | ---------------------------------- |
| `app/Models`               | Model Laravel                      |
| `app/Http/Controllers/API` | Controller API                     |
| `routes/api.php`           | Routing REST API                   |
| `Dockerfile`               | File Docker Laravel                |
| `docker-compose.yml`       | Konfigurasi multi-container Docker |

