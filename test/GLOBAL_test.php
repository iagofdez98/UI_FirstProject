<?php
//testing funcionalidades globales
include '../Model/config.php';

function ExisteBD()
{

	global $ERRORS_array_test;

// creo array de almacen de test individual
	$global_array_test = array();

// usuario o contraseña no es correcto
//-------------------------------------------------------------------------------
	$global_array_test['entidad'] = 'GENERAL';	
	$global_array_test['metodo'] = 'BD';
	$global_array_test['error'] = 'Usuario contraseña erronea';
	$global_array_test['error_esperado'] = "Access denied for user 'iu2018'@'localhost' (using password: YES)";
	$global_array_test['error_obtenido'] = '';
	$global_array_test['resultado'] = '';

	if (!$mysqli = new mysqli(host, user, 'aaaa' , BD))
	{

	}
    	
	/* Comprueba la conexión */
	if ($mysqli->connect_errno) {
    	 $global_array_test['error_obtenido'] = $mysqli->connect_error;
    	 echo $mysqli->connect_error;
    }


   	if ($global_array_test['error_obtenido'] === $global_array_test['error_esperado'])
	{
		$global_array_test['resultado'] = 'OK';
	}
	else
	{
		$global_array_test['resultado'] = 'FALSE';
	}

	array_push($ERRORS_array_test, $global_array_test);


	//NO existe la BD
	//------------------------------------------

	$global_array_test['entidad'] = 'GENERAL';	
	$global_array_test['metodo'] = 'BD';
	$global_array_test['error'] = 'No existe la bd';
	$global_array_test['error_esperado'] = "Access denied for user 'iu2018'@'localhost' to database ";
	$global_array_test['error_obtenido'] = '';
	$global_array_test['resultado'] = '';

	$mysqli = new mysqli(host, user, pass , 'oo');
    	
	/* Comprueba la conexión */
	if ($mysqli->connect_errno) {
    	 $global_array_test['error_obtenido'] = $mysqli->connect_error;
    }


   	if ((strpos($global_array_test['error_esperado'],$global_array_test['error_obtenido'])) !== false)
	{
		$global_array_test['resultado'] = 'FALSE';
	}
	else
	{
		$global_array_test['resultado'] = 'OK';
	}

	array_push($ERRORS_array_test, $global_array_test);

    

	if ((strpos($mysqli->connect_error,"Name or service not known")) !== false)
    {
    	//la direccion no existe
    }

    if ((strpos($mysqli->connect_error,"Connection refused")) !== false)
    {
    	//el gestor no esta levantado
    }


}




function ExistenTablas()
{

}

ExisteBD();

?>