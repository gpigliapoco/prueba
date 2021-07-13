<?php 

	require_once '../../modelo/m_historial.php';

	$mu= new modelo_historial();
	$idHistoria = (isset($_POST['idHistoria'])) ? $_POST['idHistoria'] : '';
    $idConsulta = (isset($_POST['idConsulta'])) ? $_POST['idConsulta'] : '';
   
    
    $consulta=$mu->registrar_fua($idHistoria,$idConsulta);
	echo $consulta;
    
    

 ?>