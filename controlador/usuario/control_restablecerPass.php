<?php 

	require_once '../modelo/m_usuario.php';

	$mu= new modelo_usuario();
	$email = (isset($_POST['email'])) ? $_POST['email'] : '';
   
	
    $consulta1=$mu->traerEmail($email);
    $data=JSON_encode($consulta1);
	echo $data;
    
    

 ?>