<?php

	class CENTRO_SHOWCURRENT{

//Clase : CENTRO_SHOWCURRENT
//Creado el : 05/10/2019
//Creado por: stwgno

//Constructor de la clase
		function __construct($tupla){	
			$this->tupla = $tupla;//se almacenan las tuplas
			$this->render(); //se carga el render
		}

		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){

			include '../View/Header.php'; //header necesita los strings
		?>
			<h1><span class="trn">SHOWCURRENT</span></h1>	
			<form name = 'Form' action='../Controller/CENTRO_Controller.php' method='post' onsubmit="return comprobar_registro();">

				 	<span class="trn">CODCENTRO</span> : 
				 		<input type = 'text' name = 'CODCENTRO' id = 'CODCENTRO' placeholder = 'Escribe el código del centro' size = '10' value = '<?php echo $this->tupla['CODCENTRO']; ?>' readonly=""><br>

					<span class="trn">CODEDIFICIO</span> : 
						<input type = 'text' name = 'CODEDIFICIO' id = 'CODEDIFICIO' placeholder = 'Escribe el código del edificio' size = '10' value = '<?php echo $this->tupla['CODEDIFICIO']; ?>' readonly=""><br>	

					<span class="trn">NOMBRECENTRO</span> : 
						<input type = 'text' name = 'NOMBRECENTRO' id = 'NOMBRECENTRO' placeholder = 'Escribe el nombre del centro' size = '50' value = '<?php echo $this->tupla['NOMBRECENTRO']; ?>' readonly=""><br>	

					<span class="trn">DIRECCIONCENTRO</span>: 
						<input type = 'text' name = 'DIRECCIONCENTRO' id = 'DIRECCIONCENTRO' placeholder = 'Escribe la direccion del centro' size = '150' value = '<?php echo $this->tupla['DIRECCIONCENTRO']; ?>' readonly ><br>	

					<span class="trn">RESPONSABLECENTRO</span>: 
						<input type = 'text' name = 'RESPONSABLECENTRO' id = 'RESPONSABLECENTRO' placeholder = 'Escribe el responsable del centro' size = '60' value = '<?php echo $this->tupla['RESPONSABLECENTRO']; ?>' readonly="" ><br>		

			</form>
				
		
			<a href='../Controller/CENTRO_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	