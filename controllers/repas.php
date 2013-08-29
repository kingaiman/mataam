<?php
class Repas extends BaseController {
	protected function repas_benef() 
	{
	/**********************
		La liste des transactions effectuée par un beneficiaire
		*******************/
		if(isset($_SESSION['logged']) && $_SESSION['logged']==true && isset($_SESSION['range']) && $_SESSION['range']==3 && $this->urlvalues['mois']<13 && $this->urlvalues['mois']>0)
		{
			define("CONTROLLER",true);
			define("REPAS_BENEF",true);
			$model=new RepasModel();
			$repas=$model->getRepasFromUserName($_SESSION['username'],$this->urlvalues['mois']);
			$this->ReturnView(array('repas'=>$repas));
		}
		else header('Location: index.php?mode=account&action=login' );
	}
	
}

?>