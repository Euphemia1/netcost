<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$DB_HOST = 'localhost';
$DB_NAME = 'u754414236_netcost';
$DB_USER = 'u754414236_admin';
$DB_PASS = 'Reti@2025';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4";
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, $options);
} catch (PDOException $e) {
  
    echo "Database connection failed: " . htmlspecialchars($e->getMessage());
    exit;
}
