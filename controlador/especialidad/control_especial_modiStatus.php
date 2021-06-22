<?php 

require_once '../../modelo/m_especialidad.php';

$mp=new modelo_especialidad();

$idespe= (isset($_POST['idespe'])) ? $_POST['idespe']:'';
$status= (isset($_POST['status'])) ? $_POST['status']:'';
$consulta=$mp->modificarStatus($idespe,$status);
echo $consulta;

?>