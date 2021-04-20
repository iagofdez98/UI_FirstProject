
<?php

//Clase : CENTRO_Model
//Creado el : 05/10/2019
//Creado por: stwgno

class CENTRO_Model {

	var $CODCENTRO;		//El CODCENTRO del CENTRO
	var $CODEDIFICIO;	//el CODEDIFICIO del CENTRO
	var $NOMBRECENTRO;	//EL NOMBRECENTRO del CENTRO
	var $DIRECCIONCENTRO;	//DIRECCIONCENTRO del CENTRO
	var $RESPONSABLECENTRO;		//RESPONSABLECENTRO del CENTRO


//Constructor de la clase
function __construct($CODCENTRO,$CODEDIFICIO,$NOMBRECENTRO,$DIRECCIONCENTRO,$RESPONSABLECENTRO){
	$this->CODCENTRO = $CODCENTRO;
	$this->CODEDIFICIO = $CODEDIFICIO;
	$this->NOMBRECENTRO = $NOMBRECENTRO;
	$this->DIRECCIONCENTRO = $DIRECCIONCENTRO;
	$this->RESPONSABLECENTRO = $RESPONSABLECENTRO;
	$this->erroresdatos = array(); 

	include_once '../Model/Access_DB.php';
	$this->mysqli = ConnectDB();
}

//function comprobar_atributos()
//si todos los atributos son correctos, devuelve true, si no se devuelve el array con los errores
function comprobar_atributos(){
	$array = array(); //array donde se guardan los errores

	$errores = $this->comprobar_CODCENTRO(); //variable que se va a igualar al resultado de los metodos de comprobacion
	
	//En los siguientes if se comprueba si errores devuelve true o false, en caso de devolver false
	//significa que hay un error en el metodo. De no haberlo salta a la siguiente condición
	if($errores == false) 
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_CODEDIFICIO();
	if($errores == false)
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_NOMBRECENTRO();
	if($errores == false)
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_DIRECCIONCENTRO();
	if($errores == false)
	{
		array_push($array, $errores);
	}
	
	$errores = $this->comprobar_RESPONSABLECENTRO();
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
		//Comprueba que no exista otro igual
		$sql = "select * from CENTRO where CODCENTRO = '".$this->CODCENTRO."'"; 

		//si no conecta a la bd
		if (!$result = $this->mysqli->query($sql))
		{
			return 'Error de gestor de base de datos';
		}

		//si existe, devuelve error
		if ($result->num_rows == 1){  // existe el usuario
				return 'Inserción fallida: el elemento ya existe';
			}

		//si no, inserta
		$sql = "INSERT INTO CENTRO (
			CODCENTRO,
			CODEDIFICIO,
			NOMBRECENTRO,
			DIRECCIONCENTRO,
			RESPONSABLECENTRO) 
				VALUES (
					'".$this->CODCENTRO."',
					'".$this->CODEDIFICIO."',
					'".$this->NOMBRECENTRO."',
					'".$this->DIRECCIONCENTRO."',
					'".$this->RESPONSABLECENTRO."'
					)";

		//si existe
		if (!$this->mysqli->query($sql)) {
			return 'Error de gestor de base de datos: ';
		}
		else{//si no
			return 'Inserción realizada con éxito'; //operacion de insertado correcta
		}	
}

//funcion SEARCH: hace una búsqueda en la tabla con
//los datos proporcionados. Si van vacios devuelve todos
function SEARCH()
{
	//busca con los elementos pasados
	$sql = "SELECT *
			FROM CENTRO
			WHERE (
				CODCENTRO LIKE '%".$this->CODCENTRO."%' AND
				CODEDIFICIO LIKE '%".$this->CODEDIFICIO."%' AND
				NOMBRECENTRO LIKE '%".$this->NOMBRECENTRO."%' AND
				DIRECCIONCENTRO LIKE '%".$this->DIRECCIONCENTRO."%' AND
				RESPONSABLECENTRO LIKE '%".$this->RESPONSABLECENTRO."%' 
			)
	";
	//si existe
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
		$if1 = "SELECT CODCENTRO
				FROM TITULACION
				WHERE(
	   				CODCENTRO = '$this->CODCENTRO'
	   			)";
		
		$valores = $this->mysqli->query($if1); 

		if($valores->num_rows == 0) //si no hay ningun centro en el edificio
		{
				$if2 = "SELECT CODCENTRO
				FROM ESPACIO
				WHERE(
	   				CODCENTRO = '$this->CODCENTRO'
	   			)";
		
			$valores = $this->mysqli->query($if2); 

			if($valores->num_rows == 0) //si no hay ningun centro en el edificio
			{

				//borra centro pasado
			   $sql = "	DELETE FROM 
			   				CENTRO
			   			WHERE(
			   				CODCENTRO = '$this->CODCENTRO'
			   			)
			   			";
				
				//si existe
			   	if ($this->mysqli->query($sql))
				{
					$resultado = 'Borrado realizado con éxito';
				}
				else//si no
				{
					$resultado = 'Error de gestor de base de datos';
				}
			}
			else//si no
			{
				$resultado = 'Error de gestor de base de datos';
			}
		}
		else//si no
		{
			$resultado = 'Error de gestor de base de datos';		
		}
	return $resultado;
}

// funcion RellenaDatos: recupera todos los atributos de una tupla a partir de su clave
function RellenaDatos()
{
    $sql = "SELECT *
			FROM CENTRO
			WHERE (
				(CODCENTRO = '$this->CODCENTRO') 
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
		//sentencia update para actualizar los datos
		$sql = "UPDATE CENTRO
				SET 
					`CODCENTRO` = '$this->CODCENTRO',
					`CODEDIFICIO` = '$this->CODEDIFICIO',
					`NOMBRECENTRO` = '$this->NOMBRECENTRO',
					`DIRECCIONCENTRO` = '$this->DIRECCIONCENTRO',
					`RESPONSABLECENTRO` = '$this->RESPONSABLECENTRO'
				WHERE (
					CODCENTRO = '$this->CODCENTRO'
				)
				";
		
		//si la tupla existe
		if ($this->mysqli->query($sql))
		{
			$resultado = 'Actualización realizada con éxito';
		}
		else //si no
		{
			$resultado = 'Error de gestor de base de datos';
		}
		return $resultado;
}

// funcion CodigosEdificio: devuelve los codigos de todos edificios que hay en la base de datos
function CodigosEdificio(){

	//se almacenan los codigos de edificio
	$sql = "SELECT CODEDIFICIO
			FROM EDIFICIO";

	//si no se encuentra la tupla
	if (!$resultado = $this->mysqli->query($sql))
	{
		return 'Error de gestor de base de datos';
	}
	else //en caso contrario
	{
		$array = array();
		while ($row=$resultado->fetch_array()) {
    		array_push($array,$row[0]);
		}
	}
	return $array;
}

// function comprobar_CODCENTRO
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_CODCENTRO()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado
	//si los atributos estan vacios
	if (strlen($this->CODCENTRO) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODCENTRO", "codigoincidencia" => "00001" ,"mensajeerror" => "CODCENTRO Vacio"]);

		$correcto = false;
	}

	//si los atributos estan vacios
	if (strlen($this->CODCENTRO) > 11)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODCENTRO", "codigoincidencia" => "00002" ,"mensajeerror" =>"CODCENTRO demasiado largo, máximo 10 caracteres"]);	
	
		$correcto = false;
	}

	if (strlen($this->CODCENTRO) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODCENTRO", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	return $correcto;
}

// function comprobar_CODEDIFICIO
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_CODEDIFICIO()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado
	//si los atributos estan vacios
	if (strlen($this->CODEDIFICIO) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODEDIFICIO", "codigoincidencia" => "00001" ,"mensajeerror" => "CODEDIFICIO Vacio"]);

		$correcto = false;
	}

	//si los atributos estan vacios
	if (strlen($this->CODEDIFICIO) > 11)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODEDIFICIO", "codigoincidencia" => "00002" ,"mensajeerror" => "CODEDIFICIO demasiado largo, máximo 10 caracteres"]);

		$correcto = false;
	}

	if (strlen($this->CODEDIFICIO) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODEDIFICIO", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	return $correcto;
}

// function comprobar_NOMBRECENTRO
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_NOMBRECENTRO()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado
	//si los atributos estan vacios
	if (strlen($this->NOMBRECENTRO) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "NOMBRECENTRO", "codigoincidencia" => "00001" ,"mensajeerror" => "NOMBRECENTRO Vacio"]);

		$correcto = false;

	}

	//si los atributos estan vacios
	if (strlen($this->NOMBRECENTRO) > 50)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "NOMBRECENTRO", "codigoincidencia" => "00002" ,"mensajeerror" => "NOMBRECENTRO demasiado largo, máximo 50 caracteres"]);

		$correcto = false;

	}

	if (strlen($this->NOMBRECENTRO) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "NOMBRECENTRO", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	//si los atributos son alfabeticos
	if (ctype_alpha($this->NOMBRECENTRO))
	{
		array_push($this->erroresdatos, ["nombreatributo" => "NOMBRECENTRO", "codigoincidencia" => "00030" ,"mensajeerror" => "NOMBRECENTRO solo permite caracteres"]);

		$correcto = false;

	}

	return $correcto;
}

// function comprobar_DIRECCIONCENTRO
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_DIRECCIONCENTRO()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado
	//si los atributos estan vacios
	if ($this->DIRECCIONCENTRO == '')
	{
		array_push($this->erroresdatos, ["nombreatributo" => "DIRECCIONCENTRO", "codigoincidencia" => "00001" ,"mensajeerror" => "DIRECCIONCENTRO Vacio"]);

		$correcto = false;
	}

	//si los atributos estan vacios
	if (strlen($this->DIRECCIONCENTRO) > 51)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "DIRECCIONCENTRO", "codigoincidencia" => "00002" ,"mensajeerror" => "DIRECCIONCENTRO demasiado largo, máximo 50 caracteres"]);

		$correcto = false;

	}

	//si los atributos estan vacios
	if (strlen($this->DIRECCIONCENTRO) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "DIRECCIONCENTRO", "codigoincidencia" => "00002" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;

	}

	//si los atributos son alfabeticos
	if (ctype_alpha($this->DIRECCIONCENTRO))
	{
		array_push($this->erroresdatos, ["nombreatributo" => "DIRECCIONCENTRO", "codigoincidencia" => "00003" ,"mensajeerror" => "DIRECCIONCENTRO solo permite caracteres"]);

		$correcto = false;

	}

	return $correcto;
}

// function comprobar_RESPONSABLECENTRO
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_RESPONSABLECENTRO()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado
	
	//si los atributos estan vacios
	if (strlen($this->RESPONSABLECENTRO) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "RESPONSABLECENTRO", "codigoincidencia" => "00001" ,"mensajeerror" => "RESPONSABLECENTRO Vacio"]);

		$correcto = false;

	}

	//si los atributos estan vacios
	if (strlen($this->RESPONSABLECENTRO) > 61)
	{
		$error ='trad_RESPONSABLECENTROLargo';
		array_push($this->erroresdatos, ["nombreatributo" => "RESPONSABLECENTRO", "codigoincidencia" => "00002" ,"mensajeerror" => "RESPONSABLECENTRO demasiado largo, máximo 50 caracteres"]);
		
		$correcto = false;

	}

	if (strlen($this->RESPONSABLECENTRO) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "RESPONSABLECENTRO", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}
	
	//si los atributos son alfabeticos
	if (ctype_alpha($this->RESPONSABLECENTRO))
	{
		$error ='trad_RESPONSABLECENTROAlfa';
		array_push($this->erroresdatos, ["nombreatributo" => "RESPONSABLECENTRO", "codigoincidencia" => "00003" ,"mensajeerror" => "RESPONSABLECENTRO solo permite caracteres"]);

		$correcto = false;

	}

	return $correcto;
}

}//fin de clase

?> 