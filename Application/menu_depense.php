<?php require("./config/config.php");
protect();
if(($_SESSION['pseudo']!=""))
	{
	/*echo"<script>alert(' Il y a des factures non regle veuillez les regle d'abord')</script>";*/
	redirect("finance.php");
	die("<script>alert(' Il y a des factures non regle veuillez les regle d'abord')</script>");	
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

		

    <?php  menufinance();?>



      <div id="page" class="container">
		<div id="content">
			<div class="post">
			  <h2 class="title">menu depense</h2>
			  <div class="entry"></div>
          </div>
        </div>
</div>
</div>
</div>
</div>
  
<div id="footer-bg">
	<div id="footer-content" class="container2">
		
                <div id="column1">
		<a href="add_societe.php">
			<h2> - Creation des societe</h2>
        
        
			<ul class="list-style2">
				<li class="first"> </li></ul></a> 
        </div>
        
        <div id="column1">
		<a href="facturesociete.php"><h2> - Facture  </h2>
        
        
			<ul class="list-style2">
				<li class="first"> </li></ul></a> 
        </div>
        
        <div id="column1">
		<a href="listefacture_societe.php"><h2> - Liste des factures et payements</h2>
        
        
			<ul class="list-style2">
				<li class="first"> </li></ul></a> 
        </div>
        
           <div id="column1">
		<a href="listsociete.php">
		<h2> - Liste des societes</h2>
        
        
			<ul class="list-style2">
				<li class="first"> </li></ul></a> 
        </div>
        
        

        </div>
        </div>
       <?php piedblanc(); ?>
</body>
</html>

        


