<?php
session_start();

// === TANGANI FATAL ERROR (seperti require file gagal) ===
register_shutdown_function(function () {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        http_response_code(500);
        $error500 = __DIR__ . '/../app/error/500.php';
        if (file_exists($error500)) {
            // Buat objek Throwable dummy
            $error_exception = new ErrorException(
                $error['message'],
                0,
                $error['type'],
                $error['file'],
                $error['line']
            );
            require $error500;
        } else {
            echo "<h2>Terjadi kesalahan kritis.</h2>";
        }
        exit;
    }
});

// === JALANKAN APLIKASI ===
require_once __DIR__ . '/../inti/Pengarah.php';

$pengarah = new Pengarah();
require __DIR__ . '/../rute/web.php';
$pengarah->jalankan();
