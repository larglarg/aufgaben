
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style_aufgaben.css">
	<title>Aufgabe</title>
</head>
<body>
<div id="form">
<form action="get_aufgabe.php" method="post">
<h1>Lösung:</h1>

<?php
    // Verbindung zur Datenbank herstellen
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "aufgaben";

    $selected = $_POST['selected'];
    $id = $_POST['id'];
    $antwort = $_POST['antwort'];
    $is_rand = $_POST['is_rand'];
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Fehlermeldungen als Ausnahmen auslösen
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Anzahl der Einträge pro Level ermitteln
        $stmt = $conn->prepare("SELECT loesung FROM aufgaben where id=:id GROUP BY level");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $sql = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($antwort== $sql['loesung']){
            echo "Die antwort <b>" . $antwort . "</b> ist Richtig";
        } else {
            echo "Die antwort <b>" . $antwort . "</b> ist leider Falsch.";
            echo "<br><br>";
            echo "Richtig währe: <b>" . $sql['loesung'] . "</b> gewesen.";
        }

    } catch (PDOException $e) {
        echo "Verbindung fehlgeschlagen: " . $e->getMessage();
    }
    if($is_rand){
        $selected = NULL;
    }

    $conn = null;
?>


        <input type="hidden" name="selected" value="<?php echo $selected?>" />
		<br><br>
        <div style="display: inline-block;">
		<input type="submit" value="Nächste Aufgabe"> 
        <a href = "aufgaben.php"><button  type="button">Weitere aufgaben erstellen</button></a>
        </div>
</div>
	</form>
   
</body>
</html>