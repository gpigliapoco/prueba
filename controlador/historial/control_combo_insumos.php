<?php
require_once '../../modelo/m_historial.php';

$mu= new modelo_historial();
$consulta=$mu->listar_combo_insumos();
echo json_encode($consulta);


?>