

<?php
require "header.php";
require "dbconfig.php";


echo "<FONT SIZE='5'>Projektübersicht</FONT>";
echo "<br></br>";
//Löschen vorgang
if(isset($_POST['projekt'])){
	$name = $_POST['projekt'];
	$res = $pdo->query("SELECT name FROM projekte WHERE name LIKE '".$name."'");
	$row1 = $res->fetch();
	if(isset($row1[0])){
		$sql = "DELETE FROM projekte WHERE name LIKE '".$name."'";
		$pdo->query($sql);
		echo "Das Projekt mit dem Namen '".$name."' wurde erfolgreich gelöscht";
	}
	else{
		echo "Das Projekt mit dem Namen ".$name." existiert nicht";
	}
	echo "<br></br><br></br>";
}

//Dropdown und Submit button
echo "<form action='projekteanzeigen.php' method='POST'>";

//TODO: als Funktion in header einbinden
$sql = "SELECT name FROM projekte";
			echo "<select name='projekt'> ";
			foreach($pdo->query($sql) as $row){
			echo "<option>".$row['name']."</option>";
	
			}
			echo "</select>";
			
//
echo "	";
echo "<input type='submit' value='Projekt löschen'>";
echo "<br></br>";
echo "</form>";


//Projekttabelle
$sql = "SELECT * FROM projekte";
	echo "<table align='center' border='1'>";
	echo "<tr><td>Name</td><td>min Mitglieder</td><td>max Mitglieder</td><td>Min</td><td>Max</td><td>Projektleiter</td><td>Lehrer</td><td>Geschlecht</td>";
	foreach($pdo->query($sql) as $row){
		echo "<tr>";
			echo "<td align='left'>".$row['name']."</td>";
			echo "<td align='left'>".$row['mitgliedermin']."</td>";
			echo "<td align='left'>".$row['mitgliedermax']."</td>";
			echo "<td align='left'>".$row['min']."</td>";
			echo "<td align='left'>".$row['max']."</td>";
			echo "<td align='left'>".$row['projektleiter']."</td>";
			echo "<td align='left'>".$row['lehrer']."</td>";
			echo "<td align='left'>".$row['geschlecht']."</td>";
		echo "</tr>";
	}
	echo "</table>";

	require "footer.php";
?>

