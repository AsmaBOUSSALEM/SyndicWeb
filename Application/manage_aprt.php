
<?php


function connect(){
	
	
		$conn = mysql_connect('localhost','root', '');
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
	
	mysql_select_db('pfe_syndic');
	
	return $conn;
}


function addaprt($nom,$etg,$nom_imm,$type,$nom_prop){
	
	connect();
	
$recherche1 = ("SELECT * FROM immeuble WHERE nomImm='$nom_imm';") ;
    $result1 = mysql_query($recherche1);
	$row1 = mysql_fetch_array($result1);	
$recherche2 = ("SELECT * FROM typeaprt WHERE nomType='$type';") ;
    $result2 = mysql_query($recherche2);
	$row2 = mysql_fetch_array($result2);	
$recherche3 = ("SELECT * FROM resident WHERE nomResident='$nom_prop';") ;
    $result3 = mysql_query($recherche3);
	$row3 = mysql_fetch_array($result3);	


	
	mysql_query("INSERT INTO `pfe_syndic`.`apartement`  VALUES (NULL, '$nom', '$etg', '$row1[0]','$row2[0]','$row3[0]')");
	
	}
	
	
?>
