<h2>Contacter Administrateur</h2>
<?php
	if($param)
	echo '<p>Votre message a été envoyé à l\'Administrateur</p>';
	else {?>
	
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">  		
			<span>Nom</span>
			<div>
				<input type="text" name="nom" id="name" class="input-xlarge"/>
			</div>
			<span>Prenom</span>
			<div>
				<input type="text" name="prenom" id="name" class="input-xlarge"/>
			</div>
			<span>Message</span>
			<div>
				<textarea class="input-xlarge" id="textarea" rows="7" name="message"></textarea>
			</div>			
			<input type="submit" class="btn btn-success" value="envoyer" name="send" />
	</form>
	<?php }
?>