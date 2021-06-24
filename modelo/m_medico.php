<?php
    Class modelo_medicos{

        private $conexion;


        function __construct(){
            require_once 'conexion.php';
            $this->conexion =new Conexion();
        $this->conexion->conectar();
        }

        function listar_medicos(){
            $consulta = "SELECT medico.idmedico,medico.nombre,medico.apellido,medico.direccion,medico.movil,medico.sexo,medico.fecha_nac,medico.documento,medico.colegiatura,medico.idespecialidad,especialidad.especialidad,CONCAT(medico.nombre,' ',medico.apellido)as medico FROM medico INNER JOIN especialidad ON medico.idespecialidad = especialidad.idespecialidad";
            $arreglo = array();
            if ($resultado = $this->conexion->conexion->query($consulta)) {
                while ($consulta_VU = mysqli_fetch_assoc($resultado)) {
                    $arreglo["data"][]=$consulta_VU;
    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        function registrar_especialidad($nombre,$fecha){
            $consulta="INSERT INTO especialidad(especialidad,fecha_registro,status) VALUES ('$nombre','$fecha','activo')";
            $resultado=$this->conexion->conexion->prepare($consulta);
            if ($resultado->execute()) {                 
              return 1;                 
                 }else {
                    return 0;
                 }
    
                 $this->conexion->cerrar();
        }

        function modificarStatus($idespe,$status){
            $consulta = "UPDATE especialidad SET status = '$status' WHERE idespecialidad = '$idespe'  ";	
            
            $resultado=$this->conexion->conexion->prepare($consulta);
            if ($resultado->execute()) {                 
              return 1;                 
                 }
                 $this->conexion->cerrar();
          }	  
          
          
          function modificarEspecialidad($idespe,$nombre){
            $consulta = "UPDATE especialidad SET especialidad = '$nombre' WHERE idespecialidad = '$idespe'  ";	
            
            $resultado=$this->conexion->conexion->prepare($consulta);
            if ($resultado->execute()) {                 
              return 1;                 
                 }
                 $this->conexion->cerrar();
          }	  

    }



?>