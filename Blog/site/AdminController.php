<?php
require_once("client.php");
require_once("Controller.php");
require_once("Billet.php");
require_once("Categorie.php");
require_once("Vue.php");

class AdminController extends Controller{

	protected $listAction=array('list'=>'listAction','detail'=>'detailAction','cat'=>'catAction','log'=>'logIn','cli'=>'clientConnection','sign'=>'sign','succes'=>'insertionClient','deconnexion'=>'deconnexion','admin'=>'admin','insert'=>'insertionBillet','insertionSucces'=>'insertSucces','errId'=>'errId','recupCom'=>'recupCom','sup'=>'supBillet','update'=>'update','updateSucces'=>'updateSucces','deleteCom'=>'deleteCom','client'=>'client','updateCli'=>'updateCli','updateCliSuc'=>'updateCliSuc','categorie'=>'categorie','insertCat'=>'insertCat','suprimCat'=>'suprimCat','updCat'=>'updCat','updCatSuc'=>'updCatSuc');


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

	public function supBillet($param){
		$billet=Billet::findById($param["id"]);
		$bil=$billet;
		if($billet->delete()){
			$vue=new Vue($bil);
			$vue->affichageGenerale("supSucces");
		}
		else{
			$vue=new Vue($param);
			$vue->affichageGenerale("supErr");       
		}

	}

	public function logIn($param){
		$vue=new Vue("");
		$vue->affichageGenerale("log");
	}


	public function clientConnection($param){
		if(client::verifCli($_POST["email"],$_POST["mp"])){
			$vue=new Vue("clientConnection");
			$vue->affichageGenerale("clientConnection");
		}
		else{
			$vue=new Vue("connectionErr");
			$vue->affichageGenerale("connectionErr");
		}
	}

	public function deconnexion($param){
		client::deconnexion();
		$vue=new Vue("deconnexion");
		$vue->affichageGenerale("deconnexion");
	}

	public function sign($param){
		$vue=new Vue($param['a']);
		$vue->affichageGenerale("sign");
	}

	public function insertionBillet($param){
		$vue=new Vue("insert");
		$vue->affichageGenerale("insert");
	}

	public function insertSucces($param){
		$fcat=strip_tags($_POST["ersagun"]);
		$id=Categorie::findByTitre($fcat);
		$nouveauBil=new Billet();
		$nouveauBil->titre=$_POST["titre"];
		$nouveauBil->auteur=$_POST["auteur"];
		$nouveauBil->text=$_POST["comment"];
		$nouveauBil->cat_id=$id->id;
		if($nouveauBil->insert()){
			$vue=new Vue($nouveauBil);
			$vue->affichageGenerale("insertBillet");
		}else{
			return null;
		}
	}

	public function insertionClient($param){
		
		$cli=new client();
		$cli->nom=$_POST['nom'];
		$cli->prenom=$_POST['prenom'];
		$cli->adr=$_POST['email'];
		$cli->pass=$_POST['motdepasse'];
		if($cli->insertCli()){
			$vue=new Vue($cli);
			$vue->affichageGenerale("insertCliOk");
		}
		else{
			$vue=new Vue("insertCliErr");
			$vue->affichageGenerale("insertCliErr");
		}
	}

	public function errId(){
		$vue=new Vue("errId");
		$vue->affichageGenerale("errId");
	}

	public function admin($param){
		session_start();
		if(isset($_SESSION["nom"])){
			$billets=Billet::findByAuthor($_SESSION["id"]);
			$vue=new Vue($billets);
			$vue->affichageGenerale("administration");
		}else{  
			$vue=new Vue($param);
			$vue->affichageGenerale("errIns"); 
		}
	}

	public function update($param){
		$billet=Billet::findById($param["id"]);
		$vue=new Vue($billet);
		$vue->affichageGenerale("updateBillet");

	}

	public function updateSucces($param){
		$billet=Billet::findById($param["id"]);
		$nouveauBillet=new Billet();
		$nouveauBillet->id=$param["id"];
		$nouveauBillet->titre=$_POST["titre_update"];
		$nouveauBillet->auteur=$billet->auteur;
		$nouveauBillet->text=$_POST["comment_update"];
		$nouveauBillet->cat_id=Categorie::findByTitre($_POST["ersagun"])->id;
		$nouveauBillet->cat=(string)$_POST["ersagun"];
		$bil=$billet;

		if($nouveauBillet->update()){
			$vue=new Vue($bil);
			$vue->affichageGenerale("updateOk");
		}
		else{
			$vue=new Vue($bil);
			$vue->affichageGenerale("updateErr");
		}
	}

	public function deleteCom($param){
		$com=Commentaire::findById($param["id"]);
		$c=$com;
		if(isset($com) && $com instanceOf Commentaire){
			$com->delete();
			$vue=new Vue($c);
			$vue->affichageGenerale("deleteComSucces");
		}else{
			$vue=new Vue($c);
			$vue->affichageGenerale("errrSup");
		}

	}

	public function client($param){
		$c=Client::findById($param["id"]);
		if(isset($c) && $c instanceOf Client){
			$vue=new Vue($c);
			$vue->affichageGenerale($param["a"]);
		}
	}

	public function updateCli($param){
		$vue=new Vue($param);
		$vue->affichageGenerale("modifCli");

	}

	public function updateCliSuc($param){
		$cnew=new Client();
		$cnew->nom=strip_tags($_POST["nomCli"]);
		$cnew->prenom=strip_tags($_POST["preCli"]);
		$cnew->adr=strip_tags($_POST["eCli"]);
		$cnew->id=$param["id"];
		if($cnew->update()){
			$vue=new Vue($param);
			$vue->affichageGenerale("modifCliOk");
		}
		else{
			$vue=new Vue($param);
			$vue->affichageGenerale("modifCliErr");
		}
		

	}

	public function categorie($param){
		$vue=new Vue($param);
		$vue->affichageGenerale($param["a"]);

	}

	public function defaultAction(){
		$vue=new Vue("default");
		
	}

	public function insertCat($param){
		$cat=new Categorie();
		$cat->titre=strip_tags($_POST["titre"]);
		$cat->description=strip_tags($_POST["description"]);
		if($cat->insert()){	
			$vue=new Vue($cat);
			$vue->affichageGenerale("insertCatSuc");
		}
		else{
			$vue=new Vue($param);
			$vue_>affichageGenerale("insertCatErr");
		}

	}

	public function suprimCat($param){
		$cat=Categorie::findByTitre($_POST["ersagun"]);
		var_dump($_POST["ersagun"]);
		var_dump($cat);
		if($cat->delete()){
			$vue=new Vue($param);
			$vue->affichageGenerale("deleteCatOk");

		}
	}

	public function updCat($param){
		$vue=new Vue($param);
		$vue->affichageGenerale($param["a"]);
	}

	public function updCatSuc($param){
		$cat=new Categorie();
		$cat->titre=strip_tags($_POST["titre"]);
		$cat->description=strip_tags($_POST["description"]);
		$cat->id=$param["id"];
		if($cat->update()){	
			$vue=new Vue($cat);
			$vue->affichageGenerale("updCatSuc");
		}
		else{
			$vue=new Vue($param);
			$vue_>affichageGenerale("updCatErr");
		}

	}
}
?>


