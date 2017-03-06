<?php
	require "header.php";
	require "dbconfig.php";
	require "dbfunctions.php";
	
	
	class Benutzer{
		//Attribute 
		public $id;
		public $ew;
		public $zw;
		public $dw;
		public $nw;
		public $zuteilung;
		public $istZugeteilt;
	}
	
	class Projekt{
		//Attribute
		public $id;
		public $minmitglieder;
		public $maxmitglieder;
		public $minklasse;
		public $maxklasse;
		public $teilnehmer;
		
		//Methoden
		
	}
	
	function getProjekt($id,$projektliste){
		foreach($projektliste as $projekt){
			if($projekt->id == $id){
				return $projekt;
			}
		}
	}
	
	function eintragen($schueler,$projektliste,$id){
		$projekt = getProjekt($id,$projektliste);
		// echo $projekt->maxmitglieder." ";
		// echo $schueler->istZugeteilt."<br>";
		// echo count($projekt->teilnehmer)." ";
		
		if(intval((count($projekt->teilnehmer)) < $projekt->maxmitglieder) && !$schueler->istZugeteilt){ 
			array_push($projekt->teilnehmer,$schueler);
			$schueler->zuteilung = $projekt->id;
			$schueler->istZugeteilt = true;
			return true;
		}
		else{
			return false;
		}
	}
	
	
	
	
	

	$benutzerliste = array();
	$sql = "SELECT * FROM projektwahl";
	foreach($pdo->query($sql) as $row){
		$benutzer = new Benutzer();
		$benutzer->id = $row["name"];
		$benutzer->ew = $row["erstwunsch"];
		$benutzer->zw = $row["zweitwunsch"];
		$benutzer->dw = $row["drittwunsch"];
		$benutzer->nw = $row["nichtwunsch"];
		$benutzer->zuteilung = 0;
		$benutzer->istZugeteilt = false;
		array_push($benutzerliste,$benutzer);
	}
	shuffle($benutzerliste);
	
	
	$projektliste = array();
	$sql = "SELECT * FROM projekte";
	foreach($pdo->query($sql) as $row){
		$projekt = new Projekt();
		$projekt->id = $row["id"];
		$projekt->minmitglieder = $row["mitgliedermin"];
		// echo $row["mitgliedermin"]."||".$row["mitgliedermax"]."<br>";
		$projekt->maxmitglieder = $row["mitgliedermax"];
		// echo $projekt->minmitglieder."||".$projekt->maxmitglieder."<br>";
		$projekt->minklasse = $row["min"];
		$projekt->maxklasse = $row["max"];
		$projekt->teilnehmer = array();
		array_push($projektliste,$projekt);
	}
if(isset($_POST['bestaetigung'])){	

	$pdo->query("DELETE FROM projektverteilung");
	foreach($benutzerliste as $benutzer){
		if(!$benutzer->istZugeteilt){
			if(eintragen($benutzer,$projektliste,$benutzer->ew)){
				// echo "Benutzer ".getUserName($benutzer->id)." wurde erfolgreich für seinen Erstwunsch ".getProjektName($benutzer->ew)." eingetragen<br>"; 
			}
		}
		
	}
	
	foreach($benutzerliste as $benutzer){
		if(!$benutzer->istZugeteilt){
			if(eintragen($benutzer,$projektliste,$benutzer->zw)){
				// echo "Benutzer ".getUserName($benutzer->id)." wurde erfolgreich für seinen Zweitwunsch ".getProjektName($benutzer->zw)." eingetragen<br>"; 
			}
		}
		
	}
	
	foreach($benutzerliste as $benutzer){
		if(!$benutzer->istZugeteilt){
			if(eintragen($benutzer,$projektliste,$benutzer->dw)){
				// echo "Benutzer ".getUserName($benutzer->id)." wurde erfolgreich für seinen Drittwunsch ".getProjektName($benutzer->dw)." eingetragen<br>"; 
			}
		}
		
	}
	
	foreach($benutzerliste as $benutzer){
		if(!$benutzer->istZugeteilt){
			$projekt = $projektliste[rand(0,count($benutzerliste)-1)]->id;
			while(($projekt == $benutzer->nw) || !eintragen($benutzer,$projektliste,$projekt)){
				$projekt += 1;
			}
			// echo "Benutzer ".getUserName($benutzer->id)." wurde zufällig in das Projekt ".getProjektName($projekt)." eingetragen<br>"; 
		}
	}
}
	
	
	
	
	
	
	
	
	foreach($benutzerliste as $benutzer){
		if($benutzer->istZugeteilt){
			$sql = "INSERT INTO projektverteilung VALUES ('',".$benutzer->id.",".$benutzer->zuteilung.")";
			$pdo->query($sql);
		}
	}
	
	
	

	echo "<form action='projektverteilung.php' method='POST'>";
	echo "<label for='bestaetigung'>Neuverteilung bestätigen</label>";
	echo "<input type='radio' name='bestaetigung' value='ja'><br></br>";
	echo "<input type='submit' name='absenden' value='Schüler Verteilen'>";
	echo "</form>";
	
	
	echo count($benutzerliste)." Schüler sind bereits veteilt<br></br>";
	
	
	$sql = "SELECT * FROM projektverteilung";
	echo "<table align='center' border='1'>";
	echo "<tr><td>Name</td><td>Projekt</td>";
	foreach($pdo->query($sql) as $row){
		echo "<tr>";
			echo "<td align='left'>".getUserName($row['userid'])."</td>";
			echo "<td align='left'>".getProjektName($row['projektid'])."</td>";
			
		echo "</tr>";
	}
	echo "</table>";

	require "footer.php";
?>

	
	
