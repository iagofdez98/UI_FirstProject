<?php

	class PROFESOR_SHOWALL{

//Clase : PROFESOR_SHOWALL
//Creado el : 05/10/2019
//Creado por: stwgno

//Constructor de la clase
		function __construct($lista,$datos){
			$this->datos = $datos; //se almacenan los datos
			$this->lista = $lista;	//se almacena la lista
			$this->render(); //se carga el render
		}

		//Función que renderiza todo lo que hay dentro de la vista, incluidos Header y Footer
		function render(){

			include '../View/Header.php'; //header necesita los strings
?>
			<h1><span class="trn">SHOWALL</span></h1>	
			<br>
			<br>
			<a href='../Controller/PROFESOR_Controller.php?action=ADD'><i class="fas fa-plus-circle"></i></a>
			<br>
			<a href='../Controller/PROFESOR_Controller.php?action=SEARCH'><i class="fas fa-search"></i></a>
			
		<table>
			<tr>
<?php
		foreach ($this->lista as $titulo) {
?>
				<th><?php echo $titulo; ?></th>
<?php
		}
?>
			</tr>
<?php
		foreach($this->datos as $fila)
		{
?>
			<tr>
<?php
			foreach ($this->lista as $columna) {			
?>
				<td><?php echo $fila[$columna]; ?></td>
<?php
			}
?>
				<td>
					<a href='
						../Controller/PROFESOR_Controller.php?action=EDIT&DNI=
							<?php echo $fila['DNI']; ?>
							'> <i class="fas fa-edit"></i> </a>
				</td>
				<td>
					<a href='
						../Controller/PROFESOR_Controller.php?action=DELETE&DNI=
							<?php echo $fila['DNI']; ?>
							'> <i class="fas fa-trash"></i> </a>
				</td>
				<td>
					<a href='
						../Controller/PROFESOR_Controller.php?action=SHOWCURRENT&DNI=
							<?php echo $fila['DNI']; ?>
							'> <i class="fas fa-info"></i> </a>
				</td>
			</tr>

<?php

		}
?>


		</table>		
		
					
<?php
			include '../View/Footer.php';
		} //fin metodo render

	} //fin REGISTER

?>

	