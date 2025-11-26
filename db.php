<?php
$dsn = getenv("DATABASE_URL"); // Render will store this in env

try {
    $pdo = new PDO($dsn, null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (Exception $e) {
    die("DB ERROR: " . $e->getMessage());
}
?>
