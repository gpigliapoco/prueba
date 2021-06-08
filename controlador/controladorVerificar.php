<?php
require_once '../modelo/m_usuario.php';

$mu= new modelo_usuario();
//$usu = (isset($_POST['usu'])) ? $_POST['usu'] : '';
//$pass = (isset($_POST['pass'])) ? $_POST['pass'] : '';

$consulta=$mu->listar_usuario();
if($consulta){
    echo json_encode($consulta);
}else{
    echo "noooooo";
}
?>