<?php
require_once '../../modelo/m_cita.php';

$mu= new modelo_cita();
$consulta=$mu->listar_cita();
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