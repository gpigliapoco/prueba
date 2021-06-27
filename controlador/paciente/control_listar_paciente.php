<?php
require_once '../../modelo/m_paciente.php';

$mu= new modelo_paciente();
$consulta=$mu->listar_paciente();
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