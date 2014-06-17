<?php function connect(){
	
	
		$conn = mysql_connect('localhost','root', '');
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
	
	mysql_select_db('pfe_syndic');
	
	return $conn;
}



 

function deletebuil($nom){
connect();
mysql_query("DELETE FROM immeuble WHERE nomImm= '$nom'");
/*$req=$bdd->prepare('DELETE FROM resident WHERE nomResident= :nom');
$req->execute(array('nom'=>$nom,));*/
}



function addBuil($nom,$nbretag,$nbreaprt,$res){
connect();

    $recherche = ("SELECT * FROM residence WHERE raisonsocial='$res';" ) ;
    $result = mysql_query($recherche);
	$row = mysql_fetch_array($result);

mysql_query("INSERT INTO immeuble VALUES('','$nom','$nbretag','$nbreaprt','$row[0]')");
}
?>