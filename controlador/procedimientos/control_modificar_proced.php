<?php 

    require_once '../../modelo/m_procedimientos.php';

    $mu= new modelo_procedimientos();
	$idproc = (isset($_POST['idproc'])) ? $_POST['idproc'] : '';
    $nombre = (isset($_POST['sexo'])) ? $_POST['sexo'] : '';
	
    
    $consulta=$mu->modificarProcedimiento($nombre);
	echo $consulta;
    
    

 ?>