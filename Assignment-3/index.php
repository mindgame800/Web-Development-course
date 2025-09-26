<?php
$role = "";
$username = "";
$message = "";
$users = ["Raju", "Shofiqe", "rased", "patel"];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['role']) && isset($_POST['username'])) {
    $role = trim($_POST['role']);
    $username = trim($_POST['username']);

        if(!empty($role) && !empty($username)) {
                $message = "Welcome $username, Your role is $role";
        } else{
            $message = "Provide role and username";
        }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $css = 'assets/css/style.css'; ?>
    <link rel="stylesheet" href="<?= $css ?>?v=<?= file_exists($css) ? filemtime($css) : time() ?>">
    <title>High Teach</title>
</head>

<body>
    <div class="main">
        <div class="header">
            <?php include "header.php"; ?>
        </div>
        <div class="right-bar">
            <div class="admin">
                <?php if($_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
                    <form method="post">
                        <div class="input">
                            <input type="text" name="role" placeholder="Your role (ex: editor, admin, user)">
                            <input type="text" name="username" placeholder="Enter your name">
                        </div>
                        <button type="submit">Submit</button>
                    </form>
                <?php else : ?>
                    <div class="message">
                        <?= $message ?>
                    </div>
              <?php endif; ?>
            </div>
            <div class="content">
                <div>Users of our company:</div>
                <div class="user">
                    <?php
                    foreach ($users as $user) {
                        echo "-" . $user . "<br>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

