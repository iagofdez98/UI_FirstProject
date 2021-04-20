<?php

	class USUARIOS_DELETE{

//Clase : USUARIOS_DELETE
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
			<h1 class="trn">DELETE</h1>	
			<form name = 'Form' action='../Controller/USUARIOS_Controller.php' method='post' onsubmit="return comprobar_registro();">
			
				 	<span class="trn">login</span> : 
				 		<input type = 'text' name = 'login' id = 'login' placeholder = 'Utiliza tu DNI' size = '9' value = '<?php echo $this->tupla['login']; ?>' readonly><br>

					<span class="trn">password</span> : 
						<input type = 'text' name = 'password' id = 'password' placeholder = 'letras y numeros' size = '15' value = '<?php echo $this->tupla['password']; ?>' readonly><br>

					<span class="trn">nombre</span> : 
						<input type = 'text' name = 'nombre' id = 'nombre' placeholder = 'Solo letras' size = '30' value = '<?php echo $this->tupla['nombre']; ?>'  readonly><br>

					<span class="trn">apellidos</span> : 
						<input type = 'text' name = 'apellidos' id = 'apellidos' placeholder = 'Solo letras' size = '50' value = '<?php echo $this->tupla['apellidos']; ?>'  readonly><br>

					<span class="trn">email</span> : 	
						<input type = 'text' name = 'email' id = 'email' size = '40' placeholder = 'Escribe tu email' value = '<?php echo $this->tupla['email']; ?>'  readonly><br>

					<span class="trn">DNI</span>: 
						<input type = 'text' name = 'DNI' id = 'DNI' placeholder = 'Utiliza tu DNI' size = '9' value = '<?php echo $this->tupla['DNI']; ?>' readonly ><br>	

				 	<span class="trn">telefono</span> : 
				 		<input type = 'text' name = 'telefono' id = 'telefono' placeholder = 'Escribe tu telefono' size = '9' value = '<?php echo $this->tupla['telefono']; ?>'  readonly><br>

				 	<span class="trn">fotopersonal</span> : 
				 		<input type = 'text' name = 'fotopersonal' id = 'fotopersonal' placeholder = 'Añade tu foto' size = '9' value = '<?php echo $this->tupla['fotopersonal']; ?>' readonly><br>

					<span class="trn">FechaNacimiento</span>:  
						<input type="date" name="FechaNacimiento" value='<?php echo $this->tupla['FechaNacimiento']; ?>'readonly><br>
					
					<span class="trn">sexo</span> : 
						<input type = 'text' name = 'sexo' id = 'sexo' placeholder = 'Añade tu foto' size = '9' value = '<?php echo $this->tupla['sexo']; ?>' readonly><br>

					<input type='submit' name='action' value='DELETE'>

			</form>
				
		
			<a href='../Controller/USUARIOS_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	