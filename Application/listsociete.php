<?php

require('./config/config_proprio.php');
protect();
protectsyndic();
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
				<h2 class="title">information sur les  residences </h2>
				<div class="entry">
	<table width="1060" border="3" align="center" class="divider" id="user">
  <tr>
    <td width="115" height="41" id="user">Raison Social</td>
    <td width="116" id="user">Adresse </td>
    <td width="161" id="user">Ville</td>
     <td width="167" id="user">Nom et Prenom du responsable</td>
    
    <td width="127" id="user">Telephone</td>
    <td width="123" id="user">fax</td>
    <td width="201" id="user">Email</td>
    <td width="123" id="user">Modifier</td>
    <td width="201" id="user">Suprimer</td>

  </tr>
  <?php 
  connect();




  $recherche = ("SELECT * FROM societe where active=1 ;" ) ;
$result = mysql_query($recherche);
while($row = mysql_fetch_array($result)){



$id=$row['id_societe'];
	$mod='<a href="modsoc.php?id='.$id.'"><input type="submit" value="Modifier"/></a>';
	$del='<a href="delsoc.php?id='.$id.'"><input type="submit" value="Suprimer"/></a>';



echo '

<tr>
    <td width="115"  id="user">'.$row["raisonsocial"].'     </td>
    <td width="266" id="user">'.$row["adresse"].'</td>
    <td width="87" id="user">'.$row["ville"].'</td>
     <td width="118" id="user">'.$row["nom"].' '.$row['prenom'].'</td>
    <td width="91" id="user">0'.$row["telephone"].'</td>
	<td width="97" id="user">'.$row["fax"].'</td>
	 <td width="91" id="user">'.$row["email"].'</td>
	<td>'.$mod.'</td>
	<td>'.$del.'</td>
  </tr>




';
 
 
}

  ?>

</table>
</div>
</div>
</div>
</div>
		

<?php piednoir(); ?>

    



</body>
</html>
