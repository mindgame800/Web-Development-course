<?php
session_start();
define("BASE_URL","/");

$message = "";
$messageClass = "";
$formEmail = $formPassword = "";

if (!isset($_SESSION["users"])) {
    $_SESSION['users'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"], ($_POST["password"]))) {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $message = validation($email, $password);

    $formEmail = htmlspecialchars($email);
    $formPassword = htmlspecialchars($password);

    if (empty($message)) {
        $founduser = null;

        foreach ($_SESSION["users"] as $user) {
            if ($user['email'] == $email) {
                $founduser = $user;
                break;
            }
        }
        if ($founduser) {
            if (password_verify($password, $founduser['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $founduser['email'];
                $_SESSION['name'] = $founduser['name'];

                $formEmail = $formPassword = "";
                header('location: dashboard.php');
                exit;
            } else {
                $message = 'Incorrect password';
                $messageClass = 'error';
            }
        } else {
            $messageClass = 'error';
            $message = 'Email is not registered';
        }
    } else {
        $messageClass = 'error';
    }
}

function validation($email, $password)
{
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Provide valid Email";
    }
    if (empty($password) || strlen($password) < 8) {
        return "8 Character password needed";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $css = 'style/style.css'; ?>
    <link rel="stylesheet" href="<?= $css ?>?v=<?= file_exists($css) ? filemtime($css) : time() ?>">
    <title>Login Form</title>
</head>

<body>
    <div>
        <form method="post">
            <label class="email" for="email">Email</label>
            <input placeholder="Your email" type="email" name="email" id="email" required value="<?= $formEmail ?>">

            <label class="word" for="password">Password</label>
            <input placeholder="type password" type="password" name="password" id="password" required minlength="8"
                value="<?= $formPassword ?>">

            <button type="submit">Login</button>
            <div class="login">
                <div>
                    Have no account?
                </div>
                <div>
                        <a href="<?=BASE_URL?>signup.php">Sign up</a>
                </div>
            </div>
        </form>
        <?php if (!empty($message)): ?>
            <div class="msg <?= $messageClass ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>