<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style_aufgaben.css">

	<title>Aufgabengenerator</title>
</head>
<body>
<div id="form">
	<h1>Aufgabengenerator</h1>
	<form action="generate_tasks.php" method="post">
		<label for="number_of_tasks">Anzahl der Aufgaben:</label>
		<input type="number" name="number_of_tasks" id="number_of_tasks" required value="1">
		<br><br>
		<label for="max_Start_Zahl">maximale höhe der startzahl:</label>
		<input type="number" name="max_Start_Zahl" id="max_Start_Zahl" required value="100">
		<br><br>
		<label for="min_Start_Zahl">minimale höhe der startzahl:</label>
		<input type="number" name="min_Start_Zahl" id="min_Start_Zahl" required value="-100">
		<br><br>
		<label for="max_operationszahl">maximale höhe der verechnungszahl:</label>
		<input type="number" name="max_operationszahl" id="max_operationszahl" required value="100">
		<br><br>
		<label for="min_operationszahl">minimale höhe der verechnungszahl:</label>
		<input type="number" name="min_operationszahl" id="min_operationszahl" required value="-100">
		<br><br>
		<label for="max_groesse_ergebniss">maximale höhe des ergebnisses:</label>
		<input type="number" name="max_groesse_ergebniss" id="max_groesse_ergebniss" required value="2000">
		<br><br>
		<label for="min_groesse_ergebniss">minimale höhe des ergebnisses:</label>
		<input type="number" name="min_groesse_ergebniss" id="min_groesse_ergebniss" required value="-2000">
		<br><br>
		<label for="difficulty_level">Schwierigkeitsniveau:</label>
		<select name="difficulty_level" id="difficulty_level" required>
			<option value="1">Level 1</option>
			<option value="2">Level 2</option>
			<option value="3">Level 3</option>
			<option value="4">ALLE</option>
		</select>
		<br><br>
		<input type="submit" value="Aufgaben generieren">
	</form>
</div>
</body>
</html>
