<?php
if(defined('CONTROLLER') && defined('INVIT_JOUR'))
{
	$regions=$param['regions'];
	$centres=$param['centres'];
	$invitations=$param['invite'];
	if(isset($this->urlvalues['region']))$id_reg=(int)$this->urlvalues['region'];
	else $id_reg=0;	
	?>
	<h2>Les Invitations</h2>
	<input type="text" class="datepicker" data-value="<?php echo $param['date'];?>" id="date"/>
	<select id="region">
	<?php
		if(($_SESSION['range']==2 && $_SESSION['vision']=='NATIONALE') || $_SESSION['range']==1)
			echo '<option value="0">TOUS</option>';
		for ($i=0;$i<count($regions);$i++)
		{
			if ($id_reg==$regions[$i]['id_region']) $s='selected';
			else $s='';
			echo '<option value="'.$regions[$i]['id_region'].'" '.$s.'>'.$regions[$i]['nom_region'].'</option>';
		}
	?>
	</select>
	<select id="centre">
	<?php
		if(($_SESSION['range']==2 && $_SESSION['vision']!='CENTRE') || $_SESSION['range']==1)
			echo '<option value="0">TOUS</option>';
		for ($i=0;$i<count($centres);$i++)	
		{
			if ($id_cen==$centres[$i]['id_centre']) $s='selected';
			else $s='';
			echo '<option value="'.$centres[$i]['id_centre'].'" '.$s.'>'.$centres[$i]['nom_centre'].'</option>';
		}
	?>
	</select>
	
	<a href="#" class="btn btn-primary btn-small" id="filter-btn">Filtrer</a>
	<script>
	$('.datepicker').pickadate({
		format: 'yyyy-mm-dd',
		formatSubmit: 'yyyy-mm-dd'
	})
	</script>
	<script>
	$('#filter-btn').click(function()
		{
			var region=$('#region').val();
			var centre=$('#centre').val();
			var date=$('#date').val();
			date=date.split('-');
			var jour=date[2];
			var mois=date[1];
			var ans=date[0];
			//alert(region+centre+'jour='+jour+'mois='+mois+'ans='+ans);
			window.location="index.php?mode=invite&action=invit_jour&j="+jour+"&m="+mois+"&a="+ans+"&region="+region+"&centre="+centre;
			return false;
		}
	)
	$("#date").removeAttr("readonly");
	</script>	
	<h3>Nombre Totale d'invités : <div id="somme"> </div></h3>
	<?php
	$somme=0;
	echo '<table class="table">
				<tr>
				<th>Nom Employé</th>
				<th>Prenom Employé</th>
				<th>Centre Universitaire</th>
				<th>Nombre d\'invités</th>			
				</tr>';
		for ($i=0;$i<count($invitations);$i++)
		{
			if($invitations[0]!=NULL)
			{
				echo '<tr>';
				echo '<td>'.$invitations[$i]['nom'].'</td>';
				echo '<td>'.$invitations[$i]['prenom'].'</td>';		
				echo '<td>'.$invitations[$i]['centre'].'</td>';
				echo '<td>'.$invitations[$i]['nb_invite'].'</td>';
				echo '</tr>';
				$somme=$somme+$invitations[$i]['nb_invite'];
			}
		}
		if (count($invitations)==0 || $invitations[0]==NULL)
			{
				echo '<tr>';
				echo '<td class="warning" colspan="4">aucune invitation enregistrée</td>';
				echo '</tr>';
			}
		echo '</table><br/><br/><br/>';

}?>
<script>
$('#somme').replaceWith("<?php echo $somme;?>");
</script>