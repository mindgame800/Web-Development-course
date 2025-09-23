<?php
$role = "Admin";
$users = ["Raju", "Shofiqe", "rased", "patel"];
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
                <?php
                if ($role==="Admin") {
                    echo "Welcome Admin";
                } else {
                    echo "No access";
                }
                ?>
            </div>
             <div class="content">
              <div>Users of our company:</div>
              <div class="user"><?php 
              foreach ($users as $user) {
                    echo "-". $user . "<br>";
              }
              ?></div>
            </div>
        </div>
    </div>
</body>

</html>