<?php

	class PROFESOR_SEARCH{

//Clase : PROFESOR_SEARCH
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
			<form name = 'Form' action='../Controller/PROFESOR_Controller.php' method='post' onsubmit="return comprobar_registro();">
			
					<span class="trn">DNI</span> : 
						<input type = 'text' name = 'DNI' id = 'DNI' placeholder = 'Utiliza tu DNI' size = '9' value = '' ><br>	

					<span class="trn">NOMBREPROFESOR</span> :  
						<input type = 'text' name = 'NOMBREPROFESOR' id = 'NOMBREPROFESOR' placeholder = 'Utiliza tu DNI' size = '15' value = '' onblur=" validarAlfabetico(this, 15)"><br>

					<span class="trn">APELLIDOSPROFESOR</span> : 
						<input type = 'text' name = 'APELLIDOSPROFESOR' id = 'APELLIDOSPROFESOR' placeholder = 'Utiliza tu DNI' size = '30' value = '' onblur=" validarAlfabetico(this, 30)" ><br>

					<span class="trn">AREAPROFESOR</span> :  
						<input type = 'text' name = 'AREAPROFESOR' id = 'AREAPROFESOR' placeholder = 'Utiliza tu DNI' size = '60' value = '' onblur="validarTexto(this, 60)" ><br>	

					<span class="trn">DEPARTAMENTOPROFESOR</span> : 
						<input type = 'text' name = 'DEPARTAMENTOPROFESOR' id = 'DEPARTAMENTOPROFESOR' placeholder = 'Utiliza tu DNI' size = '60' value = '' onblur=" validarTexto(this, 60)"><br>	

					<input type='submit' name='action' value='SEARCH'>
			</form>
				
		
			<a href='../Controller/PROFESOR_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	