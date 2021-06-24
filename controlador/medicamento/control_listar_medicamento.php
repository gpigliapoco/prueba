<?php
require_once '../../modelo/m_medicamento.php';

$mu= new modelo_medicamento();
$consulta=$mu->listar_medicamento();
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