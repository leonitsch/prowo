<?php
	require "header.php";
?>

<?php
$trennuser = " ";
$trennzeile = ";";

require "dbconfig.php";

function genUsernameArr($nutzerliste){
	$nutzerliste = explode(";", $nutzerliste);
	for($i=0;$i<count($nutzerliste);$i++){
		if($nutzerliste[$i] != NULL){
			$nutzerliste[$i] = ltrim($nutzerliste[$i]);
			$nutzerliste[$i] = strtolower($nutzerliste[$i]);
			$usernameliste[$i] = genUsername($nutzerliste[$i]);
		}
	}
	return $usernameliste;
}

function genUsername($nutzer){
	$nutzerarr = explode(" ", $nutzer);
	$praefix = $nutzerarr[1];
	$suffix = $nutzerarr[0];
	$username = substr($praefix,0,4).".".substr($suffix,0,4);
	return $username;
}

function genPassword($nutzerliste){
	$nutzerliste = explode(";", $nutzerliste);
	for($i=0;$i<count($nutzerliste);$i++){
		$password[$i] = strtolower(chr(rand(65,90)).chr(rand(65,90)).chr(rand(65,90)).chr(rand(65,90)).chr(rand(48,57)));
	}
	return $password;
}

if(isset($_POST['liste']) && file_exists($_POST['liste'])){
	$f = fopen("GenerierteNutzerliste","a+");
	ftruncate($f,0);
	
	$nutzerliste = file_get_contents($_POST['liste']);
	$nutzerliste = utf8_decode($nutzerliste);
	$nutzerliste = str_replace("ä","ae",$nutzerliste);
	$nutzerliste = str_replace("ö","oe",$nutzerliste); //? in utf8 Ã¶
	$nutzerliste = str_replace("ü","ue",$nutzerliste);


	//Echte Schulliste
	$nutzerliste = str_replace(" ","",$nutzerliste);
	$nutzerliste = str_replace(","," ",$nutzerliste);
	$nutzerliste = str_replace(array("\r\n", "\r", "\n"), ';', $nutzerliste);
	$nutzerliste = str_replace(array("\r\n", "\r", "\n"), '', $nutzerliste);


	  
	$usernames = genUsernameArr($nutzerliste);
	$passwords = genPassword($nutzerliste);
	for($i=0;$i<count($usernames);$i++){
		fwrite($f,$usernames[$i]."	".$passwords[$i]."\n");
	}


	$pdo->query("DELETE FROM benutzer"); 
	$nutzerlistearr = explode(";",$nutzerliste);
	for($i=0;$i<count($nutzerlistearr);$i++){
		$nutzer = explode(" ",$nutzerlistearr[$i]);
		if(count($nutzer)==3){
			//$passwords[$i] = hash("md5",$passwords[$i]);
			$sql = "INSERT INTO benutzer VALUES ('','".$nutzer[0]."','".$nutzer[1]."','".$usernames[$i]."','".$passwords[$i]."','".$nutzer[2]."')";
			$pdo->query($sql);
		}
	}


}


?>

	<center>
	<form action="Userscript.php" method="POST">
		
		<label for="nl">Nutzerliste: <input type="text" name="liste" required</label>
		<input type="submit" value="Importieren" required>
		<br></br>


	
	</form>
	</center>
	
<?php
	$sql = "SELECT klasse FROM benutzer";
	$klassen = array();
	
	
	foreach($pdo->query($sql) as $row) {
		if(!in_array($row['klasse'],$klassen)){
			array_push($klassen,$row['klasse']);
		}
	}
	
	
	echo "<center>";
	
	if(isset($_POST['liste']) && file_exists($_POST['liste'])) echo count($usernames)." Nutzer eingelesen";

	if(isset($_POST['klasse'])){
		$sql = "SELECT * FROM benutzer WHERE klasse like ".$_POST['klasse'];
		$postklasse = $_POST['klasse'];
	}
	else{
		$sql = "SELECT * FROM benutzer";
	}
	
	
	
	
	echo "<form name='dropdown' method='POST' action='Userscript.php'>";
	echo "<br><label for='klasse'>Klasse: </option>";
	echo "<select name='klasse' onChange='this.form.submit()'>";
	$ifpost = isset($postklasse);
	if(!$ifpost) echo "<option disabled='disabled' selected>---</option>";
	foreach($klassen as $klasse){
		echo "<option"; 
		if ($ifpost && $postklasse == $klasse) echo " selected"; 
		echo ">".$klasse."</option>";
	}
	echo "</select></br>";
	echo "</form>";




	
	echo "</center>";
	echo "<br>";
	
	echo "<table align='center' border='1'>";
	echo "<tr><td>Vorname</td><td>Nachname</td><td>Benutzername</td><td>Passwort</td><td>Klasse</td>";
	foreach($pdo->query($sql) as $row){
		echo "<tr>";
			echo "<td align='left'>".$row['vorname']."</td>";
			echo "<td align='left'>".$row['nachname']."</td>";
			echo "<td align='left'>".$row['username']."</td>";
			echo "<td align='left'>".$row['password']."</td>";
			echo "<td align='left'>".$row['klasse']."</td>";
		echo "</tr>";
	}
	echo "</table>";	
?>
<?php
	require "footer.php";
?>

