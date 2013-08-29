<?php
class AccountModel extends BaseModel {
	public function getFromUserName($username) {
		$cond=array('username'=>$username);
		$query='SELECT * FROM
		(
			SELECT * FROM
				(SELECT * FROM	
					(SELECT nom_utilisateur, nom_bene nom, prenom_bene prenom, date_n_bene date_naissance,\'beneficiaire\' nature 
						FROM beneficiaire) A UNION
					(SELECT nom_utilisateur, nom_admin nom, prenom_admin prenom, date_n_admin date_naissance,\'administrateur\' nature 
						FROM administrateur)) B UNION
				(SELECT nom_utilisateur, nom_wm nom, prenom_wm prenom, date_n_wm date_naissance,\'web master\' nature FROM web_master)
		) C NATURAL JOIN compte
		WHERE nom_utilisateur = :username;';
		return $this->prep_query($query,$cond);
	}	
	
	public function getType($username) {
		$cond=array('username'=>$username);
		$query='SELECT compte.nom_utilisateur FROM employe 
		NATURAL JOIN beneficiaire
		NATURAL JOIN compte
		WHERE compte.nom_utilisateur=:username';
		return $this->prep_query($query,$cond);
	}	
	public function getVision($username) {
		$cond=array('username'=>$username);
		$query='SELECT vision, id_vision FROM administrateur 
		WHERE nom_utilisateur=:username';
		return $this->prep_query($query,$cond);
	}	
	
	public function insertUser($pass,$nom,$prenom,$naissance,$vision,$id_vision,$user) {
		$cond=array('pass'=>$pass,'user'=>$user);		
		$query='INSERT INTO compte VALUES(:user,:pass)';
		$this->prep_query($query,$cond);
		$cond=array('nom'=>$nom,'prenom'=>$prenom,'naissance'=>$naissance,'vision'=>$vision,':id_vision'=>$id_vision,'user'=>$user);
		$query='INSERT INTO administrateur VALUES(\'\',:nom,:prenom,:naissance,:vision,:id_vision,:user,0)';
		return $this->prep_query($query,$cond);
	}	
}
?>