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

        function listar_combo_especial(){
            $consulta = "SELECT * FROM especialidad WHERE status='activo'";
            $arreglo = array();
            if ($resultado = $this->conexion->conexion->query($consulta)) {
                while ($consulta_VU = mysqli_fetch_array($resultado)) {
                    $arreglo[]=$consulta_VU;
    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        } 

        function registrar_medicos($nombre,$apellido,$direccion,$movil,$sexo,$dni,$fecha,$cole,$especial){
            $consulta="INSERT INTO medico(nombre,apellido,direccion,movil,sexo,fecha_nac,documento,colegiatura,idespecialidad,idusuarios) 
                            VALUES ('$nombre','$apellido','$direccion','$movil','$sexo','$fecha','$dni','$cole','$especial',(select max(idusuarios) from usuarios) )";
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