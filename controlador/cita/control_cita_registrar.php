<?php 

	require_once '../../modelo/m_cita.php';

	$mu= new modelo_cita();
	$idPaciente = (isset($_POST['idPaciente'])) ? $_POST['idPaciente'] : '';
    $idMedico = (isset($_POST['idMedico'])) ? $_POST['idMedico'] : '';
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
    
    $consulta=$mu->registrar_cita($idPaciente,$idMedico,$descripcion);
	echo $consulta;
    
    

 ?>