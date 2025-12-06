<?php
require_once __DIR__ . '/../../../inti/BasisData.php';

/**
 * Pengendali untuk modul UMKM
 * Menangani pendaftaran, login, dasbor, dan logout
 */
class PengendaliUMKM
{
    public function index()
    {
        if ($this->sudahMasuk()) {
            $this->dasbor();
        } else {
            $this->masuk();
        }
    }

    public function daftar()
    {
        $kesalahan = '';
        if ($_POST) {
            $nama = trim($_POST['nama'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $kata_sandi = $_POST['kata_sandi'] ?? '';

            if (!$nama || !$email || !$kata_sandi) {
                $kesalahan = 'Semua kolom wajib diisi.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $kesalahan = 'Email tidak valid.';
            } else {
                $ada = BasisData::ambil("SELECT id FROM umkms WHERE email = ?", [$email]);
                if ($ada) {
                    $kesalahan = 'Email sudah terdaftar.';
                } else {
                    $hash = password_hash($kata_sandi, PASSWORD_DEFAULT);
                    BasisData::simpan("INSERT INTO umkms (nama, email, password) VALUES (?, ?, ?)", [$nama, $email, $hash]);
                    header("Location: /umkm/masuk?berhasil_daftar=1");
                    exit;
                }
            }
        }

        $this->tampilkan('daftar', ['kesalahan' => $kesalahan], false);
    }

    public function masuk()
    {
        $kesalahan = '';
        if ($_POST) {
            $email = $_POST['email'] ?? '';
            $kata_sandi = $_POST['kata_sandi'] ?? '';

            $pengguna = BasisData::ambil("SELECT * FROM umkms WHERE email = ?", [$email]);
            if ($pengguna && password_verify($kata_sandi, $pengguna[0]['password'])) {
                $_SESSION['id_umkm'] = $pengguna[0]['id'];
                $_SESSION['nama_umkm'] = $pengguna[0]['nama'];
                header("Location: /umkm/dasbor");
                exit;
            } else {
                $kesalahan = 'Email atau kata sandi salah.';
            }
        }

        $berhasil_daftar = $_GET['berhasil_daftar'] ?? false;
        $this->tampilkan('masuk', [
            'kesalahan' => $kesalahan,
            'berhasil_daftar' => $berhasil_daftar
        ], false);
    }

    public function dasbor()
    {

        if (!$this->sudahMasuk()) {
            header("Location: /umkm/masuk");
            exit;
        }

        $this->tampilkan('dasbor', [
            'nama' => $_SESSION['nama_umkm']
        ]);
    }

    public function keluar()
    {
        session_destroy();
        header("Location: /umkm/masuk");
        exit;
    }

    // --- METODE BANTUAN ---
    private function sudahMasuk(): bool
    {
        return isset($_SESSION['id_umkm']);
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
            // 🔑 Akses tema global dari folder app/tema/
            $root_app = dirname(__DIR__, 3); // Naik 3 level: Modul/UMKM/Controller → app/
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
