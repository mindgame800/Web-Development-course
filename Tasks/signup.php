<?php
session_start();
define("BASE_URL", "/");
$message = "";
$messageClass = "";
$formName = $formEmail = $formPassword = "";

if (!isset($_SESSION["users"])) {
    $_SESSION["users"] = [];
}

function dataValidation($name, $email, $password, $users)
{
    if (empty($name))
        return "Provide your name";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
        return "Provide valid email";
    if (empty($password) || strlen($password) < 8)
        return "Use minimum 8 character password";
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            return "Email already registered";
        }
    }
    return '';
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'], $_POST['email'], $_POST['password'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $message = dataValidation($name, $email, $password, $_SESSION['users']);

    if (empty($message)) {
        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $_SESSION['users'][] = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ];

        $message = 'Account created successfully!';
        $messageClass = 'success';
        $formName = $formEmail = $formPassword = "";

    } else {
        $messageClass = 'error';
        $formName = htmlspecialchars($name);
        $formEmail = htmlspecialchars($email);
        $formPassword = htmlspecialchars($password);
    }
} else {
    $formName = $formEmail = $formPassword = "";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $css = 'style/style.css'; ?>
    <link rel="stylesheet" href="<?= $css ?>?v=<?= file_exists($css) ? filemtime($css) : time() ?>">
    <title>Sign Up Form</title>
</head>

<body>
    <div>
        <form method="post">
            <label class="name" for="username">Username</label>
            <input placeholder="type your name" type="text" name="name" id="username" required value="<?= $formName ?>">

            <label class="email" for="email">Email</label>
            <input placeholder="Your email" type="email" name="email" id="email" required value="<?= $formEmail ?>">

            <label class="word" for="password">Password</label>
            <input placeholder="type password" type="password" name="password" id="password" required minlength="8"
                value="<?= $formPassword ?>">

            <button type="submit">Submit</button>
            <div class=" login">
                <div>
                    Have an account?
                </div>
                <div>
                    <a href="<?=BASE_URL?>login.php">Login</a>
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