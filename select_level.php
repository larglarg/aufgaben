<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style_aufgaben.css">
	<title>Level Auswahl</title>
</head>
<body>
<div id="form">
<form action="get_aufgabe.php" method="post">
	<h1>Level Auswahl</h1>


		<label for="selected">Level:</label>
		<select name="selected" id="selected" required>
			<option value="1">Level 1</option>
			<option value="2">Level 2</option>
			<option value="3">Level 3</option>
		</select>
		<br><br>
		<input type="submit" value="Erste Aufgabe">
	</form>
</div>
</body>
</html>
