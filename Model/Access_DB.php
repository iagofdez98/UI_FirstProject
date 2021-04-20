<?php
//----------------------------------------------------
// DB connection function
// stwgno
// Can be modified to use CONSTANTS defined in config.inc
//----------------------------------------------------
include_once '../Model/config.php';

function ConnectDB()
{
    $mysqli = new mysqli(host, user, pass , BD);
    	
	if ($mysqli->connect_errno) {
		include './MESSAGE_View.php';
		new MESSAGE("Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error, './index.php');
		return false;
	}
	else{
		return $mysqli;
	}
}

?>
