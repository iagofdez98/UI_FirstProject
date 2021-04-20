<?php

	class ESPACIO_EDIT{

//Clase : ESPACIO_EDIT
//Creado el : 05/10/2019
//Creado por: stwgno

//Constructor de la clase
		function __construct($tupla,$coded,$codcentro){	
			$this->tupla = $tupla; //se almacenan las tuplas
			$this->coded = $coded; //se almacenan los codigos de edificios
			$this->codcentro = $codcentro;		//se almacenan los codigos de centro

			$this->render(); //se carga el render
		}

		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){

			include '../View/Header.php'; //header necesita los strings
		?>
			<h1><span class="trn">EDIT</span></h1>	
			<form name = 'Form' action='../Controller/ESPACIO_Controller.php' method='post' onsubmit="return validarEspacio('Form');">
			
				 <span class="trn">CODESPACIO</span> : 
				 	<input type = 'text' name = 'CODESPACIO' id = 'CODESPACIO' placeholder = 'Escribe el código del espacio' size = '10' value = '<?php echo $this->tupla['CODESPACIO']; ?>' onblur="comprobarVacio(this); validarTexto(this, 10)" readonly><br>


				<span class="trn">CODESPACIO</span> :
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

				<span class="trn">CODCENTRO</span> :
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

				<span class="trn">TIPO</span> : 
					<input type="radio" name="TIPO" value="DESPACHO" 
						<?php 
							if ($this->tupla['TIPO'] == "DESPACHO")
								echo "checked";
						; ?>/> Despacho 
						<input type="radio" name="TIPO" value="LABORATORIO"
						<?php 
							if ($this->tupla['TIPO'] == "LABORATORIO")
								echo "checked";
						; ?>/> Laboratorio<br/>
						<input type="radio" name="TIPO" value="PAS"
						<?php 
							if ($this->tupla['TIPO'] == "PAS")
								echo "checked";
						; ?>/>PAS<br/>

				<span class="trn">SUPERFICIEESPACIO</span> : 
					<input type = 'number' name = 'SUPERFICIEESPACIO' id = 'SUPERFICIEESPACIO' placeholder = 'En metros2' size = '4' value = '<?php echo $this->tupla['SUPERFICIEESPACIO']; ?>' onblur="comprobarVacio(this); validarEntero(this, 9999,0)" required><br>

				<span class="trn">NUMINVENTARIOESPACIO</span> : 
					<input type = 'number' name = 'NUMINVENTARIOESPACIO' id = 'NUMINVENTARIOESPACIO'  placeholder = 'Inventario' size = '8' value = '<?php echo $this->tupla['NUMINVENTARIOESPACIO']; ?>' onblur="comprobarVacio(this); validarEntero(this, 99999999, 0)" required><br>

					<input type='submit' name='action' value='EDIT'>

			</form>
				
		
			<a href='../Controller/ESPACIO_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	