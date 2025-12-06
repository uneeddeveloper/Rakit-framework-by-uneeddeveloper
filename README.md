<p align="center">
  <img src="https://raw.githubusercontent.com/uneeddeveloper/Rakit-framework-by-uneeddeveloper/e604d8dddcffd6ed6b59c69feb191d4fb61f9c8f/rakit.png" width="120">
</p>

<p align="center">
  <strong>Rakit Framework</strong><br>
  <em>Mini PHP Framework dengan Arsitektur HMVC – Simple, Modular, Indonesia Banget</em>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Framework-Rakit%20HMVC-00ff00?style=flat&logo=php">
  <img src="https://img.shields.io/badge/Version-1.0.0-00ff00?style=flat">
  <img src="https://img.shields.io/badge/License-MIT-00ff00?style=flat">
</p>

---

# 🛠️ Rakit — Framework HMVC Ringan Berbasis PHP

Framework modular, ringan, dan 100% berbahasa Indonesia.
Dibangun tanpa Composer, berjalan cepat di shared hosting, serta ideal untuk UMKM dan aplikasi kecil–menengah.

---

## 📌 Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Struktur Folder](#struktur-folder)
- [Instalasi](#instalasi)
- [Membuat Modul Baru](#membuat-modul-baru)
- [Sistem Tema (Layout)](#sistem-tema-layout)
- [Database Layer](#database-layer)
- [Sesi & Autentikasi](#sesi--autentikasi)
- [Penanganan Error](#penanganan-error)
- [Konvensi Penamaan](#konvensi-penamaan)
- [Debugging Umum](#debugging-umum)
- [Deployment ke Produksi](#deployment-ke-produksi)
- [Lisensi](#lisensi)

---

## 🚀 Fitur Utama

- **Arsitektur HMVC** — tiap fitur terisolasi dalam modul.
- **Routing sederhana** mirip Laravel (`rute/web.php`).
- **Controller berbasis class** (misal: `PengendaliAset`).
- **Tema global** untuk konsistensi tampilan.
- **Database layer ringan** berbasis PDO.
- **Error handling profesional** dengan halaman 404 & 500 berbahasa Indonesia.
- **Session & autentikasi bawaan**.
- **100% berbahasa Indonesia** — penamaan file, class, komentar.
- **Ringan & cepat**, cocok untuk shared hosting.
- **Tanpa Composer**, langsung jalan di PHP native.

---

## 🗂️ Struktur Folder

```
my-hmvc-umkm/
├── app/
│   ├── tema/
│   │   └── utama.php
│   ├── error/
│   │   ├── 404.php
│   │   └── 500.php
│   └── Modul/
│       ├── UMKM/
│       └── Aset/
├── konfigurasi/
│   ├── database.php
│   └── aplikasi.php
├── inti/
│   ├── Pengarah.php
│   └── BasisData.php
├── rute/
│   └── web.php
├── publik/
│   ├── index.php
│   └── .htaccess
├── umkm.sql
└── README.md
```

---

## 📥 Instalasi

### Persyaratan

- PHP **8.0+**
- MySQL / MariaDB
- Apache / Nginx / XAMPP / Laragon

### Langkah Instalasi

1. **Unduh project** ke folder web
   Contoh:

   ```
   C:/laragon/www/smu
   ```

2. **Import database**

   ```sql
   CREATE DATABASE umkm_app;
   -- lalu import file umkm.sql
   ```

3. **Atur koneksi database** di `konfigurasi/database.php`:

   ```php
   return [
       'host'         => 'localhost',
       'nama_database'=> 'umkm_app',
       'pengguna'     => 'root',
       'kata_sandi'   => '',
       'charset'      => 'utf8mb4'
   ];
   ```

4. **Atur mode aplikasi** di `konfigurasi/aplikasi.php`:

   ```php
   return [
       'mode' => 'development' // production jika sudah live
   ];
   ```

5. **Jalankan server** dari folder publik:

   ```bash
   cd publik
   php -S localhost:8000
   ```

6. Buka browser:
   👉 [http://localhost:8000](http://localhost:8000)

---

## 🛠️ Membuat Modul Baru

Setiap fitur (Aset, Produk, Laporan) dikelompokkan dalam modul.

### **1. Buat Struktur Folder**

```
Modul/NamaModul/
├── Controller/
│   └── PengendaliNamaModul.php
└── Tampilan/
    ├── daftar.php
    └── tambah.php
```

> Ganti **NamaModul** sesuai fitur, contoh: `Produk`

---

### **2. Buat Controller**

**Contoh:** `Modul/Produk/Controller/PengendaliProduk.php`

```php
<?php

class PengendaliProduk
{
    public function daftar()
    {
        // Hanya pengguna login yang boleh masuk
        if (!isset($_SESSION['id_umkm'])) {
            header("Location: /umkm/masuk");
            exit;
        }

        $this->tampilkan('daftar');
    }

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
```

---

### **3. Tambahkan Rute**

`rute/web.php`:

```php
$pengarah->ambil('/produk/daftar', 'PengendaliProduk@daftar');
$pengarah->ambil('/produk/tambah', 'PengendaliProduk@tambah');
```

---

## 🖥️ Sistem Tema (Layout)

Tema global berada di:

```
app/tema/utama.php
```

### Di Controller:

```php
$this->tampilkan('dasbor', ['nama' => 'Toko ABC']); // pakai tema
$this->tampilkan('masuk', $data, false);            // tanpa tema
```

### Di Tampilan:

```php
<?php $judul = "Manajemen Produk"; ?>
<h1><?= $judul ?></h1>
```

---

## 🗃️ Database Layer

Gunakan `BasisData` untuk query database.

### SELECT

```php
$data = BasisData::ambil("SELECT * FROM aset WHERE id_umkm = ?", [$id]);
```

### INSERT (mengembalikan ID)

```php
$id = BasisData::simpan("INSERT INTO produk (nama) VALUES (?)", [$nama]);
```

### UPDATE / DELETE

```php
BasisData::jalankan("DELETE FROM produk WHERE id = ?", [$id]);
```

---

## 🔐 Sesi & Autentikasi

Sesi aktif otomatis di `publik/index.php`.

### Cek login di controller:

```php
if (!isset($_SESSION['id_umkm'])) {
    header("Location: /umkm/masuk");
    exit;
}
```

---

## 🛑 Penanganan Error

### Mode Development

- Menampilkan pesan error lengkap
- untuk debugging lokal

### Mode Production

- Menyembunyikan error sensitif
- Menampilkan halaman:

  - `app/error/404.php`
  - `app/error/500.php`

> Pastikan `Pengarah.php` menangkap **Throwable**, bukan hanya Exception.

---

## 📜 Konvensi Penamaan

| Komponen         | Format                    | Contoh               |
| ---------------- | ------------------------- | -------------------- |
| Modul            | `NamaModul`               | Produk, Aset         |
| Controller       | `PengendaliNamaModul.php` | PengendaliAset.php   |
| Class controller | `PengendaliNamaModul`     | class PengendaliAset |
| Rute             | `/modul/aksi`             | /aset/daftar         |
| Tampilan         | `nama.php`                | daftar.php           |
| Tema             | `utama.php`               | app/tema/utama.php   |

---

## 🧪 Debugging Umum

| Error                            | Penyebab                           | Solusi                                   |
| -------------------------------- | ---------------------------------- | ---------------------------------------- |
| Pengendali tidak ditemukan       | File/folder salah                  | Pastikan berada di Modul/Nama/Controller |
| Tema tidak ditemukan             | File hilang                        | Cek app/tema/utama.php                   |
| Class `BasisData` not found      | Belum `require_once`               | Tambahkan di controller                  |
| 404 Not Found                    | Server salah folder                | Jalankan dari folder `publik`            |
| Halaman error mentah             | Pengarah tidak menangkap Throwable | Update try/catch di Pengarah.php         |
| File konfigurasi tidak ditemukan | Folder salah                       | Pastikan `konfigurasi/` ada di root      |

---

## 📦 Deployment ke Produksi

- Ubah mode aplikasi ke `production`
- Pastikan `.htaccess` tetap berada di folder `publik`
- Pindahkan folder publik sebagai web root hosting
- Jangan aktifkan display_errors di server

---

## 📄 Lisensi

Framework **Rakit** bebas digunakan untuk keperluan UMKM, komersial, atau edukasi.

---
