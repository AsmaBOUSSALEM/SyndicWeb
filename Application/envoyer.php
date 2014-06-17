
<?php require('./config/config.php');
error_reporting(E_ALL ^ E_NOTICE);
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

<?php
// on vérifie toujours qu'il s'agit d'un membre qui est connecté

// on teste si le formulaire a bien été soumis
if (isset($_POST['go']) && $_POST['go'] == 'Envoyer') { 
   if (empty($_POST['destinataire']) || empty($_POST['titre']) || empty($_POST['message'])) { 
      $erreur = 'Au moins un des champs est vide.'; 
   } 
   else { 
      connect();// si tout a été bien rempli, on insère le message dans notre table SQL
      $sql = 'INSERT INTO messages VALUES("", "'.$id.'", "'.$_POST['destinataire'].'", "'.date("Y-m-d H:i:s").'", "'. mysql_real_escape_string($_POST['titre']).'", "'. mysql_real_escape_string($_POST['message']).'")'; 
      mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); 
 
      mysql_close(); 
 
 	redirect('main_forum.php');
	die();
      
   }  
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
</div>
		

    <?php 
	menuconnect();
	?>
	
<a href="membre.php">Retour à l'accueil</a><br /><br />
Envoyer un message :<br /><br />
 <center>
<?php
connect();// on prépare une requete SQL selectionnant tous les login des membres du site en prenant soin de ne pas selectionner notre propre login, le tout, servant à alimenter le menu déroulant spécifiant le destinataire du message
$sql = 'SELECT pseudo as nom_destinataire, id_pseudo as id_destinataire FROM pseudo WHERE pseudo <> "'.$user.'" ORDER BY pseudo ASC';  
// on lance notre requete SQL
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());  
$nb = mysql_num_rows ($req);  
 
if ($nb == 0) { 
   // si aucun membre n'a été trouvé, on affiche tout simplement aucun formulaire
   echo 'Vous êtes le seul membre inscrit.';  
}  
else { 
   // si au moins un membre qui n'est pas nous même a été trouvé, on affiche le formulaire d'envoie de message
   ?>
   <form action="envoyer.php" method="post">
   <table>
   <tr><td>
   Pour : </td><td><select name="destinataire">
   <?php
   // on alimente le menu déroulant avec les login des différents membres du site
   while ($data = mysql_fetch_array($req)) { 
      echo '<option value="'.$data['id_destinataire'].'">' , stripslashes(htmlentities(trim($data['nom_destinataire']))) , '</option>'; 
   } 
   ?>
   <option value="-1">------Syndic--------</option>
   <?php $res=mysql_query("Select * from syndic where utilisateur<>'$user'");
   while($row2=mysql_fetch_assoc($res)){
	   
	   echo "<option value='".$row2["id_syndic"]."'>".$row2["utilisateur"]."</option>";
   }
   
   ?>
   </select></td></tr>
   <tr><td>
   Titre : </td>
   <td><input type="text" name="titre" value="<?php if (isset($_POST['titre'])) echo stripslashes(htmlentities(trim($_POST['titre']))); ?>"></td></tr>
   <tr><td>
   Message : </td>
   <td><textarea name="message"><?php if (isset($_POST['message'])) echo stripslashes(htmlentities(trim($_POST['message']))); ?></textarea></td></tr></table>
   <input type="submit" name="go" value="Envoyer">
   </form>
   <?php
}  
mysql_free_result($req);  
mysql_close();  
?>
</select>
 
<br /><br /><a href="deconnect.php">Déconnexion</a>
<?php
// si une erreur est survenue lors de la soumission du formulaire, on l'affiche
if (isset($erreur)) echo '<br /><br />',$erreur;  
?></center>
<?php piednoir(); ?>
</body>
</html> 