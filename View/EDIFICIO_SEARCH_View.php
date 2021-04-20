<?php

	class EDIFICIO_SEARCH{

//Clase : EDIFICIO_SEARCH
//Creado el : 05/10/2019
//Creado por: stwgno

//Constructor de la clase
		function __construct(){	
			$this->render();//se carga el render
		}

		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){

			include '../View/Header.php'; //header necesita los strings
		?>
			<h1><span class="trn">SEARCH</span></h1>	
			<form name = 'Form' action='../Controller/EDIFICIO_Controller.php' method='post' onsubmit="return validarCentro('Form')">

				 	<span class="trn">CODEDIFICIO</span>: 
				 		<input type = 'text' name = 'CODEDIFICIO' id = 'CODEDIFICIO' size = '10' value = '' onblur="validarTexto(this, 10)"><br>	

					<span class="trn">NOMBREEDIFICIO</span>:   	
						<input type = 'text' name = 'NOMBREEDIFICIO' id = 'NOMBREEDIFICIO' size = '50' value = '' onblur="validarTexto(this, 50)" ><br>	

					<span class="trn">DIRECCIONEDIFICIO</span>:   
						<input type = 'text' name = 'DIRECCIONEDIFICIO' id = 'DIRECCIONEDIFICIO' size = '150' value = ''onblur=" validarTexto(this, 10)"><br>	

					<span class="trn">CAMPUSEDIFICIO</span>:  
						<input type = 'text' name = 'CAMPUSEDIFICIO' id = 'CAMPUSEDIFICIO' size = '10' value = '' onblur=" validarTexto(this, 10)" ><br>	

					<input type='submit' name='action' value='SEARCH'>
			</form>
				
		
			<a href='../Controller/EDIFICIO_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	