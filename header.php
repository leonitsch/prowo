		<?php
		
		session_start();
		if(!isset($_SESSION['name'])){
			header('Location: index.php');
		}
		
		header('Content-Type: text/html; charset=UTF-8');
		
		function createProjektDropdown($name){
			$sql = "SELECT name FROM projekte";
			echo "<select name='".$name."'> ";
			foreach($pdo->query($sql) as $row){
			echo "<option>".$row['name']."</option>";
	
			}
			echo "</select>";
		}
		
	
		
		?>
<html>

	
	<head>
		
	
	</head>


	<body>
		
		<center>
		<img src="logo.png">
		
<?php
if($_SESSION['name']=="admin"){
	require "menu.php";
}
?>
			<hr size="2">
			<br></br>
