<?php
 
// -----------------------------------------
// Source  :	http://gestionsyndic.co.gp
// -----------------------------------------
// entrez les parametres profil de votre site

$url = "http://gestionsyndic.co.gp";
$site = "Gestion Syndic";
define('key_encrypt',"gerg65er4g65er4g65e4fezugfgiezffezfq"); //Clé d'encryption

// entrer les parametres pour la connexion

$dbUser = "root";
$dbPass = "";
$dbName = "pfe_syndic";
$dbHote = "localhost";



// liste des tables

 $T_immeuble = 'immeuble';
 $T_residence = 'residence';
 $T_syndic = 'syndic';


// connexion et choix de la base
$connexion = mysql_connect($dbHote, $dbUser, $dbPass);
$mysql_select_db = mysql_select_db("$dbName");
// si la connexion échoue
if (!$mysql_select_db) 
    // afficher la ligne suivante
    echo "<b>Mauvaise configuration!!! </b><br>  
Vérifiez dans votre fichier config.php la connexion à la base <b>$dbName</b>";

?>



