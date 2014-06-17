<?php require('./config/config.php'); ?>

<html>


<?php

	echo "<select name='apartement' id='apartement' onChange='go_proprio()'>";
	
	if(isset($_POST["id_immeuble"])){
		echo "<option value='-1'>-- Choisissez un apartement --</option>";
		connect();
		$res = mysql_query("SELECT id_apartement,nom FROM apartement 
			WHERE id_immeuble=".$_POST["id_immeuble"]." ORDER BY nom");
		while($row = mysql_fetch_assoc($res)){
			echo '<option value="'.$row["id_apartement"].'">'.$row["nom"].'</option>';
		}
	}
	echo "</select>";

?>
</html>