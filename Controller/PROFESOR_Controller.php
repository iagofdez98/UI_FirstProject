
<?php

//Clase : PROFESOR_Controller
//Creado el : 05/10/2019
//Creado por: stwgno

	session_start(); //solicito trabajar con la session

	include '../Functions/Authentication.php';

//comprueba autenticacion
	if (!IsAuthenticated()){
		header('Location:../index.php');
	}

	include '../Model/PROFESOR_Model.php';
	include '../View/PROFESOR_SHOWALL_View.php';
	include '../View/PROFESOR_SEARCH_View.php';
	include '../View/PROFESOR_ADD_View.php';
	include '../View/PROFESOR_EDIT_View.php';
	include '../View/PROFESOR_DELETE_View.php';
	include '../View/PROFESOR_SHOWCURRENT_View.php';
	include '../View/MESSAGE_View.php';

// la función get_data_form() recoge los valores que vienen del formulario por medio de post y la action a realizar, crea una instancia PROFESOR y la devuelve
	function get_data_form(){

		$DNI = $_POST['DNI'];//Se recoge el valor de DNI en el formulario
		$NOMBREPROFESOR = $_POST['NOMBREPROFESOR'];//Se recoge el valor de NOMBREPROFESOR en el formulario
		$APELLIDOSPROFESOR = $_POST['APELLIDOSPROFESOR'];//Se recoge el valor de APELLIDOSPROFESOR en el formulario
		$AREAPROFESOR = $_POST['AREAPROFESOR'];//Se recoge el valor de AREAPROFESOR en el formulario
		$DEPARTAMENTOPROFESOR = $_POST['DEPARTAMENTOPROFESOR'];//Se recoge el valor de DEPARTAMENTOPROFESOR en el formulario
		$action = $_POST['action'];//Se recoge el valor de action en el formulario
		
		$PROFESOR = new PROFESOR_Model($DNI, $NOMBREPROFESOR,$AREAPROFESOR,$APELLIDOSPROFESOR,$DEPARTAMENTOPROFESOR); //Se crea la instancia de PROFESOR
		return $PROFESOR; 
	}

	
// sino existe la variable action la crea vacia para no tener error de undefined index
	if (!isset($_REQUEST['action'])){
		$_REQUEST['action'] = '';
	}

// En funcion del action realizamos las acciones necesarias
		Switch ($_REQUEST['action']){
			case 'ADD': //añadir profesor
				if (!$_POST){ // se invoca la vista de add de PROFESOR
					new PROFESOR_ADD();
				}
				else{//si no
					$PROFESOR = get_data_form(); //se recogen los datos del formulario
					$respuesta = $PROFESOR->ADD(); //se recoge la respuesta de aplicar ADD() a los datos del formulario
					new MESSAGE($respuesta, '../Controller/PROFESOR_Controller.php');
				}
				break;

			case 'DELETE': //borrar profesor
				if (!$_POST){ //nos llega el id a eliminar por get
					$PROFESOR = new PROFESOR_Model($_REQUEST['DNI'],'','','',''); //se almacena el model del dni
					$valores = $PROFESOR->RellenaDatos(); //rellenan datos 
					new PROFESOR_DELETE($valores); //se le muestra al usuario los valores de la tupla para que confirme el borrado mediante un form que no permite modificar las variables 
				}
				else{ // llegan los datos confirmados por post y se eliminan
					$PROFESOR = get_data_form(); //recoge datos del form
					$respuesta = $PROFESOR->DELETE();//se aplica delete a los datos
					new MESSAGE($respuesta, '../Controller/PROFESOR_Controller.php');
				}
				break;

			case 'EDIT': //editar profesor
				if (!$_POST){ //nos llega el usuario a editar por get
					$PROFESOR = new PROFESOR_Model($_REQUEST['DNI'],'','','',''); // Creo el objeto
					$valores = $PROFESOR->RellenaDatos(); // obtengo todos los datos de la tupla
					if (is_array($valores)) //si valores es un array
					{
						new PROFESOR_EDIT($valores); //invoco la vista de edit con los datos 
							//precargados
					}else//si no
					{
						new MESSAGE($valores, '../Controller/PROFESOR_Controller.php');
					}
				}
				else{//si no

					$PROFESOR = get_data_form(); //recojo los valores del formulario

					$respuesta = $PROFESOR->EDIT(); // update en la bd en la bd
					new MESSAGE($respuesta, '../Controller/PROFESOR_Controller.php');
				}

				break;

			case 'SEARCH': //buscar entre los profesores
				if (!$_POST){
					new PROFESOR_SEARCH();
				}
				else{
					$PROFESOR = get_data_form(); //recoge datos del form
					$datos = $PROFESOR->SEARCH(); //se aplica busqueda a los datos

					$lista = array('DNI','NOMBREPROFESOR','APELLIDOSPROFESOR','AREAPROFESOR','DEPARTAMENTOPROFESOR'); //array de atributos

					new PROFESOR_SHOWALL($lista, $datos, '../index.php');
				}
				break;

			case 'SHOWCURRENT': //mostrar datos de una tupla de profesor
				$PROFESOR = new PROFESOR_Model($_REQUEST['DNI'],'','','',''); //model del dni pasado
				$valores = $PROFESOR->RellenaDatos(); //se rellena el resto de datos
				new PROFESOR_SHOWCURRENT($valores);
				break;

			default: //caso base
				if (!$_POST){
					$PROFESOR = new PROFESOR_Model('','','','',''); //nuevo model
				}
				else{//si no
					$PROFESOR = get_data_form();
				}
				$datos = $PROFESOR->SEARCH();//se aplica busqueda
				$lista = array('DNI','NOMBREPROFESOR','APELLIDOSPROFESOR','AREAPROFESOR','DEPARTAMENTOPROFESOR');
				new PROFESOR_SHOWALL($lista, $datos);
		}

?>
