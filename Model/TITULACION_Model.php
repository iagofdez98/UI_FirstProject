
<?php

//Clase : TITULACION_Model
//Creado el : 05/10/2019
//Creado por: stwgno

class TITULACION_Model {

	var $CODTITULACION; //codigo de la titulacion
	var $CODCENTRO; //codigo del centro
	var $NOMBRETITULACION; //nombre de titulacion
	var $RESPONSABLETITULACION; //responsable de la titulacion

//Constructor de la clase
function __construct($CODTITULACION,$CODCENTRO,$NOMBRETITULACION,$RESPONSABLETITULACION){
	$this->CODTITULACION = $CODTITULACION;
	$this->CODCENTRO = $CODCENTRO;
	$this->NOMBRETITULACION = $NOMBRETITULACION;
	$this->RESPONSABLETITULACION = $RESPONSABLETITULACION;

	$this->erroresdatos = array(); 

	include_once '../Model/Access_DB.php';
	$this->mysqli = ConnectDB();
}

// function comprobar_atributos
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_atributos(){
	$array = array(); //array donde se guardan los errores

	$errores = $this->comprobar_CODTITULACION(); //variable que se va a igualar al resultado de los metodos de comprobacion
	
	//En los siguientes if se comprueba si errores devuelve true o false, en caso de devolver false
	//significa que hay un error en el metodo. De no haberlo salta a la siguiente condición
	$errores = $this->comprobar_CODTITULACION();
	if($errores == false)
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_CODCENTRO();
	if($errores == false)
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_NOMBRETITULACION();
	if($errores == false)
	{
		array_push($array, $errores);
	}
	
	$errores = $this->comprobar_RESPONSABLETITULACION();
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

	if($comprobar == true)
	{
		//comprueba si existe la clave
		$sql = "select * from TITULACION where CODTITULACION = '".$this->CODTITULACION."'";

		if (!$result = $this->mysqli->query($sql))
		{
			return 'Error de gestor de base de datos';
		}

		//si existe, error
		if ($result->num_rows == 1){  // existe el usuario
				return 'Inserción fallida: el elemento ya existe';
			}

		//si no
		$sql = "INSERT INTO TITULACION (
			CODTITULACION,
			CODCENTRO,
			NOMBRETITULACION,
			RESPONSABLETITULACION) 
				VALUES (
					'".$this->CODTITULACION."',
					'".$this->CODCENTRO."',
					'".$this->NOMBRETITULACION."',
					'".$this->RESPONSABLETITULACION."'
					)";

		if (!$this->mysqli->query($sql)) {
			return 'Error de gestor de base de datos: ';
		}
		else{
			return 'Inserción realizada con éxito'; //operacion de insertado correcta
		}		
	}
	else{
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
			FROM TITULACION
			WHERE (
				CODTITULACION LIKE '%".$this->CODTITULACION."%' AND
				CODCENTRO LIKE '%".$this->CODCENTRO."%' AND
				NOMBRETITULACION LIKE '%".$this->NOMBRETITULACION."%' AND
				RESPONSABLETITULACION LIKE '%".$this->RESPONSABLETITULACION."%'
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
	$comprobar = $this->comprobar_CODTITULACION(); //Busca si la tupla es correcta o tiene algun error

	if($comprobar == true)
	{
		$if1 = "SELECT CODTITULACION
				FROM PROF_TITULACION
				WHERE(
	   				CODTITULACION = '$this->CODTITULACION'
	   			)";

		$valores = $this->mysqli->query($if1); //Almacena resultado de la consulta
		
		if($valores->num_rows == 0) //si no hay ningun centro en el edificio
		{

		   $sql = "	DELETE FROM 
		   				TITULACION
		   			WHERE(
		   				CODTITULACION = '$this->CODTITULACION'
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

// funcion RellenaDatos: recupera todos los atributos de una tupla a partir de su clave
function RellenaDatos()
{
    $sql = "SELECT *
			FROM TITULACION
			WHERE (
				(CODTITULACION = '$this->CODTITULACION') 
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
		$sql = "UPDATE TITULACION
				SET 
					`CODTITULACION` = '$this->CODTITULACION',
					`CODCENTRO` = '$this->CODCENTRO',
					`NOMBRETITULACION` = '$this->NOMBRETITULACION',
					`RESPONSABLETITULACION` = '$this->RESPONSABLETITULACION'
				WHERE (
					CODTITULACION = '$this->CODTITULACION'
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

// funcion CodigosCentro: devuelve los codigos de todos centros que hay en la base de datos
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

	if (strlen($this->CODTITULACION) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODTITULACION", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	//si los atributos estan vacios
	if (strlen($this->CODTITULACION) > 11)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODTITULACION", "codigoincidencia" => "00002" ,"mensajeerror" => "CODTITULACION demasiado largo, maximo 10 caracteres"]);	
	
		$correcto = false;
	}

	return $correcto;
}

// function Comprobar_CODCENTRO
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_CODCENTRO()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado
	//si los atributos estan vacios
	if (strlen($this->CODCENTRO) == 0)
	{
		$error ='trad_CODCENTROVacio';
		array_push($this->erroresdatos, ["nombreatributo" => "CODCENTRO", "codigoincidencia" => "00001" ,"mensajeerror" => "CODCENTRO vacio"]);

		$correcto = false;
	}

	if (strlen($this->CODCENTRO) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODCENTRO", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	//si los atributos estan vacios
	if (strlen($this->CODCENTRO) > 11)
	{
		$error ='trad_CODCENTROLargo';
		array_push($this->erroresdatos, ["nombreatributo" => "CODCENTRO", "codigoincidencia" => "00002" ,"mensajeerror" => "CODCENTRO demasiado largo, maximo 10 caracteres"]);	
	
		$correcto = false;
	}

	return $correcto;
}

// function comprobar_NOMBRETITULACION
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_NOMBRETITULACION()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado

	//si los atributos estan vacios
	if (strlen($this->NOMBRETITULACION) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "NOMBRETITULACION", "codigoincidencia" => "00001" ,"mensajeerror" => "NOMBRETITULACION vacio"]);

		$correcto = false;
	}

	//si los atributos estan vacios
	if (strlen($this->NOMBRETITULACION) > 51)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "NOMBRETITULACION", "codigoincidencia" => "00002" ,"mensajeerror" => "NOMBRETITULACION demasiado largo, maximo 50 caracteres"]);

		$correcto = false;	
	}

	if (strlen($this->NOMBRETITULACION) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "NOMBRETITULACION", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	//si los atributos son alfabeticos
	if (ctype_alpha($this->NOMBRETITULACION))
	{
		array_push($this->erroresdatos, ["nombreatributo" => "NOMBRETITULACION", "codigoincidencia" => "00003" ,"mensajeerror" => "NOMBRETITULACION no valido, solo se admiten caracteres"]);

		$correcto = false;	
	}

	return true;
}

// function comprobar_RESPONSABLETITULACION
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_RESPONSABLETITULACION()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado

	//si los atributos estan vacios
	if (strlen($this->RESPONSABLETITULACION) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "RESPONSABLETITULACION", "codigoincidencia" => "00001" ,"mensajeerror" => "RESPONSABLETITULACION vacio"]);

		$correcto = false;	
	}

	//si los atributos estan vacios
	if (strlen($this->RESPONSABLETITULACION) > 61)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "RESPONSABLETITULACION", "codigoincidencia" => "00002" ,"mensajeerror" => "RESPONSABLETITULACION demasiado largo, maximo 50 caracteres"]);

		$correcto = false;	
	}

	if (strlen($this->RESPONSABLETITULACION) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "RESPONSABLETITULACION", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	//si los atributos son alfabeticos
	if (ctype_alpha($this->RESPONSABLETITULACION))
	{
		array_push($this->erroresdatos, ["nombreatributo" => "RESPONSABLETITULACION", "codigoincidencia" => "00003" ,"mensajeerror" => "RESPONSABLETITULACION no valido, solo se admiten caracteres"]);

		$correcto = false;	
	}

	return true;
}

}//fin de clase

?> 