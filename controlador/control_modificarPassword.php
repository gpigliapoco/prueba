<?php 

	require_once '../modelo/m_usuario.php';

	$mu= new modelo_usuario();
	$idUsu = (isset($_POST['idUsu'])) ? $_POST['idUsu'] : '';
    $contraDb = (isset($_POST['contraDb'])) ? $_POST['contraDb'] : '';
	$contraEscrita = (isset($_POST['contraEscrita'])) ? $_POST['contraEscrita'] : '';
    $contraNew = (isset($_POST['contraNew'])) ? $_POST['contraNew'] : '';
    if($contraDb!=$contraEscrita){
        echo 2;
    }else{
        $consulta=$mu->modificarPassword($idUsu,$contraNew);
        echo $consulta;
    }
        
    
    

 ?>