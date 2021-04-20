<?php
//Funcion desconectar
//Creado el : 05/10/2019
//Creado por: stwgno

//desconecta al usuario
session_start();
session_destroy();
header('Location:../index.php');

?>
