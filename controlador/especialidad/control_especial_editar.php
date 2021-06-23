<?php 

    require_once '../../modelo/m_especialidad.php';

    $mu= new modelo_especialidad();
	$idespecial = (isset($_POST['idespecial'])) ? $_POST['idespecial'] : '';
    $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
	
    
    $consulta=$mu->modificarEspecialidad($idespecial,$nombre);
	echo $consulta;
    
    

 ?>