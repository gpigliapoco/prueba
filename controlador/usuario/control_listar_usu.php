<?php
require_once '../../modelo/m_usuario.php';

$mu= new modelo_usuario();
$consulta=$mu->listar_usuario();
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