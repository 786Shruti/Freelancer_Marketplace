<?php
session_start();
include "includes/config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: auth/login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$role = $_SESSION["role"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Dashboard</h1>
    </header>
    <div id="dashboard">
        <p>Welcome, <?= $role == "client" ? "Client" : "Freelancer" ?>!</p>
        <?php if ($role == "client"): ?>
            <p style="font-weight: bold;">Begin your first hunt towards recruiting talent.</p>
            <a href="jobs/post_job.php">Post a Job</a> |
            <a href="jobs/my_jobs.php">View My Jobs</a>
        <?php else: ?>
            <p style="font-weight: bold;">Begin your first hunt towards searching internships and jobs.</p>
            <a href="jobs/browse_jobs.php">Browse Jobs</a> |
            <a href="applications/my_applications.php">My Applications</a>
        <?php endif; ?>
        <br><br>
        <a href="auth/logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
