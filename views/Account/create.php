<?php
if (defined('CONTROLLER'))
{
	?>
	<h2>Créer Administrateur</h2><?php
	$error_signup=$param['error'];
	if (count($error_signup)==0 && isset($_POST['create']))
		{
			?>
			Compte administrateur créée avec succes<br/>
			<a href="index.php?mode=account&action=create" class="btn btn-success">Revenir en arrière</a>
			<?php
		}
	else if(isset($error_signup) || !isset($_POST['signup'])) {		
		?>
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">  
		<?php if(isset($error_signup['empty_value'])) echo '<div class="warning">Veuillez remplir toutes les champs<br/></div>';?>
		<?php if(isset($error_signup['user_exist'])) echo '<div class="warning">Ce nom d\'utilisateur est dèja utilisé<br/></div>';?>
		<span>Nom d'utilisateur</span>
		<div>
			<input type="text" name="username" id="name" class="input-xlarge"/>
		</div>		
		<span>Mot de passe</span>
		<div>
			<input type="password" name="pass" id="pass" class="input-xlarge"/>
		</div>
		<?php if(isset($error_signup['pass_diff'])) echo '<div class="warning">Les deux mot de passes ne sont pas identiques<br/></div>';?>
		<span>Confirmer mot de passe</span>
		<div>
			<input type="password" name="pass2" id="pass2" class="input-xlarge"/>
		</div>
		<span>Nom</span>
		<div>
			<input type="text" name="nom" id="name" class="input-xlarge"/>
		</div>
		<span>Prenom</span>
		<div>
			<input type="text" name="prenom" id="name" class="input-xlarge"/>
		</div>
		<span>Date Naissance</span>
		<div>
			<input type="text" class="datepicker" id="date" name="naissance" data-value="1985-04-30"/>
		</div>
		<span>Vision</span>
		<div>
			<select name="vision" id="vision">
				<option value="CENTRE">CENTRE</option>			
				<option value="REGION">REGION</option>			
				<option value="NATIONALE">NATIONALE</option>			
			</select>
		</div>
		<span>Id vision</span>
		<div>
			<input type="number" name="id_vision" id="id_vision" class="input-xlarge"/>
		</div>
		<script>
		$('.datepicker').pickadate({
			format: 'yyyy-mm-dd',
			formatSubmit: 'yyyy-mm-dd'
		})
		$("#date").removeAttr("readonly");
		$('#vision').change(function(){
			if ($('#vision').val()=='NATIONALE')
			{
				$('#id_vision').attr("readonly", true);
				$('#id_vision').val(0);
			}
			else
			{
				$('#id_vision').removeAttr("readonly");
			}
			
		});		
		</script>
		
		<input type="submit" class="btn btn-success" value="créer" name="create" />
	</form>
		<?php } 
}
?>