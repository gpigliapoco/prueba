<?php 

	require_once '../../modelo/m_historial.php';

	$mu= new modelo_historial();
	$id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $arregloMedicamento= (isset($_POST['arregloMedicamentos'])) ? $_POST['arregloMedicamentos'] : '';
    $arregloCantidad= (isset($_POST['arregloCantidad'])) ? $_POST['arregloCantidad'] : '';
   
    $arregloMedi= explode(",",$arregloMedicamento);/// separo mis datos
    $arregloCanti= explode(",",$arregloCantidad);/// separo mis datos

    for ($i=0; $i < count($arregloMedi); $i++) { 

        $consulta=$mu->registrar_detalleMedicamento($id,$arregloMedi[$i],$arregloCanti[$i]);
    }
    
    
	echo $consulta;
    
    

 ?>