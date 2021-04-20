
<?php

//Clase : USUARIOS_Controller
//Creado el : 05/10/2019
//Creado por: stwgno

	session_start(); //solicito trabajar con la session

	include '../Functions/Authentication.php';

	if (!IsAuthenticated()){
		header('Location:../index.php');
	}

	include '../Model/USUARIOS_Model.php';
	include '../View/USUARIOS_SHOWALL_View.php';
	include '../View/USUARIOS_SEARCH_View.php';
	include '../View/USUARIOS_ADD_View.php';
	include '../View/USUARIOS_EDIT_View.php';
	include '../View/USUARIOS_DELETE_View.php';
	include '../View/USUARIOS_SHOWCURRENT_View.php';
	include '../View/MESSAGE_View.php';

// la función get_data_form() recoge los valores que vienen del formulario por medio de post y la action a realizar, crea una instancia USUARIOS y la devuelve
	function get_data_form(){
		$login = $_POST['login'];	//Se recoge el valor de login en el formulario
		$password = $_POST['password'];	//Se recoge el valor de password en el formulario
		$nombre = $_POST['nombre'];//Se recoge el valor de nombre en el formulario
		$apellidos = $_POST['apellidos'];//Se recoge el valor de apellidos en el formulario
		$email = $_POST['email'];//Se recoge el valor de email en el formulario
		$DNI = $_POST['DNI'];//Se recoge el valor de DNI en el formulario
		$telefono = $_POST['telefono'];//Se recoge el valor de telefono en el formulario
		$fotopersonal = $_POST['fotopersonal'];//Se recoge el valor de fotopersonal en el formulario
  		$FechaNacimiento = $_POST['FechaNacimiento'];//Se recoge el valor de FechaNacimiento en el formulario
		$sexo = $_POST['sexo'];//Se recoge el valor de sexo en el formulario
		$action = $_POST['action'];//Se recoge el valor de action en el formulario
		
		$usuarios = new USUARIOS_Model($login,$password,$DNI,$nombre,$apellidos,$telefono,$email,$FechaNacimiento,$fotopersonal,$sexo); //Se crea la instancia de usuarios
		return $usuarios; 
	}

	
// sino existe la variable action la crea vacia para no tener error de undefined index

	if (!isset($_REQUEST['action'])){
		$_REQUEST['action'] = '';
	}

// En funcion del action realizamos las acciones necesarias
		Switch ($_REQUEST['action']){
			case 'ADD': //añadir usuario
				if (!$_POST){ // se invoca la vista de add de usuarios
					new USUARIOS_ADD();
				}
				else{
					$USUARIOS = get_data_form(); //se recogen los datos del formulario
					$respuesta = $USUARIOS->ADD(); //resultado de aplicar ADD() a los datos del formulario
					new MESSAGE($respuesta, '../Controller/USUARIOS_Controller.php');
				}
				break;

			case 'DELETE': //borrar usuario
				if (!$_POST){ //nos llega el id a eliminar por get
					$USUARIOS = new USUARIOS_Model($_REQUEST['login'],'','','','','','','','','');
					$valores = $USUARIOS->RellenaDatos();
					new USUARIOS_DELETE($valores); //se le muestra al usuario los valores de la tupla para que confirme el borrado mediante un form que no permite modificar las variables 
				}
				else{ // llegan los datos confirmados por post y se eliminan
					$USUARIOS = get_data_form();
					$respuesta = $USUARIOS->DELETE();
					new MESSAGE($respuesta, '../Controller/USUARIOS_Controller.php');
				}
				break;

			case 'EDIT': //editar usuario
				if (!$_POST){ //nos llega el usuario a editar por get
					$USUARIOS = new USUARIOS_Model($_REQUEST['login'],'','','','','','','','',''); // Creo el objeto
					$valores = $USUARIOS->RellenaDatos(); // obtengo todos los datos de la tupla
					if (is_array($valores))
					{
						new USUARIOS_EDIT($valores); //invoco la vista de edit con los datos 
							//precargados
					}else
					{
						new MESSAGE($valores, '../Controller/USUARIOS_Controller.php');
					}
				}
				else{

					$USUARIOS = get_data_form(); //recojo los valores del formulario

					$respuesta = $USUARIOS->EDIT(); // update en la bd en la bd
					new MESSAGE($respuesta, '../Controller/USUARIOS_Controller.php');
				}

				break;

			case 'SEARCH': //buscar usuario
				if (!$_POST){
					new USUARIOS_SEARCH();
				}
				else{
					$USUARIOS = get_data_form();
					$datos = $USUARIOS->SEARCH();

					$lista = array('login','password','email','nombre','apellidos','DNI','telefono','fotopersonal','FechaNacimiento','sexo');

					new USUARIOS_SHOWALL($lista, $datos, '../index.php');
				}
				break;

			case 'SHOWCURRENT': //mostrar en detalle info de usuario
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'],'','','','','','','','','');
				$valores = $USUARIOS->RellenaDatos();
				new USUARIOS_SHOWCURRENT($valores);
				break;

			default: //caso base
				if (!$_POST){
					$USUARIOS = new USUARIOS_Model('','','','','','','','','','');
				}
				else{//si no
					$USUARIOS = get_data_form();
				}
				$datos = $USUARIOS->SEARCH();
				$lista = array('login','password','nombre','apellidos','email','DNI','telefono','fotopersonal','FechaNacimiento','sexo');
				new USUARIOS_SHOWALL($lista, $datos);
		}

?>
