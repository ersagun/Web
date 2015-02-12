<?php

require_once "BaseException.php";

class Base{

	private static $dblink;

	private static function connect(){
		try {
			require_once "config.php";

			$dsn="mysql:host=".$host.";"."dbname=".$dbname;
			$db = new PDO($dsn, $user,$password,array(PDO::ERRMODE_EXCEPTION=>true,PDO::ATTR_PERSISTENT=>true));
		} catch(PDOException $e) {
			throw new BaseException("connection: $dsn ".$e->getMessage(). '<br/>');
		}
		return $db;
	}

	public static function getConnection(){

		if(isset(self::$dblink)){
			return self::$dblink;
		}else{
			self::$dblink=self::connect();
			return self::$dblink;
		}
	}
}
?>