<?php
session_start();

if (!isset($_SESSION["tasks"])) {
    $_SESSION["tasks"] = [];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["new_task"])) {
    $newTask = trim($_POST["new_task"]);
    if ($newTask !== "") {
        $_SESSION["tasks"][] = [
            "task" => $newTask,
            "status" => "pending",
        ];
        session_write_close(); // Ensure session is saved after adding a task
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
if (isset($_GET["complete"])) {
    $index = (int) $_GET["complete"];
    if (isset($_SESSION["tasks"][$index])) {
        $_SESSION["tasks"][$index]["status"] = "completed";
    }
}
if(isset($_GET["undo"])) {
    $index = (int) $_GET["undo"];
    if(isset($_SESSION["tasks"][$index])) {
        $_SESSION["tasks"][$index]["status"] = "pending";
    }
}
if(isset($_GET['delete'])) {
    $index = (int) $_GET['delete'];
    if(isset($_SESSION['tasks'][$index])) {
        array_splice($_SESSION['tasks'], $index, 1);
    }
}
$tasks = $_SESSION["tasks"];
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
    <div class="form-container">
        <form method="post">
            <input type="text" name="new_task" placeholder="type your task" required>
            <input type="submit" value="Add Task">
        </form>

        <table>
            <thead>
                <tr>
                    <td>#</td>
                    <td>Task</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $i => $task): ?>
                    <tr>
                        <td><?= $i + 1; ?></td>
                        <td><?= htmlspecialchars($task["task"]); ?></td>
                        <td><?= $task['status'] ?></td>
                        <td>
                            <?php if (($task['status']) == "pending"): ?>
                                <a class="btn" href="?complete=<?= $i ?>">Checkout</a>
                            <?php else: ?>
                                <a class="btn" href="?undo=<?= $i ?>">Undo</a>
                            <?php endif; ?>
                            <a class="btn" href="?delete=<?=$i?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>