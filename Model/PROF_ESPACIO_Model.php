

<?php

//Clase : PROF_ESPACIO_Model
//Creado el : 05/10/2019
//Creado por: stwgno

class PROF_ESPACIO_Model {

	var $DNI;	//DNI del profesor
	var $CODESPACIO; //codigo del espacio

//Constructor de la clase
function __construct($DNI,$CODESPACIO){
	$this->DNI = $DNI;
	$this->CODESPACIO = $CODESPACIO;

	$this->erroresdatos = array(); 

	include_once '../Model/Access_DB.php';
	$this->mysqli = ConnectDB();
}

//function comprobar_atributos()
//si todos los atributos son correctos, devuelve true, si no se devuelve el array con los errores
function comprobar_atributos(){
	$array = array(); //array donde se guardan los errores

	$errores = $this->comprobar_DNI();
	
	//En los siguientes if se comprueba si errores devuelve true o false, en caso de devolver false
	//significa que hay un error en el metodo. De no haberlo salta a la siguiente condición
	if($errores == false) //si errores es un array, indica que se ha encontrado un error
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_CODESPACIO(); //variable que se va a igualar al resultado de los metodos de comprobacion
	if($errores == false) //si errores es un array, indica que se ha encontrado un error
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
		
	$comprobar = $this->comprobar_atributos(); //Busca si la tupla es correcta o tiene algun error

	if($comprobar == true)
	{
		//comprueba si hay otro espacio asignado al mismo profesor
		$sql = "select * from PROF_ESPACIO where DNI = '".$this->DNI."'";

		if (!$result = $this->mysqli->query($sql))
		{
			return 'Error de gestor de base de datos';
		}
		//si ya existe
		if ($result->num_rows == 1){  // existe el usuario
				return 'Inserción fallida: el elemento ya existe';
			}
		//si no	
		$sql = "INSERT INTO PROF_ESPACIO (
				DNI,
				CODESPACIO) 
				VALUES (
					'".$this->DNI."',
					'".$this->CODESPACIO."'
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
	//sentencia de busqueda
	$sql = "SELECT *
			FROM PROF_ESPACIO
			WHERE (
				DNI LIKE '%".$this->DNI."%' AND
				CODESPACIO LIKE '%".$this->CODESPACIO."%'
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

	$comprobar = $this->comprobar_DNI(); //Busca si la tupla es correcta o tiene algun error

	if($comprobar == true)
	{	
		//sentencia de borrado
	   $sql = "	DELETE FROM 
	   				PROF_ESPACIO
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
			FROM PROF_ESPACIO
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
	$comprobar = $this->comprobar_atributos(); //Busca si la tupla es correcta o tiene algun error

	if($comprobar == true)
	{
		//actualizar prof_espacio
		$sql = "UPDATE PROF_ESPACIO
				SET 
					`DNI` = '$this->DNI',
					`CODESPACIO` = '$this->CODESPACIO'
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

// funcion CodigosEspacios: devuelve los codigos de todos los espacios que hay en la base de datos
function CodigosEspacio(){
	$sql = "SELECT CODESPACIO
			FROM ESPACIO";
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

// function comprobar_CODESPACIO
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_CODESPACIO()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado

	//si los atributos estan vacios
	if (strlen($this->CODESPACIO) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODESPACIO", "codigoincidencia" => "00001" ,"mensajeerror" => "CODESPACIO vacio"]);

		$correcto = false;
	}

	//si los atributos estan vacios
	if (strlen($this->CODESPACIO) > 11)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODESPACIO", "codigoincidencia" => "00002" ,"mensajeerror" => "CODESPACIO demasiado largo, maximo 10 caracteres"]);

		$correcto = false;
	}

	if (strlen($this->CODESPACIO) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODESPACIO", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	return $correcto;
}

}//fin de clase

?> 