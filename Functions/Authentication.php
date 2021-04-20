<?php
/*
function IsAuthenticated()
stwgno
07//10/2019
Esta función valida si existe la variable de session login
Si no existe redirige a la pagina de login
Si existe comprueba si el usuario tiene permisos para ejecutar la accion de ese controlador
*/
function IsAuthenticated(){
	//comprueba si esta autenticado y devuelve true o false
	if (!isset($_SESSION['login'])){
		return false;
	}
	else{
		return true;
	}
} //end of function IsAuthenticated()
?>

