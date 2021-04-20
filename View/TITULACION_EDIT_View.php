<?php

	class TITULACION_EDIT{

//Clase : TITULACION_EDIT
//Creado el : 05/10/2019
//Creado por: stwgno

//Constructor de la clase
		function __construct($tupla,$codcentro){	
			$this->tupla = $tupla; //se almacenan las tuplas
			$this->codcentro = $codcentro; //se almacena el codigo del centro

			$this->render();
		}

		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){

			include '../View/Header.php'; //header necesita los strings
		?>
			<h1><span class="trn">EDIT</span></h1>	
			<form name = 'Form' action='../Controller/TITULACION_Controller.php' method='post' onsubmit="return validarTitulacion('Form')">
	
					<span class="trn">CODTITULACION</span>: 
						<input type = 'text' name = 'CODTITULACION' id = 'CODTITULACION' placeholder = 'Cod. Titulacion' size = '10' value = '<?php echo $this->tupla['CODTITULACION']; ?>' onblur="comprobarVacio(this); validarTexto(this, 10)" readonly=""><br>		
					
					<span class="trn">CODCENTRO</span>: 
						<select name='CODCENTRO'>
						<?php 
							foreach($this->codcentro as $CODCENTRO){
						?> 	<option value = '<?php echo $CODCENTRO;?>'
													<?php
													if($CODCENTRO == $this->tupla['CODCENTRO'])
													{
													?> 
														selected = 'selected' 
													<?php 
													} 
													?>
								> <?php echo ($CODCENTRO); ?>
							</option> 
						<?php
						}
						?>
						</select> <br>

					<span class="trn">NOMBRETITULACION</span>:  
						<input type = 'text' name = 'NOMBRETITULACION' id = 'NOMBRETITULACION' placeholder = 'Nombre' size = '50' value = '<?php echo $this->tupla['NOMBRETITULACION']; ?>' onblur="comprobarVacio(this); validarTexto(this, 50)" required ><br>

					<span class="trn">RESPONSABLETITULACION</span>:  
						<input type = 'text' name = 'RESPONSABLETITULACION' id = 'RESPONSABLETITULACION' placeholder = 'Responsable' size = '60' value = '<?php echo $this->tupla['RESPONSABLETITULACION']; ?>' onblur="comprobarVacio(this); validarTexto('RESPONSABLETITULACION', 60)" required ><br>

					<input type='submit' name='action' value='EDIT'>

			</form>
				
		
			<a href='../Controller/TITULACION_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	