<?php 

require_once '../../modelo/m_paciente.php';

$mp=new modelo_paciente();

$idpaciente= (isset($_POST['idpaciente'])) ? $_POST['idpaciente']:'';
$status= (isset($_POST['status'])) ? $_POST['status']:'';
$consulta=$mp->modificarStatus($idpaciente,$status);
echo $consulta;

?>