<?php

namespace Perintah;

class DbMigrate
{
    public function jalankan(array $parameter): void
    {
        echo "[✓] Memulai migrasi database...\n";

        // Muat konfigurasi database dari .env
        $config = require RAKIT_ROOT . DIRECTORY_SEPARATOR . 'konfigurasi' . DIRECTORY_SEPARATOR . 'database.php';

        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['nama_database']};charset={$config['charset']}";
            $pdo = new \PDO($dsn, $config['pengguna'], $config['kata_sandi'], [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);
        } catch (\Exception $e) {
            $this->kesalahan("Gagal koneksi ke database: " . $e->getMessage());
        }

        // Path folder migrasi
        $migrasi_dir = RAKIT_ROOT . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrasi';
        if (!is_dir($migrasi_dir)) {
            $this->kesalahan("Folder migrasi tidak ditemukan: {$migrasi_dir}");
        }

        // Ambil semua file .sql dan urutkan
        $files = glob($migrasi_dir . DIRECTORY_SEPARATOR . '*.sql');
        if (empty($files)) {
            echo "[ℹ] Tidak ada file migrasi ditemukan.\n";
            return;
        }

        sort($files);

        $total = count($files);
        $sukses = 0;

        foreach ($files as $file) {
            $nama_file = basename($file);
            echo "[⏳] Menjalankan: {$nama_file} ... ";

            try {
                $sql = file_get_contents($file);
                // Pisahkan query jika ada multiple statement
                $queries = array_filter(array_map('trim', explode(';', $sql)));
                foreach ($queries as $query) {
                    if (!empty($query)) {
                        $pdo->exec($query);
                    }
                }
                echo "BERHASIL\n";
                $sukses++;
            } catch (\Exception $e) {
                echo "GAGAL\n";
                $this->kesalahan("Error di {$nama_file}: " . $e->getMessage());
            }
        }

        echo "\n[✓] Migrasi selesai! {$sukses}/{$total} file berhasil.\n";
    }

    private function kesalahan(string $pesan): void
    {
        fwrite(STDERR, "Error: $pesan\n");
        exit(1);
    }
}
