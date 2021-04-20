<?php
//Funcion CambioIdioma
//Creado el : 05/10/2019
//Creado por: stwgno

//Cambia de un idioma a otro
session_start();
$idioma = $_GET['idioma'];
$_SESSION['idioma'] = $idioma;
header('Location:' . $_SERVER["HTTP_REFERER"]);
?>