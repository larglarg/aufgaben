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
        fwrite($ergbnissfile, implode("\n", $task));

        for ($z = 0; $z <= 4; $z++) {
            $stmt->bindParam(':value' . ($z + 1), $task[$z]);
        }

        // Execute the query
        $stmt->execute();
        echo "New record created successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    fclose($ergbnissfile);
    $conn = null;


}

function generateTask($difficulty_level, $roundtask)
{
    switch ($difficulty_level) {
        case 1:
            return generateLevel1Task($difficulty_level, $roundtask);
@@ -70,15 +54,16 @@ function generateTask($difficulty_level, $roundtask) {
    }
}

function generateLevel1Task($dif_lvl, $roundintern)
{
    $roundintern++;
    $myfile = fopen("testfile" . $roundintern . ".txt", "w");
    $sequence = array();
    $numbber = rand(1, 100);
    $operation1 = rand(-10, 10);
    $operation2 = rand(-10, 10);
    $length = rand(4, 6);
    $y = 0;
    if ($operation1 == 0) {
        $operation1 = 1;
    }
@@ -91,34 +76,35 @@ function generateLevel1Task($dif_lvl, $roundintern) {
        } else {
            $numbber = $numbber + $operation2;
        }
        fwrite($myfile, $numbber . "\n");
        array_push($sequence, $numbber);
        $y++;
    }
    foreach ($sequence as $sigle) {
        fwrite($myfile, $sigle . "\n");
    }
    $sequence_string = implode("A", $sequence);
    fwrite($myfile, $sequence_string . "\n");
    $solution = end($sequence);
    if ($y % 2 == 0) {
        $additional_solution = $solution + $operation1;

    } else {
        $additional_solution = $solution + $operation2;
    }
    fwrite($myfile, $additional_solution . "\n");
    fwrite($myfile, $sequence_string . "\n");
    return array($sequence_string . "A?A", $additional_solution, $dif_lvl, $operation1, $operation2);
    fclose($myfile);
}


function generateLevel2Task()
{
    // to be implemented
}

function generateLevel3Task()
{
    // to be implemented
}
