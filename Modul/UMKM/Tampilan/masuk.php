<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk ke Akun UMKM</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }

        .kotak-masuk {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 400px;
        }

        .kotak-masuk h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #2575fc;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .tombol {
            width: 100%;
            padding: 12px;
            background: #2575fc;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
        }

        .tombol:hover {
            background: #1a5bc9;
        }

        .pesan {
            text-align: center;
            margin-top: 20px;
        }

        .pesan a {
            color: #2575fc;
            text-decoration: none;
            font-weight: bold;
        }

        .pesan a:hover {
            text-decoration: underline;
        }

        .sukses {
            color: green;
            background: #e6f7ee;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .error {
            color: red;
            background: #ffecec;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="kotak-masuk">
        <h2>Masuk ke Akun UMKM</h2>

        <?php if (!empty($berhasil_daftar)): ?>
            <div class="sukses">✅ Pendaftaran berhasil! Silakan masuk menggunakan email dan kata sandi Anda.</div>
        <?php endif; ?>

        <?php if (!empty($kesalahan)): ?>
            <div class="error">⚠️ <?= htmlspecialchars($kesalahan) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="kata_sandi" placeholder="Kata Sandi" required>
            </div>
            <button type="submit" class="tombol">Masuk</button>
        </form>

        <div class="pesan">
            Belum punya akun? <a href="/umkm/daftar">Daftar sekarang</a>
        </div>
    </div>
</body>

</html>