<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Glissade
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20130326

-->
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
    
	<div id="menu-wrapper">
		<div id="menu" class="container">
			<ul>
				<li class="current_page_item"><a href="index.php">Homepage</a></li>
				<li><a href="parametre.php">Services</a></li>
				<li><a href="#">Blog</a></li>
				<li><a href="#">About Us</a></li>
				<li><a href="#">Links</a></li>
                <li><a href="testt.php">connectez-vous</a></li>
				<li><a href="#">Contact Us</a></li>
                <li><a href="test7.php">this is a test</a></li>s
			</ul>
		</div>
	</div>
    <div id="three-column" class="container">
<div class="post">
				<h2 class="title">suppression d'un proprietaire </h2>
				<div class="entry">
	
		<form action="delete_prop.php" method="post" dir="ltr" lang="fr">
            <table width="777" height="97" border="0" align="center" id="tableau">
              <tr>
                <td width="328" height="45"><strong>nom du resident :</strong></td>
                <td width="345" ><input name="nom" type="text" required id="formule" width="300"></td>
              </tr>
              
              <td height="46">
              <td>
              <input name="send" type="submit" value="Valider"  />
                <input name="effacer" type="reset" value="tout effacer" class="parametre" height=45px />
<a href="parametre.php"><input name="retour" type="button" value="retour" height=45px />
              </td>
              </tr>
            </table>

          </form>
		
	
</div>
	
    <?php 
error_reporting(E_ALL ^ E_NOTICE);
include("manage_buil.php");

$nom=$_POST['nom'];
if($_POST['send']){
connect();
deletebuil($nom);
}
?>
</body>
</html>
