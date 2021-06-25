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
            $consulta="INSERT INTO insumos(ins_nombre,ins_stock,ins_fecha_registro,ins_status) VALUES ('$nombre','$stock',CURDATE(),'activo')";
            $resultado=$this->conexion->conexion->prepare($consulta);
            if ($resultado->execute()) {                 
              return 1;                 
                 }else {
                    return 0;
                 }
    
                 $this->conexion->cerrar();
        }

        function modificarInsumo($idinsumo,$nombre,$stock,$status){
            $consulta = "UPDATE insumos SET ins_status = '$status' , ins_stock = '$stock',ins_nombre = '$nombre' WHERE idinsumos = '$idinsumo'  ";	
            
            $resultado=$this->conexion->conexion->prepare($consulta);
            if ($resultado->execute()) {                 
              return 1;                 
                 }
                 $this->conexion->cerrar();
          }	    

    }



?>