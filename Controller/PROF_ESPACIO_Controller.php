
<?php

//Clase : PROF_ESPACIO_Controller
//Creado el : 05/10/2019
//Creado por: stwgno

	session_start(); //solicito trabajar con la session

	include '../Functions/Authentication.php';

//comprueba la autenticacion
	if (!IsAuthenticated()){
		header('Location:../index.php');
	}

	include_once '../Model/PROF_ESPACIO_Model.php';
	include '../View/PROF_ESPACIO_SHOWALL_View.php';
	include '../View/PROF_ESPACIO_SEARCH_View.php';
	include '../View/PROF_ESPACIO_ADD_View.php';
	include '../View/PROF_ESPACIO_EDIT_View.php';
	include '../View/PROF_ESPACIO_DELETE_View.php';
	include '../View/PROF_ESPACIO_SHOWCURRENT_View.php';
	include '../View/MESSAGE_View.php';

// la función get_data_form() recoge los valores que vienen del formulario por medio de post y la action a realizar, crea una instancia PROF_ESPACIO y la devuelve
	function get_data_form(){

		$DNI = $_POST['DNI'];//Se recoge el valor de DNI en el formulario
		$CODESPACIO = $_POST['CODESPACIO'];//Se recoge el valor de CODESPACIO en el formularioç
		$action = $_POST['action'];//Se recoge el valor de action en el formulario
		
		$PROF_ESPACIO = new PROF_ESPACIO_Model($DNI, $CODESPACIO); //Se crea la instancia de PROF_ESPACIO
		return $PROF_ESPACIO; 
	}

	
// sino existe la variable action la crea vacia para no tener error de undefined index
	if (!isset($_REQUEST['action'])){
		$_REQUEST['action'] = '';
	}

// En funcion del action realizamos las acciones necesarias
		Switch ($_REQUEST['action']){
			case 'ADD': //añadir prof_espacio
				if (!$_POST){ // se invoca la vista de add de PROF_ESPACIO
					$PROF_ESPACIO = new PROF_ESPACIO_Model('',''); //
					$respuesta = $PROF_ESPACIO->CodigosDNI();
					$respuesta2 = $PROF_ESPACIO->CodigosEspacio();	

					new PROF_ESPACIO_ADD($respuesta,$respuesta2);
				}
				else{//si no
					$PROF_ESPACIO = get_data_form(); //se recogen los datos del formulario
					$respuesta = $PROF_ESPACIO->ADD(); //se recoge el resultado de los datos aplicados ADD()
					new MESSAGE($respuesta, '../Controller/PROF_ESPACIO_Controller.php');
				}
				break;

			case 'DELETE'://borrar prof_espacio
				if (!$_POST){ //nos llega el id a eliminar por get
					$PROF_ESPACIO = new PROF_ESPACIO_Model($_REQUEST['DNI'],'');
					$valores = $PROF_ESPACIO->RellenaDatos(); 
					new PROF_ESPACIO_DELETE($valores); //se le muestra al usuario los valores de la tupla para que confirme el borrado mediante un form que no permite modificar las variables 
				}
				else{ // llegan los datos confirmados por post y se eliminan
					$PROF_ESPACIO = get_data_form();
					$respuesta = $PROF_ESPACIO->DELETE();
					new MESSAGE($respuesta, '../Controller/PROF_ESPACIO_Controller.php');
				}
				break;

			case 'EDIT'://editar prof_espacio
				if (!$_POST){ //nos llega el usuario a editar por get
					$PROF_ESPACIO = new PROF_ESPACIO_Model($_REQUEST['DNI'],''); // Creo el objeto
					$valores = $PROF_ESPACIO->RellenaDatos(); // obtengo todos los datos de la tupla
					if (is_array($valores))//si valores es array
					{
						new PROF_ESPACIO_EDIT($valores,$PROF_ESPACIO->CodigosDNI(), $PROF_ESPACIO->CodigosEspacio()); //invoco la vista de edit con los datos 
							//precargados
					}else//si no
					{
						new MESSAGE($valores, '../Controller/PROF_ESPACIO_Controller.php');
					}
				}
				else{//si no

					$PROF_ESPACIO = get_data_form(); //recojo los valores del formulario

					$respuesta = $PROF_ESPACIO->EDIT(); // update en la bd en la bd
					new MESSAGE($respuesta, '../Controller/PROF_ESPACIO_Controller.php');
				}

				break;

			case 'SEARCH'://buscar entre los prof_espacio creados
				if (!$_POST){//invoca post
					new PROF_ESPACIO_SEARCH();
				}
				else{//si no
					$PROF_ESPACIO = get_data_form();//recojo datos formulario
					$datos = $PROF_ESPACIO->SEARCH(); //se aplica search a los datos

					$lista = array('DNI','CODESPACIO'); //array con la info de los atributos

					new PROF_ESPACIO_SHOWALL($lista, $datos, '../index.php');
				}
				break;

			case 'SHOWCURRENT': //mostrar datos de una tupla
				$PROF_ESPACIO = new PROF_ESPACIO_Model($_REQUEST['DNI'],'');
				$valores = $PROF_ESPACIO->RellenaDatos(); //rellena datos del form
				new PROF_ESPACIO_SHOWCURRENT($valores);
				break;

			default://caso base
				if (!$_POST){
					$PROF_ESPACIO = new PROF_ESPACIO_Model('',''); //se crea model
				}
				else{//si no
					$PROF_ESPACIO = get_data_form(); //recojo datos del formulario
				}
				$datos = $PROF_ESPACIO->SEARCH(); //se aplica search a los datos
				$lista = array('DNI','CODESPACIO');
				new PROF_ESPACIO_SHOWALL($lista, $datos);
		}

?>
