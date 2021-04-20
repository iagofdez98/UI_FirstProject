<?php
	class CENTRO_ADD{
		
//Clase : CENTRO_ADD
//Creado el : 05/10/2019
//Creado por: stwgno

//Constructor de la clase
		function __construct($coded){	
			$this->coded = $coded;//se almacenan los codigos de los edificios que se pasan en el controller
			$this->render();//se carga el render
		}

		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){

			include '../View/Header.php'; //header necesita los strings
			?>
			<h1><span class="trn">ADD</span></h1>
			<form name = 'Form' class="form" action='../Controller/CENTRO_Controller.php' method='post' onsubmit="return validarCentro('Form')">
			
			 	<span class="trn">CODCENTRO</span> : 
			 		<input type = 'text' name = 'CODCENTRO' id = 'CODCENTRO' size = '10' value = '' onblur="comprobarVacio(this); validarTexto(this, 10)"><br>  

				<span class="trn">CODEDIFICIO</span> :  
					<select name='CODEDIFICIO'>
					<?php 
						foreach($this->coded as $CODEDIFICIO){
					?> 	<option value = '<?php echo $CODEDIFICIO;?>' > <?php echo ($CODEDIFICIO);?></option> 
					<?php
					}
					?>
					</select> <br>

				<span class="trn">NOMBRECENTRO</span> : 
					<input type = 'text' name = 'NOMBRECENTRO' id = 'NOMBRECENTRO' size = '50' value = '' onblur="comprobarVacio(this); validarTexto(this, 50)" required><br>

				<span class="trn">DIRECCIONCENTRO</span> : 
					<input type = 'text' name = 'DIRECCIONCENTRO' id = 'DIRECCIONCENTRO' size = '150' value = '' onblur="comprobarVacio(this); validarTexto(this, 50)" required><br>	

				<span class="trn">RESPONSABLECENTRO</span> : <input type = 'text' name = 'RESPONSABLECENTRO' id = 'RESPONSABLECENTRO' size = '60' value = '' onblur="comprobarVacio(this); validarTexto(this, 60)" required><br>	

					<input type='submit' name='action' value='ADD'>

			</form>
				
		
			<a href='../Controller/CENTRO_Controller.php'><i class="fas fa-chevron-circle-left"></i> </a>
		
		<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	