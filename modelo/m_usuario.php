<?php 


  class modelo_usuario{

        
    private $conexion;
    

  	function __construct(){
  		require_once 'conexion.php';
  		$this->conexion =new Conexion();
      $this->conexion->conectar();
  	}
	
	


	function verificarUsuario($usu,$pass){
		$consulta="SELECT * FROM usuarios where usu_nombre = '$usu' and usu_contra ='$pass'";
		$arreglo=array();
		if($resultado=$this->conexion->conexion->query($consulta)){
			while($consulta_VU=mysqli_fetch_assoc($resultado)){
				$arreglo[]=$consulta_VU;
			}
			return $arreglo;
			$this->conexion->cerrar();
		}
		
	}
	


	function listar_usuario(){
		$consulta = "SELECT * FROM usuarios";
		$arreglo = array();
		if ($resultado = $this->conexion->conexion->query($consulta)) {
			while ($consulta_VU = mysqli_fetch_assoc($resultado)) {
				$arreglo["data"][]=$consulta_VU;

			}
			return $arreglo;
			$this->conexion->cerrar();
		}
	}


  	function agregarUsuario($usu,$pass,$sexo,$rol,$email){
  	  $consulta = "INSERT INTO usuarios (usu_nombre,usu_contra,usu_sexo,usu_status,idrol_usuario,usu_email) VALUES('$usu', '$pass','$sexo','activo','$rol','$email') ";	
		
		$resultado=$this->conexion->conexion->prepare($consulta);
        if ($resultado->execute()) {                 
          return 1;                 
		     }else {
				return 0;
			 }

			 $this->conexion->cerrar();
  	}

	  function modificarStatus($idUsu,$status){
  	  $consulta = "UPDATE usuarios SET usu_status = '$status' WHERE idusuarios = '$idUsu'  ";	
		
		$resultado=$this->conexion->conexion->prepare($consulta);
        if ($resultado->execute()) {                 
          return 1;                 
		     }
			 $this->conexion->cerrar();
  	}	  
	  
	  function modificarUsuario($idUsuario,$sexo,$rol,$email){
  	  $consulta = "UPDATE usuarios SET usu_sexo = '$sexo',usu_email = '$email', idrol_usuario ='$rol' WHERE idusuarios = '$idUsuario'  ";	
		
		$resultado=$this->conexion->conexion->prepare($consulta);
        if ($resultado->execute()) {                 
          return 1;                 
		     }
			 $this->conexion->cerrar();
  	}	  

	  function listar_combo(){
		$consulta = "SELECT * FROM rol_usuario";
		$arreglo = array();
		if ($resultado = $this->conexion->conexion->query($consulta)) {
			while ($consulta_VU = mysqli_fetch_array($resultado)) {
				$arreglo[]=$consulta_VU;

			}
			return $arreglo;
			$this->conexion->cerrar();
		}
	}  
	
	
	function traerDatos($usuario){
		$consulta="SELECT * FROM usuarios where usu_nombre = '$usuario' ";
		$arreglo=array();
		if($resultado=$this->conexion->conexion->query($consulta)){
			while($consulta_VU=mysqli_fetch_assoc($resultado)){
				$arreglo[]=$consulta_VU;
			}
			return $arreglo;
			$this->conexion->cerrar();
		}
		
	}

	function traerEmail($email){
		$consulta="SELECT usu_email FROM usuarios where usu_email = '$email' ";
		$arreglo=array();
		if($resultado=$this->conexion->conexion->query($consulta)){
			while($consulta_VU=mysqli_fetch_assoc($resultado)){
				$arreglo[]=$consulta_VU;
			}
			return $arreglo;
			$this->conexion->cerrar();
		}
		
	}

	function modificarPassword($idUsu,$contraNew){
  	  $consulta = "UPDATE usuarios SET usu_contra = '$contraNew' WHERE idusuarios = '$idUsu'  ";	
		
		$resultado=$this->conexion->conexion->prepare($consulta);
        if ($resultado->execute()) {                 
          return 1;                 
		     }else {
				 return 0;
			 }
			 $this->conexion->cerrar();

  }

  function actulizarPassword($password,$email){
	$consulta = "UPDATE usuarios SET usu_contra = '$password' WHERE usu_email = '$email'  ";	
	
	$resultado=$this->conexion->conexion->prepare($consulta);
	if ($resultado->execute()) {                 
	  return 1;                 
		 }else {
			return 0;
		 }
		 $this->conexion->cerrar();

	}

}

 ?>