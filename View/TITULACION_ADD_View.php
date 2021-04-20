<?php

	class TITULACION_ADD{
		
//Clase : TITULACION_ADD
//Creado el : 05/10/2019
//Creado por: stwgno

//Constructor de la clase
		function __construct($codcentro){	
			$this->codcentro = $codcentro; //se almacenen los codigos del centro
			$this->render(); //se carga el render
		}

		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){

			include '../View/Header.php'; //header necesita los strings
		?>
			<h1><span class="trn">ADD</span></h1>	
			<form name = 'Form' action='../Controller/TITULACION_Controller.php' method='post' onsubmit="return validarTitulacion('Form');">
			
					<span class="trn">CODTITULACION</span> : 
						<input type = 'text' name = 'CODTITULACION' id = 'CODTITULACION' placeholder = 'Cod. Titulacion' size = '10' value = '' onblur="comprobarVacio(this); validarTexto(this, 10)" required=""><br>	
 				
	 				<span class="trn">CODCENTRO</span> : 
					<select name='CODCENTRO'>
					<?php 
						foreach($this->codcentro as $CODCENTRO){
					?> 	<option value = '<?php echo $CODCENTRO;?>' > <?php echo ($CODCENTRO);?></option> 
					<?php
					}
					?>
					</select> <br>

					<span class="trn">NOMBRETITULACION</span> :   
						<input type = 'text' name = 'NOMBRETITULACION' id = 'NOMBRETITULACION' placeholder = 'Nombre' size = '50' value = '' onblur="comprobarVacio(this); validarTexto(this, 50)" required=""><br>

					<span class="trn">RESPONSABLETITULACION</span> :   
						<input type = 'text' name = 'RESPONSABLETITULACION' id = 'RESPONSABLETITULACION' placeholder = 'Responsable' size = '60' value = '' onblur="comprobarVacio(this); validarTexto(this, 60)" required=""><br>		

					<input type='submit' name='action' value='ADD'>

			</form>
				
		
			<a href='../Controller/TITULACION_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>