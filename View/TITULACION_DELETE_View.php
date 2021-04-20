<?php

	class TITULACION_DELETE{

//Clase : TITULACION_DELETE
//Creado el : 05/10/2019
//Creado por: stwgno

//Constructor de la clase
		function __construct($tupla){	
			$this->tupla = $tupla; //se almacenan las tuplas
			$this->render(); //se carga el render
		}

		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){

			include '../View/Header.php'; //header necesita los strings
		?>
			<h1><span class="trn">DELETE</span></h1>	
			<form name = 'Form' action='../Controller/TITULACION_Controller.php' method='post' onsubmit="return comprobar_registro();">
			
					<span class="trn">CODTITULACION</span> :  
						<input type = 'text' name = 'CODTITULACION' id = 'CODTITULACION' placeholder = 'Cod. Titulacion' size = '10' value = '<?php echo $this->tupla['CODTITULACION']; ?>' readonly><br>	

					<span class="trn">CODCENTRO</span> :   
						<input type = 'text' name = 'CODCENTRO' id = 'CODCENTRO' placeholder = 'Cod. Centro' size = '10' value = '<?php echo $this->tupla['CODCENTRO']; ?>'  readonly><br>

					<span class="trn">NOMBRETITULACION</span> : 
						<input type = 'text' name = 'NOMBRETITULACION' id = 'NOMBRETITULACION' placeholder = 'Nombre' size = '50' value = '<?php echo $this->tupla['NOMBRETITULACION']; ?>'  readonly><br>

					<span class="trn">RESPONSABLETITULACION</span> :  
						<input type = 'text' name = 'RESPONSABLETITULACION' id = 'RESPONSABLETITULACION' placeholder = 'Responsable' size = '60' value = '<?php echo $this->tupla['RESPONSABLETITULACION']; ?>'  readonly><br>	

					<input type='submit' name='action' value='DELETE'>

			</form>
				
		
			<a href='../Controller/TITULACION_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	