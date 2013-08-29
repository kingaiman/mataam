<?php
if(defined('CONTROLLER') && defined('LISTE'))
{
$centres=$param['centres'];
$regions=$param['regions'];
$liste=$param['liste'];
if(isset($this->urlvalues['region']))$id_reg=(int)$this->urlvalues['region'];
else $id_reg=0;
if(isset($this->urlvalues['centre']))$id_cen=(int)$this->urlvalues['centre'];
else $id_cen=0;
?>
<h2>La Liste des Bénéficiaires</h2>
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
<select id="cat">
	<option value="0">employé</option>
	<option value="1" <?php if($param['cat']==1) echo 'selected';?>>étudiant</option>
</select>
<a href="#" class="btn btn-primary btn-small" id="filter-btn">Filtrer</a>
<script>
$('#filter-btn').click(function()
	{
		var region=$('#region').val();
		var centre=$('#centre').val();		
		var cat=$('#cat').val();		
		window.location="index.php?mode=beneficiaire&action=liste&centre="+centre+"&region="+region+"&cat="+cat;
		return false;
	}
)
</script>
<h3>Nombre Totale des bénéficiaires : <?php if($liste[0]!=NULL) echo count($liste); else echo '0';?></h3>
<?php
$montant=0;
echo '<table class="table">
			<tr>
			<th>Nom bénéficiaire</th>
			<th>Prenom bénéficiaire</th>
			<th>Centre Universitaire</th>
			</tr>';
	for ($i=0;$i<count($liste);$i++)
	{
		if($liste[0]!=NULL)
		{
			echo '<tr>';
			echo '<td>'.$liste[$i]['nom'].'</td>';
			echo '<td>'.$liste[$i]['prenom'].'</td>';		
			echo '<td>'.$liste[$i]['centre'].'</td>';
			echo '</tr>';
		}
	}
	if (count($liste)==0 || $liste[0]==NULL)
		{
			echo '<tr>';
			echo '<td class="warning" colspan="3">aucun bénéficiaire inscrit</td>';
			echo '</tr>';
		}
	echo '</table><br/><br/><br/>';

}?>