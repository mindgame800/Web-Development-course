<?php
// Define your base project path once
define("BASE_URL", "/");
function registerUser($email, $password)
{
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
        return "Use valid email";
    if (empty($password) || strlen($password) < 6)
        return "At least 6 Character required";
    $user = file_exists("user.php") ? include "user.php" : [];
    if (!isset($user[$email]) || $user[$email]['password'] !== $password)
        return "Invalid email or password";
   return "Login successfully";
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"], $_POST["password"])) {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $message = registerUser($email, $password);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $css = 'assets/css/login.css'; ?>
    <link rel="stylesheet" href="<?= $css ?>?v=<?= file_exists($css) ? filemtime($css) : time() ?>">
    <title>Login Form</title>
</head>

<body>
    <div class="admin">
        <?php if ($_SERVER['REQUEST_METHOD'] !== "POST"): ?>
            <form method="post">
                <h2>Login Form</h2>

                <label for="">Email</label>
                <input type="email" name="email" placeholder="Type your email">

                <label for="">Password</label>
                <input type="password" name="password" placeholder="Type your Password">
                <button type="submit">Submit</button>
                <div class="login">
                    <p>
                        Have no account?
                    </p>
                    <a href="<?= BASE_URL ?>index.php">Sign up</a>
                </div>
            </form>
        <?php else: ?>
            <div class="message">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>