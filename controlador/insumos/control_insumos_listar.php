<?php
require_once '../../modelo/m_insumos.php';

$mu= new modelo_insumos();
$consulta=$mu->listar_insumos();
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