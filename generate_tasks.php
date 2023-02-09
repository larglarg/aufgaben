<?php

$conn = new PDO("mysql:host=localhost;dbname=aufgaben", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$number_of_tasks = $_POST['number_of_tasks'];
$difficulty_level = $_POST['difficulty_level'];
$max_operationszahl = $_POST['max_operationszahl'];
$min_operationszahl = $_POST['min_operationszahl'];
$max_Start_Zahl = $_POST['max_Start_Zahl'];
$min_Start_Zahl = $_POST['min_Start_Zahl'];
$max_ergebniss = $_POST['max_groesse_ergebniss'];

for ($i = 0; $i < $number_of_tasks; $i++) {
    // Erzeuge eine neue Aufgabe je nach Schwierigkeitsgrad
    $task = generateTask($difficulty_level, $i, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss);


   
    // Füge die Daten in die Datenbank ein
    $sql = "INSERT INTO aufgaben (aufgabe, loesung, level, operation1, operation2)
    VALUES (:aufgabe, :loesung, :level, :operation1, :operation2)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':aufgabe', $task[0]);
    $stmt->bindParam(':loesung', $task[1]);
    $stmt->bindParam(':level', $task[2]);
    $stmt->bindParam(':operation1', $task[3]);
    $stmt->bindParam(':operation2', $task[4]);
    $stmt->execute();

}

$conn = null;



function generateTask($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss) {
    switch ($difficulty_level) {
        case 1:
            return generateLevel1Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss);
        case 2:
            return generateLevel2Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss);
        case 3:
            return generateLevel3Task();
    }
}

function generateLevel1Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss) {
    $round++;
    $sequence = [];
    $number = rand($min_start_zahl, $max_start_zahl);
    $operation1 = rand($min_operationszahl, $max_operationszahl);
    $operation2 = rand($min_operationszahl, $max_operationszahl);
    $equal_different = rand(1, 2);
    $verlche_version_vom_lvl = rand(1, 2);
    if ($equal_different == 1){
        $operation1 = $operation2;
    }
    $length = rand(4, 6);
    if ($operation1 == 0) {
        $operation1 = 1;
    }
    if ($operation2 == 0) {
        $operation2 = 1;
    }
    for ($i = $length; $i > 0; $i--) {
        if ($i % 2 == 0) {
            $number = $number + $operation1;
        } else {
            $number = $number + $operation2;
        }
        array_push($sequence, $number);
    }
    $sequence_string = implode("|", $sequence);
    $solution = end($sequence);
    $additional_solution = $solution + (($length % 2 == 0) ? $operation1 : $operation2);
    if ($additional_solution> $max_ergebniss){
        return generateLevel2Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss);
    }
    return [$sequence_string . "|?|", $additional_solution, $difficulty_level, $operation1, $operation2];
}


function generateLevel2Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss) {
    $round++;
    $sequence = array();
    $after_witch = array();
    $number = rand($min_Start_Zahl, $max_Start_Zahl);
    $operation1 = rand($min_operationszahl, $max_operationszahl);
    $operation2 = rand($min_operationszahl, $max_operationszahl);
    $gleich_unterschiedlich = rand(1, 2);
    $verlche_version_vom_lvl = rand(1, 3);
    if ($gleich_unterschiedlich == 1){
        $operation1 = $operation2;
    }
    $length = rand(4, 6);
    if ($operation1 == 0) {
        $operation1 = 1;
    }
    if ($operation2 == 0) {
        $operation2 = 1;
    }
    $after_witch = switch_multi($number, $verlche_version_vom_lvl, $length, $operation1, $operation2);
    $number = $after_witch[1];
    $length = 1;
    $sequence = $after_witch[0];
    $sequence_string = implode("|", $sequence);
    $additional_solution_array = switch_multi($number, $verlche_version_vom_lvl, $length, $operation1, $operation2);
    $additional_solution = $after_witch[1];
    if ($additional_solution> $max_ergebniss){
        return generateLevel2Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss);
    }
    return array($sequence_string."|?|", $additional_solution, $difficulty_level, $operation1, $operation2);
}

function switch_multi($number, $verlche_version_vom_lvl, $length, $operation1, $operation2){
    $sequence = array();
    switch ($verlche_version_vom_lvl) {
        case 1:
            for ($i = $length; $i > 0; $i--) {
                if ($i % 2 == 0) {
                    $number = $number * $operation1;
                } else {
                    $number = $number * $operation2;
                }
                array_push($sequence, $number);
            }
            break;
        case 2:
            for ($i = $length; $i > 0; $i--) {
                if ($i % 2 == 0) {
                    $number = $number * $operation1;
                } else {
                    $number = $number + $operation2;
                }
                array_push($sequence, $number);
            }
            break;
        case 3:
            for ($i = $length; $i > 0; $i--) {
                if ($i % 2 == 0) {
                    $number = $number + $operation1;
                } else {
                    $number = $number + $operation2;
                }
                array_push($sequence, $number);
            }
            break;
        case 4:
            for ($i = $length; $i > 0; $i--) {
                if ($i % 2 == 0) {
                    $number = $number * $operation1;
                } else {
                    $number = $number * $operation2;
                }
                array_push($sequence, $number); 
            }
            break;
    }
    
    $return_array= array($sequence, $number);
    return $return_array;
}
function generateLevel3Task() {
    // to be implemented
}

?>
