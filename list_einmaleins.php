<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style_aufgaben.css">
	<title>setting_einmaleins</title>
</head>
<body>
    <div id="form">
<?php
			if (!empty($_POST['max1'])){
				//wenn eins nicht gsetzt ist wird beides nicht gesetzt sein.

				$max1 = $_POST['max1'];
				$max2 = $_POST['max2'];
				$min1 = $_POST['min1'];
				$min2 = $_POST['min2'];
			}else {
				$max1 = 100;
				$max2 = 100;
				$min1 = -100;
				$min2 = -100;
			}
            $num = $min1;
			echo "<table>";
            while (true){
                if($num==$max1){
                    break;
                }
                echo  "<tr>"."<td>".$num."</td><td>".$num*$num."</td>"."</tr>";
                $num++;
            }
            echo "</table>";
?>

</body>
</html>
