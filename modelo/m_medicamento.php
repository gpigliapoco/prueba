<?php
    Class modelo_medicamento{

        private $conexion;


        function __construct(){
            require_once 'conexion.php';
            $this->conexion =new Conexion();
        $this->conexion->conectar();
        }

        function listar_medicamento(){
            $consulta = "SELECT * FROM medicamentos";
            $arreglo = array();
            if ($resultado = $this->conexion->conexion->query($consulta)) {
                while ($consulta_VU = mysqli_fetch_assoc($resultado)) {
                    $arreglo["data"][]=$consulta_VU;
    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        
        function registrar_medicamento($nombre,$stock){
            $consulta="INSERT INTO medicamentos(medi_nombre,medi_stock,medi_fecha_registro,medi_status) VALUES ('$nombre','$stock',CURDATE(),'activo')";
            $resultado=$this->conexion->conexion->prepare($consulta);
            if ($resultado->execute()) {                 
              return 1;                 
                 }else {
                    return 0;
                 }
    
                 $this->conexion->cerrar();
        }     
           
          
          function modificarMedicamentos($idmedica,$nombre,$stock){
            $consulta = "UPDATE medicamentos SET medi_nombre = '$nombre',medi_stock= '$stock' WHERE idmedicamentos = '$idmedica'  ";	
            
            $resultado=$this->conexion->conexion->prepare($consulta);
            if ($resultado->execute()) {                 
              return 1;                 
                 }
                 $this->conexion->cerrar();
          }	  

    }



?>