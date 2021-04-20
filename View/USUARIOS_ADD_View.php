
<?php
	class USUARIOS_ADD{
		
//Clase : USUARIOS_ADD
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
			<h1><span class="trn">ADD</span></h1>	
			<form name = 'Form' action='../Controller/USUARIOS_Controller.php' method='post' onsubmit="return validarUsuario('Form');">
			
				 	<span class="trn">login</span> : 
				 		<input type = 'text' name = 'login' id = 'login' placeholder = 'Escribe tu login' size = '9' value = '' 
				 				onblur="validarTexto(this, 15); comprobarVacio(this)" required=""><br>

					<span class="trn">password</span> : 
						<input type = 'text' name = 'password' id = 'password' placeholder = 'letras y numeros' size = '15' value = '' onblur="comprobarVacio(this); validarTexto(this, 20)" required=""><br>

					<span class="trn">DNI</span> : 
						<input type = 'text' name = 'DNI' id = 'DNI' placeholder = 'Utiliza tu DNI' size = '9' value = '' onblur="comprobarVacio(this) ; validarDNI(this)" required=""></br>

					<span class="trn">nombre</span> : 
						<input type = 'text' name = 'nombre' id = 'nombre' size = '30' value = '' onblur="comprobarVacio(this); validarAlfabetico(this,30)" required=""><br>

					<span class="trn">apellidos</span> : 
						<input type = 'text' name = 'apellidos' id = 'apellidos' placeholder = 'Solo letras' size = '50' value = '' onblur="comprobarVacio(this); validarAlfabetico(this,50)" required="" ><br>

					<span class="trn">email</span> :  
						<input type = 'text' name = 'email' id = 'email'  placeholder = 'Escribe tu email' size = '40' value = '' onblur="comprobarVacio(this); validarTexto(this, 60); validarEmail(this);" required=""><br>

				 	<span class="trn">telefono</span> :  
				 		<input type = 'text' name = 'telefono' id = 'telefono' placeholder = 'Escribe tu telefono' size = '9' value = '' onblur="comprobarVacio(this); validarTelefono(this)" required=""><br>

				 	<span class="trn">fotopersonal</span> :  
				 		<input type = 'text' name = 'fotopersonal' id = 'fotopersonal' placeholder = 'Añade tu foto' size = '9' value = '' onblur="comprobarVacio(this); validarTexto(this, 50) " required=""><br>

					<span class="trn">FechaNacimiento</span>:  
						<input type="date" name="FechaNacimiento" value = '' onblur="comprobarVacio(this)" onkeydown="return false"><br>
					
					<span class="trn">sexo</span> :  
						<input type="radio" name="sexo" id='sexo' value="hombre"/> Hombre <input type="radio" name="sexo" id='sexo' value="mujer" checked /> Mujer<br/>

					<input type='submit' name='action' value='ADD'>

			</form>
				
		
			<a href='../Controller/USUARIOS_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	