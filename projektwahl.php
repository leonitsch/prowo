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

	$sqlklassebenutzer = "SELECT klasse FROM benutzer WHERE username LIKE '".$_SESSION['name']."'";
	$kres = $pdo->query($sqlklassebenutzer);
	$klassebenutzer = $kres->fetch();
	
	echo "Deine Klasse: ".$klassebenutzer[0]."<br></br>";
		
	
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

	
		
?>

	<table>


	<tr>
		<td>Erstwunsch:</td> 
		<td>
			<?php
			$sql = "SELECT name FROM projekte WHERE min<='".$klassebenutzer["klasse"]."' AND max>='".$klassebenutzer["klasse"]."'";
				echo "<select name='ew'> ";
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
			$sql = "SELECT name FROM projekte WHERE min<='".$klassebenutzer["klasse"]."' AND max>='".$klassebenutzer["klasse"]."'";
				echo "<select name='zw'> ";
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
			$sql = "SELECT name FROM projekte WHERE min<='".$klassebenutzer["klasse"]."' AND max>='".$klassebenutzer["klasse"]."'";
				echo "<select name='dw'> ";
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
				$sql = "SELECT name FROM projekte WHERE min<='".$klassebenutzer["klasse"]."' AND max>='".$klassebenutzer["klasse"]."'";
				echo "<select name='nw'> ";
				foreach($pdo->query($sql) as $row){
				echo "<option>".$row['name']."</option>";
			}
			echo "</select>";
			?>
		</td>
	</tr>
	
	</table>


<input type="submit" name="fertig" value="Speichern">

</form>

<form action="index.php">
	<input type="submit" name="logout" value="Ausloggen">
</form>

<textfield readonly>
Hier kommt das Fristdatum hin
</textfield>

<textarea readonly>
Farbcodierung 
</textarea>
<?php
	require "footer.php";
?>