<?php
session_start();
include "../includes/config.php";

if ($_SESSION["role"] !== "freelancer") {
    die("<div class='error'>Access denied.</div>");
}

$job_id = $_GET["job_id"];
$freelancer_id = $_SESSION["user_id"];

$stmt = $pdo->prepare("INSERT INTO applications (job_id, freelancer_id) VALUES (?, ?)");
if ($stmt->execute([$job_id, $freelancer_id])) {
    $message = "Applied successfully!";
    $message_class = "success";
} else {
    $message = "Application failed.";
    $message_class = "error";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application</title>
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

        /* Application Container */
        .application-container {
            background: rgba(0, 0, 0, 0.3);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 60%;
            max-width: 400px;
        }

        h1 {
            margin-bottom: 15px;
        }

        /* Success & Error Messages */
        .success {
            background: #28a745;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            font-weight: bold;
        }

        .error {
            background: #dc3545;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            font-weight: bold;
        }

        /* Back to Jobs Button */
        .back-btn {
            display: inline-block;
            text-decoration: none;
            color: white;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 15px;
            border-radius: 5px;
            transition: 0.3s;
            font-weight: bold;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body>
    <div class="application-container">
        <h1>Job Application</h1>
        <div class="<?= $message_class ?>"><?= $message ?></div>
        <a href="../jobs/browse_jobs.php" class="back-btn">Back to Jobs</a>
    </div>
</body>
</html>
