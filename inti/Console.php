<?php

namespace Inti;

class Console
{
    public function jalankan(array $argv): void
    {
        if (count($argv) < 2) {
            $this->tampilkanBantuan();
            exit;
        }

        $perintah = $argv[1];
        $parameter = array_slice($argv, 2);

        // Konversi "buat:controller" → "BuatController"
        $nama_file = str_replace(':', '', ucwords($perintah, ':'));
        $file_perintah = RAKIT_ROOT . DIRECTORY_SEPARATOR . 'perintah' . DIRECTORY_SEPARATOR . "{$nama_file}.php";

        if (file_exists($file_perintah)) {
            require_once $file_perintah;
            $kelas = "Perintah\\{$nama_file}";
            if (class_exists($kelas)) {
                $handler = new $kelas();
                $handler->jalankan($parameter);
            } else {
                $this->kesalahan("Kelas perintah tidak ditemukan: {$kelas}");
            }
        } else {
            $this->kesalahan("Perintah tidak dikenali: {$perintah}");
        }
    }

    private function tampilkanBantuan(): void
    {
        echo "\nRakit - Framework HMVC Ringan\n";
        echo "Penggunaan: php rkt [perintah] [argumen]\n\n";
        echo "Perintah yang tersedia:\n";
        echo "  buat:controller [NamaModul]   Buat controller dan struktur modul\n";
        echo "  db:migrate                    Jalankan migrasi database\n";
        echo "\n";
    }

    public function kesalahan(string $pesan): void
    {
        fwrite(STDERR, "Error: $pesan\n");
        exit(1);
    }
}
