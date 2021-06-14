<?php 

	require_once '../modelo/m_usuario.php';

	$mu= new modelo_usuario();
	$idUsuario = (isset($_POST['idUsuario'])) ? $_POST['idUsuario'] : '';
    $sexo = (isset($_POST['sexo'])) ? $_POST['sexo'] : '';
	$rol = (isset($_POST['rol'])) ? $_POST['rol'] : '';
    
    $consulta=$mu->modificarUsuario($idUsuario,$sexo,$rol);
	echo $consulta;
    
    

 ?>