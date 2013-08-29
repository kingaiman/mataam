<?php
class Account extends BaseController {

	protected function login() {
	define('CONTROLLER',true);
	if(!isset($_SESSION['logged']) || $_SESSION['logged']==false)
	{
		if (!isset($_POST['login']))
		{
			$this->ReturnView(NULL);
		}
		else
		{
			$error_login=array();
			if($_POST['username']!="" && $_POST['password']!="")
			{
				$model=new AccountModel();
				$user=$model->getFromUserName($_POST['username']);
				if ($user==0) $error_login['pass_NA']=true;
				else
				{
					if($user[0]['mdp']==sha1($_POST['password']))
					{
						if (isset($_POST['auto-connect'])) 
						 {
						   $navigator = (!empty($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : '';
						   $hash_cookie = sha1('$*$'.$_POST['username'].'Pl0'.$user[0]['mdp'].'89/*'.$navigator);
						   setcookie('imaibou_nb', $user[0]['nom_utilisateur'], time() + 365*24*3600, null, null, false, true); 
						   setcookie('imaibou_ha', $hash_cookie, time() + 365*24*3600, null, null, false, true);
						 }
						$_SESSION['logged']=true;
						$_SESSION['username']=$_POST['username'];
						if ($user[0]['nature']=='beneficiaire')
							{
								$_SESSION['range']=3;
								$type=$model->getType($_POST['username']);
								if($type==0)$_SESSION['type']='etudiant';
								else $_SESSION['type']='employe';									
							}
						else if ($user[0]['nature']=='administrateur')						
						{
							$_SESSION['range']=2;
							$vision=$model->getVision($_POST['username']);
							$_SESSION['vision']=$vision[0]['vision'];
							$_SESSION['id_vision']=$vision[0]['id_vision'];
						}
						else if ($user[0]['nature']=='web master')
							$_SESSION['range']=1;
						header('Location: index.php');
					}
					else $error_login['pass_false']=true;
				}
			}
			else $error_login['empty']=true;
			$this->ReturnView($error_login);
		}
	}
	else header('Location: index.php?mode=account&action=logout' );
   }
   
   protected function logout() {
	if(isset($_SESSION['logged']) && $_SESSION['logged']==true)
	{
		$_SESSION=array();
		session_destroy();
		setcookie('imaibou_nb', ''); 
		setcookie('imaibou_ha', '');
		header('Location: index.php'); 
	}
   }
   
   protected function create() {
	
	if(isset($_SESSION['logged']) && $_SESSION['logged']==true && isset($_SESSION['range']) && $_SESSION['range']==1)
	{	
		define('CONTROLLER',true);
		$error_signup=array();
		if (isset($_POST['create']))
		{				
			$pass = sha1($_POST['pass']);
			$pass2 = sha1($_POST['pass2']);
			$model=new AccountModel();
			$pseudo_verif=$model->getFromUserName($_POST['username']);
			$full=(!empty ($_POST['username']) && !empty ($_POST['nom']) && !empty ($_POST['prenom']) && !empty ($pass) 
			&& !empty ($pass2) && !empty ($_POST['vision']) && !empty ($_POST['naissance']) && ((int)$_POST['id_vision']>0 || ($_POST['id_vision']==0 && $_POST['vision']=='NATIONALE')));
			if ($full) 
			{
				if(strcmp($pass, $pass2) == 0) 
				{					
					if ($pseudo_verif == 0)
					{ 									
							$model->insertUser($pass,$_POST['nom'],$_POST['prenom'],$_POST['naissance'],$_POST['vision'],$_POST['id_vision'],$_POST['username']);																			
					}
					else $error_signup['user_exist']=true;											
				
				} else $error_signup['pass_diff']=true;
			
			} else $error_signup['empty_value']=true;		   			
		}
		$this->ReturnView(array('error' => $error_signup));
	}
	else header('Location: index.php?mode=account&action=login' );
   }
}
?>