
<?php

//Clase : PROF_TITULACION_Controller
//Creado el : 05/10/2019
//Creado por: stwgno

	session_start(); //solicito trabajar con la session

	include '../Functions/Authentication.php';

//comprobar autenticacion
	if (!IsAuthenticated()){
		header('Location:../index.php');
	}

	include_once '../Model/PROF_TITULACION_Model.php';
	include '../View/PROF_TITULACION_SHOWALL_View.php';
	include '../View/PROF_TITULACION_SEARCH_View.php';
	include '../View/PROF_TITULACION_ADD_View.php';
	include '../View/PROF_TITULACION_EDIT_View.php';
	include '../View/PROF_TITULACION_DELETE_View.php';
	include '../View/PROF_TITULACION_SHOWCURRENT_View.php';
	include '../View/MESSAGE_View.php';

// la función get_data_form() recoge los valores que vienen del formulario por medio de post y la action a realizar, crea una instancia PROF_TITULACION y la devuelve
	function get_data_form(){

		$DNI = $_POST['DNI'];//Se recoge el valor de DNI en el formulario
		$CODTITULACION = $_POST['CODTITULACION'];//Se recoge el valor de CODTITULACION en el formulario
		$ANHOACADEMICO = $_POST['ANHOACADEMICO'];//Se recoge el valor de ANHOACADEMICO en el formulario
		$action = $_POST['action'];//Se recoge el valor de action en el formulario
		
		$PROF_TITULACION = new PROF_TITULACION_Model($DNI, $CODTITULACION,$ANHOACADEMICO); //Se crea la instancia de PROF_TITULACION
		return $PROF_TITULACION; 
	}

	
// sino existe la variable action la crea vacia para no tener error de undefined index
	if (!isset($_REQUEST['action'])){
		$_REQUEST['action'] = '';
	}

// En funcion del action realizamos las acciones necesarias
		Switch ($_REQUEST['action']){
			case 'ADD': //añadir prof_titulacion
				if (!$_POST){ // se invoca la vista de add de PROF_TITULACION
					$PROF_TITULACION = new PROF_TITULACION_Model('','',''); //se crea nuevo model
					$respuesta = $PROF_TITULACION->CodigosDNI(); //se aplica codigosdni al model
					$respuesta2 = $PROF_TITULACION->CodigosTitulacion(); //se aplica codigos titulacion al model
					
					new PROF_TITULACION_ADD($respuesta,$respuesta2);
				}
				else{//si no
					$PROF_TITULACION = get_data_form(); //se recogen los datos del formulario
					$respuesta = $PROF_TITULACION->ADD(); //se recoge el resultado de aplicar ADD en los datos del formulario
					new MESSAGE($respuesta, '../Controller/PROF_TITULACION_Controller.php');
				}
				break;

			case 'DELETE'://borrar prof_titulacion
				if (!$_POST){ //nos llega el id a eliminar por get
					$PROF_TITULACION = new PROF_TITULACION_Model($_REQUEST['DNI'],'','');
					$valores = $PROF_TITULACION->RellenaDatos(); //se rellenan los datos
					new PROF_TITULACION_DELETE($valores); //se le muestra al usuario los valores de la tupla para que confirme el borrado mediante un form que no permite modificar las variables 
				}
				else{ // llegan los datos confirmados por post y se eliminan
					$PROF_TITULACION = get_data_form();//se rellena el form
					$respuesta = $PROF_TITULACION->DELETE();//se aplica delete a los datos del form
					new MESSAGE($respuesta, '../Controller/PROF_TITULACION_Controller.php');
				}
				break;

			case 'EDIT'://editar prof_titulacion creada
				if (!$_POST){ //nos llega el usuario a editar por get
					$PROF_TITULACION = new PROF_TITULACION_Model($_REQUEST['DNI'],'',''); // Creo el objeto
					$valores = $PROF_TITULACION->RellenaDatos(); // obtengo todos los datos de la tupla
					if (is_array($valores))//si valores es array
					{
						new PROF_TITULACION_EDIT($valores, $PROF_TITULACION->CodigosDNI(), $PROF_TITULACION->CodigosTitulacion()); //invoco la vista de edit con los datos 
							//precargados
					}else//datos confirmados por post
					{
						new MESSAGE($valores, '../Controller/PROF_TITULACION_Controller.php');
					}
				}
				else{//datos confirmados por post

					$PROF_TITULACION = get_data_form(); //recojo los valores del formulario

					$respuesta = $PROF_TITULACION->EDIT(); // update en la bd en la bd
					new MESSAGE($respuesta, '../Controller/PROF_TITULACION_Controller.php');
				}

				break;

			case 'SEARCH': //buscar entre prof_titulacion creadas
				if (!$_POST){//invoca
					new PROF_TITULACION_SEARCH();
				}
				else{
					$PROF_TITULACION = get_data_form(); //recojo datos del formulario
					$datos = $PROF_TITULACION->SEARCH(); //busqueda a los datos del formulario

					$lista = array('DNI','CODTITULACION','ANHOACADEMICO'); //array de atributos

					new PROF_TITULACION_SHOWALL($lista, $datos, '../index.php');
				}
				break;

			case 'SHOWCURRENT': //mostrar datos de una tupla de prof_titulacion
				$PROF_TITULACION = new PROF_TITULACION_Model($_REQUEST['DNI'],'',''); //nuevo model con el dni pasado
				$valores = $PROF_TITULACION->RellenaDatos();//se rellenan los datos del form
				new PROF_TITULACION_SHOWCURRENT($valores);
				break;

			default: //caso base
				if (!$_POST){ //invoca
					$PROF_TITULACION = new PROF_TITULACION_Model('','',''); //nuevo model
				}
				else{//si no
					$PROF_TITULACION = get_data_form(); //recoge formulario
				}
				$datos = $PROF_TITULACION->SEARCH(); //busqueda de datos
				$lista = array('DNI','CODTITULACION','ANHOACADEMICO'); //array de atributos
				new PROF_TITULACION_SHOWALL($lista, $datos);
		}

?>
