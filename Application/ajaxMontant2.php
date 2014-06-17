
<?php require('./config/config.php'); ?>
<?php

/*
	echo "<select id='montant1' nom='montant1'>";
	echo "<option value='-1'>-- Choisissez un proprio --</option>"; 
	if(isset($_POST["numResident"])){
		
		connect();
		$res = mysql_query("SELECT numApart FROM apartement 
			WHERE numResident=".$_POST["numResident"]." ORDER BY numApart");
			
		$row = mysql_fetch_assoc($res);
		$res1 = mysql_query("SELECT * FROM montant
			WHERE numApart=".$row["numApart"]." ORDER BY numApart");
			$row1 = mysql_fetch_assoc($res1);
			echo "<option value='".$row1[0]."'>".$row1["montant"]."</option>";
	
	}
	echo "</select>";
	*/
?>
<?php

echo "<td id='montant1'>";
	if(isset($_POST["id_proprietaire"])){
		connect();
		
		$res1 = mysql_query("SELECT * FROM montant_s
			WHERE id_proprietaire=".$_POST["id_proprietaire"]." ORDER BY montant");
			
			$row1 = mysql_fetch_assoc($res1);
			$label=$row1["montant"];
			echo "<input type='text' value='$label' name='montant_final'/> ";
			
			
}
	echo "</td>";



/*
value=
	echo "<select name='proprio' id='proprio'>";
	
	if(isset($_POST["numApart"])){
		echo "<option value='-1'>-- Choisissez un proprio --</option>"; 
		connect();
		$res = mysql_query("SELECT numResident FROM apartement 
			WHERE numApart=".$_POST["numApart"]." ORDER BY numResident");
			
		$row = mysql_fetch_assoc($res);
		$res1 = mysql_query("SELECT * FROM resident
			WHERE numResident=".$row["numResident"]." ORDER BY numResident");
			$row1 = mysql_fetch_assoc($res1);
			echo "<option value='".$row1["numResident"]."'>".$row1["nomResident"]."</option>";
	
	}
	else echo "walo walo walo walo walo !!!!!!!!!!!!!!!!!";
	echo "</select>";
	*/
?>