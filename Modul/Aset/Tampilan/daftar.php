<?php
$judul = "Manajemen Aset";
$judul_header = "Daftar Aset UMKM";
?>

<h2>Daftar Aset Anda</h2>

<?php if (empty($aset)): ?>
    <p>Belum ada aset terdaftar. <a href="/aset/tambah">Tambah aset pertama?</a></p>
<?php else: ?>
    <table style="width:100%; border-collapse: collapse; margin-top: 1rem;">
        <thead>
            <tr style="background:#f1f5f9;">
                <th style="padding:0.75rem; text-align:left; border-bottom:1px solid #cbd5e1;">Nama</th>
                <th style="padding:0.75rem; text-align:left; border-bottom:1px solid #cbd5e1;">Jenis</th>
                <th style="padding:0.75rem; text-align:left; border-bottom:1px solid #cbd5e1;">Kondisi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($aset as $item): ?>
                <tr style="border-bottom:1px solid #e2e8f0;">
                    <td style="padding:0.75rem;"><?= htmlspecialchars($item['nama']) ?></td>
                    <td style="padding:0.75rem;"><?= htmlspecialchars($item['jenis'] ?? '-') ?></td>
                    <td style="padding:0.75rem;"><?= htmlspecialchars($item['kondisi']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<div style="margin-top: 1.5rem;">
    <a href="/aset/tambah" style="display:inline-block; padding:0.5rem 1.2rem; background:#1e40af; color:white; text-decoration:none; border-radius:6px; font-weight:bold;">
        ➕ Tambah Aset
    </a>
    <a href="/umkm/dasbor" style="display:inline-block; padding:0.5rem 1.2rem; background:#64748b; color:white; text-decoration:none; border-radius:6px; margin-left:0.5rem;">
        ← Kembali ke Dasbor
    </a>
</div>