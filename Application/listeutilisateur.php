<?php

require('./config/config.php');
protect();
protectsyndic();
?>
    <?php 


            
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

       
<style type="text/css">
#user tr #iduser {
	text-align: center;
}
#user {
	color: #000000;
}
#user {
	text-align: center;
}
</style>
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

		

    <?php  menuconnect(); ?>
    <div id="three-column" class="container">
<div class="post">
				<h2 class="title">Liste des utilisateurs</h2>
				<table width="812" border="2" align="center" id="user">
  <tr>
    <td width="88" id="user">Utilisateur     </td>
    <td width="68" id="user">Nom             </td>
    <td width="81" id="user">Prenom          </td>
     <td width="71" id="user">email          </td>
    <td width="70" id="user">Sexe             </td>
    <td width="95" id="user">Nom Apartement   </td>
    <td width="134" id="user">Date Inscription </td>
    <td width="71" id="user">Activer          </td>
    <td width="63" id="user">Supprimer          </td>
  </tr>
 

  <?php 
 
  $conteur=0;
connect();
$res = mysql_query("SELECT * FROM pseudo ;");
while($row = mysql_fetch_assoc($res)){
	$id=$row['id_pseudo'];
	if ($row["active"]==1){$active = '<a href="desactive.php?id='.$id.'"><input type="submit" value="Désactiver"/></a>';}
	else
	{$active='<a href="active.php?id='.$id.'"><input type="submit" value="Activer"/></a>';}
	
	if ($row["sexe"]=="M"){$sexe="Masculin";}
	else {$sexe="Féminin";}
	
	$help=$row["id_apartement"];
	$recherche1 = ("SELECT nom FROM apartement WHERE id_apartement='$help';" ) ;
$result1 = mysql_query($recherche1);
$row1 = mysql_fetch_array($result1);
$apart=$row1[0];

$del='<a href="delpseudo.php?id='.$id.'"><input type="submit" value="Supprimer"/></a>';
	
echo " <tr>
     <td>".$row["pseudo"]."     </td>
     <td>".$row["nom"]."            </td>
     <td>".$row["prenom"]."          </td>
     <td>".$row["email"]."            </td>
     <td>".$sexe."   </td>
	 <td>".$apart."   </td>
     <td>".$row["dateins"]." </td>
     <td>".$active."           </td>
	  <td>".$del."           </td>
   </tr>";
}
?>
</table>
</div>
</div>
</div>
<?php  piednoir();  ?> 

</body>
</html>
