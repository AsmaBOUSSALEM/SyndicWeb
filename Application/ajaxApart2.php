<?php include('manage_residence.php'); ?>

<html>


<?php

	echo "<select name='apartement' id='apartement' onchange='go()'>";
	
	if(isset($_POST["numImm"])){
		echo "<option value='-1'>-- Choisissez un apartement --</option>";
		connect();
		$res = mysql_query("SELECT numApart,nomApart FROM apartement 
			WHERE numImm=".$_POST["numImm"]." ORDER BY nomApart");
		while($row = mysql_fetch_assoc($res)){
			echo '<option value="'.$row["numApart"].'">'.$row["nomApart"].'</option>';
		}
	}
	echo "</select>";

/*
<select name='proprio' id='proprio'  >
                  <option value='-1'>-- Choisissez un apartement --</option>
                </select>
*/

?>
</html>