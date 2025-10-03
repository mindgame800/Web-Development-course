<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}
$currentUser = $_SESSION["user"];

$roleMsg = [
    "Admin" => "Welcome, Admin {$currentUser['name']}!  You have access to create, assign, and manage tasks.",
    "Editor" => "Welcome, Editor {$currentUser['name']}! You can edit tasks and view task statuses.",
    "User" => "Welcome, User {$currentUser['name']}! You can view and complete tasks assigned to you."
];
if($_SERVER["REQUEST_METHOD"] == "POST" || isset( $_POST["logout"])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $css = 'assets/dashboard.css'; ?>
    <link rel="stylesheet" href="<?= $css ?>?v=<?= file_exists($css) ? filemtime($css) : time() ?>">
    <title>Document</title>
</head>

<body>
    <h1>Dashboard</h1>

    <h2><?= $roleMsg[$currentUser['role']] ?></h2>

    <form method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>

</html>