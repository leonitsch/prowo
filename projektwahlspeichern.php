<html>

<a href="projektwahl.php"> zurueck zu Projektwahl </a><br></br>

<?php
	require "dbconfig.php";

	if(isset($_POST["ew"])){	
		$i=0;
		$pdo->query("SELECT name FROM projektwahl");
		$sql = "SELECT name FROM projektwahl";
		
		echo "Projektwahl speichern...<br>";
		$sql = "INSERT INTO projektwahl VALUES (".$i.",'".$_POST["ew"]."','".$_POST["zw"]."','".$_POST["dw"]."','".$_POST["nw"]."')";
		$pdo->query($sql);
		echo "Die Projektwahl ".$_POST["ew"]." wurde erfolgreich gespeichert<br>";

		$i=$i+1;
		
	}
	else{
		echo "Fehler beim Speichern der Wahl<br>";
}

?>


<form action="index.php">
	<input type="submit" name="logout" value="Ausloggen">
</form>

</html>
