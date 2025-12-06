<?php
require_once __DIR__ . '/../../../inti/BasisData.php';

class PengendaliAset
{
    // Pastikan hanya UMKM yang sudah login yang bisa akses
    private function periksaLogin()
    {
        if (!isset($_SESSION['id_umkm'])) {
            header("Location: /umkm/masuk");
            exit;
        }
    }

    public function daftar()
    {
        $this->periksaLogin();
        $id_umkm = $_SESSION['id_umkm'];

        // Ambil data aset milik UMKM ini
        $data_aset = BasisData::ambil(
            "SELECT * FROM aset WHERE id_umkm = ? ORDER BY created_at DESC",
            [$id_umkm]
        );

        $this->tampilkan('daftar', ['aset' => $data_aset]);
    }

    public function tambah()
    {
        $this->periksaLogin();
        $kesalahan = '';

        if ($_POST) {
            $nama = trim($_POST['nama'] ?? '');
            $jenis = trim($_POST['jenis'] ?? '');

            if (!$nama) {
                $kesalahan = 'Nama aset wajib diisi.';
            } else {
                $id_umkm = $_SESSION['id_umkm'];
                BasisData::jalankan(
                    "INSERT INTO aset (nama, jenis, id_umkm) VALUES (?, ?, ?)",
                    [$nama, $jenis, $id_umkm]
                );
                header("Location: /aset/daftar");
                exit;
            }
        }

        $this->tampilkan('tambah', ['kesalahan' => $kesalahan]);
    }


    /**
     * Tampilkan halaman dengan atau tanpa tema utama (global)
     */
    private function tampilkan(string $nama_tampilan, array $data = [], bool $gunakan_tema = true): void
    {
        extract($data);
        $jalur_tampilan = __DIR__ . "/../Tampilan/{$nama_tampilan}.php";
        if (!file_exists($jalur_tampilan)) {
            throw new Exception("Tampilan tidak ditemukan: {$jalur_tampilan}");
        }

        ob_start();
        require $jalur_tampilan;
        $konten = ob_get_clean();

        if ($gunakan_tema) {
            // 🔑 Akses tema global
            $root_app = dirname(__DIR__, 3); // Modul/Aset/Controller → app/
            $jalur_tema = $root_app . '/app/tema/utama.php';
            if (!file_exists($jalur_tema)) {
                throw new Exception("Tema utama tidak ditemukan: {$jalur_tema}");
            }
            require $jalur_tema;
        } else {
            echo $konten;
        }
    }
}
