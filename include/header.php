<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title>Mataam</title>
	<!--<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed|Open+Sans:400,300,700|Yesteryear" rel="stylesheet" type="text/css" />-->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="css/metro-bootstrap.css" rel="stylesheet" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/pick/default.css" id="theme_base">
	<link rel="stylesheet" href="css/pick/default.date.css" id="theme_date">
	<link rel="stylesheet" href="css/pick/default.time.css" id="theme_time">
	<script src="js/jquery.js"></script>
	<script src="js/picker.js" charset="utf-8"></script>
    <script src="js/picker.date.js" charset="utf-8"></script>
    <script src="js/legacy.js" charset="utf-8"></script>
    <script src="js/bootstrap-dropdown.js" charset="utf-8"></script>
</head>
<body>
<div id="menu-wrapper">
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="index.php">Acceuil</a></li>
			<?php 
				if(!isset($_SESSION['logged']) || $_SESSION['logged']==false)
					echo '<li><a href="index.php?mode=account&action=login">Connexion</a></li>';
				else 
				{					
					if(isset($_SESSION['range']) && $_SESSION['range']==3)							
					{
						echo '<li><a href="index.php?mode=transaction&action=trans_benef&mois='.date("m").'">Rechargements</a></li>';
						echo '<li><a href="index.php?mode=repas&action=repas_benef&mois='.date("m").'">Repas</a></li>';
						if($_SESSION['type']=='employe')
							echo '<li><a href="index.php?mode=invite&action=invit_employe">Invités</a></li>';
					}
					else if(isset($_SESSION['range']) && ($_SESSION['range']==2 || $_SESSION['range']==1))
						echo '<li><a href="index.php?mode=transaction&action=trans_jour">Rechargements</a></li>
						<li><a href="index.php?mode=beneficiaire&action=liste">Bénéficiaires</a></li>
						<li><a href="index.php?mode=invite&action=invit_jour">Invités</a></li>';
					if(isset($_SESSION['range']) && $_SESSION['range']==1)
						echo '<li><a href="index.php?mode=account&action=create">Créer</a></li>';
					echo '<li><a href="index.php?mode=account&action=logout">Déconnexion</a></li>';
				}
			?>			
			<li class="last"><a href="index.php?mode=home&action=contact">Contact</a></li>
		</ul>
	</div>
	<!-- end #menu -->
</div>
<div id="header-wrapper">
	<div id="header">
		<div id="logo">
			<h1><img src="img/logo.jpg"/></h1>
		</div>
	</div>
</div>
<div id="wrapper">
	<!-- end #header -->
	<div id="page">
		