<?php
return [
    'host' => $_ENV['HOST_DATABASE'] ?? 'localhost',
    'nama_database' => $_ENV['NAMA_DATABASE'] ?? 'rakit_app',
    'pengguna' => $_ENV['PENGGUNA_DATABASE'] ?? 'root',
    'kata_sandi' => $_ENV['KATA_SANDI_DATABASE'] ?? '',
    'charset' => $_ENV['CHARSET_DATABASE'] ?? 'utf8mb4'
];
