<?php

	require "dbconfig.php";
	require "dbfunctions.php";

	function getUserIDs(){
		$pdo = connectDB();
		$ids = array();
		$sql = "SELECT id FROM benutzer";
		foreach($pdo->query($sql)as $row){
			array_push($ids,$row['id']);
		}
		return $ids;
	}
	
	function getProjektIDs(){
		$pdo = connectDB();
		$ids = array();
		$sql = "SELECT id FROM projekte";
		foreach($pdo->query($sql) as $row){
			array_push($ids,$row['id']);
		}
		return $ids;
	}
	
	
	$projektdaten = array(
			array("Tanzen",2,8,5,11,"Leon","Kopp","keineangabe"),
			array("Singen",10,20,5,7,"Georg","Kopp","keineangabe"),
			array("Malen",10,20,5,8,"Gregor","Kopp","keineangabe"),
			array("Minecraft",10,20,5,8,"Julius","Kopp","keineangabe"),
			array("Programmieren",10,20,5,11,"Erik","Kopp","keineangabe"),
			array("Skaten",10,20,5,11,"Leon","Michel","keineangabe"),
			array("Film drehen",10,20,5,11,"Paul","Kopp","keineangabe"),
			array("Meditieren",10,20,5,11,"Antoine","Kopp","keineangabe"),
			array("Musik machen",10,20,5,11,"Hans","Kopp","keineangabe"),
			array("Orchester",10,20,5,11,"Marlon","Kopp","keineangabe"),
			array("Deutsch im Wandel der Zeit",10,20,5,11,"Julian","Kopp","keineangabe"),
			array("Mathematik",10,20,5,11,"Pia","Kopp","keineangabe"),
			array("Astro AG",10,20,5,11,"Lisa","Kopp","keineangabe"),
			array("Chemie",10,20,5,11,"Lena","Kopp","keineangabe"),
			array("Physik",10,20,5,11,"Brigitte","Kopp","keineangabe"),
			array("Bio",10,20,5,11,"Lara","Kopp","keineangabe")
			);
	
	
	$pdo->query("DELETE FROM projekte");

	
	foreach($projektdaten as $projekt){
		echo $projekt[0]."	";
		echo $projekt[1]."	";
		echo $projekt[2]."	";
		echo $projekt[3]."	";
		echo $projekt[4]."	";
		echo $projekt[5]."	";
		echo $projekt[6]."	";
		echo $projekt[7]."<br>";
		$sql = "INSERT INTO projekte VALUES ('','".$projekt[0]."',".$projekt[1].",".$projekt[2].",".$projekt[3].",".$projekt[4].",'".$projekt[5]."','".$projekt[6]."','".$projekt[7]."')";
		$pdo->query($sql);
		
	}

	$userids = getUserIDs();
	$projektids = getProjektIDs();

	
	foreach($userids as $id){
		echo $id."<br>";
	}
	
			
	$projektwahldaten = array(
			array($userids[0],$projektids[0],$projektids[1],$projektids[2],$projektids[3]),
			array($userids[1],$projektids[0],$projektids[4],$projektids[3],$projektids[8]),
			array($userids[2],$projektids[0],$projektids[5],$projektids[7],$projektids[9]),
			array($userids[3],$projektids[0],$projektids[7],$projektids[3],$projektids[2]),
			array($userids[4],$projektids[0],$projektids[11],$projektids[12],$projektids[6]),
			array($userids[5],$projektids[0],$projektids[3],$projektids[4],$projektids[7]),
			array($userids[6],$projektids[0],$projektids[6],$projektids[10],$projektids[8]),
			array($userids[7],$projektids[0],$projektids[15],$projektids[14],$projektids[9]),
			array($userids[8],$projektids[0],$projektids[6],$projektids[11],$projektids[5]),
			array($userids[9],$projektids[0],$projektids[14],$projektids[2],$projektids[4]),
			array($userids[10],$projektids[0],$projektids[14],$projektids[2],$projektids[4]),
			array($userids[11],$projektids[0],$projektids[14],$projektids[2],$projektids[4]),
			array($userids[12],$projektids[0],$projektids[14],$projektids[2],$projektids[4])
			);
	

	$pdo->query("DELETE FROM projektwahl"); 	
	
	
	foreach($projektwahldaten as $projektwahl){
		echo $projektwahl[0]."	";
		echo $projektwahl[1]."	";
		echo $projektwahl[2]."	";
		echo $projektwahl[3]."	";
		echo $projektwahl[4]."<br>";
		
		$sql = "INSERT INTO projektwahl VALUES ('',".$projektwahl[0].",".$projektwahl[1].",".$projektwahl[2].",".$projektwahl[3].",".$projektwahl[4].")";
		$pdo->query($sql);
		
	}



?>