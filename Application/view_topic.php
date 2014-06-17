<?php require('./config/config.php');
error_reporting(E_ALL ^ E_NOTICE);?>
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

protect();
if(($_SESSION['pseudo'])) {
	
$id1=$_SESSION['idpseudo'];
$user=$_SESSION['pseudo'];
}

if(($_SESSION['utilisateur'])){

$id1=$_SESSION['idsyndic'];
$user=$_SESSION['utilisatuer'];
	
	
}


connect();





$id=$_GET['id'];


$sql="SELECT * FROM forum_question WHERE id='$id'";
$result=mysql_query($sql);
$rows5=mysql_fetch_array($result);

?>

<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td><table width="113%" border="0" cellpadding="3" cellspacing="1" bordercolor="1" bgcolor="#FFFFFF">
<tr>
<td bgcolor="#F8F7F1"><strong><?php echo $rows5['topic']; ?></strong></td>
</tr>

<tr>
<td bgcolor="#F8F7F1"><?php echo $rows5['detail']; ?></td>
</tr>

<tr>
<td bgcolor="#F8F7F1"><strong>Par :</strong> <?php echo $rows5['name']; ?> </td>
</tr>

<tr>
<td bgcolor="#F8F7F1"><strong>Date publication : </strong><?php echo $rows5['datetime']; ?></td>
</tr>
</table></td>
</tr>
</table>
<BR>

<?php


$sql2="SELECT * FROM forum_answer WHERE question_id='$id'";
$result2=mysql_query($sql2);
while($rows8=mysql_fetch_array($result2)){
?>

<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td><table width="106%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">

<tr>
<td width="18%" bgcolor="#F8F7F1"><strong>Nom</strong></td>
<td width="5%" bgcolor="#F8F7F1">:</td>
<td width="77%" bgcolor="#F8F7F1"><?php echo $rows8['a_name']; ?></td>
</tr>

<tr>
<td bgcolor="#F8F7F1"><strong>Réponse</strong></td>
<td bgcolor="#F8F7F1">:</td>
<td bgcolor="#F8F7F1"><?php echo $rows8['a_answer']; ?></td>
</tr>
<tr>
<td bgcolor="#F8F7F1"><strong>Date réponse</strong></td>
<td bgcolor="#F8F7F1">:</td>
<td bgcolor="#F8F7F1"><?php echo $rows8['a_datetime']; ?></td>
</tr>
</table></td>
</tr>
</table><br>
 
<?php
}
$id=$_GET['id'];
$sql3="SELECT * FROM forum_question WHERE id='$id'";
$result3=mysql_query($sql3);
$rows=mysql_fetch_array($result3);
$view=$rows5['view'];
 
// if have no counter value set counter = 1
if(empty($view)){
$view=1;
$sql4="INSERT INTO forum_question(view) VALUES('$view') WHERE id='$id'";
$result4=mysql_query($sql4);
}
 
// count more value
$addview=$view+1;
$sql5="update forum_question set view='$addview' WHERE id='$id'";
$result5=mysql_query($sql5);
mysql_close();
?>

<BR>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="view_topic.php?id=<?php echo $rows5['id']; ?>">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">


<tr>
<td valign="top"><strong>Reponse</strong></td>
<td valign="top">:</td>
<td><textarea name="a_answer" cols="45" rows="3" id="a_answer"></textarea></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input name="id" type="hidden" value="<? echo $id; ?>"></td>
<td><input type="submit" name="Submit" value="valider"> <input type="reset" name="Submit2" value="Initialiser"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>

<?php

if($_POST['Submit']){
connect();
// Get value of id that sent from hidden field 
$id=$_POST['id'];

// Find highest answer number. 
$sql="SELECT MAX(a_id) AS Maxa_id FROM forum_answer WHERE question_id='$id'";
$result=mysql_query($sql);
$rows=mysql_fetch_array($result);

// add + 1 to highest answer number and keep it in variable name "$Max_id". if there no answer yet set it = 1 
if ($rows) {
$Max_id = $rows['Maxa_id']+1;
}
else {
$Max_id = 1;
}



// get values that sent from form 
$a_name=$rows5['topic'];
$a_email=$user;
$a_email=$user;
$a_answer=$_POST['a_answer']; 

$datetime=date("d/m/y H:i:s"); // create date and time
$id=$rows5['id'];
// Insert answer 
$sql2="INSERT INTO forum_answer(question_id, a_id, a_name, a_email, a_answer, a_datetime)VALUES('$id', '$Max_id', '$a_name', '$a_email', '$a_answer', '$datetime')";
$result2=mysql_query($sql2);

if($result2){

redirect("view_topic.php?id=".$rows5['id']."");
die();



$tbl_name2="forum_question";
$sql3="UPDATE $tbl_name2 SET reply='$Max_id' WHERE id=".$rows5['id'];
$result3=mysql_query($sql3);
}
else {
echo "ERROR";
}

// Close connection
mysql_close();}
?>
</div>
</div>
</div>
</div>
<?php piednoir(); ?>
</body>
</html>



