<?php
	require "header.php";
	require "dbconfig.php";
	require "dbfunctions.php";
?>
<form action="projektwahl.php" method="POST">

<?php
	
	$sql = "SELECT vorname FROM benutzer WHERE username LIKE '".$_SESSION['name']."'";
	$res = $pdo->query($sql);
	$row = $res->fetch();
	
	
	echo "Willkommen in der Projektauswahl ".$row[0]."<br></br>";
	echo "Bitte beachte: Die Projektverteilung soll so fair wie möglich erfolgen<br>";
	echo "deshalb ist es egal wann ihr euch für eure Projekte anmeldet. Die Verteilung<br>";
	echo "erfolg erst nach der Anmeldefrist. Für die rot makierten Projekte sind bereits<br>";
	echo "mehr Leute angemeldet als es Plätze gibt. Das heisst das du in rote Projekte<br>";
	echo "evtl. nicht rein kommst. Willst du auf nummer sicher gehen solltest du Grün<br>";
	echo "makierte Projekte wählen.<br></br>";
	
	$sql2 = "SELECT klasse FROM benutzer WHERE username LIKE '".$_SESSION['name']."'";
	$kres = $pdo->query($sql2);
	$row1 = $kres->fetch();
	$klassebenutzer = $row1[0];
	$klassebenutzer1 = explode(".", $klassebenutzer);
	$klassebenutzer2 = $klassebenutzer1[0];
	echo "Deine Klasse: ".$klassebenutzer2."<br></br>";
		
	
	// Teste hier, ob ew/zw/dw gleich sind oder dass nw mit einer der anderen drein übereinstimmt
	if(isset($_POST['ew'])){
	if (
	(strcmp($_POST['ew'],$_POST['zw'])!=0)&&
	(strcmp($_POST['ew'],$_POST['dw'])!=0)&&
	(strcmp($_POST['ew'],$_POST['nw'])!=0)&&
	(strcmp($_POST['zw'],$_POST['dw'])!=0)&&
	(strcmp($_POST['zw'],$_POST['nw'])!=0)&&
	(strcmp($_POST['dw'],$_POST['nw'])!=0)){
		if(isset($_POST['ew'])){	
			
			$i=0;
			$res = $pdo->query("SELECT name FROM projektwahl WHERE name=".getUserId($_SESSION['name']));
			$row = $res->fetch();
			if(isset($row[0])){
				
				$sql = "UPDATE projektwahl SET erstwunsch=".getProjektId($_POST['ew']).", zweitwunsch=".getProjektId($_POST['zw']).", drittwunsch=".getProjektId($_POST['dw']).", nichtwunsch=".getProjektId($_POST['ew'])." WHERE name='".$_SESSION['name']."'";
				$pdo->query($sql);
				
			}
			else{
				$sql = "INSERT INTO projektwahl VALUES (".$i.",".getUserId($_SESSION['name']).",".getProjektId($_POST['ew']).",".getProjektId($_POST['zw']).",".getProjektId($_POST['dw']).",".getProjektId($_POST['nw']).")";
				$pdo->query($sql);
				
				
				$i=$i+1;
			}
			echo "Deine Projektwahl wurde erfolgreich gespeichert";
			echo "<br></br>";
				
		}
	
	}
	else{
		echo "Es ist nicht möglich den gleichen Wunsch zweimal einzutragen";
		}	
	}
?>

	<table>


	<tr>
		<td>Erstwunsch:</td> 
		<td>
			<?php
			$sql = "SELECT name FROM projekte WHERE min<='".$row1["klasse"]."' AND max>='".$row1["klasse"]."'";
				echo "<select name='ew'> ";
				echo "<option disabled='disabled' selected>---</option>";
				foreach($pdo->query($sql) as $row){
				echo "<option>".$row['name']."</option>";
			}
			echo "</select>";
			
			?>
		</td>
	</tr> 


	<tr>
		<td>Zweitwunsch:</td> 
		<td>
			<?php
			$sql = "SELECT name FROM projekte WHERE min<='".$row1["klasse"]."' AND max>='".$row1["klasse"]."'";
				echo "<select name='zw'> ";
				echo "<option disabled='disabled' selected>---</option>";
				foreach($pdo->query($sql) as $row){
				echo "<option>".$row['name']."</option>";
			}
			echo "</select>";
			?>
		</td>
	</tr>



	<tr>
		<td>Drittwunsch:</td> 
		<td>
			<?php
			$sql = "SELECT name FROM projekte WHERE min<='".$row1["klasse"]."' AND max>='".$row1["klasse"]."'";
				echo "<select name='dw'> ";
				echo "<option disabled='disabled' selected>---</option>";
				foreach($pdo->query($sql) as $row){
				echo "<option>".$row['name']."</option>";
			}
			echo "</select>";
			?> 
		</td>
	</tr>

	<tr>
		<td>Nichtwunsch:</td> 
		<td>
			<?php
				$sql = "SELECT name FROM projekte WHERE min<='".$row1["klasse"]."' AND max>='".$row1["klasse"]."'";
				echo "<select name='nw'> ";
				echo "<option disabled='disabled' selected>---</option>";
				foreach($pdo->query($sql) as $row){
				echo "<option>".$row['name']."</option>";
			}
			echo "</select>";
			?>
		</td>
	</tr>
	
	</table>
	<br></br>


<input type="submit" name="fertig" value="Projektwahl Speichern">

</form>

<form action="index.php">
	<input type="submit" name="logout" value="Ausloggen">
</form>

<?php

	
	$date = strtotime("March 10, 2017 2:00 PM");
	$remaining = $date - time();
	
	$days_remaining = floor($remaining/86400);
	$hours_remaining = floor(($remaining % 86400)/3600);
	
	echo "Es bleiben dir noch ".$days_remaining." Tage und ".$hours_remaining." Stunden für deine Wahl";
 

	require "footer.php";
?>