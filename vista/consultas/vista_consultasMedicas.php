<script type="text/javascript" src="../js/consultasM.js?rev=<?php echo time();?>"></script>
<div class="col-md-12">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
              <h3 class="box-title">Consultas medicas</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
              <!-- /.box-tools -->
        </div>
            <!-- /.box-header -->
            <div class="form-group">
                <div class="col-lg-4">
                
                        <label for="">Fecha inicio</label>
                        <input type="date" id="txt_fechaN" class="form-control">
                    
                </div>
                <div class="col-lg-4">
                
                <label for="">Fecha final</label>
                <input type="date" id="txt_fechaF" class="form-control">
            
                </div>
                <div class="col-lg-2">
                <button class="btn btn-danger" style="width:100%" onclick="listar_consultas()"><i class="glyphicon glyphicon-search"></i>Buscar</button>
                </div>
                <div class="col-lg-2">
                <button class="btn btn-danger" style="width:100%" onclick="AbrirModalRegistro()"><i class="glyphicon glyphicon-plus"></i>Nuevo Registro</button>
                </div>
                
            </div>
            <div class="box-body">
            <table id="tabla_consultas" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Documento</th>
                        <th>Paciente</th>
                        <th>Fecha</th>
                        <th>Medico</th>
                        <th>Especialidad</th>
                        <th>Status</th>                        
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Documento</th>
                        <th>Paciente</th>
                        <th>Fecha</th>
                        <th>Medico</th>
                        <th>Especialidad</th>
                        <th>Status</th>                        
                        <th>Acci&oacute;n</th>
                    </tr>
                </tfoot>
            </table>           
            </div>
            <!-- /.box-body -->
    </div>
          <!-- /.box -->
</div>
<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_registro_procedimientos" role="dialog">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><b>Registrar Procedimiento</b></h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <label for="">procedimiento</label>
                    <input type="text" class="form-control" id="txt_nombre" placeholder="Ingrese procedimiento"><br>
                </div>               
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="registrarProcedimiento()"><i class="fa fa-check"><b>&nbsp;Registrar</b></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
        </div>
    </div>
</form>
<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_editar_procedimientos" role="dialog">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><b>Editar procedimiento</b></h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <input type="text" id="txtIdprocedimiento" hidden> 
                    <label for="">Procedimiento</label>
                    <input type="text" class="form-control" id="txt_nombreEditar" placeholder="Ingrese procedimiento" ><br>
                </div>              
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="modificarprocedimientos()"><i class="fa fa-check"><b>&nbsp;Modificar</b></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
        </div>
    </div>
</form>
<script>
$(document).ready(function() {
   var n=new Date();
   var y=n.getFullYear();
   var m=n.getMonth()+1;
   var d=n.getDate();
   if(d<10){
       d='0'+d;
   }
   if(m<10){
       m='0'+m;
   }

   document.getElementById("txt_fechaN").value =y +"-"+m+"-"+d;
   document.getElementById("txt_fechaF").value =y +"-"+m+"-"+d;

   listar_consultas();
    
} );



</script>