<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style_aufgaben.css">

</head>
<body>
<div id="form">
<form method="post">
	<h1>Das große 1x1</h1>
	<div id="question">
		<?php
			
			if (!empty($_POST['max1'])){
				//wenn eins nicht gsetzt ist wird alles nicht gesetzt sein.

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
			

			$num1 = rand($min1, $max1);
			$num2 = rand($min2, $max2);
			if ($quadratzahl == true){
				$num2 = $num1;
			}
			echo "<p>". $num1 . " x " . $num2."</p>";
			$correctAnswer = $num1 * $num2;
		?>
	</div>
	<label for="answer">Lösung:</label>
    <input type="hidden" name="num2" value="<?php echo $num2?>" />
    <input type="hidden" name="num1" value="<?php echo $num1?>" />
	<input type="hidden" name="max1" value="<?php echo $max1?>" />
	<input type="hidden" name="max2" value="<?php echo $max2?>" />
	<input type="hidden" name="min1" value="<?php echo $min1?>" />
	<input type="hidden" name="min2" value="<?php echo $min2?>" />
	<input type="checkbox" hidden name="quadratzahl" <?php if($quadratzahl == true){echo "checked='checked'";} else {echo "checked";}?> />
	<input type="number" id="answer" name="answer" required autofocus>
	<div id="nebeneinander">
	<input type="submit" value="Überprüfen" name="submit">
</form>

<form action="settings_einmaleins.php" method="post">
	<input type="hidden" name="num2" value="<?php echo $num2?>" />
    <input type="hidden" name="num1" value="<?php echo $num1?>" />
	<input type="hidden" name="max1" value="<?php echo $max1?>" />
	<input type="hidden" name="max2" value="<?php echo $max2?>" />
	<input type="hidden" name="min1" value="<?php echo $min1?>" />
	<input type="hidden" name="min2" value="<?php echo $min2?>" />
	<input type="checkbox" hidden name="quadratzahl" <?php if($quadratzahl == true){echo "checked='checked'";} else {echo "checked";}?> />
	<input type="submit" value="Einstellungen anpassen" name="submit">
</form>
		
<?php
if ($quadratzahl == true){
?>
	<form action="list_einmaleins.php" method="post">
		<input type="hidden" name="num2" value="<?php echo $num2?>" />
		<input type="hidden" name="num1" value="<?php echo $num1?>" />
		<input type="hidden" name="max1" value="<?php echo $max1?>" />
		<input type="hidden" name="max2" value="<?php echo $max2?>" />
		<input type="hidden" name="min1" value="<?php echo $min1?>" />
		<input type="hidden" name="min2" value="<?php echo $min2?>" />
		<input type="checkbox" hidden name="quadratzahl" <?php if($quadratzahl == true){echo "checked='checked'";} else {echo "checked";}?>/>
		<input type="submit" value="Alle Quadratzahlen" name="submit">
	</form>
	</div><br>
<?php
}
?>


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
</div>

</body>
</html>
