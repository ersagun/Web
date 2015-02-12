<?php
require_once "ClientController.php" ;
$c=new ClientController();
$c->callAction($_GET);
?>
