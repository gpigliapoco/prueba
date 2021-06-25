<?php
    Class modelo_procedimientos{

        private $conexion;


        function __construct(){
            require_once 'conexion.php';
            $this->conexion =new Conexion();
        $this->conexion->conectar();
        }

        function listar_procedimientos(){
            $consulta = "SELECT * FROM procedimientos";
            $arreglo = array();
            if ($resultado = $this->conexion->conexion->query($consulta)) {
                while ($consulta_VU = mysqli_fetch_assoc($resultado)) {
                    $arreglo["data"][]=$consulta_VU;
    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        function registrar_procedimientos($nombre){
            $consulta = "INSERT INTO procedimientos (pro_nombre,pro_status) VALUES('$nombre','activo') ";	
            
            $resultado=$this->conexion->conexion->prepare($consulta);
            if ($resultado->execute()) {                 
              return 1;                 
                 }else {
                    return 0;
                 }
    
                 $this->conexion->cerrar();
          }

          function modificarStatus($idproc,$status){
            $consulta = "UPDATE procedimientos SET pro_status = '$status' WHERE idprocedimientos = '$idproc'  ";	
            
            $resultado=$this->conexion->conexion->prepare($consulta);
            if ($resultado->execute()) {                 
              return 1;                 
                 }
                 $this->conexion->cerrar();
          }	    

          function modificarProcedimiento($nombre){
            $consulta = "SELECT COUNT(*) as cuenta FROM procedimientos  WHERE pro_nombre = '$nombre'  ";	
            if ($resultado = $this->conexion->conexion->query($consulta)) {
              if ($row = mysqli_fetch_array($resultado)) {
                              return $id= trim($row[0]); ////  devuelve la posicion 1 variable cuenta
              }
              $this->conexion->cerrar();
            }
           }

           /*  function modificarProcedimiento1($nombre){
            $consulta = "SELECT COUNT(*) as cuenta FROM procedimientos  WHERE nombre = '$nombre'  ";	
            if ($resultado = $this->conexion->conexion->query($consulta)) {
            $row = mysqli_fetch_array($resultado) ;
            return $id= trim($row[0]); ////  devuelve la posicion 1 variable cuenta
              
              
            }
           } */  ////tambien funciona esta funcion 

    }



?>