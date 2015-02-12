<?php
require_once("Controller.php");
require_once("Vue.php");
require_once("Commentaire.php");


class ClientController extends Controller{

	protected $listAction=array('list'=>'listAction','detail'=>'detailAction','cat'=>'catAction','log'=>'logIn','client'=>'clientConnection','sign'=>'sign','succes'=>'insertionClient','deconnexion'=>'deconnexion','admin'=>'admin','insert'=>'insertionBillet','insertionSucces'=>'insertSucces','errId'=>'errId','insertCom'=>'insertCom','recupCom'=>'recupCom');


	public function insertCom($param){
		$text=strip_tags($_POST["comment"]);
		session_start();
		$aut=$_SESSION["nom"];
		$id_billet=$_GET["id"];
		$com=new Commentaire();
		$com->auteur=$aut;
		$com->text=$text;
		$com->id_billet=$id_billet;
		if($com->insert()){
			$vue=new Vue($com);
			$vue->affichageGenerale("insertComSucces");
		}
		else{
			$com=new Commentaire($aut,$text);
			$vue=new Vue($com);
			$vue->affichageGenerale("insertComErr");
		}
	}

	public function recupCom($param){
		$vue=new Vue($param);
		$vue->affichageGenerale("recupCom");

	}

	public function afficheCom($param){
		$vue=new Vue($param);
		$vue->affichageGenerale("afficheCom");
	}

	public function defaultAction(){
		$vue=new Vue("default");
		$vue->affichageGenerale("default");
	}

}
?>