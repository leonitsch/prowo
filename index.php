
		<?php
		require "dbconfig.php";
		session_start();
			if(isset($_SESSION['name'])){
				session_destroy();
			}
		if(isset($_GET['login'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$sql = "SELECT password FROM benutzer WHERE username ='$username'";
			//TODO falschen Benutzernamen abfangen (rowcount=0)
			foreach($pdo->query($sql) as $row){}
// 			echo $username."<br>";;
// 			echo $password."<br>";
// 			echo $row['password']."<br>";
			if ($password ==$row['password']) {
				session_start();
				$_SESSION['name'] = $username;
				header('Location: Projektwahl.php');
				('<a href="Projektwahl.php">Hack succsessfull</a>');
			}
			if ($username =="admin" && $password == "admin"){
				session_start();
				$_SESSION['name'] = 'admin';
				$_SESSION['admin'] = true;
				header('Location: Userscript.php');
			}
			else {
				$errorMessage = "Benutzername oder Passwort falsch";
			}
			
		
		}
		?>
<!DOCTYPE html>
<html>
<head>
	<title>Anmeldung</title>
	<meta charset="utf-8">
	<style> 
		th,legend{
			font-family:arial,"lucida console",sans-serif; 
		}
		legend{
			font-size:20pt;
		}
		#kkoslogo{
			position:absolute;
			right:0;
			bottom:0;
		}
	</style>
</head>
<body>
	<center>
	
		<img src="Logo.png" alt="Logo">
	
		<fieldset>
		
		<?php
		if(isset($errorMessage)) {
			echo $errorMessage;
		}
		?>
				
		<form action="?login=1" method="post">
			<legend align="center">Anmeldung </legend>	
			
			<table>
				<tr>
					<th align="left">Benutzername</th>
					<th align="left"><input name="username" maxlength="10" required></th>
				</tr>
				<tr>
					<th align="left">Passwort</th>
					<th align="left"><input type="password" name="password" maxlength="6" required></th>
				</tr>
				<tr>
				
					<th align="left">  </th>
					<th align="left"><input type="submit" value="Einloggen"></th>
				
				</tr>
			</table>
		</form>
		</fieldset>
		<img src="kkoslogo.png" id="kkoslogo" alt="kkosLogo">
	</center>
	
</body>

</html>