<?php
class BeneficiaireModel extends BaseModel {
	
	public function getListeByRegionID($id_region,$cat) {
		if($cat==0)$add=' NATURAL JOIN employe ';
		else $add=' NATURAL JOIN etudiant ';
		
		$query='SELECT beneficiaire.nom_bene AS nom, beneficiaire.prenom_bene AS prenom	,centre.nom_centre 	AS centre
		FROM beneficiaire
		NATURAL JOIN centre
		'.$add.'
		WHERE centre.id_region=:region';
		$cond=array('region'=>$id_region);		
		return $this->prep_query($query,$cond);
	}
	
	public function getListe($cat) {
		if($cat==0)$add=' NATURAL JOIN employe ';
		else $add=' NATURAL JOIN etudiant ';
		
		$query='SELECT beneficiaire.nom_bene AS nom, beneficiaire.prenom_bene AS prenom	,centre.nom_centre AS centre
		FROM beneficiaire
		NATURAL JOIN centre
		'.$add.'
		';		
		return $this->prep_query($query);
	}
	
	public function getListeByCentreID($id_centre,$cat) {
		if($cat==0)$add=' NATURAL JOIN employe ';
		else $add=' NATURAL JOIN etudiant ';
		
		$query='SELECT beneficiaire.nom_bene AS nom, beneficiaire.prenom_bene AS prenom	,centre.nom_centre AS centre	
		FROM beneficiaire
		NATURAL JOIN centre
		'.$add.'
		WHERE centre.id_centre=:centre';
		$cond=array('centre'=>$id_centre);		
		return $this->prep_query($query,$cond);
	}
	
	public function getListeByCentreIDInRegion($id_centre,$id_region,$cat) {
		if($cat==0)$add=' NATURAL JOIN employe ';
		else $add=' NATURAL JOIN etudiant ';
		
		$query='SELECT beneficiaire.nom_bene AS nom, beneficiaire.prenom_bene AS prenom	,centre.nom_centre AS centre	
		FROM beneficiaire
		NATURAL JOIN centre
		'.$add.'
		WHERE centre.id_centre=:centre AND centre.id_region=:region';
		$cond=array('centre'=>$id_centre,'region'=>$id_region);		
		return $this->prep_query($query,$cond);
	}			
	
	public function getListeInRegion($id_region ,$cat) {
		if($cat==0)$add=' NATURAL JOIN employe ';
		else $add=' NATURAL JOIN etudiant ';
		
		$query='
		SELECT beneficiaire.nom_bene AS nom, beneficiaire.prenom_bene AS prenom	,centre.nom_centre AS centre	
		FROM beneficiaire
		NATURAL JOIN centre
		'.$add.'
		WHERE centre.id_region=:region';
		$cond=array('region'=>$id_region);		
		return $this->prep_query($query,$cond);
	}		
	
	public function getListeInCentre($id_centre ,$cat) {
		if($cat==0)$add=' NATURAL JOIN employe ';
		else $add=' NATURAL JOIN etudiant ';
		
		$query='		
		SELECT beneficiaire.nom_bene AS nom, beneficiaire.prenom_bene AS prenom	,centre.nom_centre AS centre	
		FROM beneficiaire
		NATURAL JOIN centre
		'.$add.'
		WHERE centre.id_centre=:centre';
		$cond=array('centre'=>$id_centre);		
		return $this->prep_query($query,$cond);
	}	
	
}
?>