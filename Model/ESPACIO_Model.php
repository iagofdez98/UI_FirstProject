<?php

//Clase : ESPACIO_Model
//Creado el : 05/10/2019
//Creado por: stwgno

class ESPACIO_Model {

	var $CODESPACIO; //CODIGO del ESPACIO
	var $CODEDIFICIO;//CODIGO del EDIFICIO
	var $CODCENTRO;//CODIGO del CENTRO
	var $TIPO;//Tipo de ESPACIO
	var $SUPERFICIEESPACIO; //SUPERFICIE del ESPACIO
	var $NUMINVENTARIOESPACIO; //INVENTARIO del ESPACIO

//Constructor de la clase
function __construct($CODESPACIO,$CODEDIFICIO,$CODCENTRO,$TIPO,$SUPERFICIEESPACIO,$NUMINVENTARIOESPACIO){
	$this->CODESPACIO = $CODESPACIO;
	$this->CODEDIFICIO = $CODEDIFICIO;
	$this->CODCENTRO = $CODCENTRO;
	$this->TIPO = $TIPO;
	$this->SUPERFICIEESPACIO = $SUPERFICIEESPACIO;
	$this->NUMINVENTARIOESPACIO = $NUMINVENTARIOESPACIO;

	$this->erroresdatos = array(); 

	include_once '../Model/Access_DB.php';
	$this->mysqli = ConnectDB();
}

//function comprobar_atributos()
//si todos los atributos son correctos, devuelve true, si no se devuelve el array con los errores
function comprobar_atributos(){
	$array = array(); //array donde se guardan los errores

	$errores = $this->comprobar_CODESPACIO(); //variable que se va a igualar al resultado de los metodos de comprobacion
	
	//En los siguientes if se comprueba si errores devuelve true o false, en caso de devolver false
	//significa que hay un error en el metodo. De no haberlo salta a la siguiente condición
	if($errores == false) //si errores es un array, indica que se ha encontrado un error
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_CODEDIFICIO();
	if($errores == false) //si errores es un array, indica que se ha encontrado un error
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_CODCENTRO();
	if($errores == false)
	{
		array_push($array, $errores);
	}
	
	$errores = $this->comprobar_TIPO();
	if($errores == false)
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_SUPERFICIEESPACIO();
	if($errores == false)
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_NUMINVENTARIOESPACIO();
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

	$comprobar = $this->comprobar_atributos();//Se iguala a la comprobacion de atributos
	
	if($comprobar == true)
	{
		//comprueba si existe otro ESPACIO con el mismo CODIGO
		$sql = "select * from ESPACIO where CODESPACIO = '".$this->CODESPACIO."'";

		if (!$result = $this->mysqli->query($sql))
		{
			return 'Error de gestor de base de datos';
		}

		//si existe, error
		if ($result->num_rows == 1){  // existe el usuario
				return 'Inserción fallida: el elemento ya existe';
			}

		//si no, inserta
		$sql = "INSERT INTO ESPACIO (
				CODESPACIO,
				CODEDIFICIO,
				CODCENTRO,
				TIPO,
				SUPERFICIEESPACIO,
				NUMINVENTARIOESPACIO) 
				VALUES (
					'".$this->CODESPACIO."',
					'".$this->CODEDIFICIO."',
					'".$this->CODCENTRO."',
					'".$this->TIPO."',
					'".$this->SUPERFICIEESPACIO."',
					'".$this->NUMINVENTARIOESPACIO."'
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
			FROM ESPACIO
			WHERE (
				CODESPACIO LIKE '%".$this->CODESPACIO."%' AND
				CODEDIFICIO LIKE '%".$this->CODEDIFICIO."%' AND
				CODCENTRO LIKE '%".$this->CODCENTRO."%' AND
				TIPO LIKE '%".$this->TIPO."%' AND
				SUPERFICIEESPACIO LIKE '%".$this->SUPERFICIEESPACIO."%' AND
				NUMINVENTARIOESPACIO LIKE '%".$this->NUMINVENTARIOESPACIO."%'

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

	$comprobar = $this->comprobar_CODESPACIO();//Se iguala a la comprobacion de atributos
	
	if($comprobar == true)
	{
		$if1 = "SELECT CODESPACIO
				FROM PROF_ESPACIO
				WHERE(
	   				CODESPACIO = '$this->CODESPACIO'
	   			)";

		$valores = $this->mysqli->query($if1); //Almacena resultado de la consulta

					if($valores->num_rows == 0) //si no hay ningun centro en el edificio
					{				
						//sentencia de borrado
					   $sql = "	DELETE FROM 
					   				ESPACIO
					   			WHERE(
					   				CODESPACIO = '$this->CODESPACIO'
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
			}else
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
			FROM ESPACIO
			WHERE (
				(CODESPACIO = '$this->CODESPACIO') 
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
	$comprobar = $this->comprobar_atributos();//Se iguala a la comprobacion de atributos
	
	if($comprobar == true)
	{
		//actualiza los datos del espacio
		$sql = "UPDATE ESPACIO
				SET 
					`CODEDIFICIO` = '$this->CODEDIFICIO',
					`CODESPACIO` = '$this->CODESPACIO',
					`CODCENTRO` = '$this->CODCENTRO',
					`TIPO` = '$this->TIPO',
					`SUPERFICIEESPACIO` = '$this->SUPERFICIEESPACIO',
					`NUMINVENTARIOESPACIO` = '$this->NUMINVENTARIOESPACIO'

				WHERE (
					CODESPACIO = '$this->CODESPACIO'
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
// funcion CodigosEdificio: devuelve los codigos de todos edificios que hay en la base de datos
function CodigosEdificio(){
	$sql = "SELECT CODEDIFICIO
			FROM EDIFICIO";
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

// funcion CodigosCentro: devuelve los codigos de todos edificios que hay en la base de datos
function CodigosCentro(){
	$sql = "SELECT CODCENTRO
			FROM CENTRO";
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

// function comprobar_CODEDIFICIO
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_CODEDIFICIO()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado
	//si los atributos estan vacios
	if (strlen($this->CODEDIFICIO) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODEDIFICIO", "codigoincidencia" => "00001" ,"mensajeerror" => "CODEDIFICIO vacio"]);

		$correcto = false;
	}

	//si los atributos estan vacios
	if (strlen($this->CODEDIFICIO) > 11)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODEDIFICIO", "codigoincidencia" => "00002" ,"mensajeerror" => "CODEDIFICIO demasiado largo, maximo 10 caracteres"]);

		$correcto = false;

	}

	if (strlen($this->CODEDIFICIO) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODEDIFICIO", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}	

	return $correcto;
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
		array_push($this->erroresdatos, ["nombreatributo" => "CODCENTRO", "codigoincidencia" => "00001" ,"mensajeerror" => "CODCENTRO vacio"]);

		$correcto = false;
	}

	//si los atributos estan vacios
	if (strlen($this->CODCENTRO) > 11)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODCENTRO", "codigoincidencia" => "00002" ,"mensajeerror" => "CODCENTRO demasiado largo, maximo 10 caracteres"]);	
	
		$correcto = false;
	}

	if (strlen($this->CODCENTRO) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODCENTRO", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}
	
	return $correcto;
}

// function comprobar_TIPO
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_TIPO()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado

	//si los atributos estan vacios
	if (strlen($this->TIPO) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "TIPO", "codigoincidencia" => "00001" ,"mensajeerror" => "TIPO vacio"]);	
	
		$correcto = false;
	}

	return $correcto;
}

// function comprobar_SUPERFICIEESPACIO
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_SUPERFICIEESPACIO()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado

	//si los atributos estan vacios
	if (strlen($this->SUPERFICIEESPACIO) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "SUPERFICIEESPACIO", "codigoincidencia" => "00001" ,"mensajeerror" => "SUPERFICIEESPACIO vacio"]);	
	
		$correcto = false;
	}


	//si los atributos no estan entre los numeros indicados
	if ($this->SUPERFICIEESPACIO > 9999)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "SUPERFICIEESPACIO", "codigoincidencia" => "00002" ,"mensajeerror" => "SUPERFICIEESPACIO demasiado largo, maximo 4 digitos"]);	
	
		$correcto = false;
	}

	return $correcto;
}

// function comprobar_NUMINVENTARIOESPACIO 
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_NUMINVENTARIOESPACIO()
{
	//si los atributos estan vacios
	if (strlen($this->NUMINVENTARIOESPACIO) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "NUMINVENTARIOESPACIO", "codigoincidencia" => "00001" ,"mensajeerror" => "NUMINVENTARIOESPACIO vacio"]);	
	
		$correcto = false;
	}

	//si los atributos no estan entre los numeros indicados
	if ($this->NUMINVENTARIOESPACIO > 99999999)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "NUMINVENTARIOESPACIO", "codigoincidencia" => "00004" ,"mensajeerror" => "NUMINVENTARIOESPACIO demasiado largo, maximo 8 digitos"]);	
	
		$correcto = false;
	}

	return $correcto;
}

}//fin de clase

?> 