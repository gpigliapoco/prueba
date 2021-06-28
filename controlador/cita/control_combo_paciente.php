<?php
require_once '../../modelo/m_cita.php';

$mu= new modelo_cita();
$consulta=$mu->listar_combo_paciente();
echo json_encode($consulta);


?>