<?php require('./config/config.php');
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

		

    <?php  menufinance(); ?>



      <div id="page" class="container">
		<div id="content">
			<div class="post">
			  <h2 class="title">Liste des factures</h2>
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
        
        <a href="fac_impaye_pro.php">
		<h2>Liste des factures impayees</h2>
        
		<a href="fac_pro.php">
		<h2>Liste par Proprietaires</h2>
        
        <a href="fac_pro_moi.php">
		<h2>Liste par Periode</h2>
        
        <a href="fac_apartement.php">
		<h2>Liste par apartement</h2>
        
			<ul class="list-style2">
				<li class="first"> </li></ul></a>
                
      </div>
      </div>
      </div>
      </div>
      <?php piedblanc(); ?>
       
        
</body>
</html>

        


