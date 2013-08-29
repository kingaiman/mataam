<?php
abstract class BaseController {
	protected $urlvalues;
	protected $action;
	public function __construct($action, $urlvalues) {
		$this->action = $action;
		$this->urlvalues = $urlvalues;
	}
	public function ExecuteAction() {
		return $this->{$this->action}();
	}
	protected function ReturnView($param) {
	    require_once("include/header.php");
		$viewloc = 'views/' . get_class($this) . '/' . $this->action . '.php';		
		require($viewloc);
		require_once("include/footer.php");
		
	}
}
?>