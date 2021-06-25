<?php 

	require_once '../../modelo/m_medico.php';

	$mu= new modelo_medicos();
	$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
    $apellido = (isset($_POST['apellido'])) ? $_POST['apellido'] : '';
	$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
	$movil = (isset($_POST['movil'])) ? $_POST['movil'] : '';
	$sexo = (isset($_POST['sexo'])) ? $_POST['sexo'] : '';
    $fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
    $dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
    $cole = (isset($_POST['cole'])) ? $_POST['cole'] : '';
    $especial = (isset($_POST['especial'])) ? $_POST['especial'] : '';

    
    $consulta=$mu->registrar_medicos($nombre,$apellido,$direccion,$movil,$sexo,$fecha,$dni,$cole,$especial);
	echo $consulta;
    
    

 ?>