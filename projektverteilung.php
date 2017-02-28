<?php
	require "header.php";
	require "dbconfig.php";
	require "dbfunctions.php";
	
	$projekte = getProjektListe();
	// echo $projekte['name'];
	// echo $projekte['name'];
	foreach($projekte as $p){
		echo "hallo";
		echo $projekte['name'];
	}
	
	
	require "footer.php";
?>