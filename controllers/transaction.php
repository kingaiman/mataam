<?php
class Transaction extends BaseController {
	protected function trans_benef() 
	{
	/**********************
		La liste des transactions effectuée par un beneficiaire
		*******************/
		if(isset($_SESSION['logged']) && $_SESSION['logged']==true && isset($_SESSION['range']) && $_SESSION['range']==3 && $this->urlvalues['mois']<13 && $this->urlvalues['mois']>0)
		{
			define("CONTROLLER",true);
			define("TRANS_BENEF",true);
			$model=new TransactionModel();
			$transactions=$model->getTransactionsFromUserName($_SESSION['username'],$this->urlvalues['mois']);
			$solde=$model->getSoldeFromUserName($_SESSION['username']);
			$this->ReturnView(array('transactions'=>$transactions, 'solde'=>$solde));
		}
	}
	
	protected function trans_jour()
	{
		if(isset($_SESSION['logged']) && $_SESSION['logged']==true && isset($_SESSION['range']) && ($_SESSION['range']==2 || $_SESSION['range']==1))
		{
			define("CONTROLLER",true);
			define("TRANS_JOUR",true);
			if(isset($this->urlvalues['j']) && (int)$this->urlvalues['j']!=0 && isset($this->urlvalues['m']) && (int)$this->urlvalues['m']!=0 && isset($this->urlvalues['a']) && (int)$this->urlvalues['a']!=0 )
			{
				$j=$this->urlvalues['j'];
				$m=$this->urlvalues['m'];
				$a=$this->urlvalues['a'];
				$date=$a.'-'.$m.'-'.$j;
			}
			else $date=date("Y-m-d");
			$model=new TransactionModel();			
			$centre= isset($this->urlvalues['centre']) && (int)$this->urlvalues['centre']!=0;
			$region= isset($this->urlvalues['region']) && (int)$this->urlvalues['region']!=0;
			if (($_SESSION['range']==2 && $_SESSION['vision']=='NATIONALE') || $_SESSION['range']==1)
			{						
				if($centre)
					$transactions=$model->getTransactionByCentreID($date,$this->urlvalues['centre']);
				else if($region)			
					$transactions=$model->getTransactionByRegionID($date,$this->urlvalues['region']);
				else
					$transactions=$model->getTransactionByDate($date);
				$regions=$model->getAllRegions();
				$centres=$model->getAllCentres();
			}
			else if($_SESSION['vision']=='REGION')
			{
				$regions=$model->getRegion($_SESSION['id_vision']);
				$centres=$model->getCentresInRegion($_SESSION['id_vision']);
				if($centre)
					$transactions=$model->getTransactionByCentreIDInRegion($date,$this->urlvalues['centre'],$_SESSION['id_vision']);				
				else
					$transactions=$model->getTransactionByDateInRegion($date,$_SESSION['id_vision']);
			}
			else
			{
				$regions=$model->getRegionOfCentre($_SESSION['id_vision']);
				$centres=$model->getCentre($_SESSION['id_vision']);
				$transactions=$model->getTransactionByDateInCentre($date,$_SESSION['id_vision']);
			}
			$this->ReturnView(array('transactions'=>$transactions,'regions'=>$regions,'centres'=>$centres,'date'=>$date));
		}
		else header('Location: index.php?mode=account&action=login' );
	}
}

?>