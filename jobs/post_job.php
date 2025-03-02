<?php
session_start();
include "../includes/config.php";

if ($_SESSION["role"] !== "client") {
    die("<div class='error'>Access denied.</div>");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $client_id = $_SESSION["user_id"];

    $stmt = $pdo->prepare("INSERT INTO jobs (client_id, title, description) VALUES (?, ?, ?)");
    if ($stmt->execute([$client_id, $title, $description])) {
        $message = "<div class='success'>Job posted successfully!</div>";
    } else {
        $message = "<div class='error'>Failed to post job.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job</title>
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

        /* Job Post Container */
        .job-form-container {
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

        /* Form Fields */
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        textarea {
            height: 100px;
            resize: none;
        }

        /* Button Styling */
        button {
            width: 100%;
            padding: 10px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: rgba(255, 255, 255, 0.5);
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
    </style>
</head>
<body>
    <h1>Post a Job</h1>
    <div class="job-form-container">
        <?= $message ?>
        <form method="post">
            <input type="text" name="title" placeholder="Job Title" required>
            <textarea name="description" placeholder="Job Description" required></textarea>
            <button type="submit">Post Job</button>
        </form>
    </div>
</body>
</html>
