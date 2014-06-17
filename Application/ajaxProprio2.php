
<?php include('./config/config.php'); ?>
<?php


	echo "<select name='proprio' id='proprio' autofocus onFocus='go_2()'  >";
	
	if(isset($_POST["id_apartement"])){
		
		connect();
		$res1 = mysql_query("SELECT * FROM proprietaire
			WHERE active=1 and id_apartement=".$_POST["id_apartement"]." ORDER BY id_proprietaire");
			$row1 = mysql_fetch_assoc($res1);
			echo "<option value='".$row1["id_proprietaire"]."'>".$row1["nom"]."  ".$row1["prenom"]."</option>";
	
	}
	echo "</select>";
	
?>