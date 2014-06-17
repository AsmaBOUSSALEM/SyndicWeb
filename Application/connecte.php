<?php
include('./config/config.php');
?>
<?php 
error_reporting(E_ALL ^ E_NOTICE);
if(($_SESSION['pseudo']=="") and ($_SESSION['utilisateur']==""))
	{
	redirect("con_user.php");
	die();	
	}
	
if(($_SESSION['pseudo'])) {
	$espace="Vous êtes connecté en tant que Résident";
$utilisateur=$_SESSION['pseudo'];
$nom=$_SESSION['nom'];
$prenom=$_SESSION['prenom'];
}

if(($_SESSION['utilisateur'])){
$espace="vous êtes connecté en tant que Syndic";
$utilisateur=$_SESSION['utilisateur'];
$nom=$_SESSION['nom'];
$prenom=$_SESSION['prenom'];	
	
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

<div id="wrapper">
	<div id="logo" class="container">
	  <h1>Syndic-web</h1>
		
	</div>
    
	<?php menuconnect(); ?>
    <div id="three-column" class="container">
<div class="post">
				<h2 class="title">Authentification </h2>
				<div class="entry">
	

            <table width="777" height="97" border="0" align="center" id="tableau">
            <tr>
            <td>
            </td>
            <td>
            <?php echo $espace; ?>
            </td>
            </tr>
              <tr>
                <td width="328" height="45"><strong>Utilisateur :</strong></td>
                <td width="345" ><?php echo $utilisateur;  ?></td>
              </tr>
 <tr>
                <td width="328" height="45"><strong>Nom et Prenom : </strong></td>
                <td width="345" ><?php echo $nom." ". $prenom ; ?></td>
              </tr>
              
              <tr>
              <td></td>
              <td>&nbsp;</td>
              </tr>

                          
 
                <tr>
              
              <td height="46"></td>
              <td>
              <a href="deconnect.php"><input name="Se deconnecter" type="submit" value="Se deconnecter"  /></a>
              
              
              </td>
              </tr>
             
            </table>
            <table align="center"> 
             <tr>
              <td width="120">
              <a href="membre.php"><h2 align="center">Messagerie</h2></a>
              </td>
              </tr>
            </table>
</div>
</div>
</div>

     
		
	
</div>

	
    <?php piednoir(); ?>
   

</body>
</html>
