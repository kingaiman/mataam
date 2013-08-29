<?php
	if(defined('CONTROLLER') && defined('TRANS_BENEF'))
	{
		$transactions=$param['transactions'];?>
<h2 class="initialism">Votre Solde : <?php echo $param['solde'];?><abbr> DA</abbr></h2>
<h2>La liste de vos rechargements :</h2>
<a class="btn btn-success" href="index.php?mode=transaction&action=trans_benef&mois=01">Janvier</a>
<a class="btn btn-success" href="index.php?mode=transaction&action=trans_benef&mois=02">Février</a>
<a class="btn btn-success" href="index.php?mode=transaction&action=trans_benef&mois=03">Mars</a>
<a class="btn btn-success" href="index.php?mode=transaction&action=trans_benef&mois=04">Avril</a>
<a class="btn btn-success" href="index.php?mode=transaction&action=trans_benef&mois=05">Mai</a>
<a class="btn btn-success" href="index.php?mode=transaction&action=trans_benef&mois=06">Juin</a>
<a class="btn btn-success" href="index.php?mode=transaction&action=trans_benef&mois=07">Juillet</a>
<a class="btn btn-success" href="index.php?mode=transaction&action=trans_benef&mois=08">Aout</a>
<a class="btn btn-success" href="index.php?mode=transaction&action=trans_benef&mois=09">Septembre</a>
<a class="btn btn-success" href="index.php?mode=transaction&action=trans_benef&mois=10">Octobre</a>
<a class="btn btn-success" href="index.php?mode=transaction&action=trans_benef&mois=11">Novembre</a>
<a class="btn btn-success" href="index.php?mode=transaction&action=trans_benef&mois=12">Decembre</a><br/><br/>
<?php 	
	echo '<table class="table">
			<tr>
			<th class="th1">Date</th>
			<th class="th2">Centre Universitaire</th>
			<th class="th1">Montant (DA)</th>			
			</tr>';
	for ($i=0;$i<count($transactions);$i++)
	{
		if ($transactions[$i]!=NULL)
		{
			echo '<tr>';		
			echo '<td class="td1">'.$transactions[$i]['date'].'</td>';
			echo '<td class="td2">'.$transactions[$i]['centre'].'</td>';		
			echo '<td class="td1">'.$transactions[$i]['montant'].'</td>';
			echo '</tr>';
		}
	}
	if (count($transactions)==0 || $transactions[0]==NULL)
		{
			echo '<tr>';
			echo '<td class="warning" colspan="3">aucun rechargement effectuée ce mois</td>';
			echo '</tr>';
		}
	echo '</table>';
} ?>