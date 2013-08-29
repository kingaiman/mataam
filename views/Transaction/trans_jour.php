<?php
if(defined('CONTROLLER') && defined('TRANS_JOUR'))
{
$centres=$param['centres'];
$regions=$param['regions'];
$transactions=$param['transactions'];
if(isset($this->urlvalues['region']))$id_reg=(int)$this->urlvalues['region'];
else $id_reg=0;
if(isset($this->urlvalues['centre']))$id_cen=(int)$this->urlvalues['centre'];
else $id_cen=0;
?>
<h2>Les Rechargements</h2>
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
		window.location="index.php?mode=transaction&action=trans_jour&j="+jour+"&m="+mois+"&a="+ans+"&centre="+centre+"&region="+region;
		return false;
	}
)
$("#date").removeAttr("readonly");
</script>
<h3>Nombre Totale des Rechargements : <?php if($transactions[0]!=NULL) echo count($transactions); else echo '0';?></h3>
<h3>Montant Totale des Rechargements : <div id="somme"> </div> DA</h3>
<?php
$montant=0;
echo '<table class="table">
			<tr>
			<th>Nom bénéficiaire</th>
			<th>Prenom bénéficiaire</th>
			<th>Centre Universitaire</th>
			<th>Montant (DA)</th>			
			</tr>';
	for ($i=0;$i<count($transactions);$i++)
	{
		if($transactions[0]!=NULL)
		{
			echo '<tr>';
			echo '<td>'.$transactions[$i]['nom'].'</td>';
			echo '<td>'.$transactions[$i]['prenom'].'</td>';		
			echo '<td>'.$transactions[$i]['centre'].'</td>';
			echo '<td>'.$transactions[$i]['montant'].'</td>';
			echo '</tr>';
			$montant=$montant+$transactions[$i]['montant'];
		}
	}
	if (count($transactions)==0 || $transactions[0]==NULL)
		{
			echo '<tr>';
			echo '<td class="warning" colspan="4">aucun rechargement effectuée</td>';
			echo '</tr>';
		}
	echo '</table><br/><br/><br/>';

}?>
<script>
$('#somme').replaceWith("<?php echo $montant;?>");
</script>