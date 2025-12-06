<?php
$judul = "Dasbor UMKM";
$judul_header = "Dasbor Sistem UMKM";
?>

<h2>Selamat Datang, <?= htmlspecialchars($nama) ?>!</h2>
<p>Anda telah berhasil masuk ke sistem manajemen UMKM.</p>

<div style="margin-top: 1.5rem;">
    <h3>Fitur yang Tersedia:</h3>
    <ul style="margin-top: 0.5rem; padding-left: 1.2rem;">
        <li>Pencatatan aset dan inventaris</li>
        <li>Manajemen peminjaman barang</li>
        <li>Laporan stok harian/mingguan</li>
        <li>Pemantauan kondisi barang</li>
    </ul>
</div>

<a href="/umkm/keluar" class="tombol-keluar">Keluar dari Akun</a>