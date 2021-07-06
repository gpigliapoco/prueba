<?php
require_once '../../modelo/m_consultas.php';

$mu= new modelo_consulta();
$consulta=$mu->listar_combo_paciente_consulta();
echo json_encode($consulta);


?>