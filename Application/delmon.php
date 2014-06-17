<?php

require('./config/config_syndic.php');
protect();
protectsyndic();
$id=$_GET['ida'];





?>

<?php

if($_POST['send']) {
	


connect();
	
mysql_query("DELETE FROM montant_s WHERE id_montant='$id'");
	
echo"<script>alert(' Le montant  a ete supprimer avec succes ')</script>";
redirect("listmontant.php");
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
				<h2 class="title">suppression d'un montant syndicale</h2>
				<div class="entry">
                
     <p align="center"> vous etes sur le point de supprimer un montant syndicale<br />
     Etes - vous d'accord ?
     <?php $ref='delmon.php?id=".$id."'; ?>
     <form method="post" action="<?php $ref ;?>" >
        <table width="151" align="center">
       <tr>
     <td width="69">
     <input type="submit" value="Oui" name="send" width="100"/>
	 
     </td>
     <td width="70">
     <a href="listmontant.php"><input name="retour" type="button" value="Non" height=45px /></a>
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
