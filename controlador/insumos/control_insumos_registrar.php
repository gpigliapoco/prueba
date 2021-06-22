<?php 

	require_once '../../modelo/m_insumos.php';

	$mu= new modelo_insumos();
	$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
    $stock = (isset($_POST['stock'])) ? $_POST['stock'] : '';
    
    $consulta=$mu->registrar_insumo($nombre,$stock);
	echo $consulta;
    
    

 ?>