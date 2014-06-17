<?php
include('manage_aprt.php');
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

<?php

  connect();
    $recherche2 = ("SELECT * FROM resident ;" ) ;
    $result2 = mysql_query($recherche2);
	$res=mysql_query("Select * from syndic;");
	 ?>

<div id="wrapper">
	<div id="logo" class="container">
	  <h1>Syndic-web</h1>
		
	</div>
    
	<div id="menu-wrapper">
		<div id="menu" class="container">
			<ul>
				<li class="current_page_item"><a href="index.php">Homepage</a></li>
				<li><a href="parametre.php">Services</a></li>
				<li><a href="#">Blog</a></li>
				<li><a href="#">About Us</a></li>
				<li><a href="#">Links</a></li>
                <li><a href="testt.php">connectez-vous</a></li>
				<li><a href="#">Contact Us</a></li>
		  </ul>
		</div>
	</div>
    <div id="three-column" class="container">
<div class="post">
				
				<div class="entry">
	
<form action="modify_pro.php" method="post" dir="ltr" lang="fr">
            <table width="777" height="97" border="0" align="center" id="tableau">
             <tr>
 
                <td width="328" height="45"><strong>noms du proprietaire : </strong></td>
        <td> <select size="1" name="pro" >
        <option>choisissez</option>
       
    <?php
	//$row = mysql_fetch_array($result); 
while($row2 = mysql_fetch_array($result2)) {
   echo '<option>', $row2[1], '</option>';
   
}



?>
    </select></td>

              </tr>
              
                         </table>

          </form>
		
	
</div>
	
    
   

</body>
</html>
