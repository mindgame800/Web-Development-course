<?php
$role = "Admin";

if ($role=== "Admin") {
    echo "Welcome Admin";
} else {
    echo "NO access";
};

switch ($role) {
    case 'Admin':
        echo "Access confirmed";
        break;
    case 'Editor':
        echo "Edit the content";
        break;
    default:
        "Access denied";
        break;
};

$users = ["Raju", "Shofiqe", "rased", "patel"];
echo "<pre>";
echo "All registered users:<br>";
echo "";
foreach ($users as $user) {
    echo "- ". $user . "<br>";
};
echo "</pre>";


?>