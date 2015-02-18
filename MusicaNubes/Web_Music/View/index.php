<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of index
 *
 * @author ersagun
 */

header('Content-Type: charset=utf-8'); 

$session_start = session_start();
//include 'lunch_autoload.php' ;
$file= file_get_contents("./view.html",  FILE_USE_INCLUDE_PATH);
/* @var $file type */
echo $file;


/**
if(!isset($_SESSION['username']) || $_SESSION['username'] == '')
{
	echo "Aucun utilisateur connecté";
}
else
{
	echo $_SESSION['username']." connecté(e)";
	echo "<form id='disconnect' action='#' method='POST'>";
	echo "<input name='button_deco' id='button_deco' type='submit' value='Déconnexion'>";
	echo "</form>";
}

if(isset($_POST['button_deco']))
{
	session_unset('username');
	session_destroy();
}
 * 
 */