<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');
$port = getenv('DB_PORT');

// Tiyaking kasama ang sslmode=require para sa Neon
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require"; 

try {
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (Exception $e) {
    die("DB ERROR: " . $e->getMessage());
}
?>

