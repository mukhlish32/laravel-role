<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Tentang
- Merupakan aplikasi fitur ACL (Access Control List / Role Base Access Control) yang digunakan untuk melakukan hak akses pada transaksi kategori biaya.

# Fitur
- Role
Digunakan untuk menentukan role pada suatu user nantinya. Pada setiap role akan disetting hak akses pada user dalam melakukan transaksi pada user.
- User
Digunakan sebagai aktor dalam transaksi yang ada di sistem.
- Kategori Biaya
Digunakan sebagai input data kategori biaya. Setiap kategori biaya juga akan mencatat data user yang melakukan penginputan.

# Info
- Saat pertama kali menambah data user, password akan otomatis menyimpan input '1234'. Anda hanya perlu ke fitur Ubah untuk mengubahnya sesuai yang anda inginkan (perlu menggunakan hak akses Superadmin).
- Saat menambah data role, data role akan otomatis menyimpan akses untuk membaca (read) data kategori yang diinput user sendiri.
- Fitur Akses digunakan untuk membuka hak akses pada transaksi Kategori Biaya. Untuk menjaga keamanan yang lebih secure, hanya hak akses Superadmin yang bisa melakukan transaksi data pada Role & User. Dijaga dengan memanfaatkan middleware.
- Di dalam tabel akses memiliki arti:
  - akses : merupakan nama akses yang digunakan untuk menjaga hak akses (create,read,update,delete)
  - semua : merupakan hak akses untuk menentukan apakah bisa melakukan transaksi semua (All) atau yang diinput diri sendiri (Own). Value 1 memiliki arti All sedangkan 0 memiliki arti Own
  - Apabila hak akses role tidak terdaftar di record akses maka user yang memiliki role tersebut tidak dapat melakukan transaksi yang tidak ada di record tersebut

# Yang Perlu Ditambah
- Masih belum ada fitur ubah data diri user .
- Perlu pengrombakan besar pada fitur akses apabila menambah fitur yang baru.
- Tabel pada database masih belum memiliki foreign-key sehingga tidak bisa restrict data terutama data yang akan dihapus.

# Spek
- Laravel 9
- PHP Version 8.1.6
- MYSQL
- HTML CSS

# Setup
- Buka direktori project di terminal anda.
- Ketik command : copy .env.example .env (copy paste file .env.example).
- Buat database dengan nama laravel-role.
- Lalu ketik command dibawah ini:
	- composer install
	- php artisan optimize:clear
	- php artisan key:generate (generate app key)
  - php artisan migrate (migrasi database)
  - php artisan db:seed
  - php artisan serve
- Selanjutnya buka link: http://127.0.0.1:8000/

# Login (username / password)
- Superadmin: admin / 1234
- Staf Keuangan: user / 1234

# Author
- Muhammad Mukhlish Syarif
