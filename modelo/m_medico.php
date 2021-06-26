<?php
    Class modelo_medicos{

        private $conexion;


        function __construct(){
            require_once 'conexion.php';
            $this->conexion =new Conexion();
        $this->conexion->conectar();
        }

        function listar_medicos(){
            $consulta = "SELECT medico.idmedico,
                                medico.doc_nombre,
                                medico.doc_apellido,
                                medico.doc_direccion,
                                medico.doc_movil,
                                medico.doc_sexo,
                                medico.doc_fecha_nac,
                                medico.doc_dni,
                                medico.doc_cole,
                                medico.idespecialidad,
                                medico.idusuarios,
                                especialidad.idespecialidad,
                                especialidad.es_especialidad,
                                usuarios.usu_nombre,
                                usuarios.usu_email,
                                usuarios.usu_contra,
                                usuarios.idrol_usuario,
                                CONCAT(medico.doc_nombre,'',medico.doc_apellido)as medico 
                        FROM medico 
                        INNER JOIN usuarios ON medico.idusuarios=usuarios.idusuarios 
                        INNER JOIN especialidad on medico.idespecialidad=especialidad.idespecialidad";
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
            $consulta = "SELECT * FROM especialidad WHERE es_status='activo'";
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
            $consulta="INSERT INTO medico(doc_nombre,doc_apellido,doc_direccion,doc_movil,doc_sexo,doc_fecha_nac,doc_dni,doc_cole,idespecialidad,idusuarios) 
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