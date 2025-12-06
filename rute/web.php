<?php
$pengarah->ambil('/', 'PengendaliUMKM@index');
$pengarah->ambil('/umkm', 'PengendaliUMKM@index');
$pengarah->ambil('/umkm/daftar', 'PengendaliUMKM@daftar');
$pengarah->ambil('/umkm/masuk', 'PengendaliUMKM@masuk');
$pengarah->ambil('/umkm/dasbor', 'PengendaliUMKM@dasbor');
$pengarah->ambil('/umkm/keluar', 'PengendaliUMKM@keluar');
// rute untuk modul Aset
$pengarah->ambil('/aset/daftar', 'PengendaliAset@daftar');
$pengarah->ambil('/aset/tambah', 'PengendaliAset@tambah');
