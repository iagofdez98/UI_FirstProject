<?php

	class PROFESOR_EDIT{

//Clase : PROFESOR_EDIT
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
			<h1><span class="trn">EDIT</span></h1>	
			<form name = 'Form' action='../Controller/PROFESOR_Controller.php' method='post' onsubmit="return validarProfesor('Form');">
			
					<span class="trn">DNI</span> : 
						<input type = 'text' name = 'DNI' id = 'DNI' placeholder = 'Utiliza tu DNI' size = '9' value = '<?php echo $this->tupla['DNI']; ?>' onblur="comprobarVacio(this)  && validarDNI(this)" readonly=""><br>	

					<span class="trn">NOMBREPROFESOR</span> : 
						<input type = 'text' name = 'NOMBREPROFESOR' id = 'NOMBREPROFESOR' placeholder = 'Utiliza tu DNI' size = '15' value = '<?php echo $this->tupla['NOMBREPROFESOR']; ?>' onblur="comprobarVacio(this); validarTexto(this, 15)" required><br>

					<span class="trn">APELLIDOSPROFESOR</span> :  
						<input type = 'text' name = 'APELLIDOSPROFESOR' id = 'APELLIDOSPROFESOR' placeholder = 'Utiliza tu DNI' size = '30' value = '<?php echo $this->tupla['APELLIDOSPROFESOR']; ?>' onblur="comprobarVacio(this); validarTexto(this, 30)" required><br>

					<span class="trn">AREAPROFESOR</span> :  
						<input type = 'text' name = 'AREAPROFESOR' id = 'AREAPROFESOR' placeholder = 'Utiliza tu DNI' size = '60' value = '<?php echo $this->tupla['AREAPROFESOR']; ?>' onblur="comprobarVacio(this); validarTexto(this, 60)" required><br>	

					<span class="trn">DEPARTAMENTOPROFESOR</span> : 
						<input type = 'text' name = 'DEPARTAMENTOPROFESOR' id = 'DEPARTAMENTOPROFESOR' placeholder = 'Utiliza tu DNI' size = '60' value = '<?php echo $this->tupla['DEPARTAMENTOPROFESOR']; ?>' onblur="comprobarVacio(this); validarTexto(this, 60)" required><br>	

					<input type='submit' name='action' value='EDIT'>

			</form>
				
		
			<a href='../Controller/PROFESOR_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	