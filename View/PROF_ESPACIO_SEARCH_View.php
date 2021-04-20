<?php

	class PROF_ESPACIO_SEARCH{

//Clase : PROF_ESPACIO_SEARCH
//Creado el : 05/10/2019
//Creado por: stwgno

//Constructor de la clase
		function __construct(){	
			$this->render(); //se carga el render
		}

		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){

			include '../View/Header.php'; //header necesita los strings
		?>
			<h1><span class="trn">SEARCH</span></h1>	
			<form name = 'Form' action='../Controller/PROF_ESPACIO_Controller.php' method='post' onsubmit="return comprobar_registro();">
			
					<span class="trn">DNI</span> :   
						<input type = 'text' name = 'DNI' id = 'DNI' placeholder = 'Utiliza tu DNI' size = '9' value = ''><br>

					<span class="trn">CODESPACIO</span> :  
						<input type = 'text' name = 'CODESPACIO' id = 'CODESPACIO' placeholder = 'Utiliza tu DNI' size = '9' onblur="validarTexto(this)"><br>

					<input type='submit' name='action' value='SEARCH'>

			</form>
				
		
			<a href='../Controller/PROF_ESPACIO_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	