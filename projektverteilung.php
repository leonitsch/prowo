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
	}
	
	class Projekt{
		//Attribute
		public $id;
		public $minmitglieder;
		public $maxmitglieder;
		public $minklasse;
		public $maxklasse;
		
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
		array_push($benutzerliste,$benutzer);
	}
	
	
	$projektliste = array();
	$sql = "SELECT * FROM projekte";
	foreach($pdo->query($sql) as $row){
		$projekt = new Projekt();
		$projekt->id = $row["id"];
		$projekt->minmitglieder = $row["mitgliedermin"];
		$projekt->maxmitlieder = $row["mitgliedermax"];
		$projekt->minklasse = $row["min"];
		$projekt->maxklasse = $row["max"];
		array_push($projektliste,$projekt);
	}
	
	$projekt = $projektliste[0];
	echo $projekt->id;
	

	
	
	
	
	
	require "footer.php";
?>