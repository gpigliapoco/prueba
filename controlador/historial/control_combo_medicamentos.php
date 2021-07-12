<?php
require_once '../../modelo/m_historial.php';

$mu= new modelo_historial();
$consulta=$mu->listar_combo_medicamentos();
echo json_encode($consulta);


?>