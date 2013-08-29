<?php
if(defined('CONTROLLER') && defined('INVIT_EMPLOYE'))
{
	$dates=$param['date'];
	if($dates)
	{
		$date1=$param['date1'];
		$date2=$param['date2'];		
	}
	else
	{
		$date1='';
		$date2='';
	}
	?>
	<h2>Les Invitations</h2>
	<input type="text" class="datepicker" placeholder="date debut" id="date1"/>
	<input type="text" class="datepicker1"  placeholder="date fin" id="date2"/>	
	<a href="#" class="btn btn-primary btn-small" id="filter-btn">Filtrer</a>
	<script>
	$('.datepicker').pickadate({
		format: 'yyyy-mm-dd',
		formatSubmit: 'yyyy-mm-dd'
	})
	$('.datepicker1').pickadate({
		format: 'yyyy-mm-dd',
		formatSubmit: 'yyyy-mm-dd'
	})
	</script>
	<script>
	$('#filter-btn').click(function()
		{			
			var date1=$('#date1').val();
			var date2=$('#date2').val();
			date1=date1.split('-');
			date2=date2.split('-');
			var jour1=date1[2];
			var mois1=date1[1];
			var ans1=date1[0];
			var jour2=date2[2];
			var mois2=date2[1];
			var ans2=date2[0];
			window.location="index.php?mode=invite&action=invit_employe&j1="+jour1+"&m1="+mois1+"&a1="+ans1+"&j2="+jour2+"&m2="+mois2+"&a2="+ans2;
			return false;
		}
	)
	$("#date1").removeAttr("readonly");
	$("#date2").removeAttr("readonly");
	</script>	
	<?php if($dates){?>
	<h3>Nombre Totale d'invités : <div id="somme"> </div></h3>
	<?php
	$somme=0;
	$invitations=$param['invite'];
	echo '<table class="table">
				<tr>
				<th>Nom Invité</th>
				<th>Prenom Invité</th>
				<th>Date Invitation</th>
				<th>Date naissance Invité</th>
				</tr>';
		for ($i=0;$i<count($invitations);$i++)
		{
			if($invitations[0]!=NULL)
			{
				echo '<tr>';
				echo '<td>'.$invitations[$i]['nom'].'</td>';
				echo '<td>'.$invitations[$i]['prenom'].'</td>';		
				echo '<td>'.$invitations[$i]['date_debut'].'</td>';
				echo '<td>'.$invitations[$i]['date_fin'].'</td>';
				echo '</tr>';
			}
		}
		if (count($invitations)==0 || $invitations[0]==NULL)
		{
			echo '<tr>';
			echo '<td class="warning" colspan="4">aucune invitation enregistrée</td>';
			echo '</tr>';
			$somme=0;
		}
		else $somme=count($invitations);
		echo '</table><br/><br/><br/>';
	}
?>
<script>
$('#somme').replaceWith("<?php echo $somme;?>");
</script>
<?php
}?>