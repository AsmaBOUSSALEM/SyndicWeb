<?php

require('./config/config_syndic.php');
protect();
protectsyndic();
$id=$_GET['id'];
connect();
$result=mysql_query("SELECT * FROM payementpro WHERE id_facture='$id' and active=1;");
$row=mysql_fetch_assoc($result);
if($row){
	echo"<script>alert(' Vous pouvez pas suprimer cette facture car elle a deja ete regle ')</script>";
redirect('listeutilisateur.php');
die();
}



?>

<?php

if($_POST['send']) {
	


connect();
$res="UPDATE facture set active=0 WHERE id_facture='$id'";

mysql_query($res);
	
	
echo"<script>alert(' La facture  a ete supprimer avec succes ')</script>";
redirect("listefacture.php");
die();
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
<style type="text/css">@import url(jscal/calendar-system.css);</style>
<script type="text/javascript" src="jscal/calendar.js"></script>
<script type="text/javascript" src="jscal/lang/calendar-fr.js"></script>
<script type="text/javascript" src="jscal/calendar-setup.js"></script>    
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

		

    <?php  menufinance();?>
    <div id="three-column" class="container">
<div class="post">
				<h2 class="title">suppression d'un utilisateur</h2>
				<div class="entry">
                
     <p align="center"> vous etes sur le point de supprimer un utilisateur<br />
     Etes - vous d'accord ?
     <?php $ref='delpseudo.php?id=".$id."'; ?>
     <form method="post" action="<?php $ref ;?>" >
        <table width="151" align="center">
       <tr>
     <td width="69">
     <input type="submit" value="Oui" name="send" width="100"/>
	 
     </td>
     <td width="70">
     <a href="listefacture.php"><input name="Submit" type="submit" value="Non" width="79"/></a>
     </td>
     </tr>
   </table> 
   </form>

	
</div>
</div>
</div>
</div>
		

<?php piednoir(); ?>

    



</body>
</html>
