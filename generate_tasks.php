<?php

$conn = new mysqli("localhost", "root", "", "aufgaben");

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

$number_of_tasks = $_POST['number_of_tasks'];
$difficulty_level = $_POST['difficulty_level'];

for ($i = 0; $i < $number_of_tasks; $i++) {
    $task = generateTask($difficulty_level);

try {
  $conn = new PDO("mysql:host=localhost;dbname=aufgaben", "root", "");
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO aufgaben (aufgaben, loesung, level)
  VALUES (:value1, :value2, :value3)";
  // Prepare statement
  $stmt = $conn->prepare($sql);
  // Bind parameters
  $z = 1;
  foreach ($z as &$value) {
    switch ($z) {
        case 1:
            $value1 = $z;
        case 2:
            $value2 = $z;
        case 3:
            $value3 = $z;
        default:
            $value1 = $z;
    }
    $z++;
  
}
  $stmt->bindParam(':value1', $value1);
  $stmt->bindParam(':value2', $value2);
  $stmt->bindParam(':value3', $value3);
  // Execute the query
  $stmt->execute();
  echo "New record created successfully";
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;


}

function generateTask($difficulty_level) {
    switch ($difficulty_level) {
        case 1:
            return generateLevel1Task();
        case 2:
            return generateLevel2Task();
        case 3:
            return generateLevel3Task();
        default:
            return generateLevel1Task();
    }
}

function generateLevel1Task() {
    $sequence = array();
    $start = rand(1, 100);
    $operation1 = rand(-10, 10);
    $operation2 = rand(-10, 10);
    if ($operation1 == 0) {
        $operation1 = 1;
    }
    if ($operation2 == 0) {
        $operation2 = 1;
    }
    for ($i = $start; $i <= $start + 5; $i++) {
        if ($i % 2 == 0) {
            $i = $i + $operation1;
        } else {
            $i = $i + $operation2;
        }
        array_push($sequence, $i);
    }
    $sequence_string = implode("|", $sequence);
    $solution = end($sequence);
    $additional_solution = $solution + $operation1;
    return array($sequence_string, $solution, $additional_solution);
}


function generateLevel2Task() {
    // to be implemented
}

function generateLevel3Task() {
    // to be implemented
}

