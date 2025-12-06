<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $judul ?? 'Sistem Manajemen UMKM' ?></title>
    <style>
        /* Reset & Dasar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            color: #1e293b;
            line-height: 1.6;
        }

        /* Header */
        .header {
            background: #1e293b;
            color: white;
            padding: 0.8rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header .logo {
            font-size: 1.4rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .header .logo i {
            background: #3b82f6;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .header .nav-links a {
            color: #cbd5e1;
            text-decoration: none;
            padding: 0.4rem 0.6rem;
            border-radius: 6px;
            transition: background 0.2s;
        }

        .header .nav-links a:hover,
        .header .nav-links a.active {
            background: #334155;
            color: white;
        }

        /* Konten Utama */
        .konten-utama {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        .kartu {
            background: white;
            padding: 2rem;
            border-radius: 14px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        }

        .kartu h1,
        .kartu h2 {
            margin-bottom: 1.2rem;
            color: #1e40af;
        }

        /* Footer Kecil */
        .footer-kecil {
            text-align: center;
            margin-top: 3rem;
            padding: 1.5rem;
            color: #64748b;
            font-size: 0.9rem;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }

            .header .nav-links {
                gap: 1rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            .konten-utama {
                padding: 0 1rem;
            }

            .kartu {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <!-- Header dengan Navigasi -->
    <header class="header">
        <div class="logo">
            <div>🏢</div>
            <span>Sistem UMKM</span>
        </div>
        <nav class="nav-links">
            <a href="/umkm/dasbor" class="<?= basename($_SERVER['REQUEST_URI']) === 'dasbor' ? 'active' : '' ?>">Dasbor</a>
            <a href="/aset/daftar" class="<?= strpos($_SERVER['REQUEST_URI'], '/aset/') === 0 ? 'active' : '' ?>">Aset</a>
            <!-- Tambahkan modul lain di sini -->
            <a href="/umkm/keluar" style="color: #f87171;">Keluar</a>
        </nav>
    </header>

    <!-- Konten Halaman Spesifik -->
    <main class="konten-utama">
        <div class="kartu">
            <?= $konten ?>
        </div>
    </main>

    <!-- Footer Kecil -->
    <footer class="footer-kecil">
        &copy; <?= date('Y') ?> Sistem Manajemen UMKM. Dipersembahkan untuk para pelaku usaha mikro.
    </footer>

</body>

</html>