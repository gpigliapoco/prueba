<?php 

	require_once '../../modelo/m_procedimientos.php';

	$mu= new modelo_procedimientos();
	$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';

    
    $consulta=$mu->registrar_procedimientos($nombre);
	echo $consulta;
    
    

 ?>