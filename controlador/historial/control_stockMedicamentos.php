<?php
require_once '../../modelo/m_historial.php';

$mu= new modelo_historial();
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$consulta=$mu->stockMedicamento($id);
echo json_encode($consulta);


?>