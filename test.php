<?php
	require "dbconfig.php";
	$res = $pdo->query("SELECT name FROM benutzer");
	$row1 = $res->fetch();
	echo "(0|0):".$row1[0];
		
		
?>