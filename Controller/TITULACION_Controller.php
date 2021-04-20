
<?php

//Clase : TITULACION_Controller
//Creado el : 05/10/2019
//Creado por: stwgno

	session_start(); //solicito trabajar con la session

	include '../Functions/Authentication.php';

//comprueba la autenticacion
	if (!IsAuthenticated()){
		header('Location:../index.php');
	}

	include '../Model/TITULACION_Model.php';
	include '../View/TITULACION_SHOWALL_View.php';
	include '../View/TITULACION_SEARCH_View.php';
	include '../View/TITULACION_ADD_View.php';
	include '../View/TITULACION_EDIT_View.php';
	include '../View/TITULACION_DELETE_View.php';
	include '../View/TITULACION_SHOWCURRENT_View.php';
	include '../View/MESSAGE_View.php';

// la función get_data_form() recoge los valores que vienen del formulario por medio de post y la action a realizar, crea una instancia TITULACION y la devuelve
	function get_data_form(){

		$CODTITULACION = $_POST['CODTITULACION'];//Se recoge el valor de CODTITULACION en el formulario
		$CODCENTRO = $_POST['CODCENTRO'];//Se recoge el valor de CODCENTRO en el formulario
		$NOMBRETITULACION = $_POST['NOMBRETITULACION'];//Se recoge el valor de NOMBRETITULACION en el formulario
		$RESPONSABLETITULACION = $_POST['RESPONSABLETITULACION'];//Se recoge el valor de RESPONSABLETITULACION en el formulario
		$action = $_POST['action'];//Se recoge el valor de action en el formulario

		$TITULACION = new TITULACION_Model($CODTITULACION,$CODCENTRO,$NOMBRETITULACION,$RESPONSABLETITULACION); //Se crea la instancia de TITULACION
		return $TITULACION; 
	}

	
// sino existe la variable action la crea vacia para no tener error de undefined index
	if (!isset($_REQUEST['action'])){
		$_REQUEST['action'] = '';
	}

// En funcion del action realizamos las acciones necesarias
		Switch ($_REQUEST['action']){
			case 'ADD': //añade titulacion
				if (!$_POST){ // se invoca la vista de add de TITULACION
					$titulacion = new TITULACION_Model('','','',''); //nuevo model
					$respuesta = $titulacion->CodigosCentro(); //se almacenan los codigos del centro
					new TITULACION_ADD($respuesta);
				}
				else{//si no
					$TITULACION = get_data_form(); //se recogen los datos del formulario
					$respuesta = $TITULACION->ADD(); //se iguala al resultado de aplicar ADD() a los datos del formulario
					new MESSAGE($respuesta, '../Controller/TITULACION_Controller.php');
				}
				break;

			case 'DELETE': //borrar titulacion
				if (!$_POST){ //nos llega el id a eliminar por get
					$TITULACION = new TITULACION_Model($_REQUEST['CODTITULACION'],'','',''); //model del codtitulacion pasado
					$valores = $TITULACION->RellenaDatos(); //se rellena el resto de datos
					new TITULACION_DELETE($valores); //se le muestra al usuario los valores de la tupla para que confirme el borrado mediante un form que no permite modificar las variables 
				}
				else{ // llegan los datos confirmados por post y se eliminan
					$TITULACION = get_data_form(); //recojo datos form
					$respuesta = $TITULACION->DELETE(); //se aplica delete a los datos
					new MESSAGE($respuesta, '../Controller/TITULACION_Controller.php');
				}
				break;
			case 'EDIT': //editar titulacion creada
				if (!$_POST){ //nos llega el usuario a editar por get
					$TITULACION = new TITULACION_Model($_REQUEST['CODTITULACION'],'','',''); // Creo el objeto
					$valores = $TITULACION->RellenaDatos(); // obtengo todos los datos de la tupla
					if (is_array($valores)) //si valores es array
					{
						new TITULACION_EDIT($valores, $TITULACION->CodigosCentro()); //invoco la vista de edit con los datos 
							//precargados
					}else //si no
					{
						new MESSAGE($valores, '../Controller/TITULACION_Controller.php');
					}
				}
				else{ //si no

					$TITULACION = get_data_form(); //recojo los valores del formulario

					$respuesta = $TITULACION->EDIT(); // update en la bd en la bd
					new MESSAGE($respuesta, '../Controller/TITULACION_Controller.php');
				}

				break;

			case 'SEARCH': //buscar entre las tuplas creadas
				if (!$_POST){
					new TITULACION_SEARCH();
				}
				else{
					$TITULACION = get_data_form(); // recojo datos form
					$datos = $TITULACION->SEARCH(); //busqueda a los datos

					$lista = array('CODTITULACION','CODCENTRO','NOMBRETITULACION','RESPONSABLETITULACION');

					new TITULACION_SHOWALL($lista, $datos, '../index.php');
				}
				break;

			case 'SHOWCURRENT': //mostrar en detalle una tupla
				$TITULACION = new TITULACION_Model($_REQUEST['CODTITULACION'],'','',''); //model del codtitulacion
				$valores = $TITULACION->RellenaDatos(); //se rellenan el resto de datos
				new TITULACION_SHOWCURRENT($valores);
				break;

			default: //caso base
				if (!$_POST){ //invoca
					$TITULACION = new TITULACION_Model('','','',''); //model de showall
				}
				else{//si no
					$TITULACION = get_data_form(); //recojo datos
				}
				$datos = $TITULACION->SEARCH(); //se aplica search a los datos
				$lista = array('CODTITULACION','CODCENTRO','NOMBRETITULACION','RESPONSABLETITULACION');
				new TITULACION_SHOWALL($lista, $datos);
		}

?>
