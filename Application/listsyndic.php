<?php

require('./config/config_residence.php');
protect();
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
				<h2 class="title">information sur les  Immeubles </h2>
				<div class="entry">
          <?php  
		  connect();
		  $recherche = ("SELECT * FROM residence;" ) ;
$result = mysql_query($recherche);
while($row = mysql_fetch_array($result)){
	echo '<h3>Residence 
	'.$row[1].' </h3>';
	echo '<table width="467" border="3" align="center" class="divider" id="user">
  <tr>
    <td width="158" height="41" id="user">Nom </td>
    <td width="151" id="user">Prenom </td>
    <td width="132" id="user">Pseudo </td>
	<td width="132" id="user">sexe </td>
	<td width="132" id="user">Telephone </td>
	<td width="132" id="user">Email </td>
	<td >Modifier </td>
	<td >Supprimer </td>
    
  </tr>';
  $recherche1 = ("SELECT * FROM syndic where id_residence=$row[0];" ) ;
$result1 = mysql_query($recherche1);
while($row1 = mysql_fetch_array($result1)){
	if($row1['sexe']=='M') $sexe="Masculin";
	else $sexe="Féminin";
	$id=$row1['id_syndic'];
	$mod='<a href="modsyn.php?id='.$id.'"><input type="submit" value="Modifier"/></a>';
	$del='<a href="delsyn.php?id='.$id.'"><input type="submit" value="Supprimer"/></a>';
echo '<tr>
    <td width="158"  id="user">'.$row1[1].'</td>
    <td width="151" id="user">'.$row1[2].'</td>
    <td width="132" id="user">'.$row1[7].'</td>
	<td width="151" id="user">'.$sexe.'</td>
    <td width="132" id="user">0'.$row1[5].'</td>
	<td width="132" id="user">'.$row1[6].'</td>
	<td>'.$mod.'</td>
	<td>'.$del.'</td>
    
  </tr>';

}
echo '</table>';
}
?>  
	
</div>
</div>
</div>
</div>
		

<?php piednoir(); ?>

    



</body>
</html>
