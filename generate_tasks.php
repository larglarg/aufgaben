<?php

$number_of_tasks = $_POST['number_of_tasks'];
$difficulty_level = $_POST['difficulty_level'];
$max_operationszahl = $_POST['max_operationszahl'];
$min_operationszahl = $_POST['min_operationszahl'];
$max_Start_Zahl = $_POST['max_Start_Zahl'];
$min_Start_Zahl = $_POST['min_Start_Zahl'];
$max_ergebniss = $_POST['max_groesse_ergebniss'];
$min_ergebniss = $_POST['min_groesse_ergebniss'];

$conn = new PDO("mysql:host=localhost;dbname=aufgaben", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if ($difficulty_level>3){
    $difficulty_level= 1;
    generator($conn, $difficulty_level, $i, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss, $min_ergebniss);
    $difficulty_level= 2;
    generator($conn, $difficulty_level, $i, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss, $min_ergebniss);
    $difficulty_level= 3;
}
generator($conn, $difficulty_level, $i, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss, $min_ergebniss);
$conn = null;

function generator($conn, $difficulty_level, $i, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss, $min_ergebniss){
for ($i = 0; $i < $number_of_tasks; $i++) {
    // Erzeuge eine neue Aufgabe je nach Schwierigkeitsgrad
    $task = generateTask($difficulty_level, $i, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss, $min_ergebniss);


   
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
}
function generateTask($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss, $min_ergebniss) {
    switch ($difficulty_level) {
        case 1:
            return generateLevel1Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss, $min_ergebniss);
        case 2:
            return generateLevel2Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss, $min_ergebniss);
        case 3:
            return generateLevel3Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss, $min_ergebniss);
    }
}

function generateLevel1Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss, $min_ergebniss) {
    $round++;
    $sequence = [];
    $myfile = fopen("minzahl.txt", "w");
    $number = rand($max_Start_Zahl, $min_Start_Zahl);
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
        return generateLevel1Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss, $min_ergebniss);
    }elseif($additional_solution< $min_ergebniss){
        return generateLevel1Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss, $min_ergebniss);
    }
    return [$sequence_string . "|?|", $additional_solution, $difficulty_level, $operation1, $operation2];
}


function generateLevel2Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss, $min_ergebniss) {
    $round++;
    $sequence = array();
    $after_switch = array();
    $number = rand($min_Start_Zahl, $max_Start_Zahl);
    $operation1 = rand($min_operationszahl, $max_operationszahl);
    $operation2 = rand($min_operationszahl, $max_operationszahl);
    $gleich_unterschiedlich = rand(1, 2);
    $verlche_version_vom_lvl = rand(1, 3);
    $mal_oder_geteilt_gemischt = rand (1, 3);

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
    if($mal_oder_geteilt_gemischt == 1){
        $after_switch = switch_multi($number, $verlche_version_vom_lvl, $length, $operation1, $operation2);
        $number = $after_switch[1];
        $length = 1;
        $additional_solution_array = switch_multi($number, $verlche_version_vom_lvl, $length, $operation1, $operation2);
    } elseif ($mal_oder_geteilt_gemischt == 2) {
        $after_switch = switch_dif($number, $verlche_version_vom_lvl, $length, $operation1, $operation2);
        $number = $after_switch[1];
        $length = 1;
        $additional_solution_array = switch_dif($number, $verlche_version_vom_lvl, $length, $operation1, $operation2);
    } else {
        $after_switch = switch_misch($number, $verlche_version_vom_lvl, $length, $operation1, $operation2);
        $number = $after_switch[1];
        $length = 1;
        $additional_solution_array = switch_misch($number, $verlche_version_vom_lvl, $length, $operation1, $operation2);
    }
    $sequence = $after_switch[0];
    $sequence_string = implode("|", $sequence);
    $additional_solution = $after_switch[1];
    if ($additional_solution> $max_ergebniss){
        return generateLevel2Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss, $min_ergebniss);
    }
    elseif($additional_solution< $min_ergebniss){
        return generateLevel2Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss, $min_ergebniss);
    }
    return array($sequence_string."|?|", $additional_solution, $difficulty_level, $operation1, $operation2);
}


function generateLevel3Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss, $min_ergebniss) {
    $round++;
    $sequence = array();
    $after_switch = array();
    $number = rand($min_Start_Zahl, $max_Start_Zahl);
    $operation1 = rand($min_operationszahl, $max_operationszahl);
    $operation2 = 0;
    $verlche_version_vom_lvl = rand(1, 2);
    $length = rand(4, 6);
    if ($operation1 == 0) {
        $operation1 = 1;
    }
    if ($operation2 == 0) {
        $operation2 = 1;
    }
    $after_switch = switch_lvl3($number, $verlche_version_vom_lvl, $length, $operation1, $operation2);
    $number = $after_switch[1];
    $length = 1;
    $sequence = $after_switch[0];
    $sequence_string = implode("|", $sequence);
    $additional_solution_array = switch_lvl3($number, $verlche_version_vom_lvl, $length, $operation1, $operation2);
    $additional_solution = $after_switch[1];
    if ($additional_solution> $max_ergebniss){
        return generateLevel3Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss, $min_ergebniss);
    }elseif($additional_solution< $min_ergebniss){
        return generateLevel3Task($difficulty_level, $round, $max_operationszahl, $min_operationszahl, $max_Start_Zahl, $min_Start_Zahl, $max_ergebniss, $min_ergebniss);
    }
    return array($sequence_string."|?|", $additional_solution, $difficulty_level, $operation1, $operation2);
}
function switch_multi($number, $verlche_version_vom_lvl, $length, $operation1, $operation2){
    $sequence = array();
    array_push($sequence, $number);
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
                    $number = $number * $operation2;
                }
                array_push($sequence, $number);
            }
            break;
    }
    
    $return_array= array($sequence, $number);
    return $return_array;
}
function switch_dif($number, $verlche_version_vom_lvl, $length, $operation1, $operation2) {
    $sequence = array();
    array_push($sequence, $number);
    switch ($verlche_version_vom_lvl) {
        case 1:
            for ($i = $length; $i > 0; $i--) {
                if ($i % 2 == 0) {
                    $number = $number / $operation1;
                } else {
                    $number = $number / $operation2;
                }
                array_push($sequence, $number);
            }
            break;
        case 2:
            for ($i = $length; $i > 0; $i--) {
                if ($i % 2 == 0) {
                    $number = $number / $operation1;
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
                    $number = $number / $operation2;
                }
                array_push($sequence, $number);
            }
            break;

    }
    
    $return_array= array($sequence, $number);
    return $return_array;

}
function switch_misch($number, $verlche_version_vom_lvl, $length, $operation1, $operation2){
    $sequence = array();
    array_push($sequence, $number);
    if($verlche_version_vom_lvl == 3){
        $verlche_version_vom_lvl = $verlche_version_vom_lvl - rand(1, 2);
    }
    switch ($verlche_version_vom_lvl) {
        case 1:
            for ($i = $length; $i > 0; $i--) {
                if ($i % 2 == 0) {
                    $number = $number * $operation1;
                } else {
                    $number = $number / $operation2;
                }
                array_push($sequence, $number);
            }
            break;
        case 2:
            for ($i = $length; $i > 0; $i--) {
                if ($i % 2 == 0) {
                    $number = $number / $operation1;
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
function switch_lvl3($number, $verlche_version_vom_lvl, $length, $operation1, $operation2){
    $sequence = array();
    array_push($sequence, $number);
    if($verlche_version_vom_lvl == 3){
        $verlche_version_vom_lvl = $verlche_version_vom_lvl - rand(1, 2);
    }
    switch ($verlche_version_vom_lvl) {
        case 1:
            for ($i = $length; $i > 0; $i--) {
            $operation2++;
            $number = $number * $operation1 * $operation2;
            array_push($sequence, $number);
        }
            break;
        case 2:
            for ($i = $length; $i > 0; $i--) {
                $operation2++;
                $number = $number * pow($operation1, $operation2);
                array_push($sequence, $number);
            }
            break;
    }
    
    $return_array= array($sequence, $number);
    return $return_array;

}

?>
<html>
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style_aufgaben.css">
    <title>Erstellt!</title>
</head>
<body>
<form>
    <h1>Die Aufgaben wurden erfolgreich erstellt.</h1>
    <a href = "aufgaben.php"><button  type="button">Weitere aufgaben erstellen</button></a>
    <a href = "select_level.php"><button  type="button">Zur Level Auswahl</button></a>
</form>
</body>
</html>
