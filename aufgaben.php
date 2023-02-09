<!DOCTYPE html>
<html>
<head>
	<title>Aufgabengenerator</title>
</head>
<body>
	<h1>Aufgabengenerator</h1>
	<form action="generate_tasks.php" method="post">
		<label for="number_of_tasks">Anzahl der Aufgaben:</label>
		<input type="number" name="number_of_tasks" id="number_of_tasks" required>
		<br><br>
		<label for="difficulty_level">Schwierigkeitsniveau:</label>
		<select name="difficulty_level" id="difficulty_level" required>
			<option value="1">Level 1</option>
			<option value="2">Level 2</option>
			<option value="3">Level 3</option>
		</select>
		<br><br>
		<input type="submit" value="Aufgaben generieren">
	</form>
</body>
</html>
