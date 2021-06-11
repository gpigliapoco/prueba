<?php
require_once '../modelo/m_usuario.php';

$mu= new modelo_usuario();
$consulta=$mu->listar_combo();
echo json_encode($consulta);


?>