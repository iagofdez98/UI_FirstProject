<?php

//Clase : Index_Controller
//Creado el : 05/10/2019
//Creado por: stwgno

//session
session_start();
//incluir funcion autenticacion
include '../Functions/Authentication.php';
//si no esta autenticado
if (!IsAuthenticated()){
	header('Location: ../index.php');
}
//Esta autenticado
else{
	include '../View/users_index_View.php';
	new Index();
}

?>