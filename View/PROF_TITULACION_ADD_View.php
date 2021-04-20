<?php

	class PROF_TITULACION_ADD{
		
//Clase : PROF_TITULACION_ADD
//Creado el : 05/10/2019
//Creado por: stwgno

//Constructor de la clase
		function __construct($coddni,$codtitulacion){	
			$this->coddni = $coddni;	//se almacenan codigos de dni
			$this->codtitulacion = $codtitulacion;	//se almacenan los codigos de la titulacion
			$this->render(); //se carga el render
		}

		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){

			include '../View/Header.php'; //header necesita los strings
		?>
			<h1><span class="trn">ADD</span></h1>	
			<form name = 'Form' action='../Controller/PROF_TITULACION_Controller.php' method='post' onsubmit="return validarProfTitulacion('Form');">
			
				<span class="trn">DNI</span> : 
				<select name='DNI'>
				<?php 
					foreach($this->coddni as $DNI){
				?> 	<option value = '<?php echo $DNI;?>' > <?php echo ($DNI);?></option> 
				<?php
				}
				?>
				</select> <br>

				<span class="trn">CODTITULACION</span> : 
				<select name='CODTITULACION'>
				<?php 
					foreach($this->codtitulacion as $CODTITULACION){
				?> 	<option value = '<?php echo $CODTITULACION;?>' > <?php echo ($CODTITULACION);?></option> 
				<?php
				}
				?>
				</select> <br>

				<span class="trn">ANHOACADEMICO</span> : 
					<input type = 'text' name = 'ANHOACADEMICO' id = 'ANHOACADEMICO' placeholder = 'Utiliza tu DNI' size = '9' value = '' onblur="comprobarVacio(this); validarTexto(this, 9)" ><br>
					
					<input type='submit' name='action' value='ADD'>

			</form>
				
		
			<a href='../Controller/PROF_TITULACION_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	