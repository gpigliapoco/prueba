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
       
        function stockMedicamento($id){
            $consulta = "SELECT medi_nombre,medi_stock from medicamentos WHERE idmedicamentos = '$id'";
            $arreglo = array();
            if ($resultado = $this->conexion->conexion->query($consulta)) {
                while ($consulta_VU = mysqli_fetch_array($resultado)) {
                    $arreglo[]=$consulta_VU;
    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        } 

        function stockInsumos($id){
            $consulta = "SELECT ins_nombre,ins_stock from insumos WHERE idinsumos = '$id'";
            $arreglo = array();
            if ($resultado = $this->conexion->conexion->query($consulta)) {
                while ($consulta_VU = mysqli_fetch_array($resultado)) {
                    $arreglo[]=$consulta_VU;
    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        } 

        function registrar_fua($idHistoria,$idConsulta){
            $consulta = "CALL registrar_fua('$idHistoria','$idConsulta') ";	
            
            if($resultado = $this->conexion->conexion->query($consulta)){
                if($row = mysqli_fetch_array($resultado) ){
                    return $id = trim($row[0]);
                }
                $this->conexion->cerrar();
            }
        }
       
        function registrar_detalleProcedimientos($id,$arregloPRO){
          //  $consulta = "CALL registrar_detalleProcedimiento('$id','$arregloPRO') ";	    
            $consulta = "INSERT INTO detalle_procedimientos(idfua,idprocedimientos) values('$id','$arregloPRO') ";

            $resultado=$this->conexion->conexion->prepare($consulta);
            if ($resultado->execute()) {                 
              return 1;                 
                 }
                 $this->conexion->cerrar();

        }

        function registrar_detalleMedicamento($id,$arregloMedi,$arregloCanti){
            //  $consulta = "CALL registrar_detalleProcedimiento('$id','$arregloPRO') ";	    
              $consulta = "INSERT INTO detalle_medicamento(idfua,idmedicamentos,detM_cantidad) values('$id','$arregloMedi','$arregloCanti') ";
  
              $resultado=$this->conexion->conexion->prepare($consulta);
              if ($resultado->execute()) {                 
                return 1;                 
                   }
                   $this->conexion->cerrar();
  
          }

          function registrar_detalleInsumos($id,$arregloIns,$arregloCantiIns){
            //  $consulta = "CALL registrar_detalleProcedimiento('$id','$arregloPRO') ";	    
              $consulta = "INSERT INTO detalle_insumos(idfua,idinsumos,det_cantidad) values('$id','$arregloIns','$arregloCantiIns') ";
  
              $resultado=$this->conexion->conexion->prepare($consulta);
              if ($resultado->execute()) {                 
                return 1;                 
                   }
                   $this->conexion->cerrar();
  
          }  
    }




?>