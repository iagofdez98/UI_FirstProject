<?php

// crear el array principal de test
	$ERRORS_array_test = array();
// incluimos aqui tantos ficheros de test como entidades
include '../test/Global_test.php';
include '../test/USUARIOS_test.php';






?>

<h1>De <?php echo count($ERRORS_array_test); ?> tests hay </h1>
<br>

<?php
// presentacion de resultados
?>
<h1>Test de unidad</h1>
<table>
	<tr>
		<th>
			Entidad
		</th>
		<th>
			Método
		</th>
		<th>
			Error testeado
		</th>
		<th>
			Error Esperado
		</th>
		<th>
			Error Obtenido
		</th>
		<th>
			Resultado
		</th>
	</tr>
<?php
	foreach ($ERRORS_array_test as $test)
	{
?>
	<tr>
		<td>
			<?php echo $test['entidad'];?>
		</td>
		<td>
			<?php echo $test['metodo']; ?>
		</td>
		<td>
			<?php echo $test['error']; ?>
		</td>
		<td>
			<?php echo $test['error_esperado']; ?>
		</td>
		<td>
			<?php echo $test['error_obtenido']; ?>
		</td>
		<td>
			<?php echo $test['resultado']; ?>
		</td>
	</tr>
<?php	
	}
?>
</table>

