<?php
//Clase : index
//Creado el : 05/10/2019
//Creado por: stwgno

class Index {

//constructor
	function __construct(){
		$this->render(); //se carga el render
	}

		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){
	
		include '../Locale/Strings_SPANISH.php';
		include '../View/Header.php';
?>
		<H1> <span class="trn">Bienvenido al Portal de Gestión de Usuarios de la ESEI</span> </H1>

		<i><span class="trn">El edificio de la ESEI</span></i><br>
		<img src="../View/Icons/esei_edificio.jpg" alt="esei"></img><br><br><br>
		<i><span class="trn">La entrada principal de la ESEI, dotada de un péndulo</span></i><br>
		<img src="../View/Icons/esei_pendulo.jpg" alt="esei"></img><br>
<?php
		include '../View/Footer.php';
	}

}

?>