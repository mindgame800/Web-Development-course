<?php
$welcome = "Welcome to SpectraDesk SaaS";

echo $welcome;
print $welcome;

$appName = "SpectraDesk";
$version= 4.2;
$usersCount= 4590;

echo "<pre>";
var_dump($appName, $version, $usersCount);

$changes = (int) $version;
$str = (string) $changes;

var_dump($changes, $str);
echo "</pre>";


$array =["apple", "banana", "milk"];
foreach ($array as $arr) {
    echo " $arr, <br>";
}
?>