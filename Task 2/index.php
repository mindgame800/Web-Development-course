<?php
session_start();

$message = "";
$formName = $formEmail = $formPassword = $formRole = "";
$messageClass = "";
 $users = file_exists('users.php') ? include "users.php" : [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = trim($_POST['role']);

    $message = validation($name, $email, $password, $role);

    if (empty($message)) {

        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

        $users[$email] = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedpassword,
            'role' => $role
        ];

        file_put_contents("users.php", "<?php return " . var_export($users, true) . ";");

        $message = "Account created successfully";
        $formName = $formEmail = $formPassword = $formRole = "";
        $messageClass = 'success';
    } else {
        $messageClass = 'error';
        $formName = htmlspecialchars($name);
        $formEmail = htmlspecialchars($email);
        $formPassword = $password;
        $formRole = htmlspecialchars($role);
    }
}

function validation($name, $email, $password, $role)
{
    if ($name == "") {
        return "Name is require";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Submit valid email";
    }
    if (empty($password) || strlen($password) < 8) {
        return "8 character password needed";
    }
    if (empty($role)) {
        return "Provide role";
    }
   $users = file_exists('users.php') ? include "users.php" : [];
    if (isset($users[$email])) {
        return "Email already exists";
    }
    return "";
}

//--------------login---------------

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $loginEmail = trim($_POST['login_email']);
    $loginPassword = trim($_POST['login_password']);
    $user = loginValidation($loginEmail, $loginPassword);

    if (is_array($user)) {
        
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
        exit;
    } else {
        $messageClass = "error";
        $message = $user;
    }
}

function loginValidation($loginEmail, $loginPassword)
{
    if (empty($loginEmail) || !filter_var($loginEmail, FILTER_VALIDATE_EMAIL)) {
        return "Email is not valid";
    }
    if (empty($loginPassword) || strlen($loginPassword) < 8) {
        return "Password must be at least 8 characters";
    }
    $users = file_exists('users.php') ? include 'users.php' : [];
    if (!isset($users[$loginEmail])) {
        return "Email isn't valid";
    }
    $user = $users[$loginEmail];
    if (password_verify($loginPassword, $user["password"])) {
        return $user;
    } else {
        return "Incorrect password";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $css = 'assets/style.css'; ?>
    <link rel="stylesheet" href="<?= $css ?>?v=<?= file_exists($css) ? filemtime($css) : time() ?>">
    <title>Register</title>
</head>

<body>
    <?php if (!empty($message)): ?>
        <div class="msg <?= $messageClass ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="form-wrapper">
            <h1>Register User</h1>


            <form method="post" class="register-form">
                <input type="text" name="name" placeholder="Full Name" required
                    value="<?= htmlspecialchars($formName) ?>"><br>
                <input type="email" name="email" placeholder="Email" required
                    value="<?= htmlspecialchars($formEmail) ?>"><br>
                <input type="password" name="password" placeholder="Password" required><br>

                <select name="role" required>
                    <option value="">Select Role</option>
                    <option value="Admin" <?= ($formRole == 'Admin') ? "selected" : ''; ?>>Admin</option>
                    <option value="Editor" <?= ($formRole == 'Editor') ? "selected" : ''; ?>>Editor</option>
                    <option value="User" <?= ($formRole == 'User') ? "selected" : ''; ?>>User</option>
                </select><br>
                <button type="submit" name="register">Register</button>
            </form>
        </div>

        <div class="form-wrapper">
            <h1>Login</h1>

            <form method="post" class="login-form">
                <input type="email" name="login_email" placeholder="Email" required><br>
                <input type="password" name="login_password" placeholder="Password" required><br>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>

</body>

</html>