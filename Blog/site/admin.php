<?php
require_once "AdminController.php" ;
$c=new AdminController();
$c->callAction($_GET);
?>
