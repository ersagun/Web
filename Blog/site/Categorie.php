<?php

require_once "Base.php";
require_once "BaseException.php";

  /**
   * File : Categorie.php
   *
   * @author G. Canals
   *
   *
   * @package blog
   */

/**
 *  La classe Categorie
 *
 *  La Classe Categorie  realise un Active Record sur la table categorie
 *  
 *
 *  @package blog
 */
class Categorie {

/**
   *  Identifiant de categorie
   *  @access private
   *  @var integer
   */
private $id ; 


  /**
   *  libelle de categorie
   *  @access private
   *  @var String
   */
  private $titre;

  /**
   *  description de categorie
   *  @access private
   *  @var String
   */
  private $description;


  /**
   *  Constructeur de Categorie
   *
   *  fabrique une nouvelle categorie vide
   */
  
  public function __construct() {
    // rien à faire
  }


 /**
   *  Magic pour imprimer
   *
   *  Fonction Magic retournant une chaine de caracteres imprimable
   *  pour imprimer facilement un Ouvrage
   *
   *  @return String
   */
 public function __toString() {
 	return "[". __CLASS__ . "] id : ". $this->id . ":
 	titre  ". $this->titre  .":
 	description ". $this->description  ;
 }

 public function __get($attr) {
 	if(property_exists(__CLASS__,$attr)){
 		return $this->$attr;
 	}
 	$emess= __CLASS__.": unknown member $attr (getAttr)";
 	throw new Exception($emess, 45);
 }

 public function SetAttr($attr,$val){
 	$this->$attr=$val;
 }

 public function __set($attr,$val) {
 	if(property_exists(__CLASS__,$attr)){
 		$this->$attr=$val;
 	}
 }  


/**
   *   mise a jour de la ligne courante
   *   
   *   Sauvegarde l'objet courant dans la base en faisant un update
   *   l'identifiant de l'objet doit exister (insert obligatoire auparavant)
   *   méthode privée - la méthode publique s'appelle save
   *   @acess public
   *   @return int nombre de lignes mises à jour
   */
public function update() {

	if (!isset($this->id)) {
		throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
	} 

	$c = Base::getConnection();


	$query = $c->prepare( "update categorie set titre= ?, description= ?
		where id=?");

    /* 
     * liaison des paramêtres : 
    */
    $query->bindParam (1, $this->titre, PDO::PARAM_STR);
    $query->bindParam (2, $this->description, PDO::PARAM_STR); 
    $query->bindParam (3, $this->id, PDO::PARAM_INT); 

    /*
     * exécution de la requête
     */

    return $query->execute();
}

   /**
   *   Suppression dans la base
   *
   *   Supprime la ligne dans la table corrsepondant à l'objet courant
   *   L'objet doit posséder un OID
   */
   
   public function delete() 
   {
   	if (!isset($this->id)) 
   	{
   		throw new Exception(__CLASS__ . ": Primary Key undefined : cannot delete");
   	}

   	try
   	{		
   		$c = Base::getConnection();
   		$query = $c->prepare( "DELETE FROM categorie WHERE id=?;");

			// Liaison du paramètre

   		$query->bindParam (1, $this->id, PDO::PARAM_INT);

			// éxécute la requête

   		return $query->execute();
   	}
   	catch(BaseException $e)
   	{
   		print "Exception!</ br>";
   	}
   }

/**
   *   Insertion dans la base
   *
   *   Insère l'objet comme une nouvelle ligne dans la table
   *   l'objet doit posséder  un code_rayon
   *
   *   @return int nombre de lignes insérées
   */

public function insert() 
{
	try
	{		
		$c = Base::getConnection();
		$query = $c->prepare("INSERT INTO categorie (titre, description)
			VALUES (:tit, :des)");

			// On éxécute la requête en liant les paramètres

		$exec = $query->execute(array(':tit' => $this->titre,
			':des' => $this->description));

			// On récupère l'identifiant de la catégorie

		$this->id = $c->LastInsertID('categorie');		

			// On retourne le résultat de l'éxéution

		return $exec;
	}
	catch(BaseException $e)
	{
		print "Exception!</ br>";
	}
}		

/**
   *   Finder sur ID
   *
   *   Retrouve la ligne de la table correspondant au ID passé en paramètre,
   *   retourne un objet
   *  
   *   @static
   *   @param integer $id OID to find
   *   @return Categorie renvoie un objet de type Categorie
   */

public static function findById($id) 
{	
	try
	{
		$c = Base::getConnection();
		$c->exec("SET CHARACTER SET utf8");
		$query = $c->prepare("SELECT * FROM categorie where id=?") ;
		$query->bindParam(1, $id, PDO::PARAM_INT);
		$dbres = $query->execute();

		$d = $query->fetch(PDO::FETCH_BOTH);      

			// On crée un nouvel objet Categorie à partir de la ligne de la table

		$o = new Categorie();
		$o->id = $d['id'];
		$o->titre = $d['titre'];
		$o->description = $d['description'];			

		return $o;
	}
	catch(BaseException $e)
	{
		print "Exception!</ br>";
	}
}


  /**
     *   Finder All
     *
     *   Renvoie toutes les lignes de la table categorie
     *   sous la forme d'un tableau d'objet
     *  
     *   @static
     *   @return Array renvoie un tableau de categorie
     */

  public static function findAll() 
  {
  	try
  	{
  		$c = Base::getConnection();
  		$c->exec("SET CHARACTER SET utf8");
  		$query = $c->prepare("SELECT * FROM categorie") ;
  		$query->execute();

  		$res = $query->fetchALL(PDO::FETCH_OBJ);
  		$i = 0;
  		$tab=array();

  		foreach($res as $row)
  		{	
				// On crée un nouvel objet Categorie à partir de la ligne de la table

  			$tab[$i] = new Categorie();
  			$tab[$i]->id = $row->id;
  			$tab[$i]->titre =  $row->titre;
  			$tab[$i]->description = $row->description;				
  			$i++;
  		}			

  		return $tab;
  	}
  	catch(BaseException $e)
  	{
  		print "Exception!</ br>";
  	}
  }

 /**
   *   Finder sur titre
   *
   *   Retrouve la ligne de la table correspondant au titre passé en paramètre,
   *   retourne un objet
   *  
   *   @static
   *   @param integer $titre Le titre à trouver
   *   @return Categorie renvoie un objet de type Categorie
   */

 public static function findByTitre($titre) 
 {	
 	try
 	{
 		$c = Base::getConnection();
 		$query = $c->prepare("SELECT * FROM categorie where titre=?") ;
 		$query->bindParam(1,$titre,PDO::PARAM_STR);
 		$dbres = $query->execute();

 		$d = $query->fetch(PDO::FETCH_BOTH);      

			// On crée un nouvel objet Categorie à partir de la ligne de la table

 		$o = new Categorie();
 		$o->id = $d['id'];
 		$o->titre = $d['titre'];
 		$o->description = $d['description'];			

 		return $o;
 	}
 	catch(BaseException $e)
 	{
 		print "Exception!</ br>";
 	}
 }
}
?>
