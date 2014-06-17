<?php

require('./config/config.php');
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
				<h2 class="title">information sur les  apartements </h2>
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
    <td width="158"  id="user"> Nom </td>
    <td width="151" id="user"> Numero Etage </td>
    <td width="132" id="user">Nom type </td>
    
  </tr>';
	
	
	$recherche2 = ("SELECT * FROM apartement where id_immeuble=$row1[0];" ) ;
$result2 = mysql_query($recherche2);
while($row2 = mysql_fetch_array($result2)){
	
	$recherche3= ("SELECT * FROM type_apart where id_type=$row2[0];" ) ;
$result3 = mysql_query($recherche3);
	$row3 = mysql_fetch_array($result3);
echo '<tr>
    <td width="158"  id="user">'.$row2[1].'</td>
    <td width="151" id="user">'.$row2[2].'</td>
    <td width="132" id="user">'.$row3[1].'</td>
    
  </tr>';
}
}
echo '</table>';
}   
?> 
<h2 class="title">LEs types d'apartement </h2>


<table width="380" border="3" align="center" class="divider" id="user">
  <tr>
    <td width="117" height="41" id="user">Nom Type</td>
    <td width="73" id="user">surface</td>
    <td width="79" id="user">Balcon</td>
     <td width="79" id="user">Jardin</td>
    
  </tr>




<?php

$recherche2 = ("SELECT * FROM type_apart;" ) ;
$result2 = mysql_query($recherche2);
while($row2 = mysql_fetch_array($result2)){
	echo'<tr>
    <td width="117"  id="user">'.$row2[1].'</td>
    <td width="73" id="user">'.$row2[2].' m²</td>
    <td width="79" id="user">'.$row2[3].'</td>
     <td width="79" id="user">'.$row2[4].'</td>
    
  </tr>';

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
