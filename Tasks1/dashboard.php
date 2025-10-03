<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
   
    <title>Dashboard</title>
   <style>
    body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #676060ff;
            border-radius: 8px;
            color: #fdfdfdff;
            font-weight: 600;
            font-size: 1.2rem;
        }
     h1 {
            color: #fdfdfdff;
        }
        .welcome {
            margin-bottom: 20px;
        }
        a.logout-btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #d9534f;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a.logout-btn:hover {
            background-color: #c9302c;
        }

   </style>
</head>
<body>
    <h1>Dashboard</h1>
    <p class="welcome">
        Welcome, <?= htmlspecialchars($_SESSION['name']) ?>!
    </p>
    <p>
        This is your dashboard page. You can add any content here for logged-in users.
    </p>
    <p>
        <a href="login.php" class="logout-btn">Logout</a>
    </p>
</body>
</html>
