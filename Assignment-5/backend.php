<?php
$tasks = ["Design UI", "Setup DB", "Write Docs"];

foreach ($tasks as $task) {
    echo $task. "<br>";
}
$newTask = array_push($tasks, "Develop Frontend");
echo $tasks[3];

$team1 = [
    "fname"  => "Rahi",
    "roll"=> "editor",
];

$team2 = [
    "name"=> "Rabu",    
    "roll"=> "editor",
];
echo "<br>";
$totalTeam = array_merge($team1, $team2);
print_r ($totalTeam);

$studentDetails = [
   [ "name"=> "Asif","marks"=> 80],
   [ "name"=> "Rasel","marks" => 45], 
   [ "name"=> "Rabu", "marks"=> 92, "grade"=> "A+"],
];

$addstudent = array_push($studentDetails, ["name"=> "rafi", "marks"=> 66, "grade"=> "B+"] );
echo "<br>";
print_r ($studentDetails[3]);

$change = array_splice($studentDetails,2,2, [["name"=> "Ramim", "grade"=> "C-"]]);
echo "<br>";
print_r($studentDetails[2]);

$bestmark = 0;
foreach ($studentDetails as  $value) {
    if($value['marks'] >= 50) {
        $bestmark = $key;
        break;
    }
}


echo '<br>';
print_r($bestmark);
?>