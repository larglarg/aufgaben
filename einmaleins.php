<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style_aufgaben.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<form method="post">
	<h1>Das große 1x1</h1>
	<div id="question">
		<?php
			$num1 = rand(-100, 100);
			$num2 = rand(-100, 100);
			echo "<p>". $num1 . " x " . $num2."</p>";
			$correctAnswer = $num1 * $num2;
		?>
	</div>
	
		<label for="answer">Lösung:</label>
        <input type="hidden" name="num2" value="<?php echo $num2?>" />
        <input type="hidden" name="num1" value="<?php echo $num1?>" />
		<input type="number" id="answer" name="answer" required>
		<input type="submit" value="Überprüfen" name="submit">
	</form>

	<?php
		if(isset($_POST['submit'])) {
			$userAnswer = $_POST['answer'];
			if($userAnswer == $_POST['num2']*$_POST['num1'] ) {
				echo "<p>Richtig!</p>";
			} else {
                echo "<p>deine anwort war:". $userAnswer."</p>";
				echo "<p>Die richtige lösung währe:".$_POST['num2']*$_POST['num1']."</p>";
			}
		}
	?>
	<button onclick="window.location.reload()">Nächste Aufgabe</button>
</body>
</html>
