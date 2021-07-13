<?php
require_once '../../modelo/m_historial.php';

$mu= new modelo_historial();
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$consulta=$mu->stockInsumos($id);
echo json_encode($consulta);


?>