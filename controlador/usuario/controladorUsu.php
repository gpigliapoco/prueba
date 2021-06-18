<?php 

	require_once '../modelo/m_usuario.php';

	$mu= new modelo_usuario();
	$usu = (isset($_POST['usu'])) ? $_POST['usu'] : '';
    $pass = (isset($_POST['pass'])) ? $_POST['pass'] : '';
	$sexo = (isset($_POST['sexo'])) ? $_POST['sexo'] : '';
	$rol = (isset($_POST['rol'])) ? $_POST['rol'] : '';
	$email = (isset($_POST['email'])) ? $_POST['email'] : '';
    
    $consulta=$mu->agregarUsuario($usu,$pass,$sexo,$rol,$email);
	echo $consulta;
    
    

 ?>