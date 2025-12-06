<?php
// Ambil mode aplikasi
$konfig = require __DIR__ . '/../../konfigurasi/aplikasi.php';
$mode_dev = ($konfig['mode'] === 'development');

// Jika dipanggil langsung (bukan via exception), buat dummy error
if (!isset($error_exception)) {
    $error_exception = null;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>500 — Error Server Internal</title>
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
            padding: 2rem;
        }

        .error-container {
            max-width: 900px;
            margin: 2rem auto;
        }

        .error-header {
            background: #fef2f2;
            border-left: 4px solid #ef4444;
            padding: 1.5rem;
            border-radius: 0 8px 8px 0;
            margin-bottom: 2rem;
        }

        .error-code {
            font-size: 2.5rem;
            font-weight: bold;
            color: #ef4444;
            margin-bottom: 0.5rem;
        }

        .error-title {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: #1e293b;
        }

        .error-message {
            color: #64748b;
            line-height: 1.6;
        }

        .btn-kembali {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background: #1e40af;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin-top: 1rem;
        }

        /* Detail Error (Development Only) */
        .error-detail {
            background: #f1f5f9;
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 2rem;
            font-family: monospace;
            font-size: 0.95rem;
            overflow-x: auto;
        }

        .error-detail h3 {
            margin-bottom: 1rem;
            color: #1e40af;
        }

        .error-item {
            margin-bottom: 0.5rem;
        }

        .error-file,
        .error-line {
            color: #e11d48;
        }

        .error-stack {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px dashed #cbd5e1;
        }

        .stack-item {
            margin-bottom: 0.3rem;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-header">
            <div class="error-code">500</div>
            <h1 class="error-title">Error Server Internal</h1>
            <p class="error-message">
                <?php if ($mode_dev): ?>
                    Maaf, terjadi kesalahan pada sistem. Detail error ditampilkan di bawah untuk keperluan pengembangan.
                <?php else: ?>
                    Maaf, terjadi kesalahan pada sistem kami. Tim teknis telah diberi tahu. Silakan coba lagi nanti.
                <?php endif; ?>
            </p>
            <a href="/" class="btn-kembali">← Kembali ke Beranda</a>
        </div>

        <?php if ($mode_dev && $error_exception): ?>
            <div class="error-detail">
                <h3>🔍 Detail Error (Mode Pengembangan)</h3>

                <div class="error-item">
                    <strong>Pesan:</strong>
                    <span class="error-message"><?= htmlspecialchars($error_exception->getMessage()) ?></span>
                </div>
                <div class="error-item">
                    <strong>File:</strong>
                    <span class="error-file"><?= htmlspecialchars(str_replace('\\', '/', $error_exception->getFile())) ?></span>
                </div>
                <div class="error-item">
                    <strong>Baris:</strong>
                    <span class="error-line"><?= $error_exception->getLine() ?></span>
                </div>

                <div class="error-stack">
                    <strong>Stack Trace:</strong>
                    <div style="margin-top: 0.5rem;">
                        <?php foreach ($error_exception->getTrace() as $index => $trace): ?>
                            <div class="stack-item">
                                <?= $index + 1 ?>.
                                <?php if (isset($trace['file'])): ?>
                                    <?= htmlspecialchars(str_replace('\\', '/', $trace['file'])) ?>:<?= $trace['line'] ?>
                                <?php else: ?>
                                    {internal function}
                                <?php endif; ?>
                                <?php if (isset($trace['class'])): ?>
                                    → <?= $trace['class'] ?><?= $trace['type'] ?><?= $trace['function'] ?>()
                                <?php elseif (isset($trace['function'])): ?>
                                    → <?= $trace['function'] ?>()
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>