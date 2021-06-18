<?php 

require_once '../../modelo/m_procedimientos.php';

$mp=new modelo_procedimientos();

$idproc= (isset($_POST['idproc'])) ? $_POST['idproc']:'';
$status= (isset($_POST['status'])) ? $_POST['status']:'';
$consulta=$mp->modificarStatus($idproc,$status);
echo $consulta;

?>