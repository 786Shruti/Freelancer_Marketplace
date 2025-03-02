<?php
session_start();
include "../includes/config.php";

$freelancer_id = $_SESSION["user_id"];
$stmt = $pdo->prepare("SELECT jobs.title FROM jobs 
                       JOIN applications ON jobs.id = applications.job_id 
                       WHERE applications.freelancer_id = ?");
$stmt->execute([$freelancer_id]);
$applications = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Applications</title>
    <style>
        /* General Page Styling */
        body {
            font-family: Arial, sans-serif;
            background: radial-gradient(circle, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%);
            color: white;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Applications Container */
        .applications-container {
            background: rgba(0, 0, 0, 0.3);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 60%;
            max-width: 600px;
        }

        h1 {
            margin-bottom: 15px;
        }

        /* Applications List */
        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background: rgba(255, 255, 255, 0.1);
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            font-size: 18px;
            font-weight: bold;
            color: #ffcc00;
        }
    </style>
</head>
<body>
    <h1>My Applications</h1>
    <div class="applications-container">
        <ul>
            <?php if (empty($applications)): ?>
                <li style="color: #ddd; font-weight: normal;">No applications found.</li>
            <?php else: ?>
                <?php foreach ($applications as $application): ?>
                    <li><?= htmlspecialchars($application["title"]) ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>
