<?php
// Autor : jrodeiro
// Fecha : 23/9/2019
// Descripción : 
//	Fichero de test de unidad de la entidad USUARIOS
//	Saca por pantalla el resultado de los test
// incluir el modelo de la entidad USUARIOS
	include '../Model/USUARIOS_Model.php';

// function USUARIOS_Login_test()
// Valida:
//		login no existente
//		password no correcta para el login
//		login correcto

function USUARIOS_login_test()
{

	global $ERRORS_array_test;
// creo array de almacen de test individual
	$USUARIOS_array_test1 = array();

// Comprobar el login no existe
//-------------------------------------------------------------------------------
	$USUARIOS_array_test1['entidad'] = 'USUARIOS';	
	$USUARIOS_array_test1['metodo'] = 'login';
	$USUARIOS_array_test1['error'] = 'El login no existe';
	$USUARIOS_array_test1['error_esperado'] = 'El login no existe';
	$USUARIOS_array_test1['error_obtenido'] = '';
	$USUARIOS_array_test1['resultado'] = '';
	
	$login = 'loginerror';
	$usuarios = new USUARIOS_Model($login,'','','','');
	$USUARIOS_array_test1['error_obtenido'] = $usuarios->login();
	if ($USUARIOS_array_test1['error_obtenido'] === $USUARIOS_array_test1['error_esperado'])
	{
		$USUARIOS_array_test1['resultado'] = 'OK';
	}
	else
	{
		$USUARIOS_array_test1['resultado'] = 'FALSE';
	}

	array_push($ERRORS_array_test, $USUARIOS_array_test1);

// Comprobar La password para este usuario no es correcta
//-------------------------------------------------------------------------------
	$USUARIOS_array_test1['entidad'] = 'USUARIOS';	
	$USUARIOS_array_test1['metodo'] = 'login';
	$USUARIOS_array_test1['error'] = 'La password para este usuario no es correcta';
	$USUARIOS_array_test1['error_esperado'] = 'La password para este usuario no es correcta';
	$USUARIOS_array_test1['error_obtenido'] = '';
	$USUARIOS_array_test1['resultado'] = '';
	
	// Relleno los datos de usuario	
	$login = 'miusuario';
	$password = 'mipassword';
	$nombre = 'minombre'; 
	$apellidos = 'miapellido';
	$email = 'miemail@uvigo.es';
// creo el modelo
	$usuarios = new USUARIOS_Model($login,$password,$nombre,$apellidos,$email);
// inserto la tupla
	$usuarios->ADD();
// cambio la password en el objeto modelo usuario
	$usuarios->password = 'passwordfalsa';

	$USUARIOS_array_test1['error_obtenido'] = $usuarios->login();
	if ($USUARIOS_array_test1['error_obtenido'] === $USUARIOS_array_test1['error_esperado'])
	{
		$USUARIOS_array_test1['resultado'] = 'OK';
	}
	else
	{
		$USUARIOS_array_test1['resultado'] = 'FALSE';
	}
	
	array_push($ERRORS_array_test, $USUARIOS_array_test1);		
// elimino la tupla
	$usuarios->DELETE();

// Comprobar login exitoso
//-------------------------------------------------------------------------------
	$USUARIOS_array_test1['entidad'] = 'USUARIOS';	
	$USUARIOS_array_test1['metodo'] = 'login';
	$USUARIOS_array_test1['error'] = 'Login Correcto';
	$USUARIOS_array_test1['error_esperado'] = true;
	$USUARIOS_array_test1['error_obtenido'] = '';
	$USUARIOS_array_test1['resultado'] = '';

// Relleno los datos de usuario	
	$login = 'miusuario';
	$password = 'mipassword';
	$nombre = 'minombre'; 
	$apellidos = 'miapellido';
	$email = 'miemail@uvigo.es';
// creo el modelo
	$usuarios = new USUARIOS_Model($login,$password,$nombre,$apellidos,$email);
// inserto la tupla
	$usuarios->ADD();
// pruebo el login
	$USUARIOS_array_test1['error_obtenido'] = $usuarios->login();
	if ($USUARIOS_array_test1['error_obtenido'] === $USUARIOS_array_test1['error_esperado'])
	{
		$USUARIOS_array_test1['resultado'] = 'OK';
	}
	else
	{
		$USUARIOS_array_test1['resultado'] = 'FALSE';
	}
	
	array_push($ERRORS_array_test, $USUARIOS_array_test1);	
// elimino la tupla
	$usuarios->DELETE();

}


// function USUARIOS_Register_test()
// Valida:
//		usuario ya existe
//		el usuario no existe
//		

function USUARIOS_Registrar_test()
{

	global $ERRORS_array_test;
// creo array de almacen de test individual
	$USUARIOS_array_test1 = array();

// Comprobar el login existe
	$USUARIOS_array_test1['entidad'] = 'USUARIOS';	
	$USUARIOS_array_test1['metodo'] = 'register';
	$USUARIOS_array_test1['error'] = 'El usuario ya existe';
	$USUARIOS_array_test1['error_esperado'] = 'El usuario ya existe';
	$USUARIOS_array_test1['error_obtenido'] = '';
	$USUARIOS_array_test1['resultado'] = '';
	
	// Relleno los datos de usuario	
	$login = 'miusuario';
	$password = 'mipassword';
	$nombre = 'minombre'; 
	$apellidos = 'miapellido';
	$email = 'miemail@uvigo.es';
// creo el modelo
	$usuarios = new USUARIOS_Model($login,$password,$nombre,$apellidos,$email);
// inserto la tupla
	$usuarios->ADD();

	$USUARIOS_array_test1['error_obtenido'] = $usuarios->register();
	if ($USUARIOS_array_test1['error_obtenido'] === $USUARIOS_array_test1['error_esperado'])
	{
		$USUARIOS_array_test1['resultado'] = 'OK';
	}
	else
	{
		$USUARIOS_array_test1['resultado'] = 'FALSE';
	}

	array_push($ERRORS_array_test, $USUARIOS_array_test1);

	$usuarios->DELETE();	

// Comprobar el usuario no existe
	$USUARIOS_array_test1['entidad'] = 'USUARIOS';	
	$USUARIOS_array_test1['metodo'] = 'register';
	$USUARIOS_array_test1['error'] = 'El usuario no existe';
	$USUARIOS_array_test1['error_esperado'] = true;
	$USUARIOS_array_test1['error_obtenido'] = '';
	$USUARIOS_array_test1['resultado'] = '';
	
	$login = 'jrodeiro23223';
	$usuarios = new USUARIOS_Model($login,'','','','');
	$USUARIOS_array_test1['error_obtenido'] = $usuarios->register();
	if ($USUARIOS_array_test1['error_obtenido'] === $USUARIOS_array_test1['error_esperado'])
	{
		$USUARIOS_array_test1['resultado'] = 'OK';
	}
	else
	{
		$USUARIOS_array_test1['resultado'] = 'FALSE';
	}

	array_push($ERRORS_array_test, $USUARIOS_array_test1);

// Comprobar error en la inserción
	$USUARIOS_array_test1['entidad'] = 'USUARIOS';	
	$USUARIOS_array_test1['metodo'] = 'registrar';
	$USUARIOS_array_test1['error'] = 'Error en la inserción';
	$USUARIOS_array_test1['error_esperado'] = 'Error de gestor de base de datos';
	$USUARIOS_array_test1['error_obtenido'] = '';
	$USUARIOS_array_test1['resultado'] = '';
	
	$login = 'jrodeiro887';
	$password = 'javi';
	$nombre = 'javi\' ,\'kdfalkj'; 
	$apellidos = 'rodeiro';
	$email = 'jrodeiro@uvigo.es';

	$usuarios = new USUARIOS_Model($login,$password,$nombre,$apellidos,$email);
	$USUARIOS_array_test1['error_obtenido'] = $usuarios->registrar();
	if ($USUARIOS_array_test1['error_obtenido'] === $USUARIOS_array_test1['error_esperado'])
	{
		$USUARIOS_array_test1['resultado'] = 'OK';
	}
	else
	{
		$USUARIOS_array_test1['resultado'] = 'FALSE';
	}

	array_push($ERRORS_array_test, $USUARIOS_array_test1);	

	$usuarios->DELETE();

// Comprobar Inserción realizada con éxito
	$USUARIOS_array_test1['entidad'] = 'USUARIOS';	
	$USUARIOS_array_test1['metodo'] = 'registrar';
	$USUARIOS_array_test1['error'] = 'Inserción realizada con éxito';
	$USUARIOS_array_test1['error_esperado'] = 'Inserción realizada con éxito';
	$USUARIOS_array_test1['error_obtenido'] = '';
	$USUARIOS_array_test1['resultado'] = '';
	
	$login = 'jrodeiro1';
	$password = 'javi';
	$nombre = 'javi'; 
	$apellidos = 'rodeiro';
	$email = 'jrodeiro1@uvigo.es';

	$usuarios = new USUARIOS_Model($login,$password,$nombre,$apellidos,$email);
	$USUARIOS_array_test1['error_obtenido'] = $usuarios->registrar();
	if ($USUARIOS_array_test1['error_obtenido'] === $USUARIOS_array_test1['error_esperado'])
	{
		$USUARIOS_array_test1['resultado'] = 'OK';
	}
	else
	{
		$USUARIOS_array_test1['resultado'] = 'FALSE';
	}

	array_push($ERRORS_array_test, $USUARIOS_array_test1);

	$usuarios->DELETE();


}

// function USUARIOS_Register_test()
// Valida:
//		usuario ya existe
//		el usuario no existe
//		

function USUARIOS_ADD_test()
{

	global $ERRORS_array_test;
// creo array de almacen de test individual
	$USUARIOS_array_test1 = array();

// Comprobar el login existe
	$USUARIOS_array_test1['entidad'] = 'USUARIOS';	
	$USUARIOS_array_test1['metodo'] = 'ADD';
	$USUARIOS_array_test1['error'] = 'El usuario ya existe';
	$USUARIOS_array_test1['error_esperado'] = 'Inserción fallida: el elemento ya existe';
	$USUARIOS_array_test1['error_obtenido'] = '';
	$USUARIOS_array_test1['resultado'] = '';
	
	// Relleno los datos de usuario	
	$login = 'miusuario';
	$password = 'mipassword';
	$nombre = 'minombre'; 
	$apellidos = 'miapellido';
	$email = 'miemail@uvigo.es';
// creo el modelo
	$usuarios = new USUARIOS_Model($login,$password,$nombre,$apellidos,$email);
// inserto la tupla
	$usuarios->ADD();

	$USUARIOS_array_test1['error_obtenido'] = $usuarios->ADD();
	if ($USUARIOS_array_test1['error_obtenido'] === $USUARIOS_array_test1['error_esperado'])
	{
		$USUARIOS_array_test1['resultado'] = 'OK';
	}
	else
	{
		$USUARIOS_array_test1['resultado'] = 'FALSE';
	}

	array_push($ERRORS_array_test, $USUARIOS_array_test1);

	$usuarios->DELETE();	


// Comprobar error en la inserción
	$USUARIOS_array_test1['entidad'] = 'USUARIOS';	
	$USUARIOS_array_test1['metodo'] = 'ADD';
	$USUARIOS_array_test1['error'] = 'Error en la inserción';
	$USUARIOS_array_test1['error_esperado'] = 'Error de gestor de base de datos';
	$USUARIOS_array_test1['error_obtenido'] = '';
	$USUARIOS_array_test1['resultado'] = '';
	
	$login = 'jrodeirolklkjlkj';
	$password = 'javi';
	$nombre = 'javi\' ,\'kdfalkj'; 
	$apellidos = 'rodeiro';
	$email = 'jrodeiro@uvigo.es';

	$usuarios = new USUARIOS_Model($login,$password,$nombre,$apellidos,$email);
	$USUARIOS_array_test1['error_obtenido'] = $usuarios->ADD();
	if ($USUARIOS_array_test1['error_obtenido'] === $USUARIOS_array_test1['error_esperado'])
	{
		$USUARIOS_array_test1['resultado'] = 'OK';
	}
	else
	{
		$USUARIOS_array_test1['resultado'] = 'FALSE';
	}

	array_push($ERRORS_array_test, $USUARIOS_array_test1);	

	$usuarios->DELETE();

// Comprobar Inserción realizada con éxito
	$USUARIOS_array_test1['entidad'] = 'USUARIOS';	
	$USUARIOS_array_test1['metodo'] = 'ADD';
	$USUARIOS_array_test1['error'] = 'Inserción realizada con éxito';
	$USUARIOS_array_test1['error_esperado'] = 'Inserción realizada con éxito';
	$USUARIOS_array_test1['error_obtenido'] = '';
	$USUARIOS_array_test1['resultado'] = '';
	
	$login = 'jrodeiro1';
	$password = 'javi';
	$nombre = 'javi'; 
	$apellidos = 'rodeiro';
	$email = 'jrodeiro1@uvigo.es';

	$usuarios = new USUARIOS_Model($login,$password,$nombre,$apellidos,$email);
	$USUARIOS_array_test1['error_obtenido'] = $usuarios->ADD();
	if ($USUARIOS_array_test1['error_obtenido'] === $USUARIOS_array_test1['error_esperado'])
	{
		$USUARIOS_array_test1['resultado'] = 'OK';
	}
	else
	{
		$USUARIOS_array_test1['resultado'] = 'FALSE';
	}

	array_push($ERRORS_array_test, $USUARIOS_array_test1);

	$usuarios->DELETE();


}



function USUARIOS_RellenaDatos_test()
{

	global $ERRORS_array_test;
// creo array de almacen de test individual
	$USUARIOS_array_test1 = array();

// Comprobar el login no existe
//--------------------------------------------------
	$USUARIOS_array_test1['entidad'] = 'USUARIOS';	
	$USUARIOS_array_test1['metodo'] = 'RellenaDatos';
	$USUARIOS_array_test1['error'] = 'El usuario a rellenar no existe';
	$USUARIOS_array_test1['error_esperado'] = 'Error de gestor de base de datos';
	$USUARIOS_array_test1['error_obtenido'] = '';
	$USUARIOS_array_test1['resultado'] = '';
	
	// Relleno los datos de usuario	
	$login = 'javi ,\'hola';
	
// creo el modelo
	$usuarios = new USUARIOS_Model($login,'','','','');


	$USUARIOS_array_test1['error_obtenido'] = $usuarios->RellenaDatos();
	if ($USUARIOS_array_test1['error_obtenido'] === $USUARIOS_array_test1['error_esperado'])
	{
		$USUARIOS_array_test1['resultado'] = 'OK';
	}
	else
	{
		$USUARIOS_array_test1['resultado'] = 'FALSE';
	}

	array_push($ERRORS_array_test, $USUARIOS_array_test1);

// Comprobar devuelve recordset
//----------------------------------------------
	$USUARIOS_array_test1['entidad'] = 'USUARIOS';	
	$USUARIOS_array_test1['metodo'] = 'RellenaDatos';
	$USUARIOS_array_test1['error'] = 'Devuelve el recordset';
	$USUARIOS_array_test1['error_esperado'] = 'array';
	$USUARIOS_array_test1['error_obtenido'] = '';
	$USUARIOS_array_test1['resultado'] = '';
	
	$login = 'jrodeiro1';
	$password = 'javi';
	$nombre = 'javi'; 
	$apellidos = 'rodeiro';
	$email = 'jrodeiro1@uvigo.es';

	$usuarios = new USUARIOS_Model($login,$password,$nombre,$apellidos,$email);
	$USUARIOS_array_test1['error_obtenido'] = $usuarios->ADD();


	$USUARIOS_array_test1['error_obtenido'] = gettype($usuarios->RellenaDatos());
	if ($USUARIOS_array_test1['error_obtenido'] === $USUARIOS_array_test1['error_esperado'])
	{
		$USUARIOS_array_test1['resultado'] = 'OK';
	}
	else
	{
		$USUARIOS_array_test1['resultado'] = 'FALSE';
	}

	array_push($ERRORS_array_test, $USUARIOS_array_test1);

	$usuarios->DELETE();

}

	USUARIOS_login_test();
	USUARIOS_Registrar_test();
	USUARIOS_ADD_test();
	USUARIOS_RellenaDatos_test();

?>


