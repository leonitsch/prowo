<?php
	function connectDB(){
		$pdo = new PDO('mysql:host=127.0.0.1;dbname=kkg', "root", "") or die ("connecting to Database failed");
		// $pdo = new PDO('mysql:host=127.0.0.1;dbname=prowo', "root", "") or die ("connecting to Database failed");
		// $pdo = new PDO('mysql:host=127.0.0.1;dbname=prowo', "prowo", "12345") or die ("connecting to Database failed");
		return $pdo;
	}
	function getProjektId($name){
		$pdo = connectDB();
		$sql = "SELECT id FROM projekte WHERE name ='".$name."'";
		$res = $pdo->query($sql);
		$row = $res->fetch();
		$id = $row[0];
		return $id;
	}
		
	
	function getUserId($name){
		$pdo = connectDB();
		$sql = "SELECT id FROM benutzer WHERE username ='".$name."'";
		$res = $pdo->query($sql);
		$row = $res->fetch();
		$id = $row[0];
		return $id;
	}
	
	function getUserName($id){
		$pdo = connectDB();
		$sql = "SELECT username FROM benutzer WHERE id =".$id;
		$res = $pdo->query($sql);
		$row = $res->fetch();
		$name = $row[0];
		return $name;
	}
	
	function getProjektName($id){
		$pdo = connectDB();
		$sql = "SELECT name FROM projekte WHERE id =".$id;
		$res = $pdo->query($sql);
		$row = $res->fetch();
		$name = $row[0];
		return $name;
	}
	
	
	

	?>