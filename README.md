# 🛠️ Rakit

Framework HMVC ringan berbasis PHP.  
Modular. Ringan. Siap rakit untuk segala kebutuhan.

---

## 📌 Daftar Isi

- [Fitur Utama](#-fitur-utama)
- [Struktur Folder](#-struktur-folder)
- [Instalasi](#-instalasi)
- [Membuat Modul Baru](#-membuat-modul-baru)
- [Sistem Tema (Layout)](#-sistem-tema-layout)
- [Database Layer](#-database-layer)
- [Sesi & Autentikasi](#-sesi--autentikasi)
- [Penanganan Error](#-penanganan-error)
- [Konvensi Penamaan](#-konvensi-penamaan)
- [Debugging Umum](#-debugging-umum)
- [Deployment ke Produksi](#-deployment-ke-produksi)
- [Keunggulan untuk UMKM](#-keunggulan-untuk-umkm)
- [Lisensi](#-lisensi)

---

## ✅ Fitur Utama

- **Arsitektur HMVC** — tiap fitur terisolasi dalam modul
- **Routing sederhana** seperti Laravel (`rute/web.php`)
- **Controller berbasis class** dengan penamaan jelas (`PengendaliAset`)
- **Tema global** untuk konsistensi tampilan
- **Database layer ringan** berbasis PDO (aman dari SQL injection)
- **Error handling profesional** — halaman 404 & 500 kustom dalam Bahasa Indonesia
- **Session & autentikasi** bawaan
- **100% berbahasa Indonesia** — dari nama file hingga komentar kode
- **Ringan & cepat** — cocok untuk shared hosting
- **Tanpa Composer** — langsung jalan di PHP native

---

## 🗂️ Struktur Folder

my-hmvc-umkm/
├── app/ # Aplikasi inti
│ ├── tema/ # Tema/layout global
│ │ └── utama.php
│ ├── error/ # Halaman error kustom
│ │ ├── 404.php
│ │ └── 500.php
│ └── Modul/ # Semua modul aplikasi
│ ├── UMKM/ # Modul autentikasi & dasbor
│ └── Aset/ # Contoh modul tambahan
├── konfigurasi/ # Konfigurasi aplikasi & database
│ ├── database.php
│ └── aplikasi.php
├── inti/ # Core framework
│ ├── Pengarah.php # Router
│ └── BasisData.php # Database layer
├── rute/
│ └── web.php # Semua rute aplikasi
├── publik/ # Web root (public)
│ ├── index.php # Entry point
│ └── .htaccess
├── umkm.sql # Skema database awal
└── README.md # Dokumentasi ini

---

## 🚀 Instalasi

### Persyaratan

- PHP 8.0+
- MySQL / MariaDB
- Web server (Apache/Nginx/Laragon/XAMPP)

### Langkah-langkah

1. **Unduh proyek** ke folder web (misal: `C:\laragon\www\smu`)
2. **Import database**:
   ```sql
   CREATE DATABASE umkm_app;
   -- Lalu impor file umkm.sql
   ```
3. Sesuaikan koneksi database di konfigurasi/database.php
   return [
   'host' => 'localhost',
   'nama_database' => 'umkm_app',
   'pengguna' => 'root',
   'kata_sandi' => '',
   'charset' => 'utf8mb4'
   ];
4. Atur mode aplikasi di konfigurasi/aplikasi.php:
   return [
   'mode' => 'development' // Ganti ke 'production' saat deploy
   ];
5. Jalankan server dari folder publik
   cd publik
   php -S localhost:8000
6. Buka di browser: http://localhost:8000

🛠️ Membuat Modul Baru
Setiap fitur (Aset, Produk, Laporan) dibuat sebagai modul terpisah.

Langkah 1: Buat Struktur Folder
Modul/NamaModul/
├── Controller/
│ └── PengendaliNamaModul.php
└── Tampilan/
├── daftar.php
└── tambah.php
Ganti NamaModul dengan nama fiturmu (misal: Produk)
Langkah 2: Buat Controller
Contoh: Modul/Produk/Controller/PengendaliProduk.php

<?php
class PengendaliProduk
{
    public function daftar()
    {
        // Pastikan hanya pengguna login yang bisa akses
        if (!isset($_SESSION['id_umkm'])) {
            header("Location: /umkm/masuk");
            exit;
        }

        $this->tampilkan('daftar');
    }

    // Fungsi bantuan untuk tampilan
    private function tampilkan(string $nama_tampilan, array $data = [], bool $gunakan_tema = true): void
    {
        extract($data);
        $jalur = __DIR__ . "/../Tampilan/{$nama_tampilan}.php";
        if (!file_exists($jalur)) {
            throw new Exception("Tampilan tidak ditemukan: {$jalur}");
        }

        ob_start();
        require $jalur;
        $konten = ob_get_clean();

        if ($gunakan_tema) {
            $tema = dirname(__DIR__, 3) . '/app/tema/utama.php';
            if (!file_exists($tema)) {
                throw new Exception("Tema utama tidak ditemukan");
            }
            require $tema;
        } else {
            echo $konten;
        }
    }
}
Langkah 3: Tambahkan Rute
Di rute/web.php:
// Rute modul Produk
$pengarah->ambil('/produk/daftar', 'PengendaliProduk@daftar');
$pengarah->ambil('/produk/tambah', 'PengendaliProduk@tambah');

🖥️ Sistem Tema (Layout)
Semua halaman yang memerlukan header/footer menggunakan tema global di app/tema/utama.php.

Di Controller:
// Pakai tema (default)
$this->tampilkan('dasbor', ['nama' => 'Toko ABC']);

// Tanpa tema (untuk login/daftar)
$this->tampilkan('masuk', $data, false);

Qwen3-Max
4:43 AM
Tentu! Berikut adalah konten siap salin untuk file README.md — cukup salin seluruh teks di bawah ini, lalu tempel ke editor teks (Notepad, VS Code, dll), dan simpan sebagai README.md di folder root proyekmu.

markdown
1234567891011121314151617181920212223242526272829303132333435363738394041
# 🇮🇩 Sistem Modular UMKM (SMU)

> Framework HMVC ringan berbasis PHP, 100% berbahasa Indonesia, untuk pengembangan sistem manajemen UMKM, toko kecil, dan usaha lokal.  
> Terinspirasi oleh Laravel, dibangun tanpa dependensi berat, siap jalan di shared hosting.

---

## 📌 Daftar Isi
- [Fitur Utama](#-fitur-utama)
- [Struktur Folder](#-struktur-folder)

my-hmvc-umkm/
├── app/ # Aplikasi inti
│ ├── tema/ # Tema/layout global
│ │ └── utama.php
│ ├── error/ # Halaman error kustom
│ │ ├── 404.php
│ │ └── 500.php
│ └── Modul/ # Semua modul aplikasi
│ ├── UMKM/ # Modul autentikasi & dasbor
│ └── Aset/ # Contoh modul tambahan
├── konfigurasi/ # Konfigurasi aplikasi & database
│ ├── database.php
│ └── aplikasi.php
├── inti/ # Core framework
│ ├── Pengarah.php # Router
│ └── BasisData.php # Database layer
├── rute/
│ └── web.php # Semua rute aplikasi
├── publik/ # Web root (public)
│ ├── index.php # Entry point
│ └── .htaccess
├── umkm.sql # Skema database awal
└── README.md # Dokumentasi ini

12345678910111213141516

---

## 🚀 Instalasi

### Persyaratan
- PHP 8.0+
- MySQL / MariaDB
- Web server (Apache/Nginx/Laragon/XAMPP)


Sesuaikan koneksi database di konfigurasi/database.php:
php
1234567
Atur mode aplikasi di konfigurasi/aplikasi.php:
php
123
Jalankan server dari folder publik:
bash
12
Buka di browser: http://localhost:8000
🛠️ Membuat Modul Baru
Setiap fitur (Aset, Produk, Laporan) dibuat sebagai modul terpisah.

Langkah 1: Buat Struktur Folder
123456
Modul/NamaModul/
├── Controller/
│   └── PengendaliNamaModul.php
└── Tampilan/
    ├── daftar.php
    └── tambah.php
🔸 Ganti NamaModul dengan nama fiturmu (misal: Produk)

Langkah 2: Buat Controller
Contoh: Modul/Produk/Controller/PengendaliProduk.php

php
1234567891011121314151617181920212223242526272829303132333435363738
<?php
class PengendaliProduk
{
    public function daftar()
    {
        // Pastikan hanya pengguna login yang bisa akses
        if (!isset($_SESSION['id_umkm'])) {
            header("Location: /umkm/masuk");
            exit;
        }

Langkah 3: Tambahkan Rute
Di rute/web.php:

php
123
✅ Modul otomatis terdeteksi — tidak perlu ubah Pengarah.php!

🖥️ Sistem Tema (Layout)
Semua halaman yang memerlukan header/footer menggunakan tema global di app/tema/utama.php.

Di Controller:
php
12345
// Pakai tema (default)
$this->tampilkan('dasbor', ['nama' => 'Toko ABC']);

// Tanpa tema (untuk login/daftar)
$this->tampilkan('masuk', $data, false);
Di Tampilan:
Atur judul halaman:
<?php $judul = "Manajemen Produk"; ?>
<h1><?= $judul ?></h1>

🗃️ Database Layer
Gunakan class BasisData untuk akses database:
// SELECT
$data = BasisData::ambil("SELECT * FROM aset WHERE id_umkm = ?", [$id]);

// INSERT (kembalikan ID)
$id = BasisData::simpan("INSERT INTO produk (nama) VALUES (?)", [$nama]);

// UPDATE / DELETE
BasisData::jalankan("DELETE FROM produk WHERE id = ?", [$id]);

🔐 Sesi & Autentikasi
Sesi diaktifkan di publik/index.php
Periksa login di controller:
if (!isset($\_SESSION['id_umkm'])) {
header("Location: /umkm/masuk");
exit;
}

🛑 Penanganan Error
Mode Pengembangan (development)
Menampilkan detail error: pesan, file, baris, stack trace
Hanya untuk lingkungan lokal
Mode Produksi (production)
Menyembunyikan detail teknis
Tampilkan pesan umum yang ramah pengguna
File Error
app/error/404.php → Halaman tidak ditemukan
app/error/500.php → Error internal server
⚠️ Pastikan:

Struktur folder konfigurasi/ berada di root proyek
Pengarah.php menangkap Throwable, bukan hanya Exception

📜 Konvensi Penamaan
Komponen Format Contoh
**Modul** `NamaModul` `UMKM`, `Aset`, `Produk`
**Controller** `PengendaliNamaModul.php` `PengendaliAset.php`
**Class Controller** `PengendaliNamaModul` `class PengendaliAset`
**Rute** `/modul/aksi` `/aset/daftar`
**Tampilan** `nama.php` `daftar.php`, `tambah.php`
**Tema** `utama.php` `app/tema/utama.php`

🧪 Debugging Umum
Error Solusi
`Pengendali tidak ditemukan` Periksa nama file & folder (harus `Modul/Nama/Controller/PengendaliNama.php`)
`Tema tidak ditemukan` Pastikan file ada di `app/tema/utama.php`
`Class 'BasisData' not found` Tambahkan `require_once` ke `BasisData.php` di controller
`404 Not Found` Jalankan server dari folder `publik`, bukan root
Halaman error mentah muncul Pastikan `Pengarah.php` menangkap `Throwable`, bukan hanya `Exception`
`File konfigurasi tidak ditemukan` Pastikan `konfigurasi/` di root, bukan di dalam `app/`
