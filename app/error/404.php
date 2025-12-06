<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 — Halaman Tidak Ditemukan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            color: #1e293b;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
        }

        .error-container {
            text-align: center;
            max-width: 600px;
        }

        .error-code {
            font-size: 6rem;
            font-weight: bold;
            color: #ef4444;
            margin-bottom: 1rem;
        }

        .error-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #1e293b;
        }

        .error-message {
            font-size: 1.1rem;
            color: #64748b;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .btn-kembali {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background: #1e40af;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.2s;
        }

        .btn-kembali:hover {
            background: #1e3a8a;
        }

        @media (max-width: 600px) {
            .error-code {
                font-size: 4rem;
            }

            .error-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-code">404</div>
        <h1 class="error-title">Halaman Tidak Ditemukan</h1>
        <p class="error-message">
            Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.
            Silakan periksa kembali alamat URL atau kembali ke halaman utama.
        </p>
        <a href="/" class="btn-kembali">← Kembali ke Beranda</a>
    </div>
</body>

</html>