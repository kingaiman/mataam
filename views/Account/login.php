<?php 
if(defined('CONTROLLER'))
{
	$error_login=$param;
	if (!isset($error_login['conneted'])) { ?>
	<div id="login_form">
		<form id="connexion" method="post" action="<?php echo $_SERVER['REQUEST_URI']?>">
					<h2>Connexion</h2>
					<?php if (isset($error_login['empty'])) echo '<div class="warning">Veuillez remplir toutes les champs<br/></div>';?>
					<?php if (isset($error_login['pass_NA'])) echo '<div class="warning">Nom d\'utilisateur inexistant<br/></div>';?>
				   <span>Nom d'Utilisateur :</span>
				   <div>
					 <input name="username" class="input-xlarge" type="text">
				   </div>
				   <?php if (isset($error_login['pass_false'])) echo '<div class="warning">Mot de passe incorrect<br/></div>';?>
				   <span>Mot de Passe :</span>
				   <div>
					<input name="password" class="input-xlarge" type="password">
				   </div></br>
				   <label class="checkbox">
					<input type="checkbox" name="auto-connect" checked="checked"/> connexion automatique
				  </label>
				   <input class="btn btn-success" type="submit" value="connexion" name="login"/>
		</form>
	</div>
	<?php } else {?>
	<p class="warning" style="margin-left:300px;margin-top:100px;">you are already connected</p><meta http-equiv="refresh" content="4;URL=index.php">;
<?php } }?>