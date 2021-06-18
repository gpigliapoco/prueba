<?php
require_once '../../modelo/m_procedimientos.php';

$mu= new modelo_procedimientos();
$consulta=$mu->listar_procedimientos();
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