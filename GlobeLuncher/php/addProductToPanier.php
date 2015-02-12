<?php
	session_start();
	$idP = $_GET['idP'];
	$qte = $_GET['qte'];
	$addPanier =  array('idp' =>$idP, 'qte' =>$qte);
	if(!isset($_SESSION['panier'])){
		$_SESSION['panier'] = array();
	}
	array_push($_SESSION['panier'],$addPanier);
	header('location:../choixProduit.php');
?>