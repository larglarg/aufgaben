<?php

$conn = new mysqli("localhost", "root", "", "aufgaben");

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

$number_of_tasks = $_POST['number_of_tasks'];
$difficulty_level = $_POST['difficulty_level'];
$round = 0;
for ($i = 0; $i < $number_of_tasks; $i++) {
    $task = generateTask($difficulty_level, $round);

try {
  $conn = new PDO("mysql:host=localhost;dbname=aufgaben", "root", "");
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO aufgaben (aufgabe, loesung, level, operation1, operation2)
  VALUES (:value1, :value2, :value3, :value4, :value5)";
  // Prepare statement
  $stmt = $conn->prepare($sql);
  // Bind parameters
  $ergbnissfile = fopen("endergebnise.txt", "w");
  $z = 1;
  foreach ($task as $value) {
    fwrite($ergbnissfile, $value."\n");
    switch ($z) {
        case 1:
            $value1 = $value;
        case 2:
            $value2 = $value;
        case 3: 
            $value3 = $difficulty_level;
        case 4:
            $value4 = $value;
        case 5:
            $value5 = $value;
        default:
            $value1 = $value;
    }
    $z++;
  
}
  $stmt->bindParam(':value1', $value1);
  $stmt->bindParam(':value2', $value2);
  $stmt->bindParam(':value3', $value3);
  $stmt->bindParam(':value4', $value3);
  $stmt->bindParam(':value5', $value3);
  // Execute the query
  $stmt->execute();
  echo "New record created successfully";
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
fclose($ergbnissfile);
$conn = null;


}

function generateTask($difficulty_level, $roundtask) {
    switch ($difficulty_level) {
        case 1:
            return generateLevel1Task($difficulty_level, $roundtask);
        case 2:
            return generateLevel2Task();
        case 3:
            return generateLevel3Task();
        default:
            return generateLevel1Task();
    }
}

function generateLevel1Task($dif_lvl, $roundintern) {
    $roundintern++;
    $myfile = fopen("testfile".$roundintern.".txt", "w");
    $sequence = array();
    $numbber = rand(1, 100);
    $operation1 = rand(-10, 10);
    $operation2 = rand(-10, 10);
    $length = rand(4, 6);
    $y = 0; 
    if ($operation1 == 0) {
        $operation1 = 1;
    }
    if ($operation2 == 0) {
        $operation2 = 1;
    }
    for ($i = $length; $i > 0; $i--) {
        if ($numbber % 2 == 0) {
            $numbber = $numbber + $operation1;
        } else {
            $numbber = $numbber + $operation2;
        }
        fwrite($myfile, $numbber."\n");
        array_push($sequence, $numbber);
        $y++;
    }
    foreach ($sequence as $sigle){
        fwrite($myfile, $sigle."\n");
    }
    $sequence_string = implode("|", $sequence);
    fwrite($myfile, $sequence_string."\n");
    $solution = end($sequence);
    if ($y % 2 == 0) {
        $additional_solution = $solution + $operation1;
       
    } else {
        $additional_solution = $solution + $operation2;
    }
    fwrite($myfile, $additional_solution."\n");
    fwrite($myfile, $sequence_string."\n");
    return array($sequence_string, $additional_solution, $dif_lvl, $operation1, $operation2);
    fclose($myfile);
}


function generateLevel2Task() {
    // to be implemented
}

function generateLevel3Task() {
    // to be implemented
}

