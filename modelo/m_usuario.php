<?php 


  class modelo_usuario{

        
    private $conexion;
    

  	function __construct(){
  		require_once 'conexion.php';
  		$this->conexion =new Conexion();
      $this->conexion->conectar();
  	}
	
	


	function verificarUsuario($usu,$pass){
		$consulta="SELECT nombre, contra FROM usuarios where nombre = '$usu' and contra ='$pass'";
		$data=array();
		$resultado=$this->conexion->conexion->prepare($consulta);
		$resultado->execute();
		$resultado->fetchAll(PDO::FETCH_ASSOC);
		return print_r($resultado);
		
	}
	


	function listar_usuario(){
		$consulta = "SELECT * FROM usuarios";
		$arreglo = array();
		if ($resultado = $this->conexion->conexion->query($consulta)) {
			while ($consulta_VU = mysqli_fetch_assoc($resultado)) {
				$arreglo[]=$consulta_VU;

			}
			return $arreglo;
			$this->conexion->cerrar();
		}
	}


  	function agregarUsuario($usu,$pass){
  	  $consulta = "INSERT INTO usuarios (nombre,contra) VALUES('$usu', '$pass') ";	
      $resultado=$this->conexion->conexion->prepare($consulta);
        if ($resultado->execute()) {                 
          return 1;                 
		     }
			 $this->conexion->cerrar();
  	}


	
  }

 

 ?>