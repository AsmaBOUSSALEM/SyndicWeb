<?php

require('./config/config_residence.php');
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
	<table width="1069" border="3" align="center" class="divider" id="user">
  <tr>
    <td width="115" height="41" id="user">Raison Social     </td>
    <td width="266" id="user">Adresse  </td>
    <td width="87" id="user">Ville          </td>
     <td width="118" id="user">Nombre d'immeuble</td>
    <td width="126" id="user">Nombre d'apartement            </td>
    <td width="97" id="user">Telephone   </td>
    <td width="91" id="user">Fax</td>
    <td width="113" id="user">Date d'ouverture</td>
    <td>Modifier</td>
    <td>Supprimer</td>
  </tr>
  <?php 
  connect();
  $recherche = ("SELECT * FROM residence;" ) ;
$result = mysql_query($recherche);
while($row = mysql_fetch_array($result)){
$date=$row['date_creation'];
$date=angl_fran($date);

$id=$row['id_residence'];
	$mod='<a href="modres.php?id='.$id.'"><input type="submit" value="Modifier"/></a>';
	$del='<a href="delres.php?id='.$id.'"><input type="submit" value="Supprimer"/></a>';

echo '

<tr>
    <td width="115" height="41" id="user">'.$row[1].'     </td>
    <td width="266" id="user">'.$row[2].'</td>
    <td width="87" id="user">'.$row[3].'</td>
     <td width="118" id="user">'.$row[4].'</td>
    <td width="126" id="user">'.$row[5].'            </td>
    <td width="97" id="user">0'.$row[6].'</td>
    <td width="91" id="user">0'.$row[7].'</td>
    <td width="113" id="user">'.$date.'</td>
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
