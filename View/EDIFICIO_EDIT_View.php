<?php

	class EDIFICIO_EDIT{

//Clase : EDIFICIO_EDIT
//Creado el : 05/10/2019
//Creado por: stwgno

//Constructor de la clase
		function __construct($tupla){	
			$this->tupla = $tupla; //se cargan las tuplas
			$this->render();//se carga el render
		}

		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){

			include '../View/Header.php'; //header necesita los strings
		?>
			<h1><<span class="trn">EDIT</span></h1>	
			<form name = 'Form' action='../Controller/EDIFICIO_Controller.php' method='post' onsubmit="return validarEdificio('Form');">
			
					<span class="trn">CODEDIFICIO</span>:  
						<input type = 'text' name = 'CODEDIFICIO' id = 'CODEDIFICIO' placeholder = 'Escribe el código del edificio' size = '10' value =  '<?php echo $this->tupla['CODEDIFICIO']; ?>' onblur="comprobarVacio(this); validarTexto(this, 10)" readonly><br>	

					<span class="trn">NOMBREEDIFICIO</span>:  
						<input type = 'text' name = 'NOMBREEDIFICIO' id = 'NOMBREEDIFICIO' placeholder = 'Escribe el nombre del edificio' size = '50' value =  '<?php echo $this->tupla['NOMBREEDIFICIO']; ?>' onblur="comprobarVacio(this); validarTexto(this, 50)" required><br>	

					<span class="trn">DIRECCIONEDIFICIO</span>:  
						<input type = 'text' name = 'DIRECCIONEDIFICIO' id = 'DIRECCIONEDIFICIO' placeholder = 'Escribe la direccion del edificio' size = '150' value =  '<?php echo $this->tupla['DIRECCIONEDIFICIO']; ?>' onblur="comprobarVacio(this)" required><br>	

					<span class="trn">CAMPUSEDIFICIO</span>:  
						<input type = 'text' name = 'CAMPUSEDIFICIO' id = 'CAMPUSEDIFICIO' placeholder = 'Campus del edificio' size = '10' value =  '<?php echo $this->tupla['CAMPUSEDIFICIO']; ?>' onblur="comprobarVacio(this); validarTexto(this, 10)" required ><br>	

					<input type='submit' name='action' value='EDIT'>

			</form>
				
		
			<a href='../Controller/EDIFICIO_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	