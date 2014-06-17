<?php require('./config/config.php');

protect();
if(($_SESSION['pseudo'])) {
	
$id=$_SESSION['idpseudo'];
$user=$_SESSION['pseudo'];

}

if(($_SESSION['utilisateur'])){

$id=$_SESSION['idsyndic'];
$user=$_SESSION['utilisateur'];	
	
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
		

    <?php 
	menublog();
	?>
    <div id="three-column" class="container">
<div class="post">
				<h2 class="title"> Espace Forum </h2>
				<div class="entry">
	

<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form id="form1" name="form1" method="post" action="create_topic.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3" bgcolor="#E6E6E6"><strong>Create New Topic</strong> </td>
</tr>
<tr>
<td width="14%"><strong>Topic</strong></td>
<td width="2%">:</td>
<td width="84%"><input name="topic" type="text" id="topic" size="50" /></td>
</tr>
<tr>
<td valign="top"><strong>Detail</strong></td>
<td valign="top">:</td>
<td><textarea name="detail" cols="50" rows="3" id="detail"></textarea></td>
</tr>
<tr>
<td><strong>Name</strong></td>
<td>:</td>
<td><select name="destinataire">
   <?php
   connect();
   $sql = 'SELECT pseudo as nom_destinataire, id_pseudo as id_destinataire FROM pseudo WHERE pseudo = "'.$user.'" ORDER BY pseudo ASC'; 
   $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());  
$nb = mysql_num_rows ($req);  
   // on alimente le menu déroulant avec les login des différents membres du site
   while ($data = mysql_fetch_array($req)) { 
      echo '<option value="'.$data['id_destinataire'].'">' , stripslashes(htmlentities(trim($data['nom_destinataire']))) , '</option>'; 
   } 
   ?>
   
   <?php $res=mysql_query("Select * from syndic where utilisateur='$user'");
   while($row2=mysql_fetch_assoc($res)){
	   
	   echo "<option value='".$row2["id_syndic"]."'>".$row2["utilisateur"]."</option>";
   }
   
   ?>
   </select></td>
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Submit" /> <input type="reset" name="Submit2" value="Reset" /></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
<?php

connect();
if($_POST['Submit']){
$topic=$_POST['topic'];
$detail=$_POST['detail'];
$name=$user;
$email=$_POST['email'];

$datetime=date("d/m/y h:i:s"); //create date time

$sql="INSERT INTO forum_question(topic, detail, name, email, datetime)VALUES('$topic', '$detail', '$name', '$email', '$datetime')";
$result=mysql_query($sql);

if($result){
redirect('main_forum.php');
die();
}
else {
echo "ERROR";
}
mysql_close();
}
?>
</div>
</div>
</div>
<?php piednoir(); ?>
</body>
</html>
