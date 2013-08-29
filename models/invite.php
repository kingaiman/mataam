<?php
class InviteModel extends BaseModel {

	public function getInviteByRegionID($date,$id_region) {
		$query='SELECT beneficiaire.nom_bene AS nom, beneficiaire.prenom_bene AS prenom , centre.nom_centre AS centre, count(invite.id_invite) AS nb_invite
		FROM centre
		NATURAL JOIN beneficiaire
		NATURAL JOIN invite
		WHERE centre.id_region=:region AND date_invitation=:date
		GROUP BY beneficiaire.empreinte
		';
		$cond=array('region'=>$id_region, 'date'=>$date);
		return $this->prep_query($query,$cond);
	}
	
	public function getInviteByCentreID($date,$id_centre) {
		$query='SELECT beneficiaire.nom_bene AS nom, beneficiaire.prenom_bene AS prenom , centre.nom_centre AS centre, count(invite.id_invite) AS nb_invite
		FROM centre
		NATURAL JOIN beneficiaire
		NATURAL JOIN invite
		WHERE centre.id_centre=:centre AND date_invitation=:date
		GROUP BY beneficiaire.empreinte
		';
		$cond=array('centre'=>$id_centre, 'date'=>$date);
		return $this->prep_query($query,$cond);
	}
	
	public function getInviteByCentreIDInRegion($date,$id_centre,$id_region) {
	
		$query='SELECT beneficiaire.nom_bene AS nom, beneficiaire.prenom_bene AS prenom , centre.nom_centre AS centre, count(invite.id_invite) AS nb_invite
		FROM centre
		NATURAL JOIN beneficiaire
		NATURAL JOIN invite
		WHERE centre.id_centre=:centre AND date_invitation=:date AND centre.id_region=:region
		GROUP BY beneficiaire.empreinte
		';
		$cond=array('centre'=>$id_centre, 'region'=>$id_region, 'date'=>$date);
		return $this->prep_query($query,$cond);
	}
	
	public function getInviteByDate($date) {
	
		$query='SELECT beneficiaire.nom_bene AS nom, beneficiaire.prenom_bene AS prenom, centre.nom_centre AS centre, count(invite.id_invite) AS nb_invite
		FROM centre
		NATURAL JOIN beneficiaire
		NATURAL JOIN invite
		NATURAL JOIN region
		WHERE date_invitation=:date
		GROUP BY beneficiaire.empreinte
		';
		$cond=array('date'=>$date);
		return $this->prep_query($query,$cond);
	}
	
	public function getInviteForEmploye($username,$date1,$date2) {
	
		$query='SELECT invite.nom_invite AS nom, invite.prenom_invite AS prenom, invite.date_invitation AS date_debut, invite.date_n_invite AS date_fin
		FROM invite
		NATURAL JOIN beneficiaire
		WHERE invite.date_invitation>=:date1 AND invite.date_invitation<=:date2 AND beneficiaire.nom_utilisateur=:user
		';
		$cond=array('user'=>$username,'date1'=>$date1,'date2'=>$date2);
		return $this->prep_query($query,$cond);
	}
	
	public function getRegions() {
		$query='SELECT nom_region, id_region FROM region';
		return $this->prep_query($query);
	}
}
?>