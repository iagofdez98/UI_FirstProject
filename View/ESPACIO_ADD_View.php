<?php

	class ESPACIO_ADD{

//Clase : ESPACIO_ADD
//Creado el : 05/10/2019
//Creado por: stwgno

//Constructor de la clase
		function __construct($coded,$codcentro){	
			$this->coded = $coded;		// se almacenan los codigos de los edificios
			$this->codcentro = $codcentro; //se almacenen los codigos de los centros 

			$this->render();

		}

		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){

			include '../View/Header.php'; //header necesita los strings
		?>
			<h1><span class="trn">ADD</span></h1>	
			<form name = 'Form' action='../Controller/ESPACIO_Controller.php' method='post' onsubmit="return validarEspacio('Form');">
			
				 <span class="trn">CODESPACIO</span> : 
				 	<input type = 'text' name = 'CODESPACIO' id = 'CODESPACIO' placeholder = 'Escribe el código del espacio' size = '10' value = '' onblur="comprobarVacio(this); validarTexto(this, 10)" required><br>

				<span class="trn">CODEDIFICIO</span>: 
					<select name='CODEDIFICIO'>
					<?php 
						foreach($this->coded as $CODEDIFICIO){
					?> 	<option value = '<?php echo $CODEDIFICIO;?>' > <?php echo ($CODEDIFICIO);?></option> 
					<?php
					}
					?>
					</select> <br>

				<span class="trn">CODCENTRO</span> : 
					<select name='CODCENTRO'>
					<?php 
						foreach($this->codcentro as $CODCENTRO){
					?> 	<option value = '<?php echo $CODCENTRO;?>' > <?php echo ($CODCENTRO);?></option> 
					<?php
					}
					?>
					</select> <br>

				<span class="trn">TIPO</span> : 
					<input type="radio" name="TIPO" id='TIPO' value="DESPACHO" checked/> Despacho <input type="radio" name="TIPO" id='TIPO' value="LABORATORIO" checked /> Laboratorio <input type="radio" name="TIPO" id='TIPO' value="PAS" required> PAS<br/>

				<span class="trn">SUPERFICIEESPACIO</span> : 
					<input type = 'text' name = 'SUPERFICIEESPACIO' id = 'SUPERFICIEESPACIO' placeholder = 'En metros2' size = '4' value = '' onblur="comprobarVacio(this); validarEntero(this, 9999, 0)" required><br>
					
				<span class="trn">NUMINVENTARIOESPACIO</span> : 
					<input type = 'text' name = 'NUMINVENTARIOESPACIO' id = 'NUMINVENTARIOESPACIO'  placeholder = 'Inventario' size = '8' value = '' onblur="comprobarVacio(this); validarEntero(this, 99999999, 0)" required><br>

					<input type='submit' name='action' value='ADD'>

			</form>
				
		
			<a href='../Controller/ESPACIO_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	