<?php
session_start();
include "../includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = $_POST["role"];

    // Check if email already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $existingUser = $stmt->fetch();

    if ($existingUser) {
        // Email already registered, show an alert
        echo "<script>alert('This email is already registered. Please log in instead.');</script>";
    } else {
        // Insert new user
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$username, $email, $password, $role])) {
            echo "<script>alert('Registration successful! Redirecting to login...'); window.location.href='login.php';</script>";
            exit;
        } else {
            echo "<script>alert('Error registering. Please try again.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* General Page Styling */
        body {
            font-family: Arial, sans-serif;
            background: radial-gradient(circle, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%);
            color: white;
            text-align: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* Form Container */
        .form-container {
            background: rgba(0, 0, 0, 0.3);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 300px;
        }

        h1 {
            margin-bottom: 15px;
        }

        /* Input Fields */
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            font-size: 16px;
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

        /* Link Styling */
        .login-link {
            display: block;
            margin-top: 15px;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Welcome to Freelance Marketplace</h1>
    <div class="form-container">
        <h1>Register</h1>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="client">Client</option>
                <option value="freelancer">Freelancer</option>
            </select>
            <button type="submit">Register</button>
        </form>
        <a href="login.php" class="login-link">Already have an account? Login</a>
    </div>
</body>
</html>
