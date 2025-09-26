<?php
$role = "";
$username = "";
$message = "";
$users = ["Raju", "Shofiqe", "Rased", "Patel"];
$validroles = ["Admin", "Editor", "User"];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['role']) && isset($_POST['username'])) {
    $role =strtolower(trim($_POST['role']));
    $username = strtolower(trim($_POST['username']));

    $role = ucfirst($role);
    $username = ucfirst($username);

        if(!empty($role) && !empty($username)) {
                if(!in_array(($username), $users)) {
                    $message = "❌ $username is not in our company lis";
                } elseif (!in_array(($role), $validroles)) {
                    $message = "⚠️ Invalid role. Allowed roles: admin, editor, user.";
                } else {
                    $message = match($role) {
                        "Admin" => "👑 Welcome $username , you have full access",
                        "Editor" => "👏 Hello $username, you can edit content",
                        "Users"=> "👍 Hi $username, You can use our website",
                    };
                }
                    
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

