<?php

//Clase : USUARIOS_Model
//Creado el : 05/10/2019
//Creado por: stwgno

class USUARIOS_Model {

	var $login;		//El login del usuario
	var $password;	//La contraseña del usuario
	var $nombre;	//El nombre del usuario
	var $apellidos;	//Apellidos del usuario
	var $email;		//Email del usuario
	var $DNI;		//DNI del usuario
	var $fotopersonal;	//Foto del usuario
	var $telefono;		//Telefono del usuario
	var $FechaNacimiento;	//Fecha de nacimiento del usuario
	var $sexo;		//Sexo del usuario
	var $mysqli;	//Variable usada para conectarse a la BD

//Constructor de la clase
function __construct($login,$password,$DNI,$nombre,$apellidos,$telefono,$email,$FechaNacimiento,$fotopersonal,$sexo){
	$this->login = $login;
	$this->password = $password;
	$this->DNI = $DNI;
	$this->nombre = $nombre;
	$this->apellidos = $apellidos;
	$this->telefono = $telefono;
	$this->email = $email;
	$this->FechaNacimiento = $FechaNacimiento;
	$this->fotopersonal = $fotopersonal;
	$this->sexo = $sexo;
	$this->erroresdatos = array(); 

	include_once '../Model/Access_DB.php';
	$this->mysqli = ConnectDB();
}

//function comprobar_atributos()
//si todos los atributos son correctos, devuelve true, si no se devuelve el array con los errores
function comprobar_atributos(){
	$array = array(); //array donde se guardan los errores

	$errores = $this->comprobar_login(); //variable que se va a igualar al resultado de los metodos de comprobacion
	
	//En los siguientes if se comprueba si errores devuelve true o false, en caso de devolver false
	//significa que hay un error en el metodo. De no haberlo salta a la siguiente condición
	if($errores == false) 
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_password();
	if($errores == false)
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_DNI();
	if($errores == false)
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_nombre();
	if($errores == false)
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_apellidos();
	if($errores == false)
	{
		array_push($array, $errores);
	}
	
	$errores = $this->comprobar_telefono();
	if($errores == false)
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_email();
	if($errores == false)
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_FechaNacimiento();
	if($errores == false)
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_fotopersonal();
	if($errores == false)
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_sexo();
	if($errores == false)
	{
		array_push($array, $errores);
	}

	//si está vacio el array quiere decir que no se encontraron errores, en caso contrario devolvemos el array
	if(empty($array))
	{
		return true;
	}else
	{
		return $array;
	}
}

//Metodo ADD
//Inserta en la tabla  de la BD los valores de los atributos del objeto. 
//Comprueba si la clave/s esta vacia y si existe ya en la tabla
function ADD()
{
	$comprobar = $this->comprobar_atributos(); //Busca si la tupla es correcta o tiene algun error

	if($comprobar == true)//si la tupla no tiene errores
	{
		$sql = "select * from USUARIOS where login = '".$this->login."'";

		if (!$result = $this->mysqli->query($sql)) //Si la sentencia sql no devuelve información
		{
			return 'Error de gestor de base de datos';
		}

		if ($result->num_rows == 1){  // existe el usuario
				return 'Inserción fallida: el elemento ya existe';
			}

		$sql = "INSERT INTO USUARIOS (
			login,
			password,
			DNI,
			nombre,
			apellidos,
			telefono,
			email,
			FechaNacimiento,
			fotopersonal,
			sexo
			) 
				VALUES (
					'".$this->login."',
					'".$this->password."',
					'".$this->DNI."',
					'".$this->nombre."',
					'".$this->apellidos."',
					'".$this->telefono."',
					'".$this->email."',
					'".$this->FechaNacimiento."',
					'".$this->fotopersonal."',
					'".$this->sexo."'
					)";

		if (!$this->mysqli->query($sql)) { //Si la sentencia sql no devuelve información
			return 'Error de gestor de base de datos';
		}
		else{
			return 'Inserción realizada con éxito'; //operacion de insertado correcta
		}
	}			
	else
	{
		return $comprobar;
	}	
}
    
    

//funcion de destrucción del objeto: se ejecuta automaticamente
//al finalizar el script
function __destruct()
{

}

//funcion SEARCH: hace una búsqueda en la tabla con
//los datos proporcionados. Si van vacios devuelve todos
function SEARCH()
{

	if($this->FechaNacimiento != ''){//si fechanacimiento no esta vacia
		$origDate = $this->FechaNacimiento;	//Igualada a la fecha nacimiento pasada
		$date = str_replace('/', '-', $origDate );//
		$newDate = date("Y-m-d", strtotime($date));
	}else{
		$newDate = $this->FechaNacimiento;
	}

	$sql = "SELECT *
			FROM USUARIOS
			WHERE (
				login LIKE '%".$this->login."%' AND
				password LIKE '%".$this->password."%' AND
				DNI LIKE '%".$this->DNI."%' AND
				nombre LIKE '%".$this->nombre."%' AND
				apellidos LIKE '%".$this->apellidos."%' AND
				email LIKE '%".$this->email."%' AND
				telefono LIKE '%".$this->telefono."%' AND
				FechaNacimiento LIKE '%".$newDate."%' AND
				fotopersonal LIKE '%".$this->fotopersonal."%' AND
				sexo LIKE '%".$this->sexo."%' 
			)
	";
	if (!$resultado = $this->mysqli->query($sql))
		{
			return 'Error de gestor de base de datos';
		}
	return $resultado;
    
}

//funcion DELETE : comprueba que la tupla a borrar existe y una vez
// verificado la borra
function DELETE()
{
	$comprobar = $this->comprobar_login(); //Busca si la tupla es correcta o tiene algun error

	if($comprobar == true)
	{	
	   $sql = "	DELETE FROM 
	   				USUARIOS
	   			WHERE(
	   				login = '$this->login'
	   			)
	   			";

	   	if ($this->mysqli->query($sql))
		{
			$resultado = 'Borrado realizado con éxito';
		}
		else
		{
			$resultado = 'Error de gestor de base de datos';
		}
		return $resultado;
	}else
	{
		return $comprobar;
	}
}

// funcion RellenaDatos: recupera todos los atributos de una tupla a partir de su clave
function RellenaDatos()
{
    $sql = "SELECT *
			FROM USUARIOS
			WHERE (
				(login = '$this->login') 
			)";

	if (!$resultado = $this->mysqli->query($sql))
	{
			return 'Error de gestor de base de datos';
	}else
	{
		$tupla = $resultado->fetch_array();
	}
	return $tupla;
}

// funcion Edit: realizar el update de una tupla despues de comprobar que existe
function EDIT()
{
	$comprobar = $this->comprobar_atributos(); //Busca si la tupla es correcta o tiene algun error

	if($comprobar == true)
	{
		$sql = "UPDATE USUARIOS
				SET 
					password = '$this->password',
					DNI = '$this->DNI',
					nombre = '$this->nombre',
					apellidos = '$this->apellidos',
					telefono = '$this->telefono',
					email = '$this->email',
					FechaNacimiento = '$this->FechaNacimiento',
					fotopersonal = '$this->fotopersonal',
					sexo = '$this->sexo'
				WHERE (
					login = '$this->login'
				)
				";

		if ($this->mysqli->query($sql))
		{
			$resultado = 'Actualización realizada con éxito';
		}
		else
		{
			$resultado = 'Error de gestor de base de datos';
		}
		return $resultado;
	}
	else{
		return $comprobar;
	}
}

// funcion login: realiza la comprobación de si existe el usuario en la bd y despues si la pass
// es correcta para ese usuario. Si es asi devuelve true, en cualquier otro caso devuelve el 
// error correspondiente
function login(){

	$sql = "SELECT *
			FROM USUARIOS
			WHERE (
				(login = '$this->login') 
			)";

	$resultado = $this->mysqli->query($sql);
	if ($resultado->num_rows == 0){
		return 'El login no existe';
	}
	else{
		$tupla = $resultado->fetch_array();
		if ($tupla['password'] == $this->password){
			return true;
		}
		else{
			return 'La password para este usuario no es correcta';
		}
	}
}//fin metodo login

//function Register: Registra el usuario con los datos recibidos
function Register(){

		$sql = "select * from USUARIOS where login = '".$this->login."'";

		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1){  // existe el usuario
				return 'El usuario ya existe';
			}
		else{
	    		return true; //TEST : El usuario no existe

	}
}

//function registrar: Registra el usuario con los datos recibidos
function registrar(){

			
		$sql = "INSERT INTO USUARIOS (
			login,
			password,
			nombre,
			apellidos,
			email,
			DNI,
			telefono,
			FechaNacimiento,
			fotopersonal,
			sexo
			) 
				VALUES (
					'".$this->login."',
					'".$this->password."',
					'".$this->nombre."',
					'".$this->apellidos."',
					'".$this->email."',
					'".$this->DNI."',
					'".$this->telefono."',
					'".$this->FechaNacimiento."',
					'".$this->fotopersonal."',
					'".$this->sexo."'

					)";
								
		if (!$this->mysqli->query($sql)) { //Si la sentencia sql no devuelve información
			return 'Error de gestor de base de datos';
		}
		else{
			return 'Inserción realizada con éxito'; //si es correcta
		}		
	}

// function comprobar_login
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_login()
	{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado

	//si los atributos estan vacios
	if (strlen($this->login) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "login", "codigoincidencia" => "00001" ,"mensajeerror" => "login vacio"]);

		$correcto = false;	
	}

	if (strlen($this->login) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "login", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	//si los atributos estan vacios
	if (strlen($this->login) > 15)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "login", "codigoincidencia" => "00002" ,"mensajeerror" => "login demasiado largo, maximo 10 caracteres"]);

		$correcto = false;	
	}

	return $correcto;
}

// function comprobar_password
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_password()
	{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado

	//si los atributos estan vacios
	if (strlen($this->password) > 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "password", "codigoincidencia" => "00001" ,"mensajeerror" => "password pequeño, minimo 3 caracteres"]);

		$correcto = false;	
	}

	if (strlen($this->password) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "login", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	//si los atributos estan vacios
	if (strlen($this->password) > 15)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "password", "codigoincidencia" => "00002" ,"mensajeerror" => "Password demasiado larga (no puede tener más de 15 caracteres)"]);

		$correcto = false;	
	}

	return $correcto;
}

// function comprobar_DNI
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_DNI()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado

	$letra = substr($this->DNI, -1); //sustraemos la letra
	$numeros = substr($this->DNI, 0, -1); //numeros del dni

	if (strlen($numeros) != 8)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "DNI", "codigoincidencia" => "00010" ,"mensajeerror" => "Formato dni erróneo"]);

		$correcto = false;
	}

	//si el dni es valido
	if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) != $letra && strlen($letra) == 1 && strlen ($numeros) == 8 )
	{
		array_push($this->erroresdatos, ["nombreatributo" => "DNI", "codigoincidencia" => "00011" ,"mensajeerror" => "DNI no valido"]);	
	
		$correcto = false;
	}

	return $correcto;
}

// function comprobar_password
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_nombre()
	{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado

	//si los atributos estan vacios
	if (strlen($this->nombre) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "nombre", "codigoincidencia" => "00001" ,"mensajeerror" => "nombre vacio"]);

		$correcto = false;	
	}

	if (strlen($this->nombre) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "nombre", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	//si los atributos estan vacios
	if (strlen($this->nombre) > 31)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "nombre", "codigoincidencia" => "00002" ,"mensajeerror" => "nombre demasiado largo, maximo 10 caracteres"]);

		$correcto = false;		}

	//si los atributos son alfabeticos
	if (ctype_alpha($this->nombre))
	{
		array_push($this->erroresdatos, ["nombreatributo" => "nombre", "codigoincidencia" => "00003" ,"mensajeerror" => "nombre no valido, solo se admiten caracteres"]);

		$correcto = false;	
	}

	return $correcto;
}

// function comprobar_apellidos
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_apellidos()
	{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado

	//si los atributos estan vacios
	if (strlen($this->apellidos) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "apellidos", "codigoincidencia" => "00001" ,"mensajeerror" => "apellidos vacio"]);

		$correcto = false;	
	}

	//si los atributos estan vacios
	if (strlen($this->apellidos) > 51)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "apellidos", "codigoincidencia" => "00002" ,"mensajeerror" => "apellidos demasiado largo, maximo 10 caracteres"]);

		$correcto = false;		}

	if (strlen($this->apellidos) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "apellidos", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	//si los atributos son alfabeticos
	if (ctype_alpha($this->apellidos))
	{
		array_push($this->erroresdatos, ["nombreatributo" => "apellidos", "codigoincidencia" => "00003" ,"mensajeerror" => "apellidos no valido, solo se admiten caracteres"]);

		$correcto = false;	
	}

	return $correcto;
}

// function comprobar_telefono
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_telefono()
	{

	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado
		
	//si los atributos estan vacios
	if (strlen($this->telefono) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "telefono", "codigoincidencia" => "00001" ,"mensajeerror" => "telefono vacio"]);

		$correcto = false;	
	}


	//si los atributos estan vacios
	if (strlen($this->telefono) > 11)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "telefono", "codigoincidencia" => "00002" ,"mensajeerror" => "telefono demasiado largo, maximo 10 caracteres"]);

		$correcto = false;	
	}

	return $correcto;
}

// function comprobar_email
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_email()
	{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado

	//si los atributos estan vacios
	if (strlen($this->email) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "email", "codigoincidencia" => "00001" ,"mensajeerror" => "email vacio"]);

		$correcto = false;	
	}

	if (strlen($this->email) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "email", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	//si los atributos estan vacios
	if (strlen($this->email) > 61)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "email", "codigoincidencia" => "00002" ,"mensajeerror" => "email demasiado largo, maximo 10 caracteres"]);

		$correcto = false;	
	}

	return $correcto;
}

// function comprobar_FechaNacimiento
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_FechaNacimiento()
	{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado

	//si los atributos estan vacios
	if (strlen($this->FechaNacimiento) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "FechaNacimiento", "codigoincidencia" => "00001" ,"mensajeerror" => "FechaNacimiento vacio"]);

		$correcto = false;	
	}

	return $correcto;
}

// function comprobar_fotopersonal
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_fotopersonal()
	{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado
	
	//si los atributos estan vacios
	if (strlen($this->fotopersonal) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "fotopersonal", "codigoincidencia" => "00001" ,"mensajeerror" => "FechaNacimiento vacio"]);

		$correcto = false;	
	}

	if (strlen($this->fotopersonal) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "fotopersonal", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	//si los atributos estan vacios
	if (strlen($this->fotopersonal) > 50)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "fotopersonal", "codigoincidencia" => "00002" ,"mensajeerror" => "FechaNacimiento demasiado largo, maximo 10 caracteres"]);

		$correcto = false;
	}

	return $correcto;
}


// function comprobar_sexo
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_sexo()
	{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado

	//si los atributos estan vacios
	if (strlen($this->sexo) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "sexo", "codigoincidencia" => "00001" ,"mensajeerror" => "sexo vacio"]);

		$correcto = false;
	}

	return $correcto;
}

}//fin de clase

?> 