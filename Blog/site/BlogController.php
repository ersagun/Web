<?php

require_once("Controller.php");
require_once("Billet.php");
require_once("Categorie.php");
require_once("Vue.php");


class BlogController extends Controller{

	protected $listAction=array('list'=>'listAction','detail'=>'detailAction','cat'=>'catAction','recupCom'=>'recupCom', 'contact'=>'contacts','client'=>'client');

//FAUT RECUPERER DANS UNE VARIABLE !!!!

	public function listAction($param){
		$listebillet=Billet::findAll();
		$vue=new Vue($listeBillet);
		$vue->affichageGenerale("list");
	}

	public function detailAction($param){
		$billet=Billet::findById($param['id']);
		$vue=new Vue($billet);
		$vue->affichageGenerale("detail");
	}

	public function catAction($param){
		$billetCateg=Billet::findByCat($param['id']);
		$vue=new Vue($billetCateg);
		$vue->affichageGenerale("cat");
	}

	public function defaultAction(){
		$vue=new Vue("default");
		$vue->affichageGenerale("default");
	}

	public function contacts($param){
		$vue=new Vue($param);
		$vue->affichageGenerale($param["a"]);
	}

	public function client($param){
		$c=Client::findById($param["id"]);
		if(isset($c) && $c instanceOf Client){
			$vue=new Vue($c);
			$vue->affichageGenerale($param["a"]);
		}
	}
}
?>
