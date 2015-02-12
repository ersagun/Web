<?php
require_once("Billet.php");
require_once("Categorie.php");
require_once("Commentaire.php");
class Vue{

  private $param;

  public function __construct($variable){
    $this->param=$variable;
  }

  public function affichageGenerale($paramAff){
    if(!isset($_SESSION)){
      session_start();
    }
    $f="<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
    <html xmlns=\"http://www.w3.org/1999/xhtml\"><head>
    <title>Mini Blog</title>
    <meta name=\"description\" content=\"\">
    <meta name=\"keywords\" content=\"\">
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=ISO-8859-1\">
    <link href=\"css/style.css\" rel=\"stylesheet\" type=\"text/css\">
    </head>
    <body>
    <div id=\"page\">
    <header id=\"tete\">
    <div id=\"photo\"><a href=\"blog.php\"><img src=\"img/header.jpg\" alt=\"Mini Blog\" width=\"1000\" height=\"200\"></a></div>
    <div id=\"menu\">
    <ul>
    <li><a href=\"blog.php\">Acceuil </a></li>";
    if(isset($_SESSION['nom'])){
      $f.= "<li><a href=\"admin.php?a=admin\">Administration</a> </li>";
      $f.= "<li><a href=\"admin.php?a=client&id=".$_SESSION["id"]."\">Profil</a> </li>";
      $f.= "<li><a href=\"admin.php?a=deconnexion\">Deconnexion</a> </li>";
      if($_SESSION['id']==1){
       $f.= "<li><a href=\"admin.php?a=categorie\">Categorie</a> </li>";
     }
   }
   else{
    $f.= "<li><a href=\"admin.php?a=log\">S'identifier</a> </li>";
    $f.= "<li><a href=\"admin.php?a=sign\">S'incrire</a> </li>";
  }

  $f.=          "<li id=\"last\"><a href=\"blog.php?a=contact\">Contact</a></li>
  </ul>
  </div>
  </header>
  <div id=\"milieu\">";
  $f.=      $this->affichageGauche();

  $f.=      "<section id=\"centre\" class=\"same\">";

  if(!empty($_SESSION) && isset($_SESSION["nom"])){

    switch($paramAff){
     case "updCatSuc":
     $f.=$this->updCatSuc();
     break;
     case "updCatErr":
     $f.=$this->updCatErr();
     break;
     case "updCat":
     $f.=$this->updCat();
     break;
     case "deleteCatOk":
     $f.=$this->deleteCatOk();
     break;
     case "categorie":
     $f.=$this->categorie();
     break;
     case "insertCatSuc":
     $f.=$this->insertCatSuc();
     break;
     case "insertCatErr":
     $f.=$this->insertCatErr();
     break;
     case "modifCliErr":
     $f.=$this->modifCliErr();
     break;
     case "modifCliOk":
     $f.=$this->modifCliOk();
     break;
     case "modifCli":
     $f.=$this->modifCli();
     break;
     case "client":
     $f.=$this->client();
     break;
     case "errrSup":
     $f.=$this->errrSup();
     break;
     case "deleteComSucces":
     $f.=$this->deleteComSucces();
     break;
     case "contact":
     $f.=$this->contact();
     break;
     case "updateBillet":
     $f.=$this->updateBillet();
     break;
     case "supSucces":
     $f.=$this->supSucces();
     break;
     case "list":
     $f.=$this->affichageTouteBillet();
     break;
     case "detail":
     $f.=$this->affichageUnSeulBillet();
     break;
     case "cat":
     $f.=$this->afficheBilletSameCateg();
     break;
     case"insert" :
     $f.= $this->affichageInsertionBillet();
     break;
     case "administration":
     $f.=$this->affichageAdmList();
     break;
     case "deconnexion":
     $f.=$this->deconnexion();
     break;
     case "detail":
     $f.=$this->affichageUnSeulBillet();
     break;
     case "recupCom":
     $f.=$this->recupCom();
     break;
     case "insertBillet":
     $f.= $this->insertBillet();
     break;
     case "insertComSucces":
     $f.= $this->insertcomSucces();
     break;
     case "insertComErr":
     $f.=$this-comErr();
     break;
     case "insertCom":
     $f.=$this->insertCom();
     break;
     case "updateOk":
     $f.=$this->updateOk();
     break;
     case "updateErr":
     $f.=$this->updateErr();
     break;
     case "errId":
     $f.=$this->erreurFindId();
     break;
     case "default":
     $f.=$this->affichageTouteBillet();
     break;
     default:
     $f.=$this->affichageTouteBillet();
     break;
   }
 }
 else{
  switch($paramAff){
    case "client":
    $f.=$this->client();
    break;
    case "contact":
    $f.=$this->contact();
    break;
    case "list":
    $f.=$this->affichageTouteBillet();
    break;
    case "detail":
    $f.=$this->affichageUnSeulBillet();
    break;
    case "cat":
    $f.=$this->afficheBilletSameCateg();
    break;
    case "log":
    $f.= $this->affichageLog();
    break;
    case "errIns":
    $f.=$this->errIns();
    break;
    case "clientConnection":
    $f.=$this->connectSucces();
    break;
    case "detail":
    $f.=$this->affichageUnSeulBillet();
    break;
    case "recupCom":
    $f.=$this->ErrId();
    break;
    case "connectionErr":
    $f.=$this->connectErr();
    break;
    case "sign":
    $f.= $this->affichageSign();
    break;
    case "insertCliOk":
    $f.=$this->insertCliOk();
    break;
    case "insertCliErr":
    $f.=$this->insertCliErr();
    break;
    case "insertBillet":
    $f.= $this->insertBillet();
    break;
    case "errId":
    $f.=$this->erreurFindId();
    break;
    case "deconnexion":
    $f.=$this->deconnexion();
    break;
    case "default":
    $f.=$this->affichageTouteBillet();
    break;
    default:
    $f.=$this->affichageTouteBillet();
    break;
  }
}  

$f.=     "</section>";

$f.=     $this->affichageDroite();

$f.=  "</div>
</body>
<footer id=\"footer\">
<p>&copy; Copyright 2014. Designed by Ersagun YALCINTEPE, Tom VERHOOF </p>
</footer>
</html>";
print $f;
}

public function affichageGauche(){
 $i=1;
 $f="<nav id=\"panel_gauche\" class=\"same\">
 <h2 id=\"titre_gauche\"></h2>
 <ul id=\"ul-cat\">";  
 foreach(Categorie::findAll() as $value){
  $f.="<li><a href=\"blog.php?a=cat&id=".$value->id."\">".$value->titre."</a></li>";
  $i=$i+1;
}
$f.="</ul>
</nav>";
return $f;
}

public function affichageTouteBillet(){

 $f=          "<h3 id=\"titre_centre\">Toutes les billets</h3>
 <ul id=\"ul-centre\">";
 foreach(Billet::findAll() as $value){
  $cat=Categorie::findById($value->cat_id);
  $value->cat=$cat->titre;
  $f.="<li><a href=\"blog.php?a=detail&id=".$value->id."\">".$value->__toString()."</a></li>"; 
  
}
$f.=           "</ul>";
return $f;
}

public function affichageDroite(){
  $i=1;
  $f="<nav id=\"panel_droite\" class=\"same\">
  <h2 id=\"titre_droite\"></h2>
  <ul id=\"ul-bil\">";
  foreach(Billet::findXDerniers(10) as $value){
    $f.="<li><a href=\"blog.php?a=detail&id=".$value->id."\">".$value->text."</a></li>";
    $i=$i+1;
  }
  $f.=           "</ul>        
  </nav>
  </div>";
  return $f;
}

public function affichageLog(){
 $formulaire="<h3 id=\"titre_centre\">S'identifier</h3>";
 $formulaire.= "<form action=\"admin.php?a=cli\" method=\"POST\" id=\"form-log\">";
 $formulaire.="<label for=\"email\"> E-mail :</label><br>";
 $formulaire.="<input type=\"email\" name=\"email\" id=\"email\" value=\"\" /><br><br>";
 $formulaire.="<label for=\"mot de passe\"> Mot de passe : </label><br>";
 $formulaire.="<input type=\"password\" name=\"mp\" id=\"mp\" value=\"\" /><br><br>";
 $formulaire.="<input type=\"submit\" name=\"submit\" value=\"Go !\" id=\"\"/><br><br>";
 $formulaire.="</form>";
 return $formulaire;
}

public function affichageSign(){
 $formulaire="<h3 id=\"titre_centre\">S'inscrire</h3>";
 $formulaire.= "<form action=\"admin.php?a=succes\" method=\"POST\" id=\"form-log\">";
 $formulaire.="<label for=\"nom\"> Nom :</label><br>";
 $formulaire.="<input type=\"text\" name=\"nom\" id=\"nom\" value=\"\" /><br><br>";
 $formulaire.="<label for=\"prenom\"> Prenom : </label><br>";
 $formulaire.="<input type=\"text\" name=\"prenom\" id=\"prenom\" value=\"\" /><br><br>";
 $formulaire.="<label for=\"email\"> E-mail :</label><br>";
 $formulaire.="<input type=\"email\" name=\"email\" id=\"email\" value=\"\" /><br><br>";
 $formulaire.="<label for=\"mot de passe\"> Mot de passe : </label><br>";
 $formulaire.="<input type=\"password\" name=\"motdepasse\" id=\"mp\" value=\"\" /><br><br>";
 $formulaire.="<input type=\"submit\" name=\"submit\" value=\"Inscrire !\" id=\"inscription\"/><br><br>";
 $formulaire.="</form>";
 return $formulaire;
}
// Affiche une combobox contenant toutes les catégories existantes
  // pour pouvoir choisir a quelle catégorie appartient le billet que
  // l'on souhaite insérer.

public static function ComboBoxCategories()
{
  $res = "<select name=\"ersagun\">";
  $cats = Categorie::findAll();
  $premier = false;

  foreach($cats as $cat)
  {
    $res .= '<option value="' . $cat->titre . '" ';

    if($premier)
    {
      $res .= "selected ";
      $premier = false;
    }

    $res .= ">" . $cat->titre . "</option>";
  }   

  $res .= "</select>";
  return $res;
}

public function affichageInsertionBillet(){
  $a="<h3 id=\"titre_centre\">Insertion de billet</h3>";
  $a.="<form method=\"POST\" action=\"admin.php?a=insertionSucces\">";
  $val=(int)$_SESSION["id"];
  $a.="<input type=\"hidden\" name=\"auteur\"value=\"".$val."\" /><br />";
  $a.="<label for=com> Titre:</label><br />";
  $a.="<input type=\"text\" name=\"titre\" value=\"\" placeholder=\"Ecrivez un titre...\" \><br />";
  $a.="<label for=com> Commentaire:</label><br />";
  $a.="<textarea name=\"comment\" value=\"\" rows=\"4\" cols=\"30\" placeholder=\"Ecrivez un commentaire...\"></textarea><br />";
  $a.="<label for=cat> Categorie:</label><br />";
  $a.=self::ComboBoxCategories();
  $a.="<input type=\"submit\" name=\"insert\" value=\"Insert !\" />";
  $a.="</form>";
  return $a;
}

public function erreurFindId(){
  $a="<h3 id=\"titre_centre\">Erreur</h3>";
  $a.="<p> Erreur, il n'existe pas de billet</p>";
  return $a;
}

public function affichageUnSeulBillet(){
  $a="<h3 id=\"titre_centre\">Detail de billet</h3> ";
  $cat=Categorie::findById($this->param->cat_id);
  $this->param->cat=$cat->titre;

  $a.="<p id=\"\affichebillet\">".$this->param->__toString()."<br ></p>";
  $a.="<p>Auteur : <a href=blog.php?a=client&id=".$this->param->auteur.">".client::findById($this->param->auteur)->nom." ".client::findById($this->param->auteur)->prenom."</a></p><br>";
  $a.= "<a href=cli.php?a=recupCom&id=".$_GET["id"]." id='liencomment'> Pour commenter cliquez ici</a>";

  $billets=Commentaire::findByBillet($_GET["id"]);
  $a.="<article id=\"art\"> ";  
  if ($billets instanceOf Commentaire){
    $a.="<article id=\"commentaires\"> "; 
    $a.="<h2 id=\"titre_centre\">Commentaire:</h2>";
    $a.="<h3 id=\"aut_article\">Auteur :".$value->auteur."</h3>";
    $a.="<p id=\"article\">".$value->text."</p>";
    $a.="</article>";

  }else{
    foreach(Commentaire::findByBillet($_GET["id"]) as $key=>$value){
      $a.="<article id=\"commentaires\"> "; 
      $a.="<h2 id=\"titre_com\">Commentaire:</h2>";
      $a.="<h3 id=\"aut_article\">Auteur :".$value->auteur."</h3>";
      $a.="<p id=\"article\">".$value->text."</p>";

      if(isset($_SESSION) && !empty($_SESSION)){
        if($_SESSION["nom"]==$value->auteur){
          $a.="<form method=\"POST\" action=\"admin.php?a=deleteCom&id=".(string)$value->id_com."\"\" >";
          $a.="<input type=\"hidden\" name=\"deleteCom\" value=\"".$value->id_billet."\" />";
          $a.="<input type=\"submit\" name=\"delete\" value=\"delete\"  />";
        }
      }
      $a.="</article>";
    }
  }
  $a.="</article>";
  return $a;
}

public function affichageAdmList(){
  $a="<h3 id=\"titre_centre\">Administration</h3>
  <h10 id=\"titre_centre\"><a href=\"admin.php?a=insert\">Ajouter un evenement</a></h2><br>
  <h3 id=\"titre_centre\"> Vos Billets :</h3>";
  $i=0;
  if($this->param){
    foreach($this->param as $key=>$value ){
     $cat=Categorie::findById($value->cat_id);
     $a.="<table class=table_adm>
     <tr>  
     <th>Titre</th>
     <th>Texte</th>
     <th>Categorie</th>
     <th>DATE</th>
     </tr>";  
     $a.="<tr>";
     $a.= "<td>".$value->titre."</td>";
     $a.= "<td>".$value->text."</td>";
     $a.= "<td>".$cat->titre."</td>";
     $a.= "<td>".$value->date."</td>";
     $a.= "</tr>";
     $a.="<table id=\"idtab\">";
     $a.="<tr>";
     $a.="<th></th>";
     $a.="</tr>";
     $a.="<tr>" ;
     $a.= "<td id=\"buttons\">";
     $a.= "<form method=POST id=\"supprimerIcon\" action=\"admin.php?a=sup&id=".$value->id."\">";
     $a.= "   <input type=\"submit\" name=\"Supprimer !\" value=\"Supprimer!\" />";
     $a.= "</form>";
     $a.= " <form method=POST action=\"admin.php?a=update&id=".$value->id."\">";
     $a.= " <input type=\"submit\" name=\"Mise a jour !\" value=\"Update!\" />";
     $a.= "</form>";
     $a.="</td>";
     $a.="</tr>";
     $a.="</table>";
     $a.="</table>";
     $i=$i+1;
   }
 }
 else{
  $a.="<h3 id=\"titre_centre\"></h3>
  <p class=\"affichageInf\"> Vous n'avez pas de billet encore, ajoutez un billet !</p>";
}
$a.="<br>";
$a.="<br>";
return $a;
}

public function afficheBilletSameCateg(){
  $i=1;
  $a="<h3 id=\"titre_centre\">Billets de la categorie ".Categorie::findById($_GET["id"])->titre." </h3><br>";
  if($this->param instanceof Billet || isset($this->param)){
    $a.= "<ul id=\"ul-centre\">";
    foreach($this->param as $key=>$value){
      $value->cat=Categorie::findById($this->param[0]->cat_id)->titre;
      $a.="<li><a href=\"blog.php?a=detail&id=".$value->id."\">".$value->__toString()."</a></li>";
      $i=$i+1;
    }
    $a.= "</ul>";

  }else{
    $a.="<h3 id=\"titre_centre\">Erreur </h3>
    <p class=\"affichageInf\"> Il n'y a pas de billet pour cette categorie !</p>";

  }
  return $a;
}
public function connectSucces(){
  $a="<h3 id=\"titre_centre\">Bonjour</h3>
  <p class=\"affichageInf\"> Vous etes connecte</p>";
  return $a;
}

public function connectErr(){
  $a="<h3 id=\"titre_centre\">Erreur de Connection</h3>
  <p class=\"affichageInf\"> Vous n'etes pas inscrit, inscrivez vous !</p>";
  return $a;
  return $a;
}

public function deconnexion(){
  $a="<h3 id=\"titre_centre\"></h3>
  <p class=\"affichageInf\"> Vous etes deconnecte !</p>
  <input type=\"hidden\" name=\"deco\" value=\"deco\" />";
  return $a;   
}

public function insertCliOk(){
  $a="<h3 id=\"titre_centre\"></h3>
  <p class=\"affichageInf\"> Vous etes inscrit !</p>";
  return $a;

}
public function insertCliErr(){
  $a="<h3 id=\"titre_centre\"></h3>
  <p class=\"affichageInf\"> Insertion non reussie !</p>";
  return $a;
}

public function recupCom(){
  $a="<h3 id=\"titre_centre\">Inserez un Commentaire</h3>";
  $a.="<form method=\"POST\" action=\"cli.php?a=insertCom&id=".$_GET["id"]."\">";
  $a.="<label for=com> Commentaire:</label><br />";
  $a.="<textarea name=\"comment\" value=\"\" rows=\"4\" cols=\"30\" placeholder=\"Ecrivez un commentaire...\"></textarea><br />";
  $a.="<input type=\"hidden\" name=\"id_billet\"  value=".(string)$_GET["id"]."/>";
  $a.="<input type=\"submit\" name=\"insert\" value=\"Insert !\" />";
  $a.="</form>";
  return $a;
}

public function insertComSucces(){
  $a="<h3 id=\"titre_centre\">Votre Commentaire est ajoute</h3>
  <p class=\"affichageInf\"> Insertion reussie !</p>
  <a href=blog.php?a=detail&id=".$_GET["id"].">Voir le commentaire</a>";
  return $a;
}

public function insertComErr(){
  $a="<h3 id=\"titre_centre\">Erreur</h3>
  <p class=\"affichageInf\"> Insertion non reussie !</p>";
  return $a;
}

public function insertBillet(){
 $a="<h3 id=\"titre_centre\">Reussi !</h3>
 <p class=\"affichageInf\"> Votre evenement est ajoutee. !</p>
 <a href=admin.php?a=admin>Voir le billet</a>";
 return $a;
}

public function supSucces(){
  $a="<h3 id=\"titre_centre\">Supression Reussi !</h3>
  <p class=\"affichageInf\"> Votre evenement ".$this->param->text." est supprime !</p>
  <a href=admin.php?a=admin>Voir mes billets</a>";
  return $a;
}

public function supErr(){
  $a="<h3 id=\"titre_centre\">Supression Erreur !</h3>
  <p class=\"affichageInf\"> Votre evenement ".$this->param->text." n'est pas supprime !</p>
  <a href=admin.php?a=admin>Voir mes billets</a>";
  return $a;
}

public function updateBillet(){
  $a="<h3 id=\"titre_centre\">Mise a jour du billet: ".$this->param->text." </h3>";
  $a.="<form method=\"POST\" action=\"admin.php?a=updateSucces&id=".$this->param->id."\">";
  $name_surname=$_SESSION["prenom"]." ".$_SESSION["nom"];
  $a.="<input type=\"hidden\" name=\"titre\"value=\"".$name_surname."\" /><br />";
  $a.="<label for=com> Titre:</label><br />";
  $a.="<input type=text name=\"titre_update\" value=\"\" placeholder=\"Ecrivez un titre...\" /><br />";
  $a.="<label for=com> Commentaire:</label><br />";
  $a.="<textarea name=\"comment_update\" value=\"\" rows=\"4\" cols=\"30\" placeholder=\"Ecrivez un commentaire...\"></textarea><br />";
  $a.="<label for=cat> Categorie:</label><br />";
  $a.=self::ComboBoxCategories();
  $a.="<input type=\"submit\" name=\"insert\" value=\"Insert !\" />";
  $a.="</form>";
  return $a;
}

public function updateOk(){
  $a="<h3 id=\"titre_centre\">Mise a jour est faite !</h3>
  <p class=\"affichageInf\"> Votre evenement ".$this->param->text." a ete mise a jour !</p>
  <a href=blog.php?a=detail&id=".$_GET["id"].">Voir le billet</a>";
  return $a;
}

public function updateErr(){
  $a="<h3 id=\"titre_centre\">Probleme de mise a jour !</h3>
  <p class=\"affichageInf\"> Votre evenement ".$this->param->text." n'a pas ete mise a jour !</p>";
  return $a;
}

public function ErrId(){
  $a="<h3 id=\"titre_centre\">Probleme !</h3>
  <p class=\"affichageInf\"> Vous devez vous identifier pour pouvoir mettre des commentaires !</p>";
  return $a;
}

public function errIns(){
 $a="<h3 id=\"titre_centre\">Probleme !</h3>
 <p class=\"affichageInf\"> Vous devez vous identifier pour pouvoir aller dans l'administration !</p>";
 return $a;

}
public function contact(){
 $a="<h3 id=\"titre_centre\">Contact </h3>
 <p class=\"affichageInf\"> 2 ter Boulevard Charlemagne, 54000 Nancy,
 03 54 50 38 00</p><br><br>
 <p class=\"affichageInf\"> ersagunyalcintepe@gmail.com</p><br>
 <p class=\"affichageInf\"> verhooftom@gmail.com</p>";
 return $a;

}

public function deleteComSucces(){
 $a="<h3 id=\"titre_centre\">Supprime !</h3>
 <p class=\"affichageInf\"> Votre commentaire est supprime !</p>";
 return $a;

}

public function errrSup(){
 $a="<h3 id=\"titre_centre\">Probleme !</h3>
 <p class=\"affichageInf\"> Erreur de suppression !</p>";
 return $a;
}

public function client(){
 $a="<h3 id=\"titre_centre\">".$this->param->prenom." ".$this->param->nom." </h3>
 <p class=\"affichageInf\"> Email : ".$this->param->adr."</p>";
 if(isset($_SESSION) && !empty($_SESSION)){
  if($_SESSION["id"]==$this->param->id){
   $a.="<form method=\"POST\" action=\"admin.php?a=updateCli&id=".(string)$this->param->id."\" >";
   $a.="<input type=\"submit\" name=\"modifie\" value=\"modifier\"  />";
 }
}

$a.="<h3 id=\"titre_centre\">Toutes les billets de ".$this->param->prenom." ".$this->param->nom."</h3>
<ul id=\"ul-centre\">";
foreach(Billet::findByAuthor($this->param->id) as $valueb){
  $cat=Categorie::findById($valueb->cat_id);
  $valueb->cat=$cat->titre;
  $a.="<li><a href=\"blog.php?a=detail&id=".$valueb->id."\">".$valueb->__toString()."</a></li>"; 
  $a.="<ul>";
  foreach(Commentaire::findByBillet($valueb->id) as $valuec){
    $a.="<li>"."    ".$valuec->text."</li>";
  }
  $a.="</ul>";
  $a.="<br>";
}
$a.="</ul>";
return $a;

}
public function modifCli(){ 
  $a="<h3 id=\"titre_centre\">Modifier votre Profil</h3>";
  $a.="<form method=\"POST\" action=\"admin.php?a=updateCliSuc&id=".$_GET["id"]."\">";
  $a.="<label for=com> Nom:</label><br />";
  $a.="<input type=text name=\"nomCli\" value=\"\"  /><br />";
  $a.="<label for=com> Prenom:</label><br />";
  $a.="<input type=\"text\" name=\"preCli\" value=\"\" /><br />";
  $a.="<label for=cat> Email:</label><br />";
  $a.="<input type=\"email\" name=\"eCli\" value=\"\" /><br />";
  $a.="<input type=\"submit\" name=\"insert\" value=\"Modifier !\" />";
  $a.="</form>";
  return $a;
}

public function modifCliOk(){

  $a="<h3 id=\"titre_centre\">Mise a jour OK !</h3>
  <p class=\"affichageInf\"> Vous avez modifie votre profil !</p>";
  return $a;
}

public function modifCliErr(){

  $a="<h3 id=\"titre_centre\">Probleme de Mise a jour !</h3>";
  return $a;
}

public function categorie(){
  $a="<h3 id=\"titre_centre\">Inserez une Categorie</h3>";
  $a.="<form method=\"POST\" action=\"admin.php?a=insertCat\">";
  $a.="<label for=com> Titre:</label><br />";
  $a.="<input type=\"text\" name=\"titre\" /><br>";
  $a.="<label for=com> Description:</label><br />";
  $a.="<input type=\"text\" name=\"description\" /><br>";
  $a.="<input type=\"submit\" name=\"insert\" value=\"Insert !\" />";
  $a.="</form><br><br>";

  $a.="<form method=\"POST\" action=\"admin.php?a=suprimCat\">";
  $a.="<label for=cat>Choisisez la Categorie a supprimmer:</label><br />";
  $a.=self::ComboBoxCategories();
  $a.="<input type=\"submit\" name=\"insert\" value=\"Delete !\" /><br><br>";
  $a.="</form>";

  $a.="<form method=\"POST\" action=\"admin.php?a=updCat\">";
  $a.="<label for=cat>Choisisez la Categorie a faire mise a jour:</label><br />";
  $a.=self::ComboBoxCategories();
  $a.="<input type=\"submit\" name=\"insert\" value=\"Update !\" />";
  $a.="</form>";
  return $a;
}

public function insertCatSuc(){
  $a="<h3 id=\"titre_centre\">Insertion de ".$this->param->titre." OK !</h3>
  <p class=\"affichageInf\"> Vous avez ajoute 1 categorie dans le site !</p>";
  return $a;
}


public function insertCatErr(){
  $a="<h3 id=\"titre_centre\">Probleme d'insertion de la categorie !</h3>";
  return $a;
}
public function deleteCatOk(){
  $a="<h3 id=\"titre_centre\">Categorie supprime !</h3>";
  return $a;

}
public function updCat(){
  $a="<h3 id=\"titre_centre\">Modifiez la Categorie ".$_POST['ersagun']."</h3>";
  $a.="<form method=\"POST\" action=\"admin.php?a=updCatSuc&id=".Categorie::findByTitre($_POST["ersagun"])->id."\">";
  $a.="<label for=com> Titre:</label><br />";
  $a.="<input type=\"text\" name=\"titre\" /><br>";
  $a.="<label for=com> Description:</label><br />";
  $a.="<input type=\"text\" name=\"description\" /><br>";
  $a.="<input type=\"submit\" name=\"insert\" value=\"Insert !\" />";
  $a.="</form><br><br>";
  return $a;
}

public function updCatSuc(){
  $a="<h3 id=\"titre_centre\">Mise a jour OK !</h3>";
  return $a;
}

public function updCatErr(){
  $a="<h3 id=\"titre_centre\">Probleme de la mise a jour de la categorie !</h3>";
  return $a;
}
}
?>




