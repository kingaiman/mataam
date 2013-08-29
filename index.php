<?php
session_start();
require("classes/loader.php");
require("classes/basecontroller.php");
require("classes/basemodel.php");
if(!isset($_GET['mode']))$mode="home";
else $mode=$_GET['mode'];

if(filesize('include/settings.php')==0 && $_GET['action']!='install')
	header('Location: index.php?mode=home&action=install' );

switch($mode)
{
	case 'home':
		require("models/home.php");
		require("controllers/home.php");
		break;
	case 'account':
		require("models/account.php");
		require("controllers/account.php");
		break;
	case 'transaction':
		require("models/transaction.php");
		require("controllers/transaction.php");
		break;
	case 'repas':
		require("models/repas.php");
		require("controllers/repas.php");
		break;
	case 'invite':
		require("models/invite.php");
		require("controllers/invite.php");
		break;
	case 'beneficiaire':
		require("models/beneficiaire.php");
		require("controllers/beneficiaire.php");
		break;
	
}

$loader = new Loader($_GET);
$controller = $loader->CreateController();
$controller->ExecuteAction();
?>
