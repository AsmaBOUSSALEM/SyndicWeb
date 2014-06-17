<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php
error_reporting(E_ALL ^ E_NOTICE);
function connect(){
	
	
		$conn = mysql_connect('localhost','root', '');
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
	
	mysql_select_db('pfe_syndic');
	
	return $conn;
}

function deleteresident($nom){
connect();
mysql_query("DELETE FROM resident WHERE nomResident= '$nom'");
/*$req=$bdd->prepare('DELETE FROM resident WHERE nomResident= :nom');
$req->execute(array('nom'=>$nom,));*/
}

function addresident($nom,$prenom,$cin,$profession,$tel,$email){
connect();
mysql_query("INSERT INTO resident VALUES('','$nom','$prenom','$cin','$profession','$tel','$email')");
}

function modifyPro($nom,$prenom,$cin,$profession,$tel,$email){

connect();
//mysql_query(

}


?>
<body>
</body>
</html>