<?php 

	require_once '../../modelo/m_especialidad.php';

	$mu= new modelo_especialidad();
	$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
    $fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';

    
    $consulta=$mu->registrar_especialidad($nombre,$fecha);
	echo $consulta;
    
    

 ?>