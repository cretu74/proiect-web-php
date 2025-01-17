<?php
session_start();
include("connection.php");
include("functions.php");

// Check if the user is logged in
$user_data = check_login($con);

// Check if the logged-in user is an admin
$is_admin = isset($user_data['is_admin']) && $user_data['is_admin'] == 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 20px;
            width: 400px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #555;
        }

        a {
            text-decoration: none;
            color: #5cb85c;
            font-weight: bold;
        }

        a:hover {
            color: #4cae4c;
        }

        .logout, .add-admin {
            background-color: #d9534f;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .add-admin {
            background-color: #5cb85c;
        }

        .add-admin:hover {
            background-color: #4cae4c;
        }

        .logout:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $user_data['user_name']; ?>!</h1>
        <p>You are successfully logged in.</p>

        <?php if ($is_admin): ?>
            <a href="add_admin.php" class="add-admin">Add Admin</a>
        <?php endif; ?>

        <a href="logout.php" class="logout">Logout</a>
    </div>
</body>
</html>
