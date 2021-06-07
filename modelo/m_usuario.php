<?php 


  class modelo_usuario{

        
    private $conexion;
    

  	function __construct(){
  		require_once 'conexion.php';
  		$this->conexion =new Conexion();
      $this->conexion->conectar();
  	}
	
	  function mostrarUsuarios(){
		  $consulta = "SELECT * FROM usuarios";
		  $resultado=$this->conexion->conexion->prepare($consulta);
		  $resultado->execute();
	  }


  	function agregarUsuario($usu,$pass){
  	  $consulta = "INSERT INTO usuarios (nombre,contra) VALUES('$usu', '$pass') ";	
      $resultado=$this->conexion->conexion->prepare($consulta);
        if ($resultado->execute()) {
         
         
          return 1;
         
        
		     }
     
  	}


  }

 

 ?>