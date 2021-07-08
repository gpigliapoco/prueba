<?php

require_once '../../modelo/m_historial.php';

$mu= new modelo_historial();
$fechaN = (isset($_POST['fechaN'])) ? $_POST['fechaN'] : '';
$fechaF = (isset($_POST['fechaF'])) ? $_POST['fechaF'] : '';
$consulta=$mu->listar_historial($fechaN,$fechaF);

if($consulta){
    echo json_encode($consulta);
}else{
    echo '{
        "sEcho": 1,
        "iTotalRecords": "0",
        "iTotalDisplayRecords": "0",
        "aaData": []
    }';
    
}

?>