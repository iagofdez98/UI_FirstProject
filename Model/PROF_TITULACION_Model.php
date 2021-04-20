

<?php

//Clase : PROF_TITULACION_Model
//Creado el : 05/10/2019
//Creado por: stwgno
//-------------------------------------------------------

class PROF_TITULACION_Model {

	var $DNI;	//dni del profesor
	var $CODTITULACION; //codigo de la titulacion
	var $ANHOACADEMICO; //año academico

//Constructor de la clase
function __construct($DNI,$CODTITULACION,$ANHOACADEMICO){
	$this->DNI = $DNI;
	$this->CODTITULACION = $CODTITULACION;
	$this->ANHOACADEMICO = $ANHOACADEMICO;

	$this->erroresdatos = array(); 

	include_once '../Model/Access_DB.php';
	$this->mysqli = ConnectDB();
}

//function comprobar_atributos()
//si todos los atributos son correctos, devuelve true, si no se devuelve el array con los errores
function comprobar_atributos(){
	$array = array(); //array donde se guardan los errores

	$errores = $this->comprobar_DNI(); //variable que se va a igualar al resultado de los metodos de comprobacion
	
	//En los siguientes if se comprueba si errores devuelve true o false, en caso de devolver false
	//significa que hay un error en el metodo. De no haberlo salta a la siguiente condición
	if($errores == false) //si errores es un array, indica que se ha encontrado un error
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_CODTITULACION();
	if($errores == false) //si errores es un array, indica que se ha encontrado un error
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_ANHOACADEMICO();
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
function ADD(){

	$comprobar = $this->comprobar_atributos();
	
	if($comprobar == true)
	{
		//comprueba si existe el mismo dni
		$sql = "select * from PROF_TITULACION where DNI = '".$this->DNI."'";

		if (!$result = $this->mysqli->query($sql))
		{
			return 'Error de gestor de base de datos';
		}

		//si existe, error
		if ($result->num_rows == 1){  // existe el usuario
				return 'Inserción fallida: el elemento ya existe';
			}

			//si no
		$sql = "INSERT INTO PROF_TITULACION (
				DNI,
				CODTITULACION,
				ANHOACADEMICO) 
				VALUES (
					'".$this->DNI."',
					'".$this->CODTITULACION."',
					'".$this->ANHOACADEMICO."'
					)";

		if (!$this->mysqli->query($sql)) {
			return 'Error de gestor de base de datos: ';
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
	//busqueda
	$sql = "SELECT *
			FROM PROF_TITULACION
			WHERE (
				DNI LIKE '%".$this->DNI."%' AND
				CODTITULACION LIKE '%".$this->CODTITULACION."%' AND
				ANHOACADEMICO LIKE '%".$this->ANHOACADEMICO."%'
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
	$comprobar = $this->comprobar_DNI();
	
	if($comprobar == true)
	{
		//sentencia de borrado
	   $sql = "	DELETE FROM 
	   				PROF_TITULACION
	   			WHERE(
	   				DNI = '$this->DNI'
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
			FROM PROF_TITULACION
			WHERE (
				(DNI = '$this->DNI') 
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
	$comprobar = $this->comprobar_atributos();
	
	if($comprobar == true)
	{	
		$sql = "UPDATE PROF_TITULACION
				SET 
					`DNI` = '$this->DNI',
					`CODTITULACION` = '$this->CODTITULACION',
					`ANHOACADEMICO` = '$this->ANHOACADEMICO'
				WHERE (
					DNI = '$this->DNI'
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
	}else
	{
		return $comprobar;
	}
}

// funcion CodigosDNI: devuelve los codigos de todos los dni que hay en la base de datos
function CodigosDNI(){
	$sql = "SELECT DNI
			FROM PROFESOR";
	if (!$resultado = $this->mysqli->query($sql))
	{
		return 'Error de gestor de base de datos';
	}
	else
	{
		$array = array();
		while ($row=$resultado->fetch_array()) {
    		array_push($array,$row[0]);
		}
	}
	return $array;
}

// funcion CodigosTitulacion: devuelve los codigos de todos los titulacion que hay en la base de datos
function CodigosTitulacion(){
	$sql = "SELECT CODTITULACION
			FROM TITULACION";
	if (!$resultado = $this->mysqli->query($sql))
	{
		return 'Error de gestor de base de datos';
	}
	else
	{
		$array = array();
		while ($row=$resultado->fetch_array()) {
    		array_push($array,$row[0]);
		}
	}
	return $array;

	}

// function comprobar_DNI
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_DNI()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado

	$letra = substr($this->DNI, -1); //sustraemos la letra
	$numeros = substr($this->DNI, 0, -1); //numeros del dni

	//si el dni es valido
	if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) != $letra && strlen($letra) == 1 && strlen ($numeros) == 8 )
	{
		array_push($this->erroresdatos, ["nombreatributo" => "DNI", "codigoincidencia" => "00011" ,"mensajeerror" => "DNI no valido"]);	
	
		$correcto = false;
	}

	return $correcto;
}

// function comprobar_CODTITULACION
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_CODTITULACION()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado

	//si los atributos estan vacios
	if (strlen($this->CODTITULACION) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODTITULACION", "codigoincidencia" => "00001" ,"mensajeerror" => "CODTITULACION vacio"]);

		$correcto = false;
	}

	//si los atributos estan vacios
	if (strlen($this->CODTITULACION) > 11)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODTITULACION", "codigoincidencia" => "00002" ,"mensajeerror" => "CODTITULACION demasiado largo, maximo 10 caracteres"]);

		$correcto = false;
	}

	if (strlen($this->CODTITULACION) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODTITULACION", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	return $correcto;
}

// function comprobar_ANHOACADEMICO
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_ANHOACADEMICO()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado

	//si los atributos estan vacios
	if (strlen($this->ANHOACADEMICO) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "ANHOACADEMICO", "codigoincidencia" => "00001" ,"mensajeerror" => "ANHOACADEMICO vacio"]);

		$correcto = false;
	}

	//si los atributos estan vacios
	if (strlen($this->ANHOACADEMICO) > 10)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "ANHOACADEMICO", "codigoincidencia" => "00002" ,"mensajeerror" => "ANHOACADEMICO demasiado largo, maximo 10 caracteres"]);

		$correcto = false;
	}

	if (preg_match('/[0-9]{4}-[0-9]{4}/', $this->ANHOACADEMICO))
	{
		array_push($this->erroresdatos, ["nombreatributo" => "ANHOACADEMICO", "codigoincidencia" => "00110" ,"mensajeerror" => "Solo se permiten dddd-dddd (año académico) donde d es un dígito"]);

		$correcto = false;
	}	



	return $correcto;
}
}//fin de clase

?>