<?php
    Class modelo_paciente{

        private $conexion;


        function __construct(){
            require_once 'conexion.php';
            $this->conexion =new Conexion();
        $this->conexion->conectar();
        }

        function listar_paciente(){
            $consulta = "SELECT *,Concat(pa_nombre,' ',pa_apellido) as paciente FROM paciente";
            $arreglo = array();
            if ($resultado = $this->conexion->conexion->query($consulta)) {
                while ($consulta_VU = mysqli_fetch_assoc($resultado)) {
                    $arreglo["data"][]=$consulta_VU;
    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        
        function modificarStatus($idpaciente,$status){
            $consulta = "UPDATE paciente SET pa_status = '$status' WHERE idpaciente = '$idpaciente'  ";	
            
            $resultado=$this->conexion->conexion->prepare($consulta);
            if ($resultado->execute()) {                 
              return 1;                 
                 }
                 $this->conexion->cerrar();
          }	
       
          function registrar_paciente($nombre,$apellido,$direccion,$movil,$sexo,$fecha,$dni){
            $consulta="INSERT INTO paciente(
                                pa_nombre,
                                pa_apellido,
                                pa_direccion,
                                pa_movil,
                                pa_sexo,
                                pa_fecha_nac,
                                pa_dni,
                                pa_status) 
                            VALUES (
                                '$nombre',
                                '$apellido',
                                '$direccion',
                                '$movil',
                                '$sexo',
                                '$fecha',
                                '$dni',
                                'activo')";

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