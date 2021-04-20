
<?php

//Clase: CENTRO_Controller
//Fecha: 05/10/2019
//Creado por: stwgno

//Solicita iniciar sesión
	session_start();
	include '../Functions/Authentication.php';

//Comprueba si se autentica
	if (!IsAuthenticated()){
		header('Location:../index.php');
	}

	include '../Model/CENTRO_Model.php';
	include '../View/CENTRO_SHOWALL_View.php';
	include '../View/CENTRO_SEARCH_View.php';
	include '../View/CENTRO_ADD_View.php';
	include '../View/CENTRO_EDIT_View.php';
	include '../View/CENTRO_DELETE_View.php';
	include '../View/CENTRO_SHOWCURRENT_View.php';
	include '../View/MESSAGE_View.php';

//La función get_data_form() recoge los valores que vienen del formulario por medio de POST y la action a realizar, crea una instancia centro y la devuelve
	function get_data_form(){

		$CODCENTRO = $_POST['CODCENTRO'];//Se recoge el valor de CODCENTRO en el formulario
		$CODEDIFICIO = $_POST['CODEDIFICIO'];//Se recoge el valor de CODEDIFICIO en el formulario
		$NOMBRECENTRO = $_POST['NOMBRECENTRO'];//Se recoge el valor de NOMBRECENTRO en el formulario
		$DIRECCIONCENTRO = $_POST['DIRECCIONCENTRO'];//Se recoge el valor de DIRECCIONCENTRO en el formulario
		$RESPONSABLECENTRO = $_POST['RESPONSABLECENTRO'];//Se recoge el valor de RESPONSABLECENTRO en el formulario
		
		$centro = new CENTRO_Model($CODCENTRO,$CODEDIFICIO,$NOMBRECENTRO,$DIRECCIONCENTRO,$RESPONSABLECENTRO); //Se crea la instancia de CENTRO
		return $centro; 
	}

	
//Sino existe la variable action la crea vacia para no tener error de undefined index
	if (!isset($_REQUEST['action'])){
		$_REQUEST['action'] = '';
	}

//En funcion del action realizamos las acciones necesarias

		Switch ($_REQUEST['action']){
			case 'ADD': //Añadir un nuevo centro
				if (!$_POST){ //invoca
					$centro = new CENTRO_Model('','','','',''); //Se recogen los datos del formulario
					$valores = $centro->CodigosEdificio();//Se recoge la respuesta del metodo CodigosEdificio()
					new CENTRO_ADD($valores);
				}
				else //si no
				{
					$centro = get_data_form(); //Se recogen los datos del formulario
					$respuesta = $centro->ADD();//Se recoge la respuesta del metodo ADD()
					new MESSAGE($respuesta, '../Controller/CENTRO_Controller.php');
				}
				break;

			case 'DELETE': //Borrar un centro
				if (!$_POST){ //invoca
					$centro = new CENTRO_Model($_REQUEST['CODCENTRO'],'','','',''); //Se recoge el centro a borrar
					$valores = $centro->RellenaDatos(); //Se recogen los valores del centro a borrar
					//Se le muestra al usuario los valores de la tupla para que confirme el borrado mediante un form que no permite modificar las variables 
					new CENTRO_DELETE($valores); 
				}
				else //Llegan los datos confirmados por POST y se eliminan
				{ 
					$centro = get_data_form();
					$respuesta = $centro->DELETE();
					new MESSAGE($respuesta, '../Controller/CENTRO_Controller.php');
				}
				break;

			case 'EDIT': //Editar un centro ya creado
				if (!$_POST){//invoca
					$centro = new CENTRO_Model($_REQUEST['CODCENTRO'],'','','',''); // Creo el objeto
					$valores = $centro->RellenaDatos(); //Obtengo todos los datos de la tupla
					if (is_array($valores)) //si valores es un array
					{
						new CENTRO_EDIT($valores, $centro->CodigosEdificio()); //Invoco la vista de edit con los datos precargados
					}else //esta vacio
					{
						new MESSAGE($valores, '../Controller/CENTRO_Controller.php');
					}
				}
				else //si no
				{
					$centro = get_data_form(); //recojo los valores del formulario
					$respuesta = $centro->EDIT(); // update en la bd
					new MESSAGE($respuesta, '../Controller/CENTRO_Controller.php');
				}

				break;

			case 'SEARCH': //Buscar entre los centros creados
				if (!$_POST){//invoca
					new CENTRO_SEARCH();
				}
				else//si no
				{
					$centro = get_data_form();//recojo valores del formulario
					$datos = $centro->SEARCH();//busqueda en la bd
					$lista = array('CODCENTRO','CODEDIFICIO','NOMBRECENTRO','DIRECCIONCENTRO','RESPONSABLECENTRO');//lista de la busqueda
					new CENTRO_SHOWALL($lista, $datos, '../index.php');
				}
				break;

			case 'SHOWCURRENT': //Muestra los datos de un centro
				$centro = new CENTRO_Model($_REQUEST['CODCENTRO'],'','','',''); //crea un nuevo model con el codcentro pasado
				$valores = $centro->RellenaDatos(); //rellena los datos
				new CENTRO_SHOWCURRENT($valores);
				break;

			default: //Caso por defecto
				if (!$_POST){//invoca
					$centro = new CENTRO_Model('','','','',''); //enseña todo
				}
				else//si no
				{
					$centro = get_data_form(); //recoge datos
				}
				$datos = $centro->SEARCH(); //busqueda
				$lista = array('CODCENTRO','CODEDIFICIO','NOMBRECENTRO','DIRECCIONCENTRO','RESPONSABLECENTRO'); //lista con los atributos de la tabla
				new CENTRO_SHOWALL($lista, $datos);
		}

?>
