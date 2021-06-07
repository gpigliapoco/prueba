<?php 


  class modelo_usuario{

        
    private $conexion;
    

  	function __construct(){
  		require_once 'conexion.php';
  		$this->conexion =new Conexion();
      $this->conexion->conectar();
  	}

  	function agregarUsuario($usu,$pass){
  		$consulta = "INSERT INTO usuarios (nombre,contra) VALUES('$usu', '$pass') ";	
      $resultado=$this->conexion->conexion->prepare($consulta);
        if ($resultado->execute()) {
          echo "ingresado   ";
         
          return 1;
         
        
		     }
     
  	}


  }

 



	// include_once 'conexion.php';

	// $objeto=new Conexion();
	// $conexion=$objeto->Conectar();

	// $usu = (isset($_POST['usu'])) ? $_POST['usu'] : '';
	// $pass = (isset($_POST['pass'])) ? $_POST['pass'] : '';

	
	// 	$consulta = "INSERT INTO usuarios (nombre,contra) VALUES('$usu', '$pass') ";			
 //        $resultado = $conexion->prepare($consulta);
 //        $resultado->execute(); 

 //        return $data = print json_encode($resultado);
	




 ?>