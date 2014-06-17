
<?php require('./config/config.php'); ?>
<?php
echo "<select name='proprietaire' id='proprietaire' onchange='go_montant()'>";
	
	if(isset($_POST["id_apartement"])){
		
		connect();
		$res = mysql_query("SELECT * FROM proprietaire 
			WHERE active=1 and id_apartement=".$_POST["id_apartement"]." ORDER BY nom");
		while($row = mysql_fetch_assoc($res)){
			echo '<option value="'.$row["id_proprietaire"].'">'.$row["nom"].' '.$row["prenom"].'</option>';
		}
		echo "</select>";
		
	}
	
	

?>