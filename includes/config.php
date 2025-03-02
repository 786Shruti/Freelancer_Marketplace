<?php
$host = "localhost"; 
$dbname = "freelance_marketplace"; 
$username = "root"; 
$password = "*7860Ss*"; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
