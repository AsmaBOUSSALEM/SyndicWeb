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
    
	<div id="menu-wrapper">
		<div id="menu" class="container">
			<ul>
				<li class="current_page_item"><a href="#">Homepage</a></li>
				<li><a href="parametre.php">Services</a></li>
				<li><a href="#">Blog</a></li>
				<li><a href="#">About Us</a></li>
				<li><a href="#">Links</a></li>
                <li><a href="testt.php">connectez-vous</a></li>
				<li><a href="#">Contact Us</a></li>
			</ul>
		</div>
	</div>
    <div id="three-column" class="container">
<div class="post">
				<h2 class="title">ajout d'un proprietaire </h2>
				<div class="entry">
	
		<form action="add_syndic.php" method="post" dir="ltr" lang="fr">
            <table width="777" height="350" border="0" align="center" id="tableau">
              <tr>
                <td width="328"><strong>nom de l'assistant :</strong></td>
                <td width="345" ><input name="nom" type="text" required id="formule" width="300"></td>
              </tr>
              <tr>
                <td><strong>prenom de l'assistant :</strong></td>
                <td><input name="prenom" type="text" required id="formule" width="300"></td>
              </tr>
              <tr>
                <td><strong>CIN  de l'assistant :</strong></td>
                <td><input name="cin" type="text" required id="formule" width="300"></td>
              </tr>
              
              <tr>
                <td><strong>Telephone :</strong></td>
                <td><input name="tel" type="text" required id="formule" width="300"></td>
              </tr>
              
              <tr>
                <td><strong>Email :</strong></td>
                <td><input name="email" type="email" required id="formule" width="300"></td>
              </tr>
             

              

              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="74">&nbsp;</td>
                <td><input name="send" type="submit" value="Valider" height=45px width="300" />
                <input name="effacer" type="reset" value="tout effacer" class="parametre" height=45px />
<a href="parametre.php"><input name="retour" type="button" value="retour" height=45px />
</a></td>
              </tr>
              <tr>
              <td height="55"></td>
                <td>&nbsp;</td>
                <td width="90">&nbsp;</td>
              </tr>
            </table>

          </form>
		
	
</div>
	<div id="page" class="container">
		<div id="content">
			<div class="post">
				
			</div>
			<div style="clear: both;">&nbsp;</div>
	  </div>
		
		
		<div style="clear: both;">&nbsp;</div>
</div> 
	
</div>
<?php 
error_reporting(E_ALL ^ E_NOTICE);
include("manage_assistant.php");
$prenom=$_POST['prenom'];
$nom=$_POST['nom'];
$cin=$_POST['cin'];

$tel=$_POST['tel'];
$email=$_POST['email'];



if($_POST['send']){
connect();
addAssistant($nom, $prenom, $cin, $tel, $email);

}
?>
</body>
</html>
