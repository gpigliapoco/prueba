<?php

require_once '../../modelo/m_historial.php';

$mu= new modelo_historial();

$consulta=$mu->listar_historialDia();

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