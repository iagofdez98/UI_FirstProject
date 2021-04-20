<?php

	class ESPACIO_SEARCH{

//Clase : ESPACIO_SEARCH
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
			<form name = 'Form' action='../Controller/ESPACIO_Controller.php' method='post' onsubmit="return comprobar_registro();">
			
				 <span class="trn">CODESPACIO</span> : 
				 	<input type = 'text' name = 'CODESPACIO' id = 'CODESPACIO' placeholder = 'Escribe el código del espacio' size = '10' value = '' onblur=" validarTexto(this, 10)"><br>

				<span class="trn">CODEDIFICIO</span> : 
					<input type = 'text' name = 'CODEDIFICIO' id = 'CODEDIFICIO' placeholder = 'Escribe el código del edificio' size = '9' value = '' onblur="validarTexto(this, 10)"><br>	

				<span class="trn">CODCENTRO</span> :
					<input type = 'text' name = 'CODCENTRO' id = 'CODCENTRO' placeholder = 'Escribe el código del centro' size = '15' value = '' onblur=" validarTexto(this, 10)"><br>

				<span class="trn">TIPO</span> :
					<input type="radio" name="TIPO" id='TIPO' value="DESPACHO" checked/> Despacho <input type="radio" name="TIPO" id='TIPO' value="LABORATORIO" checked /> Laboratorio <input type="radio" name="TIPO" id='TIPO' value="PAS" /> PAS<br/>

				<span class="trn">SUPERFICIEESPACIO</span> : 
					<input type = 'number' name = 'SUPERFICIEESPACIO' id = 'SUPERFICIEESPACIO' placeholder = 'En metros2' size = '4' value = '' onblur="compr validarEntero(this, 9999, 0)" ><br>
					
				<span class="trn">NUMINVENTARIOESPACIO</span> : 
					<input type = 'number' name = 'NUMINVENTARIOESPACIO' id = 'NUMINVENTARIOESPACIO'  placeholder = 'Inventario' size = '8' value = '' onblur=" validarEntero(this, 99999999, 0)" ><br>

					<input type='submit' name='action' value='SEARCH'>
			</form>
				
		
			<a href='../Controller/ESPACIO_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	