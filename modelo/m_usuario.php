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
          $new_id = $resultado->last_insert_id();
          
          echo mysqli_insert_id($resultado);
           print_r($data);
         
        
		     }
     
  	}


  }

  $r=new modelo_usuario();
  $r->agregarUsuario("pablo1","pablo1111");



	// include_once 'conexion.php';

	// $objeto=new Conexion();
	// $conexion=$objeto->Conectar();

	// $usu = (isset($_POST['usu'])) ? $_POST['usu'] : '';
	// $pass = (isset($_POST['pass'])) ? $_POST['pass'] : '';

	
	// 	$consulta = "INSERT INTO usuarios (nombre,contra) VALUES('$usu', '$pass') ";			
 //        $resultado = $conexion->prepare($consulta);
 //        $resultado->execute(); 

 //        return $data = print json_encode($resultado);
	
/*if ($consulta = $this->conexion->conexion->query($sql)) {
        if ($row = mysqli_fetch_array($consulta)) {
                        return $id= trim($row[0]);
        }
        $this->conexion->cerrar();
      }
*/
 /* $resultado=$conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;*/



 ?>