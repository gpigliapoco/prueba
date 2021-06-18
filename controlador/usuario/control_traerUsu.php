<?php 
    require '../../modelo/m_usuario.php';
    $mu=new modelo_usuario();
    $usuario=htmlspecialchars($_POST['usuario'],ENT_QUOTES,"UTF-8");   
    $consulta=$mu->traerDatos($usuario);
    echo JSON_encode($consulta);
    





?>
