

<?php

//Clase : PROFESOR_Model
//Creado el : 05/10/2019
//Creado por: stwgno

class PROFESOR_Model {

	var $DNI;	//DNI del profesor
	var $NOMBREPROFESOR; //nombre profesor
	var $APELLIDOSPROFESOR; //apellidos profesor
	var $AREAPROFESOR; //area profesor
	var $DEPARTAMENTOPROFESOR; //departamente profesor

//Constructor de la clase
function __construct($DNI,$NOMBREPROFESOR,$APELLIDOSPROFESOR,$AREAPROFESOR,$DEPARTAMENTOPROFESOR){
	$this->DNI = $DNI;
	$this->NOMBREPROFESOR = $NOMBREPROFESOR;
	$this->APELLIDOSPROFESOR = $APELLIDOSPROFESOR;
	$this->AREAPROFESOR = $AREAPROFESOR;
	$this->DEPARTAMENTOPROFESOR = $DEPARTAMENTOPROFESOR;

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
	if($errores == false) 
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_NOMBREPROFESOR();
	if($errores == false)
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_APELLIDOSPROFESOR();
	if($errores == false)
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_AREAPROFESOR();
	if($errores == false)
	{
		array_push($array, $errores);
	}
	
	$errores = $this->comprobar_DEPARTAMENTOPROFESOR();
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
//Inserta en la tabla de la BD los valores de los atributos del objeto. 
//Comprueba si la clave/s esta vacia y si existe ya en la tabla
function ADD(){
	
	$comprobar = $this->comprobar_atributos(); //Busca si la tupla es correcta o tiene algun error

	if($comprobar == true)
	{
		//comprueba si la existe la clave en la tabla
		$sql = "select * from PROFESOR where DNI = '".$this->DNI."'";

		if (!$result = $this->mysqli->query($sql))
		{
			return 'Error de gestor de base de datos';
		}

		//si existe, error
		if ($result->num_rows == 1){  // existe el usuario
				return 'Inserción fallida: el elemento ya existe';
			}

		//si no
		$sql = "INSERT INTO PROFESOR (
				DNI,
				NOMBREPROFESOR,
				APELLIDOSPROFESOR,
				AREAPROFESOR,
				DEPARTAMENTOPROFESOR) 
				VALUES (
					'".$this->DNI."',
					'".$this->NOMBREPROFESOR."',
					'".$this->APELLIDOSPROFESOR."',
					'".$this->AREAPROFESOR."',
					'".$this->DEPARTAMENTOPROFESOR."'
					)";

		if (!$this->mysqli->query($sql)) {
			return 'Error de gestor de base de datos: ';
		}
		else{
			return 'Inserción realizada con éxito'; //operacion de insertado correcta
		}		
	}else
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

	$sql = "SELECT *
			FROM PROFESOR
			WHERE (
				DNI LIKE '%".$this->DNI."%' AND
				NOMBREPROFESOR LIKE '%".$this->NOMBREPROFESOR."%' AND
				APELLIDOSPROFESOR LIKE '%".$this->APELLIDOSPROFESOR."%' AND
				AREAPROFESOR LIKE '%".$this->AREAPROFESOR."%' AND
				DEPARTAMENTOPROFESOR LIKE '%".$this->DEPARTAMENTOPROFESOR."%'
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
		$if1 = "SELECT DNI
				FROM PROF_ESPACIO
				WHERE(
	   				DNI = '$this->DNI'
	   			)";

		$valores = $this->mysqli->query($if1); //Almacena resultado de la consulta
		
		if($valores->num_rows == 0) //si no hay ningun centro en el edificio
		{
			$if2 = "SELECT DNI
			FROM PROF_TITULACION
			WHERE(
					DNI = '$this->DNI'
				)";

				$valores = $this->mysqli->query($if2); //Almacena resultado de la consulta

					if($valores->num_rows == 0) //si no hay ningun centro en el edificio
					{				
						//sentencia de borrado
					   $sql = "	DELETE FROM 
					   				PROFESOR
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
					}else
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
			FROM PROFESOR
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
		$sql = "UPDATE PROFESOR
				SET 
					`DNI` = '$this->DNI',
					`NOMBREPROFESOR` = '$this->NOMBREPROFESOR',
					`APELLIDOSPROFESOR` = '$this->APELLIDOSPROFESOR',
					`AREAPROFESOR` = '$this->AREAPROFESOR',
					`DEPARTAMENTOPROFESOR` = '$this->DEPARTAMENTOPROFESOR'
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

// function comprobar_NOMBREPROFESOR
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_NOMBREPROFESOR()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado
	//si los atributos estan vacios
	if (strlen($this->NOMBREPROFESOR) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "NOMBREPROFESOR", "codigoincidencia" => "00001" ,"mensajeerror" => "NOMBREPROFESOR vacio"]);

		$correcto = false;

	}

	//si los atributos estan vacios
	if (strlen($this->NOMBREPROFESOR) > 51)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "NOMBREPROFESOR", "codigoincidencia" => "00002" ,"mensajeerror" => "NOMBREPROFESOR demasiado largo, maximo 50 caracteres"]);

		$correcto = false;

	}

	if (strlen($this->NOMBREPROFESOR) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "NOMBREPROFESOR", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	//si los atributos son alfabeticos
	if (ctype_alpha($this->NOMBREPROFESOR))
	{
		$error ='trad_NOMBREPROFESORAlfa';
		array_push($this->erroresdatos, ["nombreatributo" => "NOMBREPROFESOR", "codigoincidencia" => "00003" ,"mensajeerror" => "NOMBREPROFESOR no valido, solo acepta caracteres"]);

		$correcto = false;

	}

	return $correcto;
}

// function comprobar_APELLIDOSPROFESOR
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_APELLIDOSPROFESOR()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado
	//si los atributos estan vacios
	if (strlen($this->APELLIDOSPROFESOR) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "APELLIDOSPROFESOR", "codigoincidencia" => "00001" ,"mensajeerror" => "APELLIDOSPROFESOR vacio"]);

		$correcto = false;

	}

	//si los atributos estan vacios
	if (strlen($this->APELLIDOSPROFESOR) > 51)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "APELLIDOSPROFESOR", "codigoincidencia" => "00002" ,"mensajeerror" => "APELLIDOSPROFESOR demasiado largo, maximo 50 caracteres"]);

		$correcto = false;

	}

	if (strlen($this->APELLIDOSPROFESOR) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "APELLIDOSPROFESOR", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	//si los atributos son alfabeticos
	if (ctype_alpha($this->APELLIDOSPROFESOR))
	{
		array_push($this->erroresdatos, ["nombreatributo" => "APELLIDOSPROFESOR", "codigoincidencia" => "00003" ,"mensajeerror" => "APELLIDOSPROFESOR no valido, solo acepta caracteres"]);

		$correcto = false;

	}

	return $correcto;
}

// function comprobar_AREAPROFESOR
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_AREAPROFESOR()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado

	//si los atributos estan vacios
	if (strlen($this->AREAPROFESOR) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "AREAPROFESOR", "codigoincidencia" => "00001" ,"mensajeerror" => "AREAPROFESOR vacio"]);

		$correcto = false;
	}

	if (strlen($this->AREAPROFESOR) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "AREAPROFESOR", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	//si los atributos estan vacios
	if (strlen($this->AREAPROFESOR) > 61)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "AREAPROFESOR", "codigoincidencia" => "00002" ,"mensajeerror" => "APELLIDOSPROFESOR demasiado largo, maximo 60 caracteres"]);

		$correcto = false;
	}

	return true;
}

// function comprobar_DEPARTAMENTOPROFESOR
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_DEPARTAMENTOPROFESOR()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado

	//si los atributos estan vacios
	if (strlen($this->DEPARTAMENTOPROFESOR) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "DEPARTAMENTOPROFESOR", "codigoincidencia" => "00001" ,"mensajeerror" => "DEPARTAMENTOPROFESOR vacio"]);

		$correcto = false;
	}

	if (strlen($this->DEPARTAMENTOPROFESOR) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "DEPARTAMENTOPROFESOR", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	//si los atributos estan vacios
	if (strlen($this->DEPARTAMENTOPROFESOR) > 61)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "DEPARTAMENTOPROFESOR", "codigoincidencia" => "00002" ,"mensajeerror" => "DEPARTAMENTOPROFESOR demasiado largo, maximo 60 caracteres"]);

		$correcto = false;
	}

	return true;
}

}//fin de clase

?> 