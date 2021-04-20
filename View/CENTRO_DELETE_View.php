<?php

	class CENTRO_DELETE{

//Clase : CENTRO_DELETE
//Creado el : 05/10/2019
//Creado por: stwgno

//Constructor de la clase
		function __construct($tupla){	
			$this->tupla = $tupla;
			$this->render();//se carga el render
		}
		
		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){

			include '../View/Header.php'; //header necesita los strings
		?>
			<h1><span class="trn">DELETE</span></h1>	
			<form name = 'Form' action='../Controller/CENTRO_Controller.php' method='post' onsubmit="return comprobar_registro();">
			
			 		<span class="trn">CODCENTRO</span> : 
				 		<input type = 'text' name = 'CODCENTRO' id = 'CODCENTRO' size = '10' value = '<?php echo $this->tupla['CODCENTRO']; ?>' readonly><br>

					<span class="trn">CODEDIFICIO</span>  : 
						<input type = 'text' name = 'CODEDIFICIO' id = 'CODEDIFICIO' size = '10' value = '<?php echo $this->tupla['CODEDIFICIO']; ?>' readonly><br>	

					<span class="trn">NOMBRECENTRO</span> : 
						<input type = 'text' name = 'NOMBRECENTRO' id = 'NOMBRECENTRO' size = '50' value = '<?php echo $this->tupla['NOMBRECENTRO']; ?>' readonly><br>	

					<span class="trn">DIRECCIONCENTRO</span> :  <input type = 'text' name = 'DIRECCIONCENTRO' id = 'DIRECCIONCENTRO' size = '150' value = '<?php echo $this->tupla['DIRECCIONCENTRO']; ?>' readonly ><br>	

					<span class="trn">RESPONSABLECENTRO</span> :  <input type = 'text' name = 'RESPONSABLECENTRO' id = 'RESPONSABLECENTRO' size = '60' value = '<?php echo $this->tupla['RESPONSABLECENTRO']; ?>'><br>	

					<input type='submit' name='action' value='DELETE'>

			</form>
				
		
			<a href='../Controller/CENTRO_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	