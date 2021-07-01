<?php 

	require_once '../../modelo/m_cita.php';

	$mu= new modelo_cita();
	$idPaciente = (isset($_POST['idPaciente'])) ? $_POST['idPaciente'] : '';
    $idMedico = (isset($_POST['idMedico'])) ? $_POST['idMedico'] : '';
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
    $idcita = (isset($_POST['idcita'])) ? $_POST['idcita'] : '';
    $status = (isset($_POST['status'])) ? $_POST['status'] : '';
    
    $consulta=$mu->editar_cita($idPaciente,$idMedico,$descripcion,$idcita,$status);
	echo $consulta;
    
    

 ?>