<?php

//Clase : Register_Controller
//Creado el : 05/10/2019
//Creado por: stwgno

session_start();
include_once '../Locale/Strings_'.$_SESSION['idioma'].'.php';

//session_start();

//se registra al usuario
if(!isset($_POST['login'])){
	include '../View/Register_View.php';
	$register = new Register();
}
else{//si no
		
	include '../Model/USUARIOS_Model.php';
	$usuario = new USUARIOS_Model($_REQUEST['login'],$_REQUEST['password'],$_REQUEST['nombre'],
		$_REQUEST['apellidos'],$_REQUEST['email'],$_REQUEST['dni'],$_REQUEST['telefono'],$_REQUEST['FechaNacimiento'],$_REQUEST['fotopersonal'],$_REQUEST['sexo']);
	$respuesta = $usuario->Register();

	//si la respuesta es afirmativa
	if ($respuesta == 'true'){
		$respuesta = $usuario->registrar();
		Include '../View/MESSAGE_View.php';
		new MESSAGE($respuesta, './Login_Controller.php');
	}
	else{//si no
		include '../View/MESSAGE_View.php';
		new MESSAGE($respuesta, './Login_Controller.php');
	}

}

?>

