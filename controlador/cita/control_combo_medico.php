<?php
require_once '../../modelo/m_cita.php';

$mu= new modelo_cita();
$espe= (isset($_POST['espe'])) ? $_POST['espe']:'';
$consulta=$mu->listar_combo_medico($espe);
echo json_encode($consulta);


?>