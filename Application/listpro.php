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
	<table width="940" border="3" align="center" class="divider" id="user">
  <tr>
    <td width="52" height="41" id="user">Nom</td>
    <td width="63" id="user">Prenom</td>
    <td width="83" id="user">Nom Immeuble</td>
     <td width="82" id="user">Nom Apartement</td>
    <td width="48" id="user">CIN</td>
    <td width="73" id="user">Profession</td>
    <td width="84" id="user">Telephone</td>
    <td width="83" id="user">Email</td>
    <td width="116" id="user">date d'habitation</td>
    <td width="82" id="user">modifier</td>
    <td width="90" id="user">supprimer</td>
  </tr>
  <?php 
  connect();




  $recherche = ("SELECT * FROM proprietaire where active=1 ;" ) ;
$result = mysql_query($recherche);
while($row = mysql_fetch_array($result)){
$idapartement=$row['id_apartement'];
$date=$row['datehabita'];
$date=angl_fran($date);
  $recherche3 = ("SELECT * FROM apartement WHERE id_apartement='$idapartement';" ) ;
$result3 = mysql_query($recherche3);
$row3 = mysql_fetch_array($result3);
$idimmeuble=$row3['id_immeuble'];

 $recherche4 = ("SELECT * FROM immeuble WHERE id_immeuble='$idimmeuble';" ) ;
$result4 = mysql_query($recherche4);
$row4 = mysql_fetch_array($result4);


$id=$row['id_proprietaire'];
	$mod='<a href="modpro.php?id='.$id.'"><input type="submit" value="Modifier"/></a>';
	$del='<a href="delpro.php?id='.$id.'"><input type="submit" value="Supprimer"/></a>';



echo '

<tr>
    <td width="115"  id="user">'.$row["nom"].'     </td>
    <td width="266" id="user">'.$row["prenom"].'</td>
    <td width="87" id="user">'.$row4["nom"].'</td>
     <td width="118" id="user">'.$row3["nom"].'</td>
    <td width="126" id="user">'.$row["CIN"].'            </td>
    <td width="97" id="user">'.$row["profession"].'</td>
    <td width="91" id="user">0'.$row["telephone"].'</td>
	 <td width="91" id="user">'.$row["email"].'</td>
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
