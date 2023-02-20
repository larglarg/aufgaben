
<?php
			if (!empty($_POST['min'])){
				//wenn eins nicht gsetzt ist wird alles nicht gesetzt sein.

				$min = $_POST['min'];
				$min = $_POST['min'];
                $lengthmin = $_POST['lengthmin'];
                $lengthmax = $_POST['lengthmax'];
			}else {
				$max = 100;
				$min = -100;
                $lengthmin = 4;
                $lengthmax = 6;
			}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style_aufgaben.css">
	<title>setting_rechenoperationen</title>
</head>
<body>
<div id="form">
<form action="einmaleins.php" method="post">
	<h1>Settings rechenoperationen</h1>

        <label for="min_Start_Zahl">maximale höhe der Zahlen</label>

        <input type="number" name="max" value="<?php echo $max?>" />
        <br><br>
        <label for="min_Start_Zahl">minimale höhe der Zahlen</label>
		<input type="number" name="min" value="<?php echo $min?>" />
        <br><br>
        <label for="min_Start_Zahl">minimale Länge</label>
        <input type="number" name="lengthmin" value="<?php echo $lengthmin?>">
        <br><br>
        <label for="min_Start_Zahl">Maximale Länge</label>
        <input type="number" name="lengthmax" value="<?php echo $lengthmax?>">
		<br><br>
        <input type="submit" value="Erste Aufgabe">
	</form>
</diV>

</body>
</html>
