
<?php
        $max1 = 100;
        $max2 = 100;
        $min1 = -100;
        $min2 = -100;

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style_aufgaben.css">
	<title>setting_einmaleins</title>
</head>
<body>
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
        <label for="min_Start_Zahl">minimale höhe der zweiten zahl</label>
		<input type="number" name="min2" value="<?php echo $min2?>" />
		<br><br>
        <label for="quadratzahl">Quadratzahlen üben?</label>
		<input type="checkbox" name="quadratzahl" />
        <br><br>
		<input type="submit" value="Erste Aufgabe">
	</form>

</body>
</html>
