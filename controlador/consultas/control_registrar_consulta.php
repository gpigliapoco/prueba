<?php 

	require_once '../../modelo/m_consultas.php';

	$mu= new modelo_consulta();
	$idCita = (isset($_POST['idCita'])) ? $_POST['idCita'] : '';
    $diagnostico = (isset($_POST['diagnostico'])) ? $_POST['diagnostico'] : '';
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
    
    $consulta=$mu->registrar_consulta($idCita,$descripcion,$diagnostico);
	echo $consulta;
    
    

 ?>