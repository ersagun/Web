<?php
require_once "BlogController.php";
require_once "AdminController.php";
require_once "client.php";

abstract class Controller{
	

	public function callAction($param){
		if(isset($param['a'])){
			$ac=$param['a'];
			if(isset($this->listAction[$ac])){
				$val=$this->listAction[$ac];
				$this->$val($param);
			}else{
				$this->defaultAction();
			}
		}
		else{
			$this->defaultAction();
		}
	}

	public abstract function defaultAction();
}
?>

