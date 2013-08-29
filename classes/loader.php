<?php
class Loader {
	private $controller;
	private $action;
	private $urlvalues;
	//store the URL values on object creation
	public function __construct($urlvalues) {
		$this->urlvalues = $urlvalues;
		if (!isset($this->urlvalues['mode'])) {
			$this->controller = "home";
		} else {
			$this->controller = $this->urlvalues['mode'];
		}
		if (!isset($this->urlvalues['action'])) {
			$this->action = "index";
		} else {
			$this->action = $this->urlvalues['action'];
		}
	}
	//establish the requested controller as an object
	public function CreateController() {
		//does the class exist?
		if (class_exists($this->controller)) {
			$parents = class_parents($this->controller);
			//does the class extend the controller class?
			if (in_array("BaseController",$parents)) {
				//does the class contain the requested method?
				if (method_exists($this->controller,$this->action)) {
					return new $this->controller($this->action,$this->urlvalues);
				} else {
					//bad method error
					header('Location: 404.php' );
				}
			} else {
				//bad controller error
				header('Location: 404.php' );
			}
		} else {
			//bad controller error
			header('Location: 404.php');
		}
	}
}
?>