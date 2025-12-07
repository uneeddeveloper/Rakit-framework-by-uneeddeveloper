<?php

namespace Perintah;

use Inti\Console;

class JalankanMigrasi
{
    public function jalankan(array $parameter): void
    {
        // Muat konfigurasi database
        $config = require __DIR__ . '/../konfigurasi/database.php';
        $dsn = "mysql:host={$config['host']};dbname={$config['nama_database']};charset={$config['charset']}";

        try {
            $pdo = new \PDO($dsn, $config['pengguna'], $config['kata_sandi']);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            die("[✗] Gagal koneksi database: " . $e->getMessage() . "\n");
        }

        $path_migrasi = __DIR__ . '/../database/migrasi';
        if (!is_dir($path_migrasi)) {
            die("[✗] Folder migrasi tidak ditemukan: $path_migrasi\n");
        }

        $files = glob($path_migrasi . '/*.sql');
        if (empty($files)) {
            echo "[ℹ] Tidak ada file migrasi.\n";
            return;
        }

        sort($files);
        foreach ($files as $file) {
            $sql = file_get_contents($file);
            $pdo->exec($sql);
            echo "[✓] Jalankan: " . basename($file) . "\n";
        }

        echo "[✓] Semua migrasi berhasil dijalankan!\n";
    }
}
