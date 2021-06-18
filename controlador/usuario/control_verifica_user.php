<?php 
    require '../../modelo/m_usuario.php';
    $mu=new modelo_usuario();
    $user=htmlspecialchars($_POST['usu'],ENT_QUOTES,"UTF-8");
    $pass=htmlspecialchars($_POST['pass'],ENT_QUOTES,"UTF-8");
    $consulta=$mu->verificarUsuario($user,$pass);
    $data=JSON_encode($consulta);
    if(count($consulta)>0){
        echo $data;
    }else{
        echo 0;
    }





?>

