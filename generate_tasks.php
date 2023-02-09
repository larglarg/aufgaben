<?php

$conn = new mysqli("localhost", "root", "", "aufgaben");

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

$number_of_tasks = $_POST['number_of_tasks'];
$difficulty_level = $_POST['difficulty_level'];
$max_operationszahl = $_POST['max_operationszahl'];
$min_operationszahl = $_POST['min_operationszahl'];
$max_Start_Zahl = $_POST['max_Start_Zahl'];
$min_Start_Zahl = $_POST['min_Start_Zahl'];
$round = 0;
for ($i = 0; $i < $number_of_tasks; $i++) {
    $task = generateTask($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl);

try {
  $conn = new PDO("mysql:host=localhost;dbname=aufgaben", "root", "");
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO aufgaben (aufgabe, loesung, level, operation1, operation2)
  VALUES (:value1, :value2, :value3, :value4, :value5)";
  // Prepare statement
  $stmt = $conn->prepare($sql);
  // Bind parameters
  
  $z = 1;
  foreach ($task as $value) {
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
    }
    $z++;
  
}
  $stmt->bindParam(':value1', $value1);
  $stmt->bindParam(':value2', $value2);
  $stmt->bindParam(':value3', $value3);
  $stmt->bindParam(':value4', $value4);
  $stmt->bindParam(':value5', $value5);
  // Execute the query
  $stmt->execute();
  echo "New record created successfully";
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

$conn = null;


}

function generateTask($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl) {
    switch ($difficulty_level) {
        case 1:
            return generateLevel1Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl);
        case 2:
            return generateLevel2Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl);
        case 3:
            return generateLevel3Task();
    }
}

function generateLevel1Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl) {
    $round++;
    $sequence = array();
    $numbber = rand($min_Start_Zahl, $max_Start_Zahl);
    $operation1 = rand($min_operationszahl, $max_operationszahl);
    $operation2 = rand($min_operationszahl, $max_operationszahl);
    $gleich_unterschiedlich = rand(1, 2);
    $verlche_version_vom_lvl = rand(1, 2);
    if ($gleich_unterschiedlich == 1){
        $operation1 = $operation2;
    }
    $length = rand(4, 6);
    $y = 0; 
    if ($operation1 == 0) {
        $operation1 = 1;
    }
    if ($operation2 == 0) {
        $operation2 = 1;
    }
    for ($i = $length; $i > 0; $i--) {
        if ($i % 2 == 0) {
            $numbber = $numbber + $operation1;
        } else {
            $numbber = $numbber + $operation2;
        }
        array_push($sequence, $numbber);
        $y++;
    }
    $sequence_string = implode("|", $sequence);
    $solution = end($sequence);
    if ($y % 2 == 0) {
        $additional_solution = $solution + $operation1;
       
    } else {
        $additional_solution = $solution + $operation2;
    }
    return array($sequence_string."|?|", $additional_solution, $difficulty_level, $operation1, $operation2);

}


function generateLevel2Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl) {
    $round++;
    $sequence = array();
    $after_witch = array();
    $numbber = rand($min_Start_Zahl, $max_Start_Zahl);
    $operation1 = rand($min_operationszahl, $max_operationszahl);
    $operation2 = rand($min_operationszahl, $max_operationszahl);
    $gleich_unterschiedlich = rand(1, 2);
    $verlche_version_vom_lvl = rand(1, 3);
    if ($gleich_unterschiedlich == 1){
        $operation1 = $operation2;
    }
    $length = rand(4, 6);
    $y = 0; 
    if ($operation1 == 0) {
        $operation1 = 1;
    }
    if ($operation2 == 0) {
        $operation2 = 1;
    }
    $after_witch = switch_multi($numbber, $verlche_version_vom_lvl, $length, $operation1, $operation2);
    $numbber = $after_witch[1];
    $length = 1;
    $sequence = $after_witch[0];
    $y++;
    $sequence_string = implode("|", $sequence);
    $additional_solution_array = switch_multi($numbber, $verlche_version_vom_lvl, $length, $operation1, $operation2);
    $additional_solution = $after_witch[1];
    return array($sequence_string."|?|", $additional_solution, $difficulty_level, $operation1, $operation2);
}

function switch_multi($numbber, $verlche_version_vom_lvl, $length, $operation1, $operation2){

    $sequence = array();
    switch ($verlche_version_vom_lvl) {
        case 1:
            for ($i = $length; $i > 0; $i--) {
                if ($i % 2 == 0) {
                    $numbber = $numbber * $operation1;
                } else {
                    $numbber = $numbber * $operation2;
                }
                array_push($sequence, $numbber);
                
                
            }
        case 2:
            for ($i = $length; $i > 0; $i--) {
                if ($i % 2 == 0) {
                    $numbber = $numbber * $operation1;
                } else {
                    $numbber = $numbber + $operation2;
                }
                array_push($sequence, $numbber);
                
            }
        case 3:
            for ($i = $length; $i > 0; $i--) {
                if ($i % 2 == 0) {
                    $numbber = $numbber + $operation1;
                } else {
                    $numbber = $numbber + $operation2;
                }
                array_push($sequence, $numbber);
            }
        case 4:
            for ($i = $length; $i > 0; $i--) {
                if ($i % 2 == 0) {
                    $numbber = $numbber * $operation1;
                } else {
                    $numbber = $numbber * $operation2;
                }
                array_push($sequence, $numbber); 
            }
            
    }
    $return_array= array($sequence, $numbber);
    return $return_array;
}
function generateLevel3Task() {
    // to be implemented
}

?>
