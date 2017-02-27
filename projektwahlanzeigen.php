<?php 
	require "header.php";
	require "dbconfig.php";
	require "dbfunctions.php";
	
?>

<form action="projektwahlanzeigen.php" method="POST">
	<input type="submit" name="löschen" value="Projektwahl löschen">
</form>



<?php
	if(isset($_POST['löschen'])){
		$pdo->query("DELETE FROM projektwahl");
	}
	
	echo "<br>";
	$sql = "SELECT * FROM projektwahl";
	echo "<table align='center' border='1'>";
	echo "<tr><td>Name</td><td>Erstwunsch</td><td>Zweitwunsch</td><td>Drittwunsch</td><td>Nichtwunsch</td>";
	foreach($pdo->query($sql) as $row){
		echo "<tr>";
			echo "<td align='left'>".getUserName($row['name'])."</td>";
			echo "<td align='left'>".getProjektName($row['erstwunsch'])."</td>";
			echo "<td align='left'>".getProjektName($row['zweitwunsch'])."</td>";
			echo "<td align='left'>".getProjektName($row['drittwunsch'])."</td>";
			echo "<td align='left'>".getProjektName($row['nichtwunsch'])."</td>";
		echo "</tr>";
	}
	echo "</table>";	
	
	
	
	
	
	require "footer.php";
?>



