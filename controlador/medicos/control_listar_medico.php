<?php
require_once '../../modelo/m_medico.php';

$mu= new modelo_medicos();
$consulta=$mu->listar_medicos();
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