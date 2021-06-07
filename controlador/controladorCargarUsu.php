
<?php 

require_once '../modelo/m_usuario.php';

$mu= new modelo_usuario();


$consulta=$mu->agregarUsuario($usu, $pass);
echo $consulta;



?>