<?php

	class CENTRO_EDIT{

//Clase : CENTRO_EDIT
//Creado el : 05/10/2019
//Creado por: stwgno

//Constructor de la clase
		function __construct($tupla, $coded){
			$this->tupla = $tupla;	//se almacenan las tuplas
			$this->coded = $coded;//se almacenan los codigos de los edificios que se pasan en el controller
			$this->render();//se carga el render
		}

		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){

			include '../View/Header.php'; //header necesita los strings
		?>
			<h1><span class="trn">EDIT</span> : </h1>	
			<form name = 'Form' action='../Controller/CENTRO_Controller.php' method='post' onsubmit="return validarCentro('Form')">

			 	<span class="trn">CODCENTRO</span> : 
			 		<input type = 'text' name = 'CODCENTRO' id = 'CODCENTRO' placeholder = 'Escribe el código del centro' size = '10' value = '<?php echo $this->tupla['CODCENTRO']; ?>' onblur="comprobarVacio(this)" readonly><br>

				<span class="trn">CODEDIFICIO</span> : 
					<select name='CODEDIFICIO'>
					<?php 
						foreach($this->coded as $CODEDIFICIO){
					?> 	<option value = '<?php echo $CODEDIFICIO;?>'
												<?php
												if($CODEDIFICIO == $this->tupla['CODEDIFICIO'])
												{
												?> 
													selected = 'selected' 
												<?php 
												} 
												?>
							> <?php echo ($CODEDIFICIO); ?>
						</option> 
					<?php
					}
					?>
					</select> <br>

				<span class="trn">NOMBRECENTRO</span> :  
					<input type = 'text' name = 'NOMBRECENTRO' id = 'NOMBRECENTRO' placeholder = 'Escribe el nombre del centro' size = '50' value = '<?php echo $this->tupla['NOMBRECENTRO']; ?>' onblur="comprobarVacio(this); validarTexto(this, 50)" required><br>	

				<span class="trn">DIRECCIONCENTRO</span> :  
					<input type = 'text' name = 'DIRECCIONCENTRO' id = 'DIRECCIONCENTRO' placeholder = 'Escribe la direccion del centro' size = '150' value = '<?php echo $this->tupla['DIRECCIONCENTRO']; ?>' onblur="comprobarVacio(this); validarTexto(this, 150)" required><br>	

				<span class="trn">RESPONSABLECENTRO</span> :  
					<input type = 'text' name = 'RESPONSABLECENTRO' id = 'RESPONSABLECENTRO' placeholder = 'Escribe el responsable del centro' size = '60' value = '<?php echo $this->tupla['RESPONSABLECENTRO']; ?>' onblur="comprobarVacio(this); validarTexto(this, 60)" required><br>	


				<input type='submit' name='action' value='EDIT'>

			</form>
				
		
			<a href='../Controller/CENTRO_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	