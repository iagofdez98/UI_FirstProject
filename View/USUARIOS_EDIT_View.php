<?php

	class USUARIOS_EDIT{

//Clase : USUARIOS_EDIT
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
			<form name = 'Form' action='../Controller/USUARIOS_Controller.php' method='post' onsubmit="return validarUsuario('Form');">
			
				 	<span class="trn">login</span> : 
				 		<input type = 'text' name = 'login' id = 'login' placeholder = 'Utiliza tu dni' size = '9' value = '<?php echo $this->tupla['login']; ?>' onblur="comprobarVacio(this); validarTexto(this, 15)" readonly><br>

					<span class="trn">password</span>: 
						<input type = 'text' name = 'password' id = 'password' placeholder = 'letras y numeros' size = '15' value = '<?php echo $this->tupla['password']; ?>' onblur="comprobarVacio(this)  ; validarTexto(this,20)" ><br>

					<span class="trn">nombre</span>: 
						<input type = 'text' name = 'nombre' id = 'nombre' placeholder = 'Solo letras' size = '30' value = '<?php echo $this->tupla['nombre']; ?>' onblur="comprobarVacio(this)  ; validarAlfabetico(this,30)" ><br>

					<span class="trn">apellidos</span>: 
						<input type = 'text' name = 'apellidos' id = 'apellidos' placeholder = 'Solo letras' size = '50' value = '<?php echo $this->tupla['apellidos']; ?>' onblur="comprobarVacio(this)  ; validarAlfabetico(this,50)" ><br>

					<span class="trn">email</span> : 
						<input type = 'text' name = 'email' id = 'email'  placeholder = 'Escribe tu email' size = '40' value = '<?php echo $this->tupla['email']; ?>' onblur="comprobarVacio(this)  ; validarTexto(this, 60)" readonly><br>

					<span class="trn">DNI</span> : 
						<input type = 'text' name = 'DNI' id = 'DNI' placeholder = 'Utiliza tu dni' size = '9' value = '<?php echo $this->tupla['DNI']; ?>' onblur="comprobarVacio(this)  ; validarDNI(this)"><br>	

				 	<span class="trn">telefono</span> : 
				 		<input type = 'text' name = 'telefono' id = 'telefono' placeholder = 'Escribe tu telefono' size = '9' value = '<?php echo $this->tupla['telefono']; ?>' onblur="comprobarVacio(this); validarTelefono(this)"><br>

				 	<span class="trn">fotopersonal</span> : 
				 		<input type = 'text' name = 'fotopersonal' id = 'fotopersonal' placeholder = 'Añade tu foto' size = '9' value = '<?php echo $this->tupla['fotopersonal']; ?>' onblur="comprobarVacio(this); validarTexto(this,50)"><br>

					<span class="trn">FechaNacimiento</span>:  
						<input type="date" name="FechaNacimiento" value = '<?php echo $this->tupla['FechaNacimiento']; ?>'><br>

					<span class="trn">sexo</span> : 
						<input type="radio" name="sexo" value="hombre" 
						<?php 
							if ($this->tupla['sexo'] == "hombre")
								echo "checked";
						; ?>/> Hombre 
						<input type="radio" name="sexo" value="mujer"
						<?php 
							if ($this->tupla['sexo'] == "mujer")
								echo "checked";
						; ?>/> Mujer<br/>


					<input type='submit' name='action' value='EDIT'>

			</form>
				
		
			<a href='../Controller/USUARIOS_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	