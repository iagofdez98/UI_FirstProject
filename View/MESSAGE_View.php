<!--
Header
Fecha: 28/10/2019
Creado por: stwgno 
-->
<?php

class MESSAGE{

	private $string; //almacena strings
	private $volver; //volver

//constructor
	function __construct($string, $volver){
		$this->string = $string;
		$this->volver = $volver;	
		$this->render(); //se carga el render
	}

	function render(){

		include '../View/Header.php';
?>
		<br>
		<br>
		<br>
		<p>
		<H3>
<?php		
		echo $strings[$this->string];
?>
		</H3>
		</p>
		<br>
		<br>
		<br>

<?php

		echo '<a href=\'' . $this->volver . "'>" . $strings['Volver'] . " </a>";
		include '../View/Footer.php';
	} //fin metodo render

}