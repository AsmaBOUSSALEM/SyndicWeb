<?php

require('./config/config_proprio.php');
protect();
protectsyndic();
$id=$_GET['id'];
connect();

$rec1=mysql_query("SELECT SUM(montant) as mntfact from facture_s where active=1 
group by id_societe
having id_societe='$id';");
$r1=mysql_fetch_assoc($rec1);
$mntfact=$r1['mntfact'];


$rec2=mysql_query("SELECT SUM(montantpayer) as mntpay from payementsoc where active=1
group by id_societe
having id_societe='$id';");
$r2=mysql_fetch_assoc($rec2);
$mntpay=$r2['mntpay'];

if($mntpay!=$mntfact){
	
echo"<script>alert(' Il y a des factures non regle veuillez les regle d'abord')</script>";
redirect('listsociete.php');
die('Il y a des factures non regle veuillez les regle d\'abord');
}
?>

<?php

if($_POST['send']) {
	


connect();

$date=date('Y-m-d');

mysql_query("UPDATE societe set active=0 where id_societe='$id'") or die("erreur modification");


	
	
echo"<script>alert(' La societe  a ete supprimer avec succes ')</script>";
redirect("listsociete.php");
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

		

    <?php  menuservice();?>
    <div id="three-column" class="container">
<div class="post">
				<h2 class="title">suppression d'une societe</h2>
				<div class="entry">
                
     <p align="center"> vous etes sur le point de supprimer une societe<br />
     Etes - vous d'accord ?
     <?php $ref="delsoc.php?id='$id'";
 ?>
     <form method="post" action="<?php $ref ;?>" >
        <table width="151" align="center">
       <tr>
     <td width="69">
     <input type="submit" value="Oui" name="send" width="100"/>
	 
     </td>
     <td width="70">
     <a href="listsociete.php"><input name="Submit" type="submit" value="Non" width="79"/></a>
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
