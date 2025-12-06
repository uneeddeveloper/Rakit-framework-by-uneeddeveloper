<?php

class BasisData
{
    private static ?PDO $koneksi = null;

    public static function sambung(): PDO
    {
        if (self::$koneksi === null) {
            $konfig = require __DIR__ . '/../konfigurasi/database.php';
            $dsn = "mysql:host={$konfig['host']};dbname={$konfig['nama_database']};charset={$konfig['charset']}";
            self::$koneksi = new PDO($dsn, $konfig['pengguna'], $konfig['kata_sandi'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        }
        return self::$koneksi;
    }

    // Ambil data (SELECT)
    public static function ambil(string $sql, array $parameter = []): array
    {
        $perintah = self::sambung()->prepare($sql);
        $perintah->execute($parameter);
        return $perintah->fetchAll();
    }

    // Jalankan perintah (INSERT, UPDATE, DELETE)
    public static function jalankan(string $sql, array $parameter = []): int
    {
        $perintah = self::sambung()->prepare($sql);
        $perintah->execute($parameter);
        return $perintah->rowCount();
    }

    // Simpan data dan kembalikan ID terakhir
    public static function simpan(string $sql, array $parameter = []): int
    {
        $pdo = self::sambung();
        $perintah = $pdo->prepare($sql);
        $perintah->execute($parameter);
        return $pdo->lastInsertId();
    }
}
