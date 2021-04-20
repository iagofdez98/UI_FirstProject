

<?php

//Clase : EDIFICIO_Model
//Creado el : 05/10/2019
//Creado por: stwgno

class EDIFICIO_Model {

	var $CODEDIFICIO;		//El CODEDIFICIO de EDIFICIO
	var $NOMBREEDIFICIO;	//El NOMBRE del EDIFICIO
	var $DIRECCIONEDIFICIO;	//DIRECCION de EDIFICIO
	var $CAMPUSEDIFICIO;		//CAMPUS del EDIFICIO

//Constructor de la clase
function __construct($CODEDIFICIO,$NOMBREEDIFICIO,$DIRECCIONEDIFICIO,$CAMPUSEDIFICIO){
	$this->CODEDIFICIO = $CODEDIFICIO;
	$this->NOMBREEDIFICIO = $NOMBREEDIFICIO;
	$this->DIRECCIONEDIFICIO = $DIRECCIONEDIFICIO;
	$this->CAMPUSEDIFICIO = $CAMPUSEDIFICIO;
	$this->erroresdatos = array(); 

	include_once '../Model/Access_DB.php';
	$this->mysqli = ConnectDB();
}

//function comprobar_atributos()
//si todos los atributos son correctos, devuelve true, si no se devuelve el array con los errores
function comprobar_atributos(){
	$array = array(); //array donde se guardan los errores

	$errores = $this->comprobar_CODEDIFICIO(); //variable que se va a igualar al resultado de los metodos de comprobacion

	//En los siguientes if se comprueba si errores devuelve true o false, en caso de devolver false
	//significa que hay un error en el metodo. De no haberlo salta a la siguiente condición
	if($errores == false) 
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_NOMBREEDIFICIO();
	if($errores == false)
	{
		array_push($array, $errores);
	}

	$errores = $this->comprobar_DIRECCIONEDIFICIO();
	if($errores == false)
	{
		array_push($array, $errores);
	}
	
	$errores = $this->comprobar_CAMPUSEDIFICIO();
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
	$comprobar = $this->comprobar_atributos();//variable que se va a igualar al resultado de los metodos de comprobacion
	
	if($comprobar == true)
	{
		//comprueba que no exista otra tupla con el mismo CODEDIFICIO
		$sql = "select * from EDIFICIO where CODEDIFICIO = '".$this->CODEDIFICIO."'";

		if (!$result = $this->mysqli->query($sql))
		{
			return 'Error de gestor de base de datos';
		}

		//si existe, error
		if ($result->num_rows == 1){  // existe el usuario
				return 'Inserción fallida: el elemento ya existe';
			}

		//si no, inserta
		$sql = "INSERT INTO EDIFICIO (
			CODEDIFICIO,
			NOMBREEDIFICIO,
			DIRECCIONEDIFICIO,
			CAMPUSEDIFICIO) 
				VALUES (
					'".$this->CODEDIFICIO."',
					'".$this->NOMBREEDIFICIO."',
					'".$this->DIRECCIONEDIFICIO."',
					'".$this->CAMPUSEDIFICIO."'
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

	//busca entre los edificios
	$sql = "SELECT *
			FROM EDIFICIO
			WHERE (
				CODEDIFICIO LIKE '%".$this->CODEDIFICIO."%' AND
				NOMBREEDIFICIO LIKE '%".$this->NOMBREEDIFICIO."%' AND
				DIRECCIONEDIFICIO LIKE '%".$this->DIRECCIONEDIFICIO."%' AND
				CAMPUSEDIFICIO LIKE '%".$this->CAMPUSEDIFICIO."%' 
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

	$comprobar = $this->comprobar_CODEDIFICIO();//variable que se va a igualar al resultado de los metodos de comprobacion
	
	if($comprobar == true)
	{
		$if1 = "SELECT CODEDIFICIO
				FROM CENTRO
				WHERE(
	   				CODEDIFICIO = '$this->CODEDIFICIO'
	   			)";

		$valores = $this->mysqli->query($if1); //Almacena resultado de la consulta
		
		if($valores->num_rows == 0) //si no hay ningun centro en el edificio
		{
			$if2 = "SELECT CODEDIFICIO
			FROM ESPACIO
			WHERE(
					CODEDIFICIO = '$this->CODEDIFICIO'
				)";

				$valores = $this->mysqli->query($if2); //Almacena resultado de la consulta

					if($valores->num_rows == 0) //si no hay ningun centro en el edificio
					{				
						//sentencia de borrado
					   $sql = "	DELETE FROM 
					   				EDIFICIO
					   			WHERE(
					   				CODEDIFICIO = '$this->CODEDIFICIO'
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
	}
	else{
		return $comprobar;
	}
}

// funcion RellenaDatos: recupera todos los atributos de una tupla a partir de su clave
function RellenaDatos()
{
    $sql = "SELECT *
			FROM EDIFICIO
			WHERE (
				(CODEDIFICIO = '$this->CODEDIFICIO') 
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

	$comprobar = $this->comprobar_CODEDIFICIO();//variable que se va a igualar al resultado de los metodos de comprobacion
	
	if($comprobar == true)
	{
		//actualizar datos
		$sql = "UPDATE EDIFICIO
				SET 
					`CODEDIFICIO` = '$this->CODEDIFICIO',
					`NOMBREEDIFICIO` = '$this->NOMBREEDIFICIO',
					`DIRECCIONEDIFICIO` = '$this->DIRECCIONEDIFICIO',
					`CAMPUSEDIFICIO` = '$this->CAMPUSEDIFICIO'
				WHERE (
					CODEDIFICIO = '$this->CODEDIFICIO'
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
	}

	//si los atributos estan vacios
	if (strlen($this->CODEDIFICIO) > 11)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODEDIFICIO", "codigoincidencia" => "00002" ,"mensajeerror" => "CODEDIFICIO demasiado largo, máximo 10 caracteres"]);
	}

	if (strlen($this->CODEDIFICIO) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CODEDIFICIO", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	return $correcto;
}

// function comprobar_NOMBREEDIFICIO
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_NOMBREEDIFICIO()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado
	//si los atributos estan vacios
	if (strlen($this->NOMBREEDIFICIO) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "NOMBREEDIFICIO", "codigoincidencia" => "00001" ,"mensajeerror" => "NOMBREEDIFICIO Vacio"]);
	}

	//si los atributos estan vacios
	if (strlen($this->NOMBREEDIFICIO) > 51)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "NOMBREEDIFICIO", "codigoincidencia" => "00002" ,"mensajeerror" => "NOMBREEDIFICIO demasiado largo, máximo 50 caracteres"]);
	}

	if (strlen($this->NOMBREEDIFICIO) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "NOMBREEDIFICIO", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	//si los atributos son alfabeticos
	if (ctype_alpha($this->NOMBREEDIFICIO))
	{
		array_push($this->erroresdatos, ["nombreatributo" => "NOMBREEDIFICIO", "codigoincidencia" => "00030" ,"mensajeerror" => "NOMBREEDIFICIO solo permite caracteres"]);
	}

	return $correcto;
}
// function comprobar_DIRECCIONEDIFICIO
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_DIRECCIONEDIFICIO()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado
	//si los atributos estan vacios
	if (strlen($this->DIRECCIONEDIFICIO) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "DIRECCIONEDIFICIO", "codigoincidencia" => "00001" ,"mensajeerror" => "DIRECCIONEDIFICIO Vacio"]);
	}

	//si los atributos estan vacios
	if (strlen($this->DIRECCIONEDIFICIO) > 51)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "DIRECCIONEDIFICIO", "codigoincidencia" => "00002" ,"mensajeerror" => "DIRECCIONEDIFICIO demasiado largo, máximo 50 caracteres"]);
	}

	if (strlen($this->DIRECCIONEDIFICIO) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "DIRECCIONEDIFICIO", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}

	//si los atributos son alfabeticos
	if (ctype_alpha($this->DIRECCIONEDIFICIO))
	{
		array_push($this->erroresdatos, ["nombreatributo" => "DIRECCIONEDIFICIO", "codigoincidencia" => "00030" ,"mensajeerror" => "DIRECCIONEDIFICIO solo permite caracteres"]);
	}
	
	return $correcto;
}

// function comprobar_CAMPUSEDIFICIO
// Si todas las funciones de comprobacion de atributos individuales son true devuelve true
// Si alguna es false, devuelve el array de errores de datos
function comprobar_CAMPUSEDIFICIO()
{
	$correcto = true; //variable booleana que comprueba si el atributo cuumple o no lo especificado
	//si los atributos estan vacios
	if (strlen($this->CAMPUSEDIFICIO) == 0)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CAMPUSEDIFICIO", "codigoincidencia" => "00001" ,"mensajeerror" => "CAMPUSEDIFICIO Vacio"]);
	}

	//si los atributos estan vacios
	if (strlen($this->CAMPUSEDIFICIO) > 11)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CAMPUSEDIFICIO", "codigoincidencia" => "00002" ,"mensajeerror" => "CAMPUSEDIFICIO demasiado largo, máximo 10 caracteres"]);
	}

	if (strlen($this->CAMPUSEDIFICIO) < 3)
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CAMPUSEDIFICIO", "codigoincidencia" => "00003" ,"mensajeerror" => "Valor de atributo no numérico demasiado corto"]);

		$correcto = false;
	}	

	//si los atributos son alfabeticos
	if (ctype_alpha($this->CAMPUSEDIFICIO))
	{
		array_push($this->erroresdatos, ["nombreatributo" => "CAMPUSEDIFICIO", "codigoincidencia" => "00030" ,"mensajeerror" => "CAMPUSEDIFICIO solo permite caracteres"]);
	}

	return $correcto;
}

}//fin de clase

?> 