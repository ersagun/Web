<?php
require_once("Base.php");
require_once("BaseException.php");
class client{
	private $id;
	private $nom;
	private $prenom;
	private $adr;
	private $pass;


	public function __construct(){

	}

	public function __set($att,$val){
		$this->$att=$val;
	}

	public function __get($att){
		return $this->$att;
	}


	public function insertCli(){
		if($this->nom!="" && $this->prenom!=""&& $this->adr!="" && $this->pass!=""){
			$db=Base::getConnection();
			$db->exec("SET CHARACTER SET utf8");
			try{
				$query ="insert into client(nom,prenom,email,password) values (:n,:pre,:em,:p)";
				$stmt=$db->prepare($query);	
				$stmt->execute(array(':n' =>$this->nom,':pre'=>$this->prenom,':em'=>$this->adr,':p'=>sha1($this->pass))) ;
				return true;
			} catch (PDOException $e){
				throw new BaseException($e->getMessage());
			}	
		}
		else{
			return false;
		} 
	}

	public function update() 
	{	  
		if (!isset($this->id)) 
		{
			throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
		} 

		$c = Base::getConnection();
		$c->exec("SET CHARACTER SET utf8");
		$query = $c->prepare( "update client set nom= ?, prenom= ?,
			email= ? where id=?");

		/* 
		 * liaison des paramêtres : 
		*/
		
		$query->bindParam (1, $this->nom, PDO::PARAM_STR);
		$query->bindParam (2, $this->prenom, PDO::PARAM_STR); 
		$query->bindParam (3, $this->adr, PDO::PARAM_STR);
		$query->bindParam (4, $this->id, PDO::PARAM_INT);

		
		/*
		 * exécution de la requête
		 */

		return $query->execute();
	}

	public static function verifCli($adresse,$pass){

		$db=Base::getConnection();
		$db->exec("SET CHARACTER SET utf8");
		try{
			$stmt=$db->prepare('SELECT * FROM client WHERE email=:e');
			$hash=sha1($pass);
			$dbres=$stmt->execute(array(':e'=>$adresse));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			if(isset($row["nom"])&& isset($row["prenom"]) && isset($row["email"])){
				if($row['password']==$hash){
					$client=new client();
					$client->nom=$row["id"];
					$client->nom=$row["nom"];
					$client->prenom=$row["prenom"];
					$client->email=$row["email"];
					session_start();
					$_SESSION["id"]=$row["id"];
					$_SESSION["nom"]=$row["nom"];	 
					$_SESSION["prenom"]=$row["prenom"];	 
					$_SESSION["adresse"]=$row["email"];

					return true;
				} 
			}
			else{
				return false;
			}
		}catch(PDOException $k){
			return false;
		}

	}

	public static function deconnexion(){
		session_start();
		session_destroy();
	}

	public static function findById($id) 
	{
		try
		{
			$c = Base::getConnection();
			$c->exec("SET CHARACTER SET utf8");
			$query = $c->prepare("SELECT * FROM client where id=?;") ;
			$query->bindParam(1, $id, PDO::PARAM_INT);
			$dbres = $query->execute();

			$d = $query->fetch(PDO::FETCH_BOTH);      

				// On crée un nouvel objet Billet à partir de la ligne de la table

			$o = new Client();
			$o->id = $d['id'];
			$o->nom = $d['nom'];
			$o->prenom = $d['prenom'];
			$o->adr= $d['email'];
			$o->pass = $d['password'];			
			return $o;
		}
		catch(BaseException $e)
		{
			print "Exception!</ br>";
		}
	}
}
?>