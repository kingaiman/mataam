<h2>Installation</h2>
<?php
	if($param==1)
		echo '<div class="warning">impossible de se connecter � la base de donn�e</div>';
?>
<?php
		if($param==1 || $param==2)
	{?>
		<h4>Veuillez remplir les informations concernant les bases de donn�es</h4>
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">  		
			<span>H�te de la base de donn�es</span>
			<div>
				<input type="text" name="host" id="name" class="input-xlarge" value="localhost"/>
			</div>
			<span>Nom de la base de donn�es</span>
			<div>
				<input type="text" name="name" id="name" class="input-xlarge"/>
			</div>
			<span>Nom d'utilisateur de la base de donn�es</span>
			<div>
				<input type="text" name="user" id="name" class="input-xlarge"/>
			</div>
			<span>Mot de passe de la base de donn�es</span>
			<div>
				<input type="password" name="pass" id="name" class="input-xlarge"/>
			</div>				
			<input type="submit" class="btn btn-success" value="envoyer" name="send" />
	</form>
<?php }
	else if ($param==0) echo 
	'
	<p>l\'installation s\'est correctement d�roul�<br/>Les informations de l\'administrateur<br/>
	Nom d\'utilisateur de l\'admin : admin<br/>
	Mot de passe de l\'admin : admin
	</p>
	';
?>