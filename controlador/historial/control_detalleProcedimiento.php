<?php 

	require_once '../../modelo/m_historial.php';

	$mu= new modelo_historial();
	$id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $arregloProcedimiento= (isset($_POST['arregloProcedimiento'])) ? $_POST['arregloProcedimiento'] : '';
   
    $arregloPRO= explode(",",$arregloProcedimiento);/// separo mis datos

    for ($i=0; $i < count($arregloPRO); $i++) { 

        $consulta=$mu->registrar_detalleProcedimientos($id,$arregloPRO[$i]);
    }
    
    
	echo $consulta;
    
    

 ?>