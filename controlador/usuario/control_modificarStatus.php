<?php 

require_once '../modelo/m_usuario.php';

$mu= new modelo_usuario();
$idUsu = (isset($_POST['idUsu'])) ? $_POST['idUsu'] : '';
$status = (isset($_POST['status'])) ? $_POST['status'] : '';

$consulta=$mu->modificarStatus($idUsu,$status);
echo $consulta;

?>