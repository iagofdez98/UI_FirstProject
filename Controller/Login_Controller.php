<?php
session_start();

//Clase : Login_Controller
//Creado el : 05/10/2019
//Creado por: stwgno

//comprobar la solicitud de login
if(!isset($_REQUEST['login']) && !(isset($_REQUEST['password']))){
	include '../View/Login_View.php';
	$login = new Login();
}
else{//si no

	include '../Model/Access_DB.php';

	include '../Model/USUARIOS_Model.php';
	$usuario = new USUARIOS_Model($_REQUEST['login'],$_REQUEST['password'],'','','','','','','','');
	$respuesta = $usuario->login();

	//si la respuesta es true
	if ($respuesta == 'true'){
		session_start();
		$_SESSION['login'] = $_REQUEST['login'];
		header('Location:../index.php');
	}
	else{//si no
		include '../View/MESSAGE_View.php';
		new MESSAGE($respuesta, './Login_Controller.php');
	}

}

?>

