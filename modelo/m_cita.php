<?php
    Class modelo_cita{

        private $conexion;


        function __construct(){
            require_once 'conexion.php';
            $this->conexion =new Conexion();
        $this->conexion->conectar();
        }

        function listar_cita(){
            $consulta = "SELECT cita.idcita,
                                cita.cita_n_ate,
                                cita.cita_fecha_registro,
                                cita.cita_status,
                                concat(medico.doc_nombre,' ',medico.doc_apellido) as medico,
                                concat(paciente.pa_nombre,' ',paciente.pa_apellido) as paciente 
                                FROM cita 
                                INNER JOIN paciente on cita.idpaciente = paciente.idpaciente 
                                INNER JOIN medico on cita.idmedico = medico.idmedico";
            $arreglo = array();
            if ($resultado = $this->conexion->conexion->query($consulta)) {
                while ($consulta_VU = mysqli_fetch_assoc($resultado)) {
                    $arreglo["data"][]=$consulta_VU;
    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

      
    }



?>