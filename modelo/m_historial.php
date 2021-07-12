<?php
    Class modelo_historial{

        private $conexion;


        function __construct(){
            require_once 'conexion.php';
            $this->conexion =new Conexion();
        $this->conexion->conectar();
        }

        function listar_historial($fechaN,$fechaF){
            $consulta = "call listar_historial('$fechaN','$fechaF')";
            $arreglo = array();
            if ($resultado = $this->conexion->conexion->query($consulta)) {
                while ($consulta_VU = mysqli_fetch_assoc($resultado)) {
                    $arreglo["data"][]=$consulta_VU;
    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        function listar_historialDia(){
            $consulta = "call listar_historialDia()";
            $arreglo = array();
            if ($resultado = $this->conexion->conexion->query($consulta)) {
                while ($consulta_VU = mysqli_fetch_assoc($resultado)) {
                    $arreglo["data"][]=$consulta_VU;
    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        function listar_combo_insumos(){
            $consulta = "call comboInsumos";
            $arreglo = array();
            if ($resultado = $this->conexion->conexion->query($consulta)) {
                while ($consulta_VU = mysqli_fetch_array($resultado)) {
                    $arreglo[]=$consulta_VU;
    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        } 

        function listar_combo_procedimientos(){
            $consulta = "call comboProcedimientos";
            $arreglo = array();
            if ($resultado = $this->conexion->conexion->query($consulta)) {
                while ($consulta_VU = mysqli_fetch_array($resultado)) {
                    $arreglo[]=$consulta_VU;
    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        } 

        function listar_combo_medicamentos(){
            $consulta = "call comboMedicamentos";
            $arreglo = array();
            if ($resultado = $this->conexion->conexion->query($consulta)) {
                while ($consulta_VU = mysqli_fetch_array($resultado)) {
                    $arreglo[]=$consulta_VU;
    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        } 
       
 
       
    }




?>