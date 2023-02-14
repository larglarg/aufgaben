
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style_aufgaben.css">
	<title>Aufgabe</title>
</head>
<body>
<form action="check.php" method="post">
<?php
    // Verbindung zur Datenbank herstellen
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "aufgaben";
    $is_rand = False;
    if(!empty($_POST['selected'])) {
        $selected = $_POST['selected'];
     } else {
        $selected = rand(1, 3);
        $is_rand = true;
     }
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Zufällige Aufgabe ermitteln
        $stmt = $conn->prepare("SELECT aufgabe, id FROM aufgaben Where level=:selected ORDER BY RAND() LIMIT 1");
        $stmt->bindParam(':selected', $selected);
        $stmt->execute();
        $sql = $stmt->fetch(PDO::FETCH_ASSOC);
        // Zufällige Aufgabe ausgeben
        echo "<p>Zu lösende ausgabe:</p>";
        echo "<h2>" . $sql['aufgabe'] . "</h2>";

    } catch (PDOException $e) {
        echo "Verbindung fehlgeschlagen: " . $e->getMessage();
    }

    $conn = null;
?>

	<h1>	<title>Aufgabe des levels <?php echo $selected?>:</title> </h1>

		<label for="">antwort:</label>
		<input type="number" name="antwort" id="antwort" step="0.001" required>
        <input type="hidden" name="selected" value="<?php echo $selected?>" />
        <input type="hidden" name="id" value="<?php echo $sql['id'];?>" />
        <input type="hidden" name="is_rand" value="<?php echo $is_rand?>" />
		<br><br>
		<input type="submit" value="Absenden">
	</form>

</body>
</html>
