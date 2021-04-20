<?php

	class USUARIOS_SEARCH{

//Clase : USUARIOS_SEARCH
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
			<h1><?php echo $strings['SEARCH']; ?></h1>	
			<form name = 'Form' action='../Controller/USUARIOS_Controller.php' method='post' onsubmit="return comprobar_registro();">
			
				 	<?php echo $strings['login']?> : <input type = 'text' name = 'login' id = 'login' placeholder = 'Utiliza tu dni' size = '9' value = '' onblur="validarTexto(this, 15)"><br>

					<?php echo $strings['password']?> : <input type = 'text' name = 'password' id = 'password' placeholder = 'letras y numeros' size = '15' value = ''  onblur=" validarTexto(this, 20)"><br>

					<?php echo $strings['nombre']?> : <input type = 'text' name = 'nombre' id = 'nombre' placeholder = 'Solo letras' size = '30' value = '' onblur=" validarAlfabetico(this,30)"  ><br>

					<?php echo $strings['apellidos']?> : <input type = 'text' name = 'apellidos' id = 'apellidos' placeholder = 'Solo letras' size = '50' onblur="validarAlfabetico(this,50)" ><br>

					<?php echo $strings['email']?> : <input type = 'text' name = 'email' id = 'email' placeholder = 'Escribe tu email' size = '40' value = '' onblur="validarTexto(this, 60)"><br>

					<?php echo $strings['DNI']?> : <input type = 'text' name = 'DNI' id = 'DNI' placeholder = 'Utiliza tu dni' size = '9' value = ''><br>	

				 	<?php echo $strings['telefono']?> : <input type = 'text' name = 'telefono' id = 'telefono' placeholder = 'Escribe tu telefono' size = '9' value = '' onblur=" validarTelefono(this)"><br>

				 	<?php echo $strings['fotopersonal']?> : <input type = 'text' name = 'fotopersonal' id = 'fotopersonal' placeholder = 'Añade tu foto' size = '9' value = '' onblur="validarTexto(this, 50) " ><br>

					<?php echo $strings['FechaNacimiento']?>:  <input type="date" name="FechaNacimiento" onkeydown="return false"><br>

					<?php echo $strings['sexo']?> : <input type = 'text' name = 'sexo' id = 'sexo' placeholder = 'hombre/mujer' size = '30' value = '' ><br>

					<input type='submit' name='action' value='SEARCH'>
			</form>
				
		
			<a href='../Controller/USUARIOS_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	