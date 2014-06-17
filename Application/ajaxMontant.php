
<?php require('./config/config.php'); ?>
<?php
echo "<select name='mon' id='mon'>";
	
	if(isset($_POST["id_proprietaire"])){
		
		connect();
		$res = mysql_query("SELECT * FROM montant_s 
			WHERE id_proprietaire=".$_POST["id_proprietaire"]." ORDER BY id_montant");
		while($row = mysql_fetch_assoc($res)){
			echo '<option value="'.$row["id_montant"].'">'.$row["montant"].'</option>';
		}
	}
	echo "</select>";

?>