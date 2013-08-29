<?php
class RepasModel extends BaseModel {

	public function getRepasFromUsername($user,$mois) {		
		$query='SELECT paiement.date_paie AS date, centre.nom_centre AS centre, paiement.montant_paie AS montant
		FROM paiement
		INNER JOIN beneficiaire on beneficiaire.empreinte=paiement.empreinte
		INNER JOIN centre on centre.id_centre=paiement.id_centre
		WHERE beneficiaire.nom_utilisateur=:user AND MONTH(paiement.date_paie)=:mois
		';
		$cond=array('user'=>$user, 'mois'=>(int)$mois);
		return $this->prep_query($query,$cond);
	}
}
?>