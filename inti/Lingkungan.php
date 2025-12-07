<?php

/**
 * Loader Lingkungan untuk Framework Rakit
 * Membaca file .env dan memuat konfigurasi
 */
class Lingkungan
{
    public static function muat(string $path = '.env'): void
    {
        if (!file_exists($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // Abaikan komentar dan baris kosong
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            // Pisahkan key dan value
            if (strpos($line, '=') !== false) {
                [$key, $value] = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);

                // Hapus tanda kutip jika ada
                if (str_starts_with($value, '"') && str_ends_with($value, '"')) {
                    $value = substr($value, 1, -1);
                }
                if (str_starts_with($value, "'") && str_ends_with($value, "'")) {
                    $value = substr($value, 1, -1);
                }

                // Simpan ke $_ENV dan define sebagai konstanta
                $_ENV[$key] = $value;
                if (!defined($key)) {
                    define($key, $value);
                }
            }
        }
    }
}
