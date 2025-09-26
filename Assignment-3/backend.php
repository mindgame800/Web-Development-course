<?php
$role = "Admin";

if ($role === "Admin") {
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
    echo "- " . $user . "<br>";
};
echo "</pre>";

$statuscode = 404;

$response = match ($statuscode) {
    400 => "Bad response",
    203 => "Worst",
    404 => "Error"
};
echo $response;

$role = "editor";

$mainrole = match ($role) {
    "admin" => "Edit, code, delete",
    "editor" => "Edit",
    "user" => "use"
};
echo $mainrole;

$hour = date("h");

$time = match (true) {
    $hour < 10 => "morning",
    $hour < 2 => "afternoon"
};

echo $time;
echo $hour;
echo "<br>";

$day = "Tue";

$events = match ($day) {

    "Mon", "Sat" => ["color" => "#439494", "activity" => "Run 2 km"],
    "Sun", "Tue" => ["color" => "#433434", "activity" => "Study 34pages"],
    "Wed", "Thu" => ["color" => "#984737", "activity" => "Do exercise"]
};
echo "<P style = 'background: {$events["color"]}; color: #ccc';>{$events['activity']};</P>";
echo "<br>";

?>