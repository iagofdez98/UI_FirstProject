<?php

	class ESPACIO_DELETE{

//Clase : ESPACIO_DELETE
//Creado el : 05/10/2019
//Creado por: stwgno

//Constructor de la clase
		function __construct($tupla){	
			$this->tupla = $tupla; //se almacenan las tuplas
			$this->render();		//se carga el render
		}

		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){

			include '../View/Header.php'; //header necesita los strings
		?>
			<h1><span class="trn">DELETE</span></h1>	
			<form name = 'Form' action='../Controller/ESPACIO_Controller.php' method='post' onsubmit="return comprobar_registro();">
			
				 	<span class="trn">CODESPACIO</span> : 
				 		<input type = 'text' name = 'CODESPACIO' id = 'CODESPACIO' placeholder = 'Escribe el código del espacio' size = '10' value = '<?php echo $this->tupla['CODESPACIO']; ?>' readonly><br>

					<span class="trn">CODEDIFICIO</span> :  
						<input type = 'text' name = 'CODEDIFICIO' id = 'CODEDIFICIO' placeholder = 'Escribe el código del edificio' size = '10' value = '<?php echo $this->tupla['CODEDIFICIO']; ?>'  readonly><br>

					<span class="trn">CODCENTRO</span> : 
						<input type = 'text' name = 'CODCENTRO' id = 'CODCENTRO' placeholder = 'Escribe el código del centro' size = '10' value = '<?php echo $this->tupla['CODCENTRO']; ?>' readonly><br>

					<span class="trn">TIPO</span> : 
						<input type = 'text' name = 'TIPO' id = 'TIPO' placeholder = 'Solo letras' size = '30' value = '<?php echo $this->tupla['TIPO']; ?>' readonly><br>

					<span class="trn">SUPERFICIEESPACIO</span> : 
						<input type = 'number' name = 'SUPERFICIEESPACIO' id = 'SUPERFICIEESPACIO' placeholder = 'En metros2' size = '4' value = '<?php echo $this->tupla['SUPERFICIEESPACIO']; ?>' readonly><br>

					<span class="trn">NUMINVENTARIOESPACIO</span> : 
						<input type = 'number' name = 'NUMINVENTARIOESPACIO' id = 'NUMINVENTARIOESPACIO'  placeholder = 'Inventario' size = '8' value = '<?php echo $this->tupla['NUMINVENTARIOESPACIO']; ?>' readonly><br>

					<input type='submit' name='action' value='DELETE'>

			</form>
				
		
			<a href='../Controller/ESPACIO_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	