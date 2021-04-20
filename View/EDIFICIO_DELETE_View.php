<?php

	class EDIFICIO_DELETE{

//Clase : EDIFICIO_DELETE
//Creado el : 05/10/2019
//Creado por: stwgno

//Constructor de la clase
		function __construct($tupla){	
			$this->tupla = $tupla; //se almacena la tupla
			$this->render();//se carga el render
		}

		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){

			include '../View/Header.php'; //header necesita los strings
		?>
			<h1><span class="trn">DELETE</span></h1>	
			<form name = 'Form' action='../Controller/EDIFICIO_Controller.php' method='post' onsubmit="return comprobar_registro();">	

				 	<span class="trn">CODEDIFICIO</span>:  
				 		<input type = 'text' name = 'CODEDIFICIO' id = 'CODEDIFICIO' placeholder = 'Escribe el código del edificio' size = '10' value = '<?php echo $this->tupla['CODEDIFICIO']; ?>' readonly><br>	

					<span class="trn">NOMBREEDIFICIO</span>:  
						<input type = 'text' name = 'NOMBREEDIFICIO' id = 'NOMBREEDIFICIO' size = '50' value = '<?php echo $this->tupla['NOMBREEDIFICIO']; ?>' readonly><br>	

					<span class="trn">DIRECCIONEDIFICIO</span>:  
						<input type = 'text' name = 'DIRECCIONEDIFICIO' id = 'DIRECCIONEDIFICIO' size = '150' value = '<?php echo $this->tupla['DIRECCIONEDIFICIO']; ?>' readonly><br>	

					<span class="trn">CAMPUSEDIFICIO</span>: 
						<input type = 'text' name = 'CAMPUSEDIFICIO' id = 'CAMPUSEDIFICIO' placeholder = 'Campus del edificio' size = '60' value =  '<?php echo $this->tupla['CAMPUSEDIFICIO']; ?>' readonly ><br>	

					<input type='submit' name='action' value='DELETE'>

			</form>
				
		
			<a href='../Controller/EDIFICIO_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	