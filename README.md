<p align="center">
  <img src="https://raw.githubusercontent.com/uneeddeveloper/Rakit-framework-by-uneeddeveloper/e604d8dddcffd6ed6b59c69feb191d4fb61f9c8f/rakit.png" width="120">
</p>

<p align="center">
  <strong>Rakit Framework</strong><br>
  <em>HMVC PHP Framework – Ringan, Modular, Indonesia Banget</em>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Framework-Rakit%20HMVC-00ff00?style=flat&logo=php">
  <img src="https://img.shields.io/badge/Version-1.0.0-00ff00?style=flat">
  <img src="https://img.shields.io/badge/License-MIT-00ff00?style=flat">
</p>

---

# 🛠️ Rakit

> Framework HMVC ringan berbasis PHP, 100% berbahasa Indonesia, untuk pengembangan aplikasi web modular.  
> Ringan. Cepat. Siap CLI. Tanpa dependensi berat. Untuk semua developer.

---

## 📌 Daftar Isi

- [Fitur Utama](#-fitur-utama)
- [Persyaratan](#-persyaratan)
- [Instalasi](#-instalasi)
- [Struktur Folder](#-struktur-folder)
- [CLI (Command Line Interface)](#-cli-command-line-interface)
  - [`buat:controller`](#buatcontroller)
  - [`db:migrate`](#dbmigrate)
- [Konfigurasi Lingkungan](#-konfigurasi-lingkungan)
- [Database & Migrasi](#-database--migrasi)
- [Modul & Routing](#-modul--routing)
- [Tema (Layout)](#-tema-layout)
- [Penanganan Error](#-penanganan-error)
- [Deployment ke Produksi](#-deployment-ke-produksi)
- [Lisensi](#-lisensi)

---

## ✅ Fitur Utama

- **Arsitektur HMVC** — tiap fitur terisolasi dalam modul
- **CLI Bawaan** — buat controller & migrasi database via terminal
- **Routing Sederhana** — seperti Laravel (`rute/web.php`)
- **Tema Global** — konsistensi tampilan di seluruh halaman
- **Database Layer Aman** — berbasis PDO, aman dari SQL injection
- **Error Handling Profesional** — halaman 404 & 500 kustom
- **Konfigurasi `.env`** — kelola database & mode aplikasi
- **100% Berbahasa Indonesia** — dari nama file hingga dokumentasi
- **Portable** — jalan di Windows, Linux, Mac, laptop siapa saja

---

## ⚙️ Persyaratan

- PHP 8.0+
- MySQL / MariaDB
- Web server (Apache/Nginx/Laragon/XAMPP)

---

## 🚀 Instalasi

1. **Unduh atau clone proyek** ke folder web:

```

C:/laragon/www/rakit

```

2. **Buat database**:

```sql
CREATE DATABASE rakit_app;
```

3. **Salin file konfigurasi**:

   ```bash
   copy .env.contoh .env    # Windows
   cp .env.contoh .env      # Linux/Mac
   ```

4. **Isi `.env`:**

   ```ini
   MODE_APLIKASI=development
   NAMA_DATABASE=rakit_app
   PENGGUNA_DATABASE=root
   KATA_SANDI_DATABASE=
   ```

5. **Jalankan server**:

   ```bash
   cd publik
   php -S localhost:8000
   ```

6. Buka browser:
   **[http://localhost:8000](http://localhost:8000)**

---

## 🗂️ Struktur Folder

```
rakit/
├── app/                  # Aplikasi inti
│   ├── tema/             # Tema/layout global
│   ├── error/            # Halaman error kustom
│   └── ...
├── database/migrasi/     # File migrasi SQL
├── inti/                 # Core framework
├── konfigurasi/          # Konfigurasi aplikasi & database
├── Modul/                # Semua modul aplikasi
├── perintah/             # Perintah CLI
├── publik/               # Web root (public)
├── rute/                 # Routing aplikasi
├── .env                  # Konfigurasi lingkungan
├── .env.contoh           # Contoh konfigurasi
├── rkt                   # CLI utama
└── README.md
```

---

# 💻 CLI (Command Line Interface)

Framework `Rakit` menyediakan CLI untuk mempercepat pengembangan.

### Penggunaan Umum

```bash
php rkt [perintah] [argumen]
```

---

### 🔧 `buat:controller`

Membuat modul lengkap: controller + view.

```bash
php rkt buat:controller Produk
```

Hasil:

- `Modul/Produk/Controller/PengendaliProduk.php`
- `Modul/Produk/Tampilan/index.php`

---

### 🗄 `db:migrate`

Menjalankan semua file SQL di `database/migrasi/`.

```bash
php rkt db:migrate
```

Penamaan migrasi harus:

```
01_buat_tabel_user.sql
02_buat_tabel_produk.sql
```

---

## ⚙️ Konfigurasi Lingkungan

Gunakan file `.env` untuk mengatur:

```ini
# MODE
MODE_APLIKASI=development

# DATABASE
HOST_DATABASE=localhost
NAMA_DATABASE=rakit_app
PENGGUNA_DATABASE=root
KATA_SANDI_DATABASE=
CHARSET_DATABASE=utf8mb4

# URL
URL_APLIKASI=http://localhost:8000
```

---

## 🗃️ Database & Migrasi

### 1. Membuat file migrasi

```sql
-- database/migrasi/01_buat_tabel_umkm.sql
CREATE TABLE umkms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL
);
```

### 2. Menjalankan migrasi

```bash
php rkt db:migrate
```

### 3. Query database di framework

```php
$data = BasisData::ambil("SELECT * FROM aset WHERE id = ?", [$id]);
$id = BasisData::simpan("INSERT INTO produk (nama) VALUES (?)", [$nama]);
```

---

## 🧩 Modul & Routing

### Struktur Modul

```
Modul/Produk/
├── Controller/PengendaliProduk.php
└── Tampilan/daftar.php
```

### Routing

`rute/web.php`:

```php
$pengarah->ambil('/produk', 'PengendaliProduk@index');
$pengarah->ambil('/produk/daftar', 'PengendaliProduk@daftar');
```

---

## 🎨 Tema (Layout)

Default tema: `app/tema/utama.php`

### Controller menggunakan tema:

```php
$this->tampilkan('dashboard', ['nama' => 'Rakit App']);
```

### Tanpa tema:

```php
$this->tampilkan('login', $data, false);
```

---

## 🛑 Penanganan Error

### Mode development

- Semua error terlihat

### Mode production

- Error disembunyikan
- Menggunakan tampilan:

  - `app/error/404.php`
  - `app/error/500.php`

---

## 🚀 Deployment ke Produksi

1. Ubah mode aplikasi:

   ```ini
   MODE_APLIKASI=production
   ```

2. Matikan error reporting:

   ```php
   error_reporting(0);
   ini_set('display_errors', 0);
   ```

3. Upload ke hosting
4. Jalankan migrasi:

   ```bash
   php rkt db:migrate
   ```

---

## 📄 Lisensi

MIT License — bebas digunakan untuk proyek pribadi maupun komersial.

---

<p align="center">
  Dibangun dengan ❤️ untuk developer Pemula Indonesia 🇮🇩
</p>

---

# 🟢 **READY!**
