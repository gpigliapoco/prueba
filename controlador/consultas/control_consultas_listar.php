<?php
<<<<<<< HEAD
require_once '../../modelo/m_consulta.php';

$mu= new modelo_consulta();
$consulta=$mu->listar_consulta();
=======

require_once '../../modelo/m_consultas.php';

$mu= new modelo_consulta();
$fechaN = (isset($_POST['fechaN'])) ? $_POST['fechaN'] : '';
$fechaF = (isset($_POST['fechaF'])) ? $_POST['fechaF'] : '';
$consulta=$mu->listar_consulta($fechaN,$fechaF);
>>>>>>> 08120fc23c9253ea6260f9970ee96c1ab683fb58
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