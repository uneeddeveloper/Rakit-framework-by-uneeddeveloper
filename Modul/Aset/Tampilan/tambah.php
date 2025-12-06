<?php
$judul = "Tambah Aset Baru";
$judul_header = "Tambah Aset";
?>

<h2>Tambah Aset Baru</h2>

<?php if (!empty($kesalahan)): ?>
    <div style="background:#fee2e2; color:#b91c1c; padding:0.75rem; border-radius:6px; margin-bottom:1rem;">
        ⚠️ <?= htmlspecialchars($kesalahan) ?>
    </div>
<?php endif; ?>

<form method="POST" style="margin-top: 1.5rem;">
    <div style="margin-bottom:1rem;">
        <label for="nama" style="display:block; margin-bottom:0.5rem; font-weight:bold;">Nama Aset</label>
        <input type="text" name="nama" id="nama" required
            style="width:100%; padding:0.75rem; border:1px solid #cbd5e1; border-radius:6px;">
    </div>

    <div style="margin-bottom:1.5rem;">
        <label for="jenis" style="display:block; margin-bottom:0.5rem; font-weight:bold;">Jenis Aset (Opsional)</label>
        <input type="text" name="jenis" id="jenis"
            placeholder="Meja, Komputer, Mesin Jahit, dll"
            style="width:100%; padding:0.75rem; border:1px solid #cbd5e1; border-radius:6px;">
    </div>

    <button type="submit" style="background:#1e40af; color:white; padding:0.75rem 1.5rem; border:none; border-radius:6px; font-weight:bold; cursor:pointer;">
        Simpan Aset
    </button>
    <a href="/aset/daftar" style="display:inline-block; margin-left:1rem; color:#1e40af; text-decoration:underline;">Batal</a>
</form>