<?php
abstract class BaseModel {
	protected $database;
	protected $pdo_options;
	protected $accountTable;
	
	public function __construct() {
		require_once("include/settings.php");		
		$this->pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$this->database = new PDO("mysql:host=".$db_host.";dbname=".$db_name, $db_username, $db_password);
	}
	
	public function clean_vars($cond)
	{
		if (is_array($cond))
		{			
			foreach ($cond as $key => $value)
			{
				$cond[$key]=addslashes($cond[$key]);
				$cond[$key]=htmlspecialchars($cond[$key]);
			}
		}
		else 
		{
			$cond=addslashes($cond);
			$cond=htmlspecialchars($cond);
		}
	}
	
	public function parse_int($cond)
	{
		if (is_array($cond))
		{			
			foreach ($cond as $key => $value)
			{
				$cond[$key]=(int)$cond[$key];
			}
		}
		else 
		{
			$cond=(int)$cond;			
		}
	}
	
	public function select($table,$field,$cond=NULL)
	{		
		
		$query = "SELECT " . $field;
		$query .= " FROM " . $table;
		if (is_array($cond))
		{
			$this->clean_vars($cond);
			$query .= " WHERE ";
			$i = 0;
			foreach ($cond as $key => $value)
			{
				$query .= ($i != 0)? " AND " : '';
				$query .= $key . " = :".$key;
				$i++;
			}
		}	
		$req=$this->database->prepare($query);
		$req->execute($cond);
		if($req->rowCount()!=0)
		{
			while($rep=$req->fetch())
			{
				$out[] = $rep;
			}
			return $out;
		}
		return 0;
	}
	
	public function prep_query($query,$cond=NULL)
	{			
		$out=array();
		$req=$this->database->prepare($query);
		$req->execute($cond);
		if($req->rowCount()!=0)
		{
			while($rep=$req->fetch())
			{
				$out[] = $rep;
			}
			return $out;
		}
		return 0;
	}
	
	public function no_return_query($query,$cond=NULL)
	{					
		$req=$this->database->prepare($query);
		$req->execute($cond);		
	}	
	
	public function getAllRegions() {
		$query='SELECT nom_region, id_region FROM region';
		return $this->prep_query($query);
	}
	
	public function getAllCentres() {
		$query='SELECT nom_centre, id_centre FROM centre';
		return $this->prep_query($query);
	}
	
	public function getRegion($id_region) {
		$query='SELECT nom_region, id_region FROM region WHERE id_region=:region';
		$cond=array('region'=>$id_region);	
		return $this->prep_query($query,$cond);
	}
	
	public function getCentresInRegion($id_region) {
		$query='SELECT nom_centre, id_centre FROM centre WHERE id_region=:region';
		$cond=array('region'=>$id_region);	
		return $this->prep_query($query,$cond);
	}	
	
	public function getRegionOfCentre($id_centre) {
		$query='SELECT region.nom_region, region.id_region 
		FROM region 
		NATURAL JOIN centre
		WHERE centre.id_centre=:centre';
		$cond=array('centre'=>$id_centre);	
		return $this->prep_query($query,$cond);
	}
	
	public function getCentre($id_centre) {
		$query='SELECT nom_centre, id_centre FROM centre WHERE id_centre=:centre';
		$cond=array('centre'=>$id_centre);	
		return $this->prep_query($query,$cond);
	}	
}
?>