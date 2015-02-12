<?php
require_once "BlogController.php" ;
$c=new BlogController();
$c->callAction($_GET);
?>
