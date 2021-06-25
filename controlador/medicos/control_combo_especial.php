<?php
require_once '../../modelo/m_medico.php';

$mu= new modelo_medicos();
$consulta=$mu->listar_combo_especial();
echo json_encode($consulta);


?>