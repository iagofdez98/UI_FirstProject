<?php

//Clase : EDIFICIO_Controller
//Creado el : 05/10/2019
//Creado por: stwgno

	session_start(); //Solicito trabajar con la session

	include '../Functions/Authentication.php';

//Se comprueba la autenticacion
	if (!IsAuthenticated()){
		header('Location:../index.php');
	}

	include '../Model/EDIFICIO_Model.php';
	include '../View/EDIFICIO_SHOWALL_View.php';
	include '../View/EDIFICIO_SEARCH_View.php';
	include '../View/EDIFICIO_ADD_View.php';
	include '../View/EDIFICIO_EDIT_View.php';
	include '../View/EDIFICIO_DELETE_View.php';
	include '../View/EDIFICIO_SHOWCURRENT_View.php';
	include '../View/MESSAGE_View.php';

//La función get_data_form() recoge los valores que vienen del formulario por medio de post y la action a realizar, crea una instancia EDIFICIO y la devuelve
	function get_data_form(){

		$CODEDIFICIO = $_POST['CODEDIFICIO'];	//Se recoge el valor de CODEDIFICIO en el formulario
		$NOMBREEDIFICIO = $_POST['NOMBREEDIFICIO'];	//Se recoge el valor de NOMBREEDIFICIO en el formulario
		$DIRECCIONEDIFICIO = $_POST['DIRECCIONEDIFICIO'];	//Se recoge el valor de DIRECCIONEDIFICIO en el formulario
		$CAMPUSEDIFICIO = $_POST['CAMPUSEDIFICIO'];	//Se recoge el valor de CAMPUSEDIFICIO en el formulario
		$action = $_POST['action'];//Se recoge el valor de action en el formulario
		
		$edificio = new EDIFICIO_Model($CODEDIFICIO,$NOMBREEDIFICIO,$DIRECCIONEDIFICIO,$CAMPUSEDIFICIO); //Se crea la instancia de EDIFICIO
		return $edificio; 
	}

	
//Sino existe la variable action la crea vacia para no tener error de undefined index

	if (!isset($_REQUEST['action'])){
		$_REQUEST['action'] = '';
	}

//En funcion del action realizamos las acciones necesarias

		Switch ($_REQUEST['action']){
			case 'ADD': //Añadir un nuevo edificio
				if (!$_POST){//invoca
					new EDIFICIO_ADD();
				}
				else{//si no
					$edificio = get_data_form(); //se recogen los datos del formulario
					$respuesta = $edificio->ADD(); //aplica ADD a los datos recogidos
					new MESSAGE($respuesta, '../Controller/EDIFICIO_Controller.php');
				}
				break;

			case 'DELETE': //Borrar un edificio
				if (!$_POST){//invoca
					$edificio = new EDIFICIO_Model($_REQUEST['CODEDIFICIO'],'','',''); //nuevo model con el codedificio deseado
					$valores = $edificio->RellenaDatos();//se rellenan los datos
					//Se le muestra al usuario los valores de la tupla para que confirme el borrado mediante un form que no permite modificar las variables 
					new EDIFICIO_DELETE($valores); 
				}
				else{ // llegan los datos confirmados por post y se eliminan
					$edificio = get_data_form(); //recoge datos del formulario
					$respuesta = $edificio->DELETE(); //recoge la respuesta del metodo delete aplicado al formulario
					new MESSAGE($respuesta, '../Controller/EDIFICIO_Controller.php');
				}
				break;

			case 'EDIT': //Editar un edificio creado
				if (!$_POST){//invoca
					$edificio = new EDIFICIO_Model($_REQUEST['CODEDIFICIO'],'','',''); // Creo el objeto
					$valores = $edificio->RellenaDatos(); // obtengo todos los datos de la tupla
					if (is_array($valores)) //si valores es un array
					{
						new EDIFICIO_EDIT($valores); //invoco la vista de edit con los datos precargados
					}else //si no
					{
						new MESSAGE($valores, '../Controller/EDIFICIO_Controller.php');
					}
				}
				else{//si no

					$edificio = get_data_form(); //recojo los valores del formulario

					$respuesta = $edificio->EDIT(); // update en la bd en la bd
					new MESSAGE($respuesta, '../Controller/EDIFICIO_Controller.php');
				}

				break;

			case 'SEARCH': //Buscar un edificio entre los ya creados
				if (!$_POST){ //invoca
					new EDIFICIO_SEARCH();
				}
				else{//si no
					$edificio = get_data_form(); //recojo valores del formulario
					$datos = $edificio->SEARCH();//aplica search a los valores del form

					$lista = array('CODEDIFICIO','NOMBREEDIFICIO','DIRECCIONEDIFICIO','CAMPUSEDIFICIO'); //lista con los atributos

					new EDIFICIO_SHOWALL($lista, $datos, '../index.php');
				}
				break;

			case 'SHOWCURRENT': //Muestra la informacion sobre un edificio
				$edificio = new EDIFICIO_Model($_REQUEST['CODEDIFICIO'],'','',''); //model con el codedificio deseado
				$valores = $edificio->RellenaDatos(); //se rellenan los datos con los valores
				new EDIFICIO_SHOWCURRENT($valores);
				break;

			default: //Caso por defecto
				if (!$_POST){ //invoca
					$edificio = new EDIFICIO_Model('','','',''); //model vacio
				}
				else{//si no
					$edificio = get_data_form(); //recojo datos del form
				}
				$datos = $edificio->SEARCH();//busqueda vacia
				$lista = array('CODEDIFICIO','NOMBREEDIFICIO','DIRECCIONEDIFICIO','CAMPUSEDIFICIO'); //lista con los atributos
				new EDIFICIO_SHOWALL($lista, $datos); //se le pasa al showall la lista y los datos de todos los edificios
		}

?>
