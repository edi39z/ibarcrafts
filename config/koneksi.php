<?php
// File konfigurasi koneksi database terpusat
// Semua file PHP harus include file ini, bukan membuat koneksi sendiri

// ============================================================
// KONFIGURASI DATABASE
// Ubah bagian PRODUCTION sesuai kredensial hosting Anda
// ============================================================

// --- LOCAL (XAMPP/Laragon/MAMP) ---
define('LOCAL_HOST', 'localhost');
define('LOCAL_USER', 'root');
define('LOCAL_PASS', '');
define('LOCAL_DB',   'ibarcrafts');

// --- PRODUCTION (InfinityFree) ---
// Kredensial dari panel InfinityFree > MySQL Databases
// Catatan: host database InfinityFree BUKAN "localhost",
// tapi "sqlXXX.epizy.com" (bisa juga "sqlXXX.infinityfree.com")
define('PROD_HOST', 'sqlXXX.epizy.com');             // Host database dari panel
define('PROD_USER', 'ifo_43381445_ibarcrafts');       // Username database dari panel
define('PROD_PASS', 'GANTI_DENGAN_PASSWORD_DB');     // Password database dari panel
define('PROD_DB',   'ifo_43381445_ibarcrafts');       // Nama database dari panel

// ============================================================
// AUTO-DETECT: local atau production?
// Deteksi berdasarkan server hostname
// ============================================================
$isLocal = in_array($_SERVER['HTTP_HOST'] ?? '', [
    'localhost',
    '127.0.0.1',
    'ibarcrafts.test',
    'ibarcrafts.local',
]);

if ($isLocal) {
    $host = LOCAL_HOST;
    $user = LOCAL_USER;
    $pass = LOCAL_PASS;
    $db   = LOCAL_DB;
} else {
    $host = PROD_HOST;
    $user = PROD_USER;
    $pass = PROD_PASS;
    $db   = PROD_DB;
}

// ============================================================
// KONEKSI DATABASE
// ============================================================
$koneksi = new mysqli($host, $user, $pass, $db);

if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}

$koneksi->set_charset("utf8mb4");
