<?php
// Tiyaking ito ang PINAKA-UNANG LINYA ng file. (Dahil sa ob_start)
ob_start();

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');
$port = getenv('DB_PORT');

// I-declare ang $pdo sa labas ng try block
$pdo = null;

// Tiyaking kasama ang sslmode=require para sa Neon
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require"; 

try {
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (Exception $e) {
    // Kung mag-fail ang connection:
    // 1. Huwag mag-die/mag-echo/mag-output.
    // 2. I-log na lang ang error sa server logs.
    error_log("Database connection failed: " . $e->getMessage());
    // Hayaan lang na maging null ang $pdo, para mag-fail ang queries.
}
// TANGGALIN ang closing tag: ?>
