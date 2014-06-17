<?php
require('./config/config.php');
error_reporting(E_ALL ^ E_NOTICE);
session_start();  
// on vérifie toujours qu'il s'agit d'un membre qui est connecté
protect();
if(($_SESSION['pseudo'])) {
	
$id1=$_SESSION['idpseudo'];


}

if(($_SESSION['utilisateur'])){

$id1=$_SESSION['idsyndic'];

	
}
 
 echo $_GET['id_exp'];
// on teste si l'id du message a bien été fourni en argument au script envoyer.php
   connect();// on prépare une requête SQL permettant de supprimer le message tout en vérifiant qu'il appartient bien au membre qui essaye de le supprimer
   $sql = "DELETE FROM messages WHERE  titre='".$_GET['id_exp']."'"; 
   // on lance cette requête SQL
   $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error()); 
 
   mysql_close(); 
 
 redirect('messages.php'); 
 die();
   

?> 
