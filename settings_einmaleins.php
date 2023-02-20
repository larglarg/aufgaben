
<?php
			if (!empty($_POST['max1'])){
				//wenn eins nicht gsetzt ist wird beides nicht gesetzt sein.

				$max1 = $_POST['max1'];
				$max2 = $_POST['max2'];
				$min1 = $_POST['min1'];
				$min2 = $_POST['min2'];
                $quadratzahl = $_POST['quadratzahl'];
			}else {
				$max1 = 100;
				$max2 = 100;
				$min1 = -100;
				$min2 = -100;
                $quadratzahl = false;
			}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style_aufgaben.css">
	<title>setting_einmaleins</title>
</head>
<body>
<div id="form">
<form action="einmaleins.php" method="post">
	<h1>Settings einmaleins</h1>

        <label for="min_Start_Zahl">maximale höhe der ersten zahl</label>

        <input type="number" name="max1" value="<?php echo $max1?>" />
        <br><br>
        <label for="min_Start_Zahl">minimale höhe der ersten zahl</label>
		<input type="number" name="max2" value="<?php echo $max2?>" />
        <br><br>
        <label for="min_Start_Zahl">maximale höhe der zweiten zahl</label>
		<input type="number" name="min1" value="<?php echo $min1?>" />
        <br><br>
        <label for="min_Start_Zahl">maximale höhe der zweiten zahl</label>
		<input type="number" name="min2" value="<?php echo $min2?>" />
        <br><br>
        <label for="quadratzahl">Quadratzahlen üben?</label>
		<input type="checkbox" name="quadratzahl" <?php if($quadratzahl == true){echo "checked='checked'";} else {echo "checked";}?>/>

        <br><br>
		<input type="submit" value="Erste Aufgabe">
	</form>
</diV>

</body>
</html>
