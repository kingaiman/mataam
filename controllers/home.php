<?php
class Home extends BaseController {
	protected function Index() {
		$this->ReturnView(NULL);
	}
	
	protected function contact() {
		if(isset($_POST['send']))
		$this->ReturnView(true);
		else $this->ReturnView(false);
	}
	
	protected function install() {
		if(filesize('include/settings.php')==0)
		{			
			$error=0;
			if(isset($_POST['send']))
			{		
				try
				{
					$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;		
					$bd = new PDO('mysql:host='.$_POST['host'].';dbname='.$_POST['name'], $_POST['user'], $_POST['pass'], $pdo_options);
				}
				catch(Exception $e)
				{
					$error=1;
				}
				if($error==0)
				{
					$query="";
					$file=fopen("include/settings.php",'a+');
					$content='<?php $db_host="'.$_POST['host'].'";';
					$content.="\r\n";
					$content.='$db_name="'.$_POST['name'].'";';
					$content.="\r\n";
					$content.='$db_username="'.$_POST['user'].'";';
					$content.="\r\n";
					$content.='$db_password="'.$_POST['pass'].'";';				
					$content.="\r\n?>";
					fputs($file,$content);	
					fclose($file);
					$file=fopen("sql/mataam.sql",'r');
					while($line=fgets($file))				
					$query.=$line;
					$req = $bd->query($query);
					fclose($file);
					if (file_exists("sql/mataam.sql")) unlink("sql/mataam.sql");
					$this->ReturnView(0);
				}	
				else $this->ReturnView(1);
			}			
			else $this->ReturnView(2);
		}
		else header('Location: index.php' );
	}
}
?>