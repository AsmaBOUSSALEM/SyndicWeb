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
$idmessage=$_GET['id_message'];
//if (!isset($_SESSION['utilisateur'])) { 
   // si ce n'est pas le cas, on le redirige vers l'accueil
  // header ('Location: index.php'); 
   //exit();  
//}
  
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
	
    <div id="three-column" class="container">
<div class="post">
				<h2 class="title">ajout d'apartement </h2>
				<div class="entry">
<a href="membre.php">Retour à l'accueil</a><br /><br />
<?php
error_reporting(E_ALL ^ E_NOTICE);
connect();$id=$_GET['id_message'];

$sql="SELECT * FROM messages WHERE id='".$id."'";
$result=mysql_query($sql);
$rows5=mysql_fetch_array($result);

$exp=$rows5['id_expediteur'];

// on teste si notre paramètre existe bien et qu'il n'est pas vide
if (!isset($_GET['id_message']) || empty($_GET['id_message'])) { 
   echo 'Aucun message reconnu.';  
}  
else { 
   connect();// on prépare une requete SQL selectionnant la date, le titre et l'expediteur du message que l'on souhaite lire, tout en prenant soin de vérifier que le message appartient bien au membre connecté
   
   $sql = "SELECT titre, date, message, pseudo as expediteur FROM messages, pseudo ,syndic WHERE id_destinataire='$id1' AND id_expediteur=id_pseudo AND messages.id='idmessage'"; 
   
   $sql2 = mysql_query("SELECT titre, date, message, utilisateur as expediteur2 FROM messages, syndic,pseudo WHERE id_destinataire='$id1' AND id_expediteur=id_syndic AND messages.id='$idmessage'"); 
   // on lance cette requete SQL à MySQL
   $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error()); 
   $nb = mysql_num_rows($req); 
   $nb1 =mysql_num_rows($sql2); 
  // echo "nombre a : ".$nb."  nombre b : ".$nb1;
    // si le message a été trouvé, on l'affiche
      $data = mysql_fetch_array($req); 
 
   if ($nb == 0 and $nb1==0) {  
      echo 'Aucun message reconnu.'; 
	  
   } 
   else if ($nb1!=1){ 

     $data=mysql_fetch_assoc($sql2);
      
      
      
      // on affiche également un lien permettant de supprimer ce message de la boite de réception
      $sup1 = '<br /><br /><a href="supprimer.php?id_exp='.$data['titre'].'">Supprimer ce message</a>'; 
   } 
   else
   {

      
      
      // on affiche également un lien permettant de supprimer ce message de la boite de réception
      $sup2 = '<br /><br /><a href="supprimer.php?id_exp='.$data['titre'].'">Supprimer ce message</a>';
   }
   mysql_free_result($req); 
   mysql_close();  
}  
?>

<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">

<tr>
<td bgcolor="#F8F7F1"><strong>message de <?php 
if($nb!=0)
echo $data['expediteur'];
else echo $data['expediteur2'];
?>

</strong></td>

<td bgcolor="#F8F7F1"><?php echo $data['message'] ; ?></td>
</tr>
<tr>
<td bgcolor="#F8F7F1"><strong>titre</strong></td>

<td bgcolor="#F8F7F1"><?php echo $data['titre']; ?></td>
</tr>
<tr>
<td bgcolor="#F8F7F1"><strong>Date/Time</strong></td>

<td bgcolor="#F8F7F1"><?php echo $data['date']; ?></td>
</tr>

</table></td>
</tr>
</table><br>

<?php
connect();$sql2="SELECT * FROM messages WHERE id_expediteur=".$id." AND id_destinataire=".$rows5['id_expediteur']." OR id_expediteur=".$rows5['id_expediteur']." AND id_destinataire=".$id;
$result2=mysql_query($sql2);
while($rows8=mysql_fetch_array($result2) ){
?>

<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">

<tr>
<td bgcolor="#F8F7F1"><strong>Answer</strong></td>

<td bgcolor="#F8F7F1"><?php echo $rows8['message']; ?></td>
</tr>
<tr>
<td bgcolor="#F8F7F1"><strong>Date/Time</strong></td>

<td bgcolor="#F8F7F1"><?php echo $rows8['date']; ?></td>
</tr>
</table></td>
</tr>
</table><br>
 <?php }?>

<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="lire.php?id_message=<?php echo $rows5[0];?>">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">

<tr>
<td valign="top"><strong>Answer</strong></td>
<td valign="top">:</td>
<td><textarea name="a_answer" cols="45" rows="3" id="a_answer"></textarea></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input name="id" type="hidden" value="<? echo $id; ?>"></td>
<td><input type="submit" name="Submit" value="valider"> <input type="reset" name="Submit2" value="Reset"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
<?php
if($_POST['Submit']){

      connect();// si tout a été bien rempli, on insère le message dans notre table SQL
      $sql = 'INSERT INTO messages VALUES("", "'.$id.'", "'.$exp.'", "'.date("Y-m-d H:i:s").'", "'.$data['titre'].'", "'.mysql_real_escape_string($_POST['a_answer']).'")'; 
      mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); 
 
      mysql_close(); 
 
      
   }  

?>
<?php

if ($nb1!=1)  echo $sup1;
else echo  $sup2 ;

?>
<br /><br /><a href="deconnect.php">Déconnexion</a>
</div>
</div>
</div>
<?php piednoir(); ?>
</body>
</html> 