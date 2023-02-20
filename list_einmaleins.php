<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style_aufgaben.css">
	<title>Liste alle vorkommenden quadratzahlen</title>
</head>
<body>
    <div id="form">
	<h1>Liste alle vorkommenden quadratzahlen</h1>
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
			if ($max1 == $min1*-1){
				$num = 0;
			}else{
				$num = $min1;
			}
			
			echo "<table>";
			echo "<td>Basis zahl</td><td>ergebniss</td>";
            while (true){
                if($num==$max1){
                    break;
                }
                echo  "<tr>"."<td>".$num."</td><td>".$num*$num."</td>"."</tr>";
                $num++;
            }
            echo "</table>";
?>
<div id="nebeneinander">
	<form action="einmaleins.php" method="post">
		<input type="hidden" name="num2" value="<?php echo $num2?>" />
		<input type="hidden" name="num1" value="<?php echo $num1?>" />
		<input type="hidden" name="max1" value="<?php echo $max1?>" />
		<input type="hidden" name="max2" value="<?php echo $max2?>" />
		<input type="hidden" name="min1" value="<?php echo $min1?>" />
		<input type="hidden" name="min2" value="<?php echo $min2?>" />
		<input type="checkbox" hidden name="quadratzahl" <?php if($quadratzahl == true){echo "checked='checked'";} else {echo "checked";}?>/>
		<input type="submit" value="Zurück zu den aufgaben" name="submit">
	</form>
	<form action="settings_einmaleins.php" method="post">
		<input type="hidden" name="num2" value="<?php echo $num2?>" />
		<input type="hidden" name="num1" value="<?php echo $num1?>" />
		<input type="hidden" name="max1" value="<?php echo $max1?>" />
		<input type="hidden" name="max2" value="<?php echo $max2?>" />
		<input type="hidden" name="min1" value="<?php echo $min1?>" />
		<input type="hidden" name="min2" value="<?php echo $min2?>" />
		<input type="checkbox" hidden name="quadratzahl" <?php if($quadratzahl == true){echo "checked='checked'";} else {echo "checked";}?> />
		<input type="submit" value="Zurück zu den Einstellungen" name="submit">
	</form>
		</div>
		</div>
</body>
</html>
