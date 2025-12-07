<?php

namespace Perintah;

class BuatController
{
    public function jalankan(array $parameter): void
    {
        if (empty($parameter[0])) {
            $this->tampilkanPanduan();
            exit(1);
        }

        $nama_modul = trim($parameter[0]);
        if (!preg_match('/^[a-zA-Z_]\w*$/', $nama_modul)) {
            $this->kesalahan("Nama modul tidak valid. Gunakan huruf dan angka saja.");
        }

        // Gunakan RAKIT_ROOT yang sudah didefinisikan
        $modul_dir = RAKIT_ROOT . DIRECTORY_SEPARATOR . 'Modul';
        $path_controller = $modul_dir . DIRECTORY_SEPARATOR . $nama_modul . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . "Pengendali{$nama_modul}.php";
        $path_tampilan = $modul_dir . DIRECTORY_SEPARATOR . $nama_modul . DIRECTORY_SEPARATOR . 'Tampilan';

        // Buat folder Modul jika belum ada
        if (!is_dir($modul_dir)) {
            if (!mkdir($modul_dir, 0755, true)) {
                $this->kesalahan("Gagal membuat folder Modul. Periksa permission.");
            }
        }

        // Buat folder Controller
        $dir_controller = dirname($path_controller);
        if (!is_dir($dir_controller)) {
            if (!mkdir($dir_controller, 0755, true)) {
                $this->kesalahan("Gagal membuat folder Controller.");
            }
        }

        // Buat folder Tampilan
        if (!is_dir($path_tampilan)) {
            if (!mkdir($path_tampilan, 0755, true)) {
                $this->kesalahan("Gagal membuat folder Tampilan.");
            }
        }

        // Simpan controller
        $konten_controller = <<<PHP
<?php
class Pengendali{$nama_modul}
{
    public function index()
    {
        \$this->tampilkan('index');
    }

    private function tampilkan(string \$nama_tampilan, array \$data = [], bool \$gunakan_tema = true): void
    {
        extract(\$data);
        \$jalur = __DIR__ . "/../Tampilan/{\$nama_tampilan}.php";
        if (!file_exists(\$jalur)) {
            file_put_contents(\$jalur, "<h1>Halaman {\$nama_tampilan} belum dibuat.</h1>");
        }

        ob_start();
        require \$jalur;
        \$konten = ob_get_clean();

        if (\$gunakan_tema) {
            \$tema = dirname(__DIR__, 3) . '/app/tema/utama.php';
            if (file_exists(\$tema)) {
                require \$tema;
            } else {
                echo \$konten;
            }
        } else {
            echo \$konten;
        }
    }
}
PHP;

        if (file_put_contents($path_controller, $konten_controller) === false) {
            $this->kesalahan("Gagal menyimpan file controller.");
        }

        $konten_tampilan = "<h1>Selamat datang di modul {$nama_modul}!</h1>\n<p>File ini dibuat otomatis oleh CLI Rakit.</p>";
        if (file_put_contents($path_tampilan . DIRECTORY_SEPARATOR . 'index.php', $konten_tampilan) === false) {
            $this->kesalahan("Gagal menyimpan file tampilan.");
        }

        echo "[✓] Modul '{$nama_modul}' berhasil dibuat!\n";
        echo "  - Controller: Modul/{$nama_modul}/Controller/Pengendali{$nama_modul}.php\n";
        echo "  - Tampilan : Modul/{$nama_modul}/Tampilan/index.php\n";
    }

    private function tampilkanPanduan(): void
    {
        echo "Penggunaan: buat:controller NamaModul\n";
        echo "Contoh: buat:controller Produk\n";
    }

    private function kesalahan(string $pesan): void
    {
        fwrite(STDERR, "Error: $pesan\n");
        exit(1);
    }
}
