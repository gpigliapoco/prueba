<?php
    
    $idUsuario=$_POST['iduser'];
    $user=$_POST['usu'];
    session_start();
    $_SESSION['S_idusuario']=$idUsuario;
    $_SESSION['S_user']=$user;


?>