<!--
Login
Fecha: 28/10/2019
Creado por: stwgno 
-->

<?php

	class Login{


		function __construct(){	
			$this->render();
		}

		function render(){

			include '../View/Header.php'; 
?>
			<h1><span class="trn">Login</span></h1>	 
			<form name = 'Form' action='../Controller/Login_Controller.php' method='post' onsubmit="return comprobar_login();">
		
					<span class="trn">Login</span> : <input type = 'text' name = 'login' placeholder = 'Utiliza tu Dni' size = '9' value = '' onblur="javi1();"  ><br>
				 	
					<span class="trn">Contraseña</span> : <input type = 'password' name = 'password' placeholder = 'Letras y numeros' size = '15' value = '' onblur="esNoVacio('password')  && comprobarLetrasNumeros('password',15)"  ><br>

					<input type='submit' name='action' value='Login'>

			</form>
							
<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin Login

?>
