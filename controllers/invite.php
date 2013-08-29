<?php
class Invite extends BaseController {

	protected function invit_jour() 
	{
		if(isset($_SESSION['logged']) && $_SESSION['logged']==true && isset($_SESSION['range']) && ($_SESSION['range']==2 || $_SESSION['range']==1))
		{
			define("CONTROLLER",true);
			define("INVIT_JOUR",true);
			if(isset($this->urlvalues['j']) && (int)$this->urlvalues['j']!=0 && isset($this->urlvalues['m']) && (int)$this->urlvalues['m']!=0 && isset($this->urlvalues['a']) && (int)$this->urlvalues['a']!=0 )
			{
				$j=$this->urlvalues['j'];
				$m=$this->urlvalues['m'];
				$a=$this->urlvalues['a'];
				$date=$a.'-'.$m.'-'.$j;
			}
			else $date=date("Y-m-d");
			$model=new InviteModel();			
			$centre= isset($this->urlvalues['centre']) && (int)$this->urlvalues['centre']!=0;
			$region= isset($this->urlvalues['region']) && (int)$this->urlvalues['region']!=0;
			if (($_SESSION['range']==2 && $_SESSION['vision']=='NATIONALE') || $_SESSION['range']==1)
			{						
				if($centre)
					$invite=$model->getInviteByCentreID($date,$this->urlvalues['centre']);
				else if($region)			
					$invite=$model->getInviteByRegionID($date,$this->urlvalues['region']);
				else
					$invite=$model->getInviteByDate($date);
					
				$regions=$model->getAllRegions();
				$centres=$model->getAllCentres();				
			}
			else if($_SESSION['vision']=='REGION')
			{				
				if($centre)
					$invite=$model->getInviteByCentreIDInRegion($date,$this->urlvalues['centre'],$_SESSION['id_vision']);				
				else
					$invite=$model->getInviteByRegionID($date,$_SESSION['id_vision']);
					
				$regions=$model->getRegion($_SESSION['id_vision']);
				$centres=$model->getCentresInRegion($_SESSION['id_vision']);
			}
			else
			{				
				$invite=$model->getInviteByCentreID($date,$_SESSION['id_vision']);
				
				$regions=$model->getRegionOfCentre($_SESSION['id_vision']);
				$centres=$model->getCentre($_SESSION['id_vision']);
			}
			$this->ReturnView(array('invite'=>$invite,'regions'=>$regions,'centres'=>$centres,'date'=>$date));
		}
		else header('Location: index.php?mode=account&action=login' );
	}
	
	protected function invit_employe() 
	{
		if(isset($_SESSION['logged']) && $_SESSION['logged']==true && isset($_SESSION['range']) && $_SESSION['range']==3 && $_SESSION['type']=='employe')
		{
			define("CONTROLLER",true);
			define("INVIT_EMPLOYE",true);
			$model=new InviteModel();
			if(isset($this->urlvalues['j1']) && (int)$this->urlvalues['j1']!=0 && isset($this->urlvalues['m1']) && (int)$this->urlvalues['m1']!=0 && isset($this->urlvalues['a1']) && (int)$this->urlvalues['a1']!=0 )
			{
				if(isset($this->urlvalues['j2']) && (int)$this->urlvalues['j2']!=0 && isset($this->urlvalues['m2']) && (int)$this->urlvalues['m2']!=0 && isset($this->urlvalues['a2']) && (int)$this->urlvalues['a2']!=0 )
				{
					$j1=$this->urlvalues['j1'];
					$m1=$this->urlvalues['m1'];
					$a1=$this->urlvalues['a1'];
					$date1=$a1.'-'.$m1.'-'.$j1;
					$j2=$this->urlvalues['j2'];
					$m2=$this->urlvalues['m2'];
					$a2=$this->urlvalues['a2'];
					$date2=$a2.'-'.$m2.'-'.$j2;
					$invite=$model->getInviteForEmploye($_SESSION['username'],$date1,$date2);
					$this->ReturnView(array('invite'=>$invite,'date'=>true,'date1'=>$date1,'date2'=>$date2));
				}
				else $this->ReturnView(array('date'=>false));
			}
			else $this->ReturnView(array('date'=>false));
		}
		else header('Location: index.php?mode=account&action=login' );
	}
	
}

?>