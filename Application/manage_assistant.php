
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


function addAssistant($nom, $prenom, $cin, $tel, $email){
	
	connect();
	


	mysql_query("INSERT INTO `pfe_syndic`.`syndic`  VALUES (NULL, '$nom', '$prenom', '$cin', '$tel', '$email')");
	
	}
	
	
?>
