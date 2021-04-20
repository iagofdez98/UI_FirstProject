<?php

	class PROF_TITULACION_DELETE{
		
//Clase : PROF_TITULACION_DELETE		
//Creado el : 05/10/2019
//Creado por: stwgno

//Constructor de la clase
		function __construct($tupla){	
			$this->tupla = $tupla;	//se almacenan las tuplas
			$this->render();	//se carga el render

		}

		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){

			include '../View/Header.php'; //header necesita los strings
		?>
			<h1><span class="trn">DELETE</span></h1>	
			<form name = 'Form' action='../Controller/PROF_TITULACION_Controller.php' method='post' onsubmit="return comprobar_registro();">
			
					<span class="trn">DNI</span> : 
						<input type = 'text' name = 'DNI' id = 'DNI' placeholder = 'Utiliza tu DNI' size = '9' value = '<?php echo $this->tupla['DNI']; ?>' readonly><br>	

					<span class="trn">CODTITULACION</span> : 
						<input type = 'text' name = 'CODTITULACION' id = 'CODTITULACION' placeholder = 'Utiliza tu DNI' size = '10' value = '<?php echo $this->tupla['CODTITULACION']; ?>' readonly><br>

					<span class="trn">ANHOACADEMICO</span> :  
						<input type = 'text' name = 'ANHOACADEMICO' id = 'ANHOACADEMICO' placeholder = 'Utiliza tu DNI' size = '9' value = '<?php echo $this->tupla['ANHOACADEMICO']; ?>' readonly><br>

					<input type='submit' name='action' value='DELETE'>

			</form>
				
		
			<a href='../Controller/PROF_TITULACION_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	