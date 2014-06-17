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
				<h2 class="title">Liste des montants syndicales </h2>
				<div class="entry">
	<?php  
		  connect();
		  $recherche = ("SELECT * FROM residence;" ) ;
$result = mysql_query($recherche);
while($row = mysql_fetch_array($result)){
	echo '<h3>Residence 
	'.$row[1].' </h3>';
	
	
	
	

  $recherche1 = ("SELECT * FROM immeuble where id_residence=$row[0];" ) ;
$result1 = mysql_query($recherche1);
while($row1 = mysql_fetch_array($result1)){
	
	echo'
	<table width="467" border="3" align="center" class="divider" id="user2">
	<tr>
	<td>
	 <h3>Immeuble 
	'.$row1[1].' </h3></td>
	</tr>
	</table>
	';
	echo '<table width="467" border="3" align="center" class="divider" id="user">';
	echo '
	<tr>
    <td width="158"  id="user"> Nom Apartement </td>
    <td width="151" id="user"> Montant </td>
	<td id="user">Modifier </td>
	<td  id="user">Supprimer </td>
    
  </tr>';
	
	
	$recherche2 = ("SELECT * FROM apartement where id_immeuble=".$row1['id_immeuble'].";" ) ;
$result2 = mysql_query($recherche2);
while($row2 = mysql_fetch_array($result2)){
	$test=$row2['id_apartement'];
//	echo "c'est ici 3afak : : ".$test;
	$rec=mysql_query("SELECT * from montant_s where id_apartement='$test';");
	while($r=mysql_fetch_array($rec)){
	
	
	
	$id1=$r['id_montant'];

	$mod1='<a href="modmon.php?ida='.$id1.'"><input type="submit" value="Modifier"/></a>';
	$del1='<a href="delmon.php?ida='.$id1.'"><input type="submit" value="Supprimer"/></a>';
	$ty=$row2['id_type'];
	$recherche3= ("SELECT * FROM type_apart where id_type='$ty';" ) ;
$result3 = mysql_query($recherche3);
	$row3 = mysql_fetch_array($result3);
	
echo '<tr>
    <td width="158"  id="user">'.$row2['nom'].'</td>
    <td width="151" id="user">'.$r['montant'].'</td>
	<td>'.$mod1.'</td>
	 <td>'.$del1.'</td>
    
  </tr>';
}
}
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
