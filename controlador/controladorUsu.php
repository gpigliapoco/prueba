<?php 

	require_once '../modelo/m_usuario.php';

	$mu= new modelo_usuario();
	$usu = (isset($_POST['usu'])) ? $_POST['usu'] : '';
    $pass = (isset($_POST['pass'])) ? $_POST['pass'] : '';
    printf($usu);
    $consulta=$mu->agregarUsuario($usu, $pass);
    echo $consulta;
    

 ?>