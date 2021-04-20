<?php

	class USUARIOS_SHOWCURRENT{

//Clase : USUARIOS_SHOWCURRENT
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
			<h1><?php echo $strings['SHOWCURRENT']; ?></h1>	
			<form name = 'Form' action='../Controller/USUARIOS_Controller.php' method='post' onsubmit="return comprobar_registro();">
			
				 	<?php echo $strings['login']?> : <input type = 'text' name = 'login' id = 'login' placeholder = 'Utiliza tu dni' size = '9' value = '<?php echo $this->tupla['login']; ?>' readonly><br>

					<?php echo $strings['password']?> : <input type = 'text' name = 'password' id = 'password' placeholder = 'letras y numeros' size = '15' value = '<?php echo $this->tupla['password']; ?>' readonly><br>

					<?php echo $strings['nombre']?> : <input type = 'text' name = 'nombre' id = 'nombre' placeholder = 'Solo letras' size = '30' value = '<?php echo $this->tupla['nombre']; ?>'  readonly><br>

					<?php echo $strings['apellidos']?> : <input type = 'text' name = 'apellidos' id = 'apellidos' placeholder = 'Solo letras' size = '50' value = '<?php echo $this->tupla['apellidos']; ?>' readonly><br>

					<?php echo $strings['email']?> : <input type = 'text' name = 'email' placeholder = 'Escribe tu email' id = 'email' size = '40' value = '<?php echo $this->tupla['email']; ?>' readonly><br>

					<?php echo $strings['DNI']?> : <input type = 'text' name = 'DNI' id = 'DNI' placeholder = 'Utiliza tu dni' size = '9' value = '<?php echo $this->tupla['DNI']; ?>' readonly><br>	

				 	<?php echo $strings['telefono']?> : <input type = 'text' name = 'telefono' id = 'telefono' placeholder = 'Escribe tu telefono' size = '9' value = '<?php echo $this->tupla['telefono']; ?>' readonly><br>

				 	<?php echo $strings['fotopersonal']?> : <input type = 'text' name = 'fotopersonal' id = 'fotopersonal' placeholder = 'Añade tu foto' size = '9' value = '<?php echo $this->tupla['fotopersonal']; ?>' readonly><br>

					<?php echo $strings['FechaNacimiento']?>:  <input type="date" name="FechaNacimiento" value = '<?php echo $this->tupla['FechaNacimiento']; ?>'readonly><br>

					<?php echo $strings['sexo']?> : <input type = 'text' name = 'sexo' id = 'sexo' placeholder = 'hombre/mujer' size = '30' value = '<?php echo $this->tupla['sexo']; ?>' readonly><br>


		
			</form>
				
		
			<a href='../Controller/USUARIOS_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	