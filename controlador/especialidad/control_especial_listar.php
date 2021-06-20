<?php
require_once '../../modelo/m_especialidad.php';

$mu= new modelo_especialidad();
$consulta=$mu->listar_especial();
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