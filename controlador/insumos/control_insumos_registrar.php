<?php 

	require_once '../../modelo/m_insumos.php';

	$mu= new modelo_insumos();
	$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
    $stock = (isset($_POST['stock'])) ? $_POST['stock'] : '';
    $fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';

    
    $consulta=$mu->registrar_insumo($nombre,$stock,$fecha);
	echo $consulta;
    
    

 ?>