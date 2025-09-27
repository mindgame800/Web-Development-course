<?php
// Define your base project path once
define("BASE_URL", "/");
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"], $_POST["email"], $_POST["password"])) {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $message = registerUser($name, $email, $password);
}

function registerUser($name, $email, $password)
{
    if (empty($name))
        return "Error, name is required";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
        return "Valid email is required";
    if (empty($password) || strlen($password) < 6)
        return "6 Character password required";

    $user = file_exists("user.php") ? include "user.php" : [];
    if (isset($user[$email])) return "Email already registered";
    $user[$email] = ["name"=> $name, "password"=> $password];
    file_put_contents("user.php", '<?php return '. var_export($user, true) .';');
    return sprintf("Registration successful for %s", $name);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $css = 'assets/css/style.css'; ?>
    <link rel="stylesheet" href="<?= $css ?>?v=<?= file_exists($css) ? filemtime($css) : time() ?>">
    <title>Sign Up Form</title>
</head>

<body>
    <div class="admin">
        <?php if ($_SERVER["REQUEST_METHOD"] !== "POST"): ?>
            <form method="post" action="">
                <h2>Sign Up Form</h2>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Type your name">

                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Type your email">

                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Type your password">

                <button type="submit">Submit</button>
                <div class="login">
                    <p>Have an account?</p>
                    <a href="<?= BASE_URL ?>login.php">Login Here</a>
                </div>
            </form>
        <?php else: ?>
            <div class="message <?= $messageClass ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>