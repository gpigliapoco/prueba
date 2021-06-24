<?php 

	require_once '../../modelo/m_medicamento.php';

	$mu= new modelo_medicamento();
	$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
    $stock = (isset($_POST['stock'])) ? $_POST['stock'] : '';
    
    $consulta=$mu->registrar_medicamento($nombre,$stock);
	echo $consulta;
    
    

 ?>