<?php

	class PROF_ESPACIO_EDIT{
		
//Clase : PROF_ESPACIO_EDIT
//Creado el : 05/10/2019
//Creado por: stwgno

//Constructor de la clase
		function __construct($tupla,$coddni,$codespacio){	
			$this->tupla = $tupla;	//se almacenan las tuplas
			$this->coddni = $coddni;	//se almacenan los codigos del dni
			$this->codespacio = $codespacio;	//se almacenan los codigos de espacio

			$this->render();
		}

		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){

			include '../View/Header.php'; //header necesita los strings
		?>
			<h1><span class="trn">EDIT</span></h1>	
			<form name = 'Form' action='../Controller/PROF_ESPACIO_Controller.php' method='post' onsubmit="return validarProfEspacio('Form');">	

				<span class="trn">DNI</span> :  
					<select name='DNI'>
					<?php 
						foreach($this->coddni as $DNI){
					?> 	<option value = '<?php echo $DNI;?>'
												<?php
												if($DNI == $this->tupla['DNI'])
												{
												?> 
													selected = 'selected' 
												<?php 
												} 
												?>
							> <?php echo ($DNI); ?>
						</option> 
					<?php
					}
					?>
					</select> <br>

				<span class="trn">CODESPACIO</span> :  
					<select name='CODESPACIO'>
					<?php 
						foreach($this->codespacio as $CODESPACIO){
					?> 	<option value = '<?php echo $CODESPACIO;?>'
												<?php
												if($CODESPACIO == $this->tupla['CODESPACIO'])
												{
												?> 
													selected = 'selected' 
												<?php 
												} 
												?>
							> <?php echo ($CODESPACIO); ?>
						</option> 
					<?php
					}
					?>
					</select> <br>

					<input type='submit' name='action' value='EDIT'>

			</form>
				
		
			<a href='../Controller/PROF_ESPACIO_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	