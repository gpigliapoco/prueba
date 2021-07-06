<?php

require_once '../../modelo/m_consultas.php';

$mu= new modelo_consulta();
$fechaN = (isset($_POST['fechaN'])) ? $_POST['fechaN'] : '';
$fechaF = (isset($_POST['fechaF'])) ? $_POST['fechaF'] : '';
$consulta=$mu->listar_consulta($fechaN,$fechaF);

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