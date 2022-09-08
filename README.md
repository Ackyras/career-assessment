# Career-Assessment

---

## Requirements and Dependecies

---

1. PHP >8.0.2
2. Laravel v9.19
3. Composer 2.3.5
4. MySQL(Engine Database dapat diganti nantinya. Laravel mendukung engine lainnya seperti MariaDB 10.3+, MySQL 5.7+, PostgreSQL 10.0+, SQLite 3.8.8+, SQL Server 2017+)
5. Laravel/Sanctum

---

## Installation

---

1. Klon repositori (URL HTTPS : https://github.com/Ackyras/career-assessment.git ; SSH : git@github.com:Ackyras/career-assessment.git)
2. Jalankan `composer install` dari terminal di dalam folder anda melakukan klon repositori ini untuk menginstall _dependencies_ yang diperlukan
3. Jalankan `cp .env.example .env` dari terminal di dalam folder anda melakukan klon repositori ini untuk membuat file **.env** yang berguna untuk mengkonfigurasi aplikasi
4. Buat database baru dengan database engine yang didukung laravel (MariaDB 10.3+, MySQL 5.7+, PostgreSQL 10.0+, SQLite 3.8.8+, SQL Server 2017+)
5. Buka file **.env** dan ubah pengaturan database (ditandai dengan inisial **"DB\_"**) sesuai dengan konfigurasi database engine anda
6. Buka file **.env** dan masukkan API Key Raja Ongkir pada **RAJA_ONGKIR_API_KEY**
7. Jalankan `php artisan migrate` dari terminal di dalam folder anda melakukan klon repositori ini untuk melakukan migrasi awal database
8. Jalankan `php artisan key:generate` dari terminal di dalam folder anda melakukan klon repositori ini untuk membuat kunci aplikasi baru
9. Jalankan `php artisan serve` dari terminal di dalam folder anda melakukan klon repositori ini untuk menjalankan aplikasi (untuk autentikasi dummy, gunakan email : user@user, password : password);

---

## Penjelasan Branch

---

### Main

---

Branch main pada repository ini digunakan sebagai instalasi dan pengaturan dasar yang dibutuhkan dalam aplikasi ini, seperti:

1. Autentikasi(login)
2. Pengaturan Sanctum
3. Pengaturan Route

---

### Sprint-1

---

Branch ini dibuat untuk menyelesaikan sprint1, dengan kriteria:

```
1. Integrasi dengan API province & city Rajaongkir (paket starter)
   https://rajaongkir.com/dokumentasi/starter
2. Membuat artisan command​ yg melakukan fetching API data provinsi & kota dan data
   disimpan ke dalam database.
3. Membuat REST API untuk pencarian provinsi & kota dengan endpoint berikut:

    - [GET] /search/provinces?id={province_id}

    - [GET] /search/cities?id={city_id}


Data API pencarian ini mengambil dari database.
```

Integrasi dengan API Rajaongkir diimplementasikan dengan membuat _service/helper_ yang berisikan fungsi untuk melakukan _fetch_ data, pengecekan data, dan menyimpan data kedalam database. _Service/helper_ dapat dilihat pada direktori `app/Services/RajaOngkirService.php`

_Artisan command_ dibuat dan disimpan dalam direktori `app/Console/Commands/FetchAPI/RajaOngkir.php`. Untuk menjalankan _artisan command_, dapat dilakukan dengan menggunakan perintah `php artisan fetch:raja-ongkir`. Perintah ini akan menjalankan pengecekan data di database terlebih dahulu. Jika di dalam database telah tersimpan data _province_ ataupun _city_, program akan memastikan pengguna apakah pengguna yakin ingin melanjutkan proses atau tidak. Jika pengguna menyetujui, maka program akan melakukan _fetch_ data dari API Rajaongkir, dan memperbarui data yang telah disimpan jika ada, atau membuat data baru jika tidak.

REST API telah dibangun sesuai dengan kriteria, dan untuk endpoint yang tersedia adalah :

```
    - [GET] url/v1/search/province
        Endpoint ini akan memberikan data seluruh provinsi yang ada didalam database.

        Endpoint ini hanya memiliki 1 parameter yang bisa dimasukkan kedalam query.
        [GET] url/v1/search/province?id={id}
            Jika parameter id dimasukkan, maka program akan mengembalikan data provinsi yang memiliki id serupa.

    - [GET] url/v1/search/city
        Endpoint ini akan memberikan data seluruh kota yang ada didalam database.
        Endpoint ini hanya memiliki 1 parameter yang bisa dimasukkan kedalam query.
        [GET] url/v1/search/city?id={id}&province={province}
            Jika parameter id dimasukkan, maka program akan mengembalikan data kota yang memiliki id serupa.
            Jika parameter province dimasukkan, maka program akan mengembalikan data yang memiliki province_id serupa.
```

---

### Sprint-2

---

Branch ini dibuat untuk menyelesaikan sprint2, dengan kriteria:

```
Meningkatnya kebutuhan Web service, tim engineer memutuskan untuk membuat swapable implementation​ untuk endpoint pencarian provinsi dan kota.
1. Membuat sumber data pencarian province & cities bisa melalui database​ atau direct API​ raja ongkir (swapable implementation). Proses swap implementasi dapat dilakukan melalui konfigurasi tanpa merubah source code yang sudah dibuat.
2. Menyediakan API login agar endpoint pencarian hanya bisa diakses oleh authorized user saja.
3. Membuat unit test / API test agar web service tetap reliable & maintainable
```

_Swappable Implementation_ diterapkan dengan menggunakan _Repository Pattern_ yang dapat diatur melalui file `app/Providers/RepositoryServiceProvider.php`. _Provider_ ini melakukan pengikatan repository dengan bantuan _interface_ yang dapat dilihat di folder `app/Repositories/Interfaces/`. _Interface_ dibuat untuk masing-masing fitur(provinsi dan kota), dan masing-masing _interface_ memiliki 2 repositori yang terikat(_DatabaseRepository_ dan _APIRepository_). Untuk mengganti konfigurasi implementasi yang digunakan, dapat dilakukan dengan menghapus tag komentar pada kelas repository yang diimport dan yang berdirektorikan API, dan memberikan tag komentar pada kelas repository yang diimport dan yang berdirektorikan Database.

API _Login_ tersedia pada endpoint:

```
    [POST]  url/v1/auth/login
        parameter yang dibutuhkan adalah email dan password (untuk autentikasi akun dummy dapat dilihat diatas)
```

API autentikasi ini dibuat dengan menggunakan _package_ Laravel/Sanctum. Jika login berhasil, maka aplikasi akan memberikan access_token yang digunakan sebagai autentikasi bertipe _Bearer Token_ untuk melakukan _request_ ke _endpoint_ yang membutuhkan akses terautentikasi.

Untuk membuat web service tetap reliable dan maintainable, aplikasi ini memiliki 2 featured test yang dapat digunakan untuk melakukan testing terhadap aplikasi yang sudah dibuat. Featured test yang tersedia mewakili fitur untuk provinsi dan kota. Kedua featured test ini memiliki pengujian yang sama, yaitu: - Pengambilan data melalui database `[PASSED]` - Pengambilan data melalui API RajaOngkir `[PASSED]` - Data yang diterima, memang memiliki data yang tersimpan didalam database (diwakili dengan pengambilan data random dari database)`[PASSED]` - Data yang diterima dengan menggunakan repositori API dan Database memiliki jumlah yang sama `[PASSED]`

---

## Penutup

---

Saya mengucapkan terimakasih kepada tim HRD PT. DOT Indonesia atas kesempatan berharga yang telah diberikan untuk mengikuti penilaian melamar kerja di PT. DOT Indonesia.

Dalam penilaian ini, implementasi yang saya buat masih terdapat banyak kekurangan dan pastinya dapat dilakukan dengan cara yang lebih baik lagi. Namun, saya tetap berharap kiranya tim HRD PT. DOT Indonesia dapat memberikan saya kesempatan untuk dapat mengembangkan kemampuan saya dengan bekerja bersama tim developer dan bersama memajukan PT. DOT Indonesia.
