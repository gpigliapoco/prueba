<?php 

require_once '../../modelo/m_medicamento.php';

$mp=new modelo_medicamento();

$idmedica= (isset($_POST['idmedicamentos'])) ? $_POST['idmedicamentos']:'';
$nombre= (isset($_POST['nombre'])) ? $_POST['nombre']:'';
$stock= (isset($_POST['stock'])) ? $_POST['stock']:'';
//$status= (isset($_POST['status'])) ? $_POST['status']:'';
$consulta=$mp->modificarMedicamentos($idmedica$nombre,$stock);
echo $consulta;

?>