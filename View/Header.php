<!--
Header
Fecha: 28/10/2019
Creado por: stwgno 
-->

<?php
	include_once '../Functions/Authentication.php';
	if (!isset($_SESSION['idioma'])) {
		$_SESSION['idioma'] = 'SPANISH';
	}
	else{
	}
	include '../Locale/Strings_' . $_SESSION['idioma'] . '.php';
?>

<html>
<head>
	<meta charset="UTF-8">
	<title class="trn">Gestión de Usuarios IU</title>
		<link rel="shortcut icon" href="">
		<link rel = "stylesheet" type = "text/css" href = "../View/Forms_prueba.css" />
		
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="../View/jquery.translate.js"></script>	
		<script src="../View/Diccionario.js"></script>	

    	<script src="https://kit.fontawesome.com/457fd98281.js" crossorigin="anonymous"></script>
		<script src="../View/Javascript.js"></script>

</head>
<body>
<header>
	<p style="text-align:center">
		<h1>
				<span class="trn">Portal de Gestión</span>
		</h1>
	</p>

	<div class="dropdown" align="left">
		<i class="fas fa-globe-africa" ></i>
		<div class="dropdown-content" name="idioma" onChange='this.form.submit()'>
			<a class="btn btn-default lang_selector trn" href="#" role="button" data-value="es"><img src="../View/Icons/spain.jpg" alt="spain"></img></a>		
			<a class="btn btn-default lang_selector trn" href="#" role="button" data-value="eng"><img src="../View/Icons/uk.jpg" alt="uk"></img></a>		
			<a class="btn btn-default lang_selector trn" href="#" role="button" data-value="gal"><img src="../View/Icons/galicia.jpg" alt="galicia"></img></a>		
		</div>
	</div>

<?php
	
	if (IsAuthenticated()){
?>
			
	<div width: 50%; align="right">
		<a href='../Functions/Desconectar.php'>
			<i class="fas fa-sign-out-alt"></i>
		</a>
	</div>

<?php
	
	}
	else{?>
		<span class="trn">Usuario no autenticado</span>

		<a href='../Controller/Register_Controller.php' class="trn">Registrar</a>
<?php
	}	
?>


</header>

<div id = 'main'>
<?php
	//session_start();
	if (IsAuthenticated()){
		include '../View/users_menuLateral.php';
	}
?>
<article>
