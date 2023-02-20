<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style_aufgaben.css">

</head>
<body>
<div id="form">
<form method="post">
	<h1>Rechenoperationen</h1>
	<div>
		<?php
			 echo '<from method="post">';
			if (!empty($_POST['min'])){
				//wenn eins nicht gsetzt ist wird alles nicht gesetzt sein.

				$min = $_POST['min'];
				$min = $_POST['min'];
                $lengthmin = $_POST['lengthmin'];
                $lengthmax = $_POST['lengthmax'];
			}else {
				$max = 1000;
				$min = -1000;
                $lengthmin = 4;
                $lengthmax = 6;
			}
			$length = rand($lengthmin, $lengthmax);
            $retry = -1;
            do {
            $return_array = generate_task($length, $max, $min);
            $zahlen = $return_array[0];
            $operatioen = $return_array[1];
            $richtige_antwort =$return_array[2];
            $retry++;
            }while(decimalPlaces($richtige_antwort)!= 0);
            $aufgabe = "";
            
            for ($i = 0; $i < $length; $i++){
                echo $zahlen[$i];
                echo '<input type="hidden" name="Zahlen" value="'.$zahlen[$i].'">';
                $aufgabe .= $zahlen[$i].$operatioen[$i];
                echo '<select name="rechenoperation" id="rechenoperation'.$i.'" required><option value="+">+</option><option value="-">-</option><option value="*">*</option><option value="/">/</option></select>';
            }
            echo $zahlen[$length]."=".$richtige_antwort;
            echo '<input type="hidden" name="Zahlen" value="'.$zahlen[$length].'">';
            $aufgabe .=$zahlen[$length];
            echo '<input type="hidden" id="length" name="length" value="'.$length.'">';
            echo '<input type="hidden" id="aufgabe" name="aufgabe" value="'.$aufgabe.'">';
            echo '<input type="hidden" id="richtige_antwort" name="richtige_antwort" value="'.$richtige_antwort.'">';
            echo '<input type="button" onclick="check_answer()" value="Überprüfen"';
            echo "</form>";
            echo "<div id='outputfeld'>"
            ?>
            <script>
                function check_answer(){
                    var aufgabe = document.getElementById('aufgabe').value;
                    var rechenoperation = document.getElementsByName('rechenoperation');
                    var Zahlen = document.getElementsByName('Zahlen');
                    var antwort = document.getElementById('richtige_antwort').value;
                    var antwort_gesamt = "";
                    i = 0;
                    rechenoperation.forEach(element=>{
                        antwort_gesamt += " "+Zahlen[i].value+" "+element.value;
                        i++;

                    })
                    var richtige_antwort = document.getElementById('richtige_antwort').value;
                    antwort_gesamt += " "+Zahlen[i].value;
                    console.log(antwort_gesamt);
                    var user_answer = eval(antwort_gesamt);
                    var outputfeld = document.getElementById('outputfeld');
                    if (user_answer ==  richtige_antwort){
                        outputfeld.innerHTML="die antwort ist richtig"
                
                    }else{
                        outputfeld.innerHTML="die antwort ist Falsch, richtig wäre: <br>"+aufgabe+" <br>gewesen";
                    }
                    outputfeld.hidden=false;
                    console.log(eval(aufgabe));
                
                }
            </script> 
            <?php 
            

            

            
            
            

/*		?>
	</div>
	<label for="answer">Lösung:</label>
	<input type="hidden" name="max" value="<?php echo $max?>" />
	<input type="hidden" name="min" value="<?php echo $min?>" />
	<input type="number" id="answer" name="answer" required autofocus>
	<div id="nebeneinander">
	<input type="submit" value="Überprüfen" name="submit">
</form>

<form action="settings_einmaleins.php" method="post">
<input type="hidden" name="min" value="<?php echo $max?>" />
<input type="hidden" name="min" value="<?php echo $max?>" />

	<input type="submit" value="Einstellungen anpassen" name="submit">
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
</div>

</body>
</html>

<?php */
function generate_task($length, $max, $min){
    $zahlen = array();
    $operatioen = array();
    $rechnung = "";
    $zahl = rand($min, $max);
    array_push($zahlen, $zahl  );
    for ($i = 0; $i < $length; $i++) {
        switch (rand(1, 4)) {
            case 1:
                array_push($operatioen, " + " );
                $zahl = rand($min, $max);

                array_push($zahlen, $zahl);
            break;
            case 2:
                array_push($operatioen, " - " );
                $zahl = rand($min, $max);

                array_push($zahlen, $zahl);
            break;
            case 3:
                array_push($operatioen, " * " );
                $zahl = rand($min, $max);

                array_push($zahlen, $zahl);
            break;
            case 4:
                array_push($operatioen, " / " );
                do {
                    $zahl = rand($min, $max);
                }while($zahl == 0);
                array_push($zahlen, $zahl);
            break;
        }
        
    }


    for ($i = 0; $i < $length; $i++){
        $rechnung .= $zahlen[$i].$operatioen[$i];
    }               
    $rechnung .= $zahlen[$length++];
    $richtige_antwort = eval("return ".$rechnung.";");
    $return = array($zahlen, $operatioen, $richtige_antwort);
return $return;
}
function decimalPlaces($number) {
    $str = strval($number);
    $pos = strrpos($number, '.');
    return ($pos===false ? 0 : strlen($str)-$pos-1);
}
?>