<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Daftar UMKM</title>
    <style>
        body {
            font-family: sans-serif;
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
        }
    </style>
</head>

<body>
    <h2>Daftar Akun UMKM</h2>
    <?php if (!empty($kesalahan)): ?>
        <p style="color:red"><?= htmlspecialchars($kesalahan) ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="nama" placeholder="Nama UMKM" required style="width:100%; padding:8px; margin:5px 0;"><br>
        <input type="email" name="email" placeholder="Email" required style="width:100%; padding:8px; margin:5px 0;"><br>
        <input type="password" name="kata_sandi" placeholder="Kata Sandi" required style="width:100%; padding:8px; margin:5px 0;"><br>
        <button type="submit" style="padding:10px 20px; background:#28a745; color:white; border:none; cursor:pointer;">Daftar</button>
    </form>
    <p>Sudah punya akun? <a href="/umkm/masuk">Masuk di sini</a></p>
</body>

</html>