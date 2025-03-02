<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelance Marketplace</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: radial-gradient(circle, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%);
            color: white;
            text-align: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #index {
            background: rgba(0, 0, 0, 0.3); /* Slight transparency for contrast */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.2);
            transition: 0.3s;
        }

        a:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body>
    <div id="index">
        <h1>Welcome to the Freelance Marketplace</h1>
        <p>A platform where freelancers and clients connect.</p>
    
        <?php if (!isset($_SESSION["user_id"])): ?>
            <a href="auth/register.php">Register</a> 
            <a href="auth/login.php">Login</a>
        <?php else: ?>
            <a href="dashboard.php">Go to Dashboard</a>
            <a href="auth/logout.php">Logout</a>
        <?php endif; ?>
    </div>
</body>
</html>
