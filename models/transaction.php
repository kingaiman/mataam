<?php
class TransactionModel extends BaseModel {
	public function getTransactionsFromUsername($user,$mois) {		
		$query='SELECT rechargement.date_rech AS date, centre.nom_centre AS centre, rechargement.montant_rech AS montant
		FROM rechargement
		INNER JOIN beneficiaire on beneficiaire.empreinte=rechargement.empreinte
		INNER JOIN centre on centre.id_centre=rechargement.id_centre
		WHERE beneficiaire.nom_utilisateur=:user AND MONTH(rechargement.date_rech)=:mois
		';
		$cond=array('user'=>$user, 'mois'=>(int)$mois);
		return $this->prep_query($query,$cond);
	}
	
	public function getSoldeFromUsername($user) {
		$query='SELECT credit FROM beneficiaire WHERE nom_utilisateur=:user';
		$cond=array('user'=>$user);
		$tmp=$this->prep_query($query,$cond);
		return $tmp[0]['credit'];
	}	
	
	public function getTransactionByRegionID($date,$id_region) {
		$query='SELECT centre.nom_centre AS centre, rechargement.montant_rech AS montant,
		beneficiaire.nom_bene AS nom, beneficiaire.prenom_bene AS prenom
		FROM rechargement
		INNER JOIN beneficiaire on beneficiaire.empreinte=rechargement.empreinte 
		INNER JOIN centre on centre.id_centre=rechargement.id_centre
		WHERE rechargement.date_rech=:date AND centre.id_region=:region';
		$cond=array('date'=>$date,'region'=>$id_region);		
		return $this->prep_query($query,$cond);
	}
	
	public function getTransactionByCentreID($date,$id_centre) {
		$query='SELECT centre.nom_centre AS centre, rechargement.montant_rech AS montant,
		beneficiaire.nom_bene AS nom, beneficiaire.prenom_bene AS prenom
		FROM rechargement
		INNER JOIN beneficiaire on beneficiaire.empreinte=rechargement.empreinte 
		INNER JOIN centre on centre.id_centre=rechargement.id_centre
		WHERE rechargement.date_rech=:date AND centre.id_centre=:centre';
		$cond=array('date'=>$date,'centre'=>$id_centre);		
		return $this->prep_query($query,$cond);
	}
	
	public function getTransactionByCentreIDInRegion($date,$id_centre,$id_region) {
		$query='SELECT centre.nom_centre AS centre, rechargement.montant_rech AS montant,
		beneficiaire.nom_bene AS nom, beneficiaire.prenom_bene AS prenom
		FROM rechargement
		INNER JOIN beneficiaire on beneficiaire.empreinte=rechargement.empreinte 
		INNER JOIN centre on centre.id_centre=rechargement.id_centre
		WHERE rechargement.date_rech=:date AND centre.id_centre=:centre AND centre.id_region=:region';
		$cond=array('date'=>$date,'centre'=>$id_centre,'region'=>$id_region);		
		return $this->prep_query($query,$cond);
	}	
	
	public function getTransactionByDate($date) {
		$query='
		SELECT centre.nom_centre AS centre, rechargement.montant_rech AS montant,
		beneficiaire.nom_bene AS nom, beneficiaire.prenom_bene AS prenom
		FROM rechargement
		INNER JOIN beneficiaire on beneficiaire.empreinte=rechargement.empreinte 
		INNER JOIN centre on centre.id_centre=rechargement.id_centre
		WHERE rechargement.date_rech=:date';
		$cond=array('date'=>$date);		
		return $this->prep_query($query,$cond);
	}	
	
	public function getTransactionByDateInRegion($date,$id_region) {
		$query='
		SELECT centre.nom_centre AS centre, rechargement.montant_rech AS montant,
		beneficiaire.nom_bene AS nom, beneficiaire.prenom_bene AS prenom
		FROM rechargement
		INNER JOIN beneficiaire on beneficiaire.empreinte=rechargement.empreinte 
		INNER JOIN centre on centre.id_centre=rechargement.id_centre
		WHERE rechargement.date_rech=:date AND centre.id_region=:region';
		$cond=array('date'=>$date,'region'=>$id_region);		
		return $this->prep_query($query,$cond);
	}	
	
	public function getTransactionByDateInCentre($date,$id_centre) {
		$query='
		SELECT centre.nom_centre AS centre, rechargement.montant_rech AS montant,
		beneficiaire.nom_bene AS nom, beneficiaire.prenom_bene AS prenom
		FROM rechargement
		INNER JOIN beneficiaire on beneficiaire.empreinte=rechargement.empreinte 
		INNER JOIN centre on centre.id_centre=rechargement.id_centre
		WHERE rechargement.date_rech=:date AND centre.id_centre=:centre';
		$cond=array('date'=>$date,'centre'=>$id_centre);		
		return $this->prep_query($query,$cond);
	}	
	
}
?>