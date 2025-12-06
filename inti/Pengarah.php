<?php

class Pengarah
{
    private array $rute = [];

    public function ambil(string $uri, string $tindakan): void
    {
        $this->rute[rtrim($uri, '/') ?: '/'] = $tindakan;
    }

    public function jalankan(): void
    {
        try {
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri = rtrim($uri, '/') ?: '/';

            if (!isset($this->rute[$uri])) {
                $error404 = dirname(__DIR__, 1) . '/app/error/404.php';
                if (file_exists($error404)) {
                    http_response_code(404);
                    require $error404;
                } else {
                    http_response_code(404);
                    echo "404 — Halaman tidak ditemukan";
                }
                return;
            }

            $tindakan = $this->rute[$uri];
            if (!str_contains($tindakan, '@')) {
                throw new Exception("Format tindakan salah. Gunakan 'Pengendali@metode'");
            }

            [$kelas, $metode] = explode('@', $tindakan);

            if (str_starts_with($kelas, 'Pengendali')) {
                $modul = substr($kelas, 10);
            } else {
                throw new Exception("Nama kelas pengendali harus dimulai dengan 'Pengendali'");
            }

            $file = __DIR__ . "/../Modul/{$modul}/Controller/{$kelas}.php";

            if (!file_exists($file)) {
                throw new Exception("File pengendali tidak ditemukan: {$file}");
            }

            require_once $file;

            if (!class_exists($kelas)) {
                throw new Exception("Kelas {$kelas} tidak ditemukan");
            }

            $pengendali = new $kelas();
            if (!method_exists($pengendali, $metode)) {
                throw new Exception("Metode {$metode} tidak ditemukan di {$kelas}");
            }

            $pengendali->$metode();
        } catch (Throwable $e) { // ✅ GANTI INI: Throwable, bukan Exception
            http_response_code(500);
            $error500 = dirname(__DIR__, 1) . '/app/error/500.php';
            if (file_exists($error500)) {
                $error_exception = $e;
                require $error500;
            } else {
                echo "Terjadi kesalahan pada sistem. (" . $e->getMessage() . ")";
            }
        }
    }
}
