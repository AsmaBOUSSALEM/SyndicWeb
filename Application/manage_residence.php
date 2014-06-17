
<?php
include('redirection.php');
include('func_facture.php');
//ouvrire une sesion
session_start();
//Clé d'encryption 
define('key_encrypt',"gerg65er4g65er4g65e4fezugfgiezffezfq"); 
//Fonction pour se connecter

function connect(){	
$conn = mysql_connect('localhost','root', '');
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
	
	mysql_select_db('syndic');
	
	return $conn;
}

//Fonction pour ajouter une residence

function addResidence($raisonsocial,$rue,$ville,$nbreImm,$nbreAprt,$tel,$fax,$email,$nomSyn){
	
	connect();
	

$recherche = ("SELECT * FROM syndic WHERE nomSyn='$nomSyn';" ) ;
    $result = mysql_query($recherche);
	$row = mysql_fetch_array($result);	
	
	mysql_query("INSERT INTO `syndic`.`residence`  VALUES (NULL, '$raisonsocial', '$rue', '$ville', '$nbreImm', '$nbreAprt', '$tel', '$fax', '$email', CURRENT_TIMESTAMP, '$row[0]')");
	
	}
//Fonction pour ajouter un user
function adduser($user,$passwd,$email,$active,$ip,$nom,$prenom,$sexe,$apartement){
	connect();
	mysql_query("INSERT INTO `syndic`.`users`  VALUES (NULL, '$user', '$passwd', '$email', '$active', '$ip', '$nom', '$prenom','$sexe', CURRENT_TIMESTAMP,$apartement)");
}

//Fonction pour ajouter un utilisateur
function addutilisateur($utilisateur,$passwd,$syndic){
	connect();
	mysql_query("INSERT INTO `syndic`.`utilisateur`  VALUES (NULL, '$utilisateur', '$passwd', '$syndic')");
}

function addmontant($apartement,$montant){
	connect();
	mysql_query("INSERT INTO `syndic`.`montant`  VALUES (NULL, '$apartement', '$montant')");
}

function addfacture($idmontant,$apartement,$datefacture,$datelimite,$mois){
	connect();
	mysql_query("INSERT INTO `syndic`.`facture`  VALUES (NULL,  '$idmontant','$apartement','$datefacture','$datelimite','$mois')");
}

function addautofacture($datefacture,$datelimite,$mois){
	connect();
	mysql_query("INSERT INTO `syndic`.`autofacture`  VALUES (NULL,'$datefacture','$datelimite','$mois')");
}
?>
