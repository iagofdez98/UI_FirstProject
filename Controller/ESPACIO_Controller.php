
<?php

//Clase : ESPACIO_Controller
//Creado el : 05/10/2019
//Creado por: stwgno

	session_start(); //solicito trabajar con la session

	include '../Functions/Authentication.php';

//Comprueba la autenticacion
	if (!IsAuthenticated()){
		header('Location:../index.php');
	}

	include '../Model/ESPACIO_Model.php';
	include '../View/ESPACIO_SHOWALL_View.php';
	include '../View/ESPACIO_SEARCH_View.php';
	include '../View/ESPACIO_ADD_View.php';
	include '../View/ESPACIO_EDIT_View.php';
	include '../View/ESPACIO_DELETE_View.php';
	include '../View/ESPACIO_SHOWCURRENT_View.php';
	include '../View/MESSAGE_View.php';

//La función get_data_form() recoge los valores que vienen del formulario por medio de post y la action a realizar, crea una instancia ESPACIO y la devuelve
	function get_data_form(){

		$CODESPACIO = $_POST['CODESPACIO'];	//Se recoge el valor de CODESPACIO en el formulario
		$CODEDIFICIO = $_POST['CODEDIFICIO'];	//Se recoge el valor de CODEDIFICIO en el formulario
		$CODCENTRO = $_POST['CODCENTRO'];	//Se recoge el valor de CODCENTRO en el formulario
		$TIPO = $_POST['TIPO'];	//Se recoge el valor de TIPO en el formulario
		$SUPERFICIEESPACIO = $_POST['SUPERFICIEESPACIO'];	//Se recoge el valor de SUPERFICIEESPACIO en el formulario
		$NUMINVENTARIOESPACIO = $_POST['NUMINVENTARIOESPACIO'];	//Se recoge el valor de NUMINVENTARIOESPACIO en el formulario
		$action = $_POST['action'];//Se recoge el valor de action en el formulario
		
		$espacio = new ESPACIO_Model($CODESPACIO,$CODEDIFICIO,$CODCENTRO,$TIPO,$SUPERFICIEESPACIO,$NUMINVENTARIOESPACIO); //Se crea la instancia de ESPACIO
		return $espacio; 
	}

	
// sino existe la variable action la crea vacia para no tener error de undefined index

	if (!isset($_REQUEST['action'])){
		$_REQUEST['action'] = '';
	}

// En funcion del action realizamos las acciones necesarias

		Switch ($_REQUEST['action']){
			case 'ADD'://añade espacios
				if (!$_POST){ // se invoca la vista de add de ESPACIO
					$espacio = new ESPACIO_Model('','','','','',''); //nuevo model en blanco 
					$respuesta = $espacio->CodigosEdificio(); //recoge los codedificio
					$respuesta2 = $espacio->CodigosCentro(); //recoge los codcentro

					new ESPACIO_ADD($respuesta,$respuesta2);
				}
				else{//si no
					$espacio = get_data_form(); //se recogen los datos del formulario
					$respuesta = $espacio->ADD(); //Se recoge el resultado de añadir los datos recogidos
					new MESSAGE($respuesta, '../Controller/ESPACIO_Controller.php');
				}
				break;

			case 'DELETE': //borrar un espacio
				if (!$_POST){ //nos llega el id a eliminar por get
					$espacio = new ESPACIO_Model($_REQUEST['CODESPACIO'],'','','','',''); //se recoge el espacio a borrar
					$valores = $espacio->RellenaDatos(); //se rellenan el resto de datos del espacio a borrar
					new ESPACIO_DELETE($valores); //se le muestra al usuario los valores de la tupla para que confirme el borrado mediante un form que no permite modificar las variables 
				}
				else{ // llegan los datos confirmados por post y se eliminan
					$espacio = get_data_form();//recoge datos del form
					$respuesta = $espacio->DELETE();//se le aplica el delete a los datos
					new MESSAGE($respuesta, '../Controller/ESPACIO_Controller.php');
				}
				break;

			case 'EDIT': //editar un espacio
				if (!$_POST){ //nos llega el usuario a editar por get
					$espacio = new ESPACIO_Model($_REQUEST['CODESPACIO'],'','','','','');
					$valores = $espacio->RellenaDatos(); // obtengo todos los datos de la tupla
					if (is_array($valores))//si valores es array
					{
						new ESPACIO_EDIT($valores, $espacio->CodigosEdificio(), $espacio->CodigosCentro()); //invoco la vista de edit con los datos 
							//precargados
					}else//si no
					{
						new MESSAGE($valores, '../Controller/ESPACIO_Controller.php');
					}
				}
				else{//si no hay post

					$espacio = get_data_form(); //recojo los valores del formulario

					$respuesta = $espacio->EDIT(); // update en la bd en la bd
					new MESSAGE($respuesta, '../Controller/ESPACIO_Controller.php');
				}

				break;

			case 'SEARCH': //buscar un espacio creado
				if (!$_POST){//invoca
					new ESPACIO_SEARCH();
				}
				else{//si no
					$espacio = get_data_form();//recojo datos del formulario
					$datos = $espacio->SEARCH();//busca entre las tuplas

					$lista = array('CODESPACIO','CODEDIFICIO','CODCENTRO','TIPO','SUPERFICIEESPACIO','NUMINVENTARIOESPACIO'); //array con los atributos

					new ESPACIO_SHOWALL($lista, $datos, '../index.php');
				}
				break;

			case 'SHOWCURRENT'://mostrar datos de una tupla
				$espacio = new ESPACIO_Model($_REQUEST['CODESPACIO'],'','','','',''); //tupla a mostrar
				$valores = $espacio->RellenaDatos(); //rellena los datos que faltan
				new ESPACIO_SHOWCURRENT($valores);
				break;

			default: //caso base
				if (!$_POST){
					$espacio = new ESPACIO_Model('','','','','',''); //model en blanco
				}
				else{//si no
					$espacio = get_data_form();//recojo datos form
				}
				$datos = $espacio->SEARCH(); //se le aplica el search a los datos recogidos
				$lista = array('CODESPACIO','CODEDIFICIO','CODCENTRO','TIPO','SUPERFICIEESPACIO','NUMINVENTARIOESPACIO');
				new ESPACIO_SHOWALL($lista, $datos);
		}

?>
