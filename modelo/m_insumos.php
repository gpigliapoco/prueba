<?php
    Class modelo_insumos{

        private $conexion;


        function __construct(){
            require_once 'conexion.php';
            $this->conexion =new Conexion();
        $this->conexion->conectar();
        }

        function listar_insumos(){
            $consulta = "SELECT * FROM insumos";
            $arreglo = array();
            if ($resultado = $this->conexion->conexion->query($consulta)) {
                while ($consulta_VU = mysqli_fetch_assoc($resultado)) {
                    $arreglo["data"][]=$consulta_VU;
    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        function registrar_insumo($nombre,$stock){
            $consulta="INSERT INTO insumos(nombre,stock,fecha_registro,status) VALUES ('$nombre','$stock',CURDATE(),'activo')";
            $resultado=$this->conexion->conexion->prepare($consulta);
            if ($resultado->execute()) {                 
              return 1;                 
                 }else {
                    return 0;
                 }
    
                 $this->conexion->cerrar();
        }

        function modificarInsumo($idinsumo,$nombre,$stock,$status){
            $consulta = "UPDATE insumos SET status = '$status' , stock = '$stock',nombre = '$nombre' WHERE idinsumos = '$idinsumo'  ";	
            
            $resultado=$this->conexion->conexion->prepare($consulta);
            if ($resultado->execute()) {                 
              return 1;                 
                 }
                 $this->conexion->cerrar();
          }	    

    }



?>