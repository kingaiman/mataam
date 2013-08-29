<?php
class Beneficiaire extends BaseController {
	
	protected function liste()
	{
		if(isset($_SESSION['logged']) && $_SESSION['logged']==true && isset($_SESSION['range']) && ($_SESSION['range']==2 || $_SESSION['range']==1))
		{
			define("CONTROLLER",true);
			define("LISTE",true);
			$model=new BeneficiaireModel();			
			$centre= isset($this->urlvalues['centre']) && (int)$this->urlvalues['centre']!=0;
			$region= isset($this->urlvalues['region']) && (int)$this->urlvalues['region']!=0;
			if(isset($this->urlvalues['cat']))
			{
				$cat=(int)$this->urlvalues['cat'];
			}
			else $cat=0;
			if (($_SESSION['range']==2 && $_SESSION['vision']=='NATIONALE') || $_SESSION['range']==1)
			{						
				if($centre)
					$liste=$model->getListeByCentreID($this->urlvalues['centre'],$cat);
				else if($region)			
					$liste=$model->getListeByRegionID($this->urlvalues['region'],$cat);
				else 
					$liste=$model->getListe($cat);
				
				$regions=$model->getAllRegions();
				$centres=$model->getAllCentres();
			}
			else if($_SESSION['vision']=='REGION')
			{				
				if($centre)
					$liste=$model->getListeByCentreIDInRegion($this->urlvalues['centre'],$_SESSION['id_vision'],$cat);				
				else
					$liste=$model->getListeInRegion($_SESSION['id_vision'],$cat);
					
				$regions=$model->getRegion($_SESSION['id_vision']);
				$centres=$model->getCentresInRegion($_SESSION['id_vision']);
			}
			else
			{				
				$liste=$model->getListeInCentre($_SESSION['id_vision'],$cat);
				
				$regions=$model->getRegionOfCentre($_SESSION['id_vision']);
				$centres=$model->getCentre($_SESSION['id_vision']);
			}
			$this->ReturnView(array('liste'=>$liste,'regions'=>$regions,'centres'=>$centres,'cat'=>$cat));
		}
		else header('Location: index.php?mode=account&action=login' );
	}
}

?>