
<?php require("./config/config.php");

protect();
if(($_SESSION['pseudo'])) {
	
$id=$_SESSION['idpseudo'];
$user=$_SESSION['pseudo'];

}

if(($_SESSION['utilisateur'])){

$id=$_SESSION['idsyndic'];
$user=$_SESSION['utilisateur'];
}

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>pfe syndic</title>
<link href="http://fonts.googleapis.com/css?family=Oxygen:400,700,300" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>
<table width="904">
<tr>
<td width="490">
<div id="wrapper">

	<div id="logo" class="container">
	  
      <h1>Syndic-web</h1>
      	</div>
</div>
</td>
<td width="402">        
      <div id="connect" class="connect" >  
      <?php appele(); ?>
</div>
</td>
</tr>
</table>

		

    <?php 
	menuconnect();
	?>
	


    <div id="three-column" class="container">
<div class="post">
				<h2 class="title">Message Prive<em></em> </h2>
				<div class="entry">

<?php
connect();// on prépare une requete SQL cherchant tous les titres, les dates ainsi que l'auteur des messages pour le membre connecté
$sql = 'SELECT titre, date, pseudo as expediteur, messages.id as id_message FROM messages, pseudo WHERE id_destinataire="'.$id.'" AND id_expediteur=id_pseudo ORDER BY date DESC';  

$sql2 = mysql_query('SELECT titre, date, utilisateur as expediteur2, messages.id as id_message FROM messages, syndic WHERE id_destinataire="'.$id.'" AND id_expediteur=id_syndic ORDER BY date DESC');  

// lancement de la requete SQL
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());  
$nb = mysql_num_rows($req); 
$nb=mysql_num_rows($sql2); 
 
if ($nb == 0) { 
   echo 'Vous n\'avez aucun message.';  
}  
else { 
   // si on a des messages, on affiche la date, un lien vers la page lire.php ainsi que le titre et l'auteur du message
   while ($data = mysql_fetch_array($req)) { 
      echo $data['date'] , ' - <a href="lire.php?id_message=' , $data['id_message'] , '">' , stripslashes(htmlentities(trim($data['titre']))) , '</a> [ Message de ' , stripslashes(htmlentities(trim($data['expediteur']))) , ' ]<br />'; 
   }  
   
    while ($data = mysql_fetch_array($sql2)) { 
      echo $data['date'] , ' - <a href="lire.php?id_message=' , $data['id_message'] , '">' , stripslashes(htmlentities(trim($data['titre']))) , '</a> [ Message de ' , stripslashes(htmlentities(trim($data['expediteur2']))) , ' ]<br />'; 
   }  
}  
mysql_free_result($req);  
mysql_close();  
?>
<br /><a href="envoyer.php">Envoyer un message</a>
<?php if(($_SESSION['utilisateur'])){
$msg="<a href='listeutilisateur.php'>Gestion des utilisateurs</a>";
echo "<center><h3>".$msg." </h3></center>"; 

}?>



</div>
</div>
</div>

<?php piednoir(); ?>


</body>
</html> 
