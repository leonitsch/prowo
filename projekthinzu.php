
	<?php
		require "header.php";
	?>
	<meta charset="utf-8">
	<FONT SIZE="5">Projekt hinzufügen</FONT>
	<br></br>
	
<?php



	require "dbconfig.php";


	if(isset($_POST["name"])){	
		$i=0;
		$sql = "SELECT name FROM projekte";
		foreach($pdo->query($sql) as $row){
			if($row['name']==$_POST['name']){
				echo "Das Projekt mit dem Namen ".$row['name']." ist bereits vorhanden<br>";
				exit();
			}
		}
		$sql = "INSERT INTO projekte VALUES ('','".$_POST["name"]."',".$_POST["mitgliedermin"].",".$_POST["mitgliedermax"].",".$_POST["min"].",".$_POST["max"].",'".$_POST["leiter"]."','".$_POST["lehrer"]."','"."keineangabe"."')";
		$pdo->query($sql);
		echo "Das Projekt mit dem Namen '".$_POST["name"]."' wurde erfolgreich eingetragen<br>";
	
	}


?>


<form action="projekthinzu.php" method="POST">
	<table align="center">


	<tr>
		<td align="left"><label for="bl">Projektname</label></td>
		<td align="left"><input type="text" name="name" required></td>  
	</tr> 


	<tr>
		<td align="left"><label for="bl">min Mitglieder</label></td>
		<td align="left"><input type="number" name="mitgliedermin" required></td>  
	</tr>
	<tr>
		<td align="left"><label for="bl">max Mitglieder</label></td>
		<td align="left"><input type="number" name="mitgliedermax" required></td>  
	</tr>


	<tr>
		<td align="left">min Klasse</td> 
		<td align="left"><select name="min"> 
			<option>5</option> 
			<option>6</option> 
			<option>7</option>
			<option>8</option>
			<option>9</option>
			<option>10</option>
			<option>11</option> 
			</select> 
		</td>
	</tr>

	<tr>
		<td align="left">max Klasse</td> 
		<td align="left"><select name="max"> 
			<option>5</option> 
			<option>6</option> 
			<option>7</option>
			<option>8</option>
			<option>9</option>
			<option>10</option>
			<option>11</option>
			</select> 
		</td>
	</tr>


	<tr> 
		<td align="left"><label for="bl">Projektleiter</label></td>
		<td align="left"><input type="text" name="leiter" required></td>  
	</tr>
	<tr>
		<td align="left"><label for="bl">Lehrer</label></td>
		<td align="left"><input type="text" name="lehrer" required></td>  
		
		

	</tr>
	<tr>
	<td>
		<label for="maennl">maennlich</label> 
		<input type="radio" id="m�nnl" name="geschlecht" value="0"> 
	</td>
	<td>
		<label for="weibl">weiblich</label> 
		<input type="radio" id="weibl" name="geschlecht" value="1">
	</td>
	<tr>

	<p>
		
	</p>

	</table>
	<input type="submit" name="fertig" value="Projekt eintragen">

</form>


	



<?php
	require "footer.php";
?>