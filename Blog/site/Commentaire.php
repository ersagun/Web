<?php

class Commentaire{

	private $id_com;
	private $auteur;
	private $text;
	private $id_billet;

	public function __construct(){
	}

	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr,$val){
		$this->$attr=$val;
	}

	public function insert(){
		try{

			$db=Base::getConnection();
			$db->exec("SET CHARACTER SET utf8");
			$stmt=$db->prepare("insert into commentaire(auteur,text,date,id_billet) values(:aut,:text,NOW(),:idbillet)");
			$dbres=$stmt->execute(array(":aut"=>$this->auteur,":text"=>$this->text,":idbillet"=>$this->id_billet));

			$this->id_com=$db->LastInsertId('commentaire');
			return true;

		}catch(PDOException $e){
			print("probleme de connexion !");
		}
	}  

	public function update(){
	}

	public function delete(){	
		try
		{		
			$c = Base::getConnection();
			$c->exec("SET CHARACTER SET utf8");
			$query = $c->prepare( "DELETE FROM commentaire WHERE id_com=?;");

			// Liaison du paramètre

			$query->bindParam (1, $this->id_com, PDO::PARAM_INT);

			// éxécute la requête

			return $query->execute();
		}
		catch(BaseException $e)
		{
			print "Exception!</ br>";
		}
	}

	public static function findByAuteur($auteur){
		try{
			$db=Base::getConnection();
			$db->exec("SET CHARACTER SET utf8");
			$stmt=$db->prepare('Select * from commentaire where auteur=:aut');
			$rep=$stmt->execute(array(':aut'=>$auteur));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			$com=new Commentaire();
			$com->auteur=$row["auteur"];
			$com->text=$row["text"];
			$com->id_com=$row["id_com"];

			if(!empty($row["text"])){
				return $com;
			}
			else{ return null;}
		}catch(PDOException $f){
			return null;
		}
	}

	public static function findById($id){
		try{
			$db=Base::getConnection();
			$db->exec("SET CHARACTER SET utf8");
			$stmt=$db->prepare('Select * from commentaire where id_com=:id');
			$rep=$stmt->execute(array(':id'=>$id));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			$com=new Commentaire();
			$com->auteur=$row["auteur"];
			$com->text=$row["text"];
			$com->id_com=$row["id_com"];
			if(isset($row["text"])){
				return $com;
			}
			else{ return "err";}
		}catch(PDOException $f){
			return null;
		}
	}

	public function __toString(){
		return "I: ". $this->id.", Titre: ".$this->titre.", : ".$this->body." Categorie: ".$this->cat.", Date: ".$this->date;
	}

	public static function findByBillet($id_billet){
		try{
			$db=Base::getConnection();
			$db->exec("SET CHARACTER SET utf8");
			$stmt=$db->prepare('Select * from commentaire where id_billet=:id');
			$stmt->execute(array(':id'=>$id_billet));
			$i=0;
			$par=array();
			while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
				$com=new Commentaire();
				$com->auteur=$row["auteur"];
				$com->text=$row["text"];
				$com->id_com=$row["id_com"];

				$par[$i]=$com;
				$i=$i+1;
			}

		}catch(PDOException $f){
			return null;
		}
		return $par;
	}
}
?>