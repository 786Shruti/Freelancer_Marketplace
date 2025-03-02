<?php
session_start();
include "../includes/config.php";

if ($_SESSION["role"] !== "client") {
    die("Access denied.");
}

$client_id = $_SESSION["user_id"];
$stmt = $pdo->prepare("SELECT * FROM jobs WHERE client_id = ?");
$stmt->execute([$client_id]);
$jobs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Jobs</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>My Posted Jobs</h1>
    <a href="../dashboard.php">Back to Dashboard</a>
    
    <ul>
        <?php foreach ($jobs as $job): ?>
            <li>
                <strong><?= htmlspecialchars($job["title"]) ?></strong>
                <p><?= htmlspecialchars($job["description"]) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
