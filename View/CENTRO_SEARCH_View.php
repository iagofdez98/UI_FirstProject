<?php

	class CENTRO_SEARCH{

//Clase : CENTRO_SEARCH
//Creado el : 05/10/2019
//Creado por: stwgno

//Constructor de la clase
		function __construct(){	
			$this->render();//se carga el renderizado
		}

		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){

			include '../View/Header.php'; //header necesita los strings
		?>
			<h1><span class="trn">SEARCH</span></h1>	
			<form name = 'Form' action='../Controller/CENTRO_Controller.php' method='post' onsubmit="return comprobar_registro();">

				 	<span class="trn">CODCENTRO</span> :   
				 		<input type = 'text' name = 'CODCENTRO' id = 'CODCENTRO' size = '10' value = '' onblur=" validarTexto(this, 10)"><br>

					<span class="trn">CODEDIFICIO</span> :  
						<input type = 'text' name = 'CODEDIFICIO' id = 'CODEDIFICIO' placeholder = 'Escribe el código del edificio' size = '10' value = '' ><br>	

					<span class="trn">NOMBRECENTRO</span> :   
						<input type = 'text' name = 'NOMBRECENTRO' id = 'NOMBRECENTRO' placeholder = 'Escribe el nombre del centro' size = '50' value = '' onblur=" validarTexto(this, 50)" ><br>	

					<span class="trn">DIRECCIONCENTRO</span> :   
						<input type = 'text' name = 'DIRECCIONCENTRO' id = 'DIRECCIONCENTRO' placeholder = 'Escribe la direccion del centro' size = '150' value = '' onblur=" validarTexto(this, 50)"><br>	

					<span class="trn">RESPONSABLECENTRO</span> :   
						<input type = 'text' name = 'RESPONSABLECENTRO' id = 'RESPONSABLECENTRO' placeholder = 'Escribe el responsable del centro' size = '60' value = '' onblur="validarTexto(this, 60)"><br>	

					<input type='submit' name='action' value='SEARCH'>
			</form>
				
		
			<a href='../Controller/Index_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	