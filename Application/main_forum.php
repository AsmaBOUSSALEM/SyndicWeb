<?php
error_reporting(E_ALL ^ E_NOTICE);
?>
<?php require('./config/config.php');
protect();
if(($_SESSION['pseudo'])) {
	
$id=$_SESSION['idpseudo'];
$user=$_SESSION['pseudo'];
}

if(($_SESSION['utilisateur'])){

$id=$_SESSION['idsyndic'];
$user=$_SESSION['utilisatuer'];
	
	
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
	
<?php
connect();
$tbl_name="forum_question"; // Table name 
$sql="SELECT * FROM forum_question ORDER BY id DESC";
// OREDER BY id DESC is order result by descending

$result=mysql_query($sql);
?>

<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td width="6%" align="center" bgcolor="#E6E6E6"><strong>#</strong></td>
<td width="53%" align="center" bgcolor="#E6E6E6"><strong>Sujet</strong></td>
<td width="15%" align="center" bgcolor="#E6E6E6"><strong>Vues</strong></td>

<td width="13%" align="center" bgcolor="#E6E6E6"><strong>Date de publication</strong></td>
</tr>

<?php
 
// Start looping table row
while($rows=mysql_fetch_array($result)){
?>
<tr>
<td bgcolor="#FFFFFF"><?php echo $rows['id']; ?></td>
<td bgcolor="#FFFFFF"><a href="view_topic.php?id=<?php echo $rows['id']; ?>"><?php echo $rows['topic']; ?></a><BR></td>
<td align="center" bgcolor="#FFFFFF"><?php echo $rows['view']; ?></td>

<td align="center" bgcolor="#FFFFFF"><?php echo $rows['datetime']; ?></td>
</tr>

<?php
// Exit looping and close connection 
}

?>

<?php

error_reporting(E_ALL ^ E_NOTICE);


$topic=$_POST['topic'];
$detail=$_POST['detail'];
$name=$_POST['name'];
$email=$_POST['email'];

$datetime=date("d/m/y h:i:s"); //create date time

?>


<tr>
<td colspan="5" align="right" bgcolor="#E6E6E6"><a href="create_topic.php"><strong>Nouveau sujet</strong> </a></td>
</tr>
</table>
<p><?php if(($_SESSION['utilisateur'])){
$msg="<a href='listeutilisateur.php'>Gestion des utilisateurs</a>";
echo "<center><h3>".$msg." </h3></center>"; 

}?></p>
    </div>
</div>
</div>

<?php piednoir(); ?>
</body>
</html>