<?php
require_once '../../modelo/m_consulta.php';

$mu= new modelo_consulta();
$consulta=$mu->listar_consulta();
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