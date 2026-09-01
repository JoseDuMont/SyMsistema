<?php

require_once __DIR__ . '/../bootstrap.php';

$host     = $_ENV['DB_HOST'];
$dbname   = $_ENV['DB_NAME'];
$user     = $_ENV['DB_USER'];
$pass     = $_ENV['DB_PASSWORD'];

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
} catch (PDOException $e) {
    die("Error DB: " . $e->getMessage());
}
