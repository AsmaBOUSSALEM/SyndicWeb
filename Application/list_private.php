<?php

include('./config/config.php');

?>
    <?php 
connect();
error_reporting(E_ALL ^ E_NOTICE);


$mois=$_POST['mois'];
$datefacture = $_POST['datefacture'];
$datelimite = $_POST['datelimite'];


$datefacture = fran_angl($datefacture);
$datelimite = fran_angl($datelimite);
$an = substr($datefacture, 0, 4);

$erm = array();


if(ctrl_date($datefacture, $datelimite))
{$erm[]=ctrl_date($datefacture, $datelimite);}


if(empty($erm)){

;
}
else{
	/* 
echo"<script>alert('Il y a une erreur dans les dates')</script>";
	redirect("autofacture.php");
	die();
	*/
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





<script type="text/javascript" src="jscal/onChangePro.js"></script>
        <style type="text/css">
        @import url(jscal/calendar-system.css);#user {
	color: #000000;
}
        #user {
	text-align: left;
}
        </style>
<script type="text/javascript" src="jscal/calendar.js"></script>
<script type="text/javascript" src="jscal/lang/calendar-fr.js"></script>
<script type="text/javascript" src="jscal/calendar-setup.js"></script>

</head>
<body>


<div id="wrapper">
	<div id="logo" class="container">
	  <h1>Syndic-web</h1>
		
	</div>
    
	<?php menufinance(); ?>
    <div id="three-column" class="container">
<div class="post">
<h2 class="title">Liste des Messages privE</h2>


                </div>
                </div>
                </div>
                
                
                <?php piednoir(); ?>
  

</body>
</html>
