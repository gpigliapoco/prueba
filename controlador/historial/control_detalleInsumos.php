<?php 

	require_once '../../modelo/m_historial.php';

	$mu= new modelo_historial();
	$id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $arregloInsumos= (isset($_POST['arregloInsumos'])) ? $_POST['arregloInsumos'] : '';
    $arregloCantidadIns= (isset($_POST['arregloCantidadIns'])) ? $_POST['arregloCantidadIns'] : '';
   
    $arregloIns= explode(",",$arregloInsumos);/// separo mis datos
    $arregloCantiIns= explode(",",$arregloCantidadIns);/// separo mis datos

    for ($i=0; $i < count($arregloIns); $i++) { 

        $consulta=$mu->registrar_detalleInsumos($id,$arregloIns[$i],$arregloCantiIns[$i]);
    }
    
    
	echo $consulta;
    
    

 ?>