<?php 

	require_once '../modelo/m_usuario.php';

	$mu= new modelo_usuario();
	$email = (isset($_POST['email'])) ? $_POST['email'] : '';
    $password = (isset($_POST['password'])) ? $_POST['password'] : '';
	
    $consulta=$mu->actulizarPassword($password,$email);
    echo $consulta;
    
    

 ?>