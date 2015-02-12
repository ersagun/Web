<?php

require_once('Base.php');
require_once('BaseException.php');
require_once('Categorie.php');
require_once('Billet.php');


class Billet 
{
	  /**
	   *  Identifiant de billet
	   *  @access private
	   *  @var integer
	   */
	  private $id ; 


	  /**
	   *  libelle de billet
	   *  @access private
	   *  @var String
	   */
	  private $titre;

	  /**
	   *  description de billet
	   *  @access private
	   *  @var String
	   */
	  private $text;
	  
	  /**
	   * clé étrangère de la catégorie correspondant à ce billet
	   * @access private
	   * @var integer
	   */

	  
	  private $cat_id;
	  
	  public $cat;
	  
	  /**
	   * La date a laquelle l'auteur ecrit le billet.
	   * @access private
	   * @var date
	   */
	  
	  private $date;

          	  /**
	   * L'auteur.
	   * @access private
	   * @var date
	   */
          	  private $auteur;




	  // Constructeur


	  /**
	   *  Constructeur de Billet
	   *
	   *  fabrique un nouveau billet vide
	   */

	  public function __construct() {
// rien à faire
	  }

	  public function __set($attr,$val) {
	  	$this->$attr=$val;

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

  /**
	   *   Insertion dans la base
	   *
	   *   Insère l'objet comme une nouvelle ligne dans la table
	   *   l'objet doit posséder un code_rayon
	   *
	   *   @return int nombre de lignes insérées
	   */

  public function insert() 
  {
  	try
  	{		
  		$c = Base::getConnection();
  		$c->exec("SET CHARACTER SET utf8");
  		$query = $c->prepare("INSERT INTO billets (titre, body, cat_id, auteur, date)
  			VALUES (:titre, :text, :cat_id, :auteur, NOW());");

			// On éxécute la requête en liant les paramètres

  		$exec = $query->execute(array(':titre' => $this->titre,
  			':text' => $this->text,
  			':cat_id' => $this->cat_id, 
  			':auteur' => $this->auteur));

			// On récupère l'identifiant de la catégorie

  		$this->id = $c->LastInsertID('billet');		

			// On retourne le résultat de l'éxéution

  		return $exec;
  	}
  	catch(BaseException $e)
  	{
  		print "Exception!</ br>";
  		throw new BaseException($e->getMessage());
  	}

  }

	  	  /**
	   *   Suppression dans la base
	   *
	   *   Supprime la ligne dans la table corrsepondant à l'objet courant
	   *   L'objet doit posséder un OID
	   */


	  	  public function delete() 
	  	  {		
	  	  	try
	  	  	{		
	  	  		$c = Base::getConnection();
	  	  		$c->exec("SET CHARACTER SET utf8");
	  	  		$query = $c->prepare( "DELETE FROM billets WHERE id=?;");

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
	   *   mise a jour de la ligne courante
	   *   
	   *   Sauvegarde l'objet courant dans la base en faisant un update
	   *   l'identifiant de l'objet doit exister (insert obligatoire auparavant)
	   *   méthode privée - la méthode publique s'appelle save.
	   *   On suppose que le champ date, représentant la date de création 
	   *   du billet, n'est pas modifiable.
	   *   @acess public
	   *   @return int nombre de lignes mises à jour
	   */

	  public function update() 
	  {	  
	  	if (!isset($this->id)) 
	  	{
	  		throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
	  	} 

	  	$c = Base::getConnection();
	  	$c->exec("SET CHARACTER SET utf8");
	  	$query = $c->prepare( "update billets set titre= ?, body= ?,
	  		cat_id= ?, date=NOW() where id=?;");

		/* 
		 * liaison des paramêtres : 
		*/
		
		$query->bindParam (1, $this->titre, PDO::PARAM_STR);
		$query->bindParam (2, $this->text, PDO::PARAM_STR); 
		$query->bindParam (3, $this->cat_id, PDO::PARAM_INT);
		$query->bindParam (4, $this->id, PDO::PARAM_INT);
		
		/*
		 * exécution de la requête
		 */

		return $query->execute();
	}


	public function __toString() {
		return "[". __CLASS__ . "] Titre : ". $this->titre . " - 
		Texte : ". $this->text ." - 
		Categorie : ". $this->cat  ." - 
		Auteur : ".client::findById($this->auteur)->nom." ".client::findById($this->auteur)->prenom. " - 
		Date : ". $this->date  ;
	}


/**
	   *   Finder sur ID
	   *
	   *   Retrouve la ligne de la table correspondant au ID passé en paramètre,
	   *   retourne un objet
	   *  
	   *   @static
	   *   @param integer $id OID to find
	   *   @return Billet renvoie un objet de type Billet
	   */

public static function findById($id) 
{
	try
	{
		$c = Base::getConnection();
		$c->exec("SET CHARACTER SET utf8");
		$query = $c->prepare("SELECT * FROM billets where id=?;") ;
		$query->bindParam(1, $id, PDO::PARAM_INT);
		$dbres = $query->execute();

		$d = $query->fetch(PDO::FETCH_BOTH);      

				// On crée un nouvel objet Billet à partir de la ligne de la table
		if($dbres){
			$o = new Billet();
			$o->id = $d['id'];
			$o->titre = $d['titre'];
			$o->text = $d['body'];
			$o->cat_id = $d['cat_id'];
			$o->date = $d['date'];	
			$o->auteur = $d['auteur'];
			$o->cat = Categorie::findByTitre($d['cat_id'])->titre;	
		}else{
			return null;
		}

		return $o;
	}
	catch(BaseException $e)
	{
		print "Exception!</ br>";
	}
}

/*
		 *	Finder sur l'attribut Titre
		 *
		 *  Retrouve la ligne de la table correspondant au titre passé en paramètre,
		 *  retourne un objet
	     *  
	     *   @static
	     *   @param integer $titre Le titre to find
	     *   @return Billet renvoie un objet de type Billet
	     */

public static function findByTitre($titre)
{
	try
	{
		$c = Base::getConnection();
		$c->exec("SET CHARACTER SET utf8");
		$query = $c->prepare("SELECT * FROM billets where titre=?") ;
		$query->bindParam(1, $titre, PDO::PARAM_STR);
		$dbres = $query->execute();

		$d = $query->fetchALL(PDO::FETCH_OBJ);
		$i = 0;
		$tab = array();

		foreach($d as $row)
		{	
					// On crée un nouvel objet Billet à partir de la ligne de la table

			$tab[$i] = new Billet();
			$tab[$i]->id = $row->id;
			$tab[$i]->titre =  $row->titre;
			$tab[$i]->text = $row->body;
			$tab[$i]->cat_id = $row->cat_id;
			$tab[$i]->date = $row->date;
			$tab[$i]->auteur = $row->auteur;
			$tab[$i]->cat = Categorie::findByTitre($row->cat_id)->titre;			
			$i++;
		}			

		return $tab;
	}
	catch(BaseException $e)
	{
		print "Exception!</ br>";
	}
}

public static function findByCat( $cat ) {

	$db=Base::getConnection() ;
	$db->exec("SET CHARACTER SET utf8");
	try{
		$stmt =$db->prepare('Select * from billets where cat_id = :cat');
		$stmt->execute(array(':cat' =>$cat)) ;
		$i=0;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$a = new Billet();
			$a->id = $row['id'];
			$a->titre= $row['titre'];
			$a->text=$row['body'];
			$a->cat_id=$row['cat_id'];
			$a->date=$row['date'];
			$a->auteur=$row['auteur'];
			$c=Categorie::findByTitre($row['cat_id']);
			$a->cat = $c->titre;
			$param[$i]=$a;
			$i=$i+1;
		}
		if(!isset($param)){
			return null;
		}
		else{
			return $param;
		}
	} catch (PDOException $e) { 
		return null ; }
	}

	/**
		 *   Finder All
		 *
		 *   Renvoie toutes les lignes de la table billet
		 *   sous la forme d'un tableau d'objet
		 *  
		 *   @static
		 *   @return Array renvoie un tableau de billet
		 */

	public static function findAll() 
	{
		try
		{
			$c = Base::getConnection();
			$c->exec("SET CHARACTER SET utf8");
			$query = $c->prepare("SELECT * FROM billets;") ;
			$query->execute();

			$res = $query->fetchALL(PDO::FETCH_OBJ);
			$i = 0;
			$tab = array();

			foreach($res as $row)
			{	
					// On crée un nouvel objet Billet à partir de la ligne de la table

				$tab[$i] = new Billet();
				$tab[$i]->id = $row->id;
				$tab[$i]->titre =  $row->titre;
				$tab[$i]->text = $row->body;
				$tab[$i]->cat_id = $row->cat_id;
				$tab[$i]->date = $row->date;	
				$tab[$i]->auteur = $row->auteur;	
				$tab[$i]->cat = Categorie::findById($row->cat_id)->titre;			
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
		 *   Finder All
		 *
		 *   Renvoie les x derniers billets lorsque la
		 *   table est triée par date. On obtient donc les 
		 *	 10 billets les plus récents.
		 *  
		 *   @static
		 *   @return Array renvoie un tableau de billets
		 */

public static function findXDerniers($x)
{
	try
	{
		$c = Base::getConnection();
		$c->exec("SET CHARACTER SET utf8");
		$query = $c->prepare("SELECT * FROM billets ORDER BY date DESC LIMIT 0, ?;");
		$query->BindParam(1, $x, PDO::PARAM_INT);
		$query->execute();

		$res = $query->fetchALL(PDO::FETCH_OBJ);
		$i = 0;
		$tab = array();

		foreach($res as $row)
		{	
					// On crée un nouvel objet Billet à partir de la ligne de la table

			$tab[$i] = new Billet();
			$tab[$i]->id = $row->id;
			$tab[$i]->titre =  $row->titre;
			$tab[$i]->text = $row->body;
			$tab[$i]->cat_id = $row->cat_id;
			$tab[$i]->date = $row->date;
			$tab[$i]->auteur = $row->auteur;
			$tab[$i]->cat = Categorie::findByTitre($row->cat_id)->titre;					
			$i++;
		}			

		return $tab;
	}
	catch(BaseException $e)
	{
		print "Exception!</ br>";
	}
}


public static function findByAuthor($id) 
{
	try
	{
		$c = Base::getConnection();
		$c->exec("SET CHARACTER SET utf8");
		$query = $c->prepare("SELECT * FROM billets where auteur=?;") ;
		$query->bindParam(1, $id, PDO::PARAM_INT);
		$dbres = $query->execute();

		$res = $query->fetchALL(PDO::FETCH_OBJ);
		$i = 0;
		$tab = array();
		if($dbres){

			foreach($res as $row)
			{	
					// On crée un nouvel objet Billet à partir de la ligne de la table

				$tab[$i] = new Billet();
				$tab[$i]->id = $row->id;
				$tab[$i]->titre =  $row->titre;
				$tab[$i]->text = $row->body;
				$tab[$i]->cat_id = $row->cat_id;
				$tab[$i]->date = $row->date;	
				$tab[$i]->auteur = $row->auteur;	
				$tab[$i]->cat = Categorie::findById($row->cat_id)->titre;			
				$i++;
			}
			return $tab;
		}else{
			return null;
		}
	}
	catch(BaseException $e)
	{
		print "Exception!</ br>";
	}
}

}
?>