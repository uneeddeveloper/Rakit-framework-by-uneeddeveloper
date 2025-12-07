#!/usr/bin/env php
<?php

// Tentukan root proyek berdasarkan lokasi file `rkt`
define('RAKIT_ROOT', realpath(dirname(__FILE__)));

require_once RAKIT_ROOT . DIRECTORY_SEPARATOR . 'inti' . DIRECTORY_SEPARATOR . 'Console.php';

use Inti\Console;

$console = new Console();
$console->jalankan($argv);
