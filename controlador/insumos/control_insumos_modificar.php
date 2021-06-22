<?php 

require_once '../../modelo/m_insumos.php';

$mp=new modelo_insumos();

$idinsumo= (isset($_POST['idinsumos'])) ? $_POST['idinsumos']:'';
$nombre= (isset($_POST['nombre'])) ? $_POST['nombre']:'';
$stock= (isset($_POST['stock'])) ? $_POST['stock']:'';
$status= (isset($_POST['status'])) ? $_POST['status']:'';
$consulta=$mp->modificarInsumo($idinsumo,$nombre,$stock,$status);
echo $consulta;

?>