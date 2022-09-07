# Career-Assessment

This repo was created to fulfill and complete the assessment from career.co.id.

## Requirements and Dependecies

1. PHP >8.0.2
2. Laravel v9.19
3. Composer 2.3.5
4. MySQL(Engine Database dapat diganti nantinya. Laravel mendukung engine lainnya seperti MariaDB 10.3+, MySQL 5.7+, PostgreSQL 10.0+, SQLite 3.8.8+, SQL Server 2017+)
5. Laravel/Sanctum

## Installation

1. Klon repositori (URL HTTPS : https://github.com/Ackyras/career-assessment.git ; SSH : git@github.com:Ackyras/career-assessment.git)
2. Jalankan `composer install` dari terminal di dalam folder anda melakukan klon repositori ini untuk menginstall _dependencies_ yang diperlukan
3. Jalankan `cp .env.example .env` dari terminal di dalam folder anda melakukan klon repositori ini untuk membuat file **.env** yang berguna untuk mengkonfigurasi aplikasi
4. Buat database baru dengan database engine yang didukung laravel (MariaDB 10.3+, MySQL 5.7+, PostgreSQL 10.0+, SQLite 3.8.8+, SQL Server 2017+)
5. Buka file **.env** dan ubah pengaturan database (ditandai dengan inisial **"DB\_"**) sesuai dengan konfigurasi database engine anda
6. Buka file **.env** dan masukkan API Key Raja Ongkir pada **RAJA_ONGKIR_API_KEY**
7. Jalankan `php artisan migrate` dari terminal di dalam folder anda melakukan klon repositori ini untuk melakukan migrasi awal database
8. Jalankan `php artisan key:generate` dari terminal di dalam folder anda melakukan klon repositori ini untuk membuat kunci aplikasi baru
9. Jalankan `php artisan serve` dari terminal di dalam folder anda melakukan klon repositori ini untuk menjalankan aplikasi (untuk autentikasi dummy, gunakan email : user@user, password : password);

## Penjelasan Branch

Branch main pada repository ini digunakan sebagai instalasi dan pengaturan dasar yang dibutuhkan dalam aplikasi ini, seperti:

1. Autentikasi(login)
2. Pengaturan Sanctum
3. Pengaturan Route
