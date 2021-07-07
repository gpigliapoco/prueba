<?php 

	require_once '../../modelo/m_consultas.php';

	$mu= new modelo_consulta();
	$idconsulta = (isset($_POST['idconsulta'])) ? $_POST['idconsulta'] : '';
    $diagnostico = (isset($_POST['diagnostico'])) ? $_POST['diagnostico'] : '';
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
    
    $consulta=$mu->editar_consulta($idconsulta,$descripcion,$diagnostico);
	echo $consulta;
    
    

 ?>