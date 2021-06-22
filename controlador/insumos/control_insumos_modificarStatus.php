<?php 

require_once '../../modelo/m_insumos.php';

$mp=new modelo_insumos();

$idinsumo= (isset($_POST['idinsumos'])) ? $_POST['idinsumos']:'';
$status= (isset($_POST['status'])) ? $_POST['status']:'';
$consulta=$mp->modificarStatus($idinsumo,$status);
echo $consulta;

?>