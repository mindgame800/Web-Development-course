<?php
$baseprice = 100;
$textrate = 0.01;
echo $totalprice = $baseprice * $textrate;

$isPremium  = true;
echo "<br>";
if ($isPremium) {
    echo "Welcome, you got the discount";
}
else {
    echo "Discount isn't available";
};

$premium = 900;
echo "<br>";
if ($premium > 500) {
    echo "Got discount";
}
else {
    echo "Discount isn't available";
}
echo "<br>";

$fname = "Spectra";
$lname = "Desk";

echo $appname = $fname . ' ' . $lname;

echo "<br>";

$arr1 = ["apple", "realmi", "poco"];
$arr2 = ["apple", "poco", "realmi"];

 $compare = $arr1 == $arr2;
var_dump($compare) ;
echo "<br>";

if ($arr1 == $arr2) {
    echo "Arrays are same";
}
else {
    echo "They are not same";
}

?>