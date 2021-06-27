<?php 

    require '../../modelo/m_paciente.php';

    $mu= new modelo_paciente();
    $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
    $apellido = (isset($_POST['apellido'])) ? $_POST['apellido'] : '';
	$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
	$movil = (isset($_POST['movil'])) ? $_POST['movil'] : '';
	$sexo = (isset($_POST['sexo'])) ? $_POST['sexo'] : '';
    $fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
    $dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';

    $consulta=$mu->registrar_paciente($nombre,$apellido,$direccion,$movil,$sexo,$fecha,$dni);
	echo $consulta;




?>