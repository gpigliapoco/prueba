<script type="text/javascript" src="../js/historial.js?rev=<?php echo time();?>"></script>
<div class="col-md-12">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
              <h3 class="box-title">Mantenimiento historial medicas</h3>

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
                <button class="btn btn-danger" style="width:100%" onclick="listar_historial()"><i class="glyphicon glyphicon-search"></i>Buscar</button>
                </div>
                <div class="col-lg-2">
                <button class="btn btn-danger" style="width:100%" onclick="cargar_contenido('contenido_principal','historial/vista_historialManten.php')"><i class="glyphicon glyphicon-plus"></i>Nuevo Registro</button>
                </div>
                
            </div>
            <div class="box-body">
            <table id="tabla_historial" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Documento</th>
                        <th>Paciente</th>                        
                        <th>Medico</th>
                        <th>Diagnostico</th>                                              
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Documento</th>
                        <th>Paciente</th>                        
                        <th>Medico</th>
                        <th>Diagnostico</th>                                                
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
    <div class="modal fade" id="modal_registro_consultas" role="dialog">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><b>Registrar Consulta</b></h4>
            </div>
            <div class="modal-body">
            <div class="col-lg-12">
                    <label for="">Paciente</label>
                    <select class="js-example-basic-single" name="state" id="cbm_paciente_consulta" style="width:100%;">       
                    </select><br><br>
                </div>
                <div class="col-lg-12">
                     <label for="">Descripcion</label>
                     <textarea name="" id="txt_descripcion" rows="5" class="form-control" style="resize:none">
                     </textarea>
                    </div> 
                    <div class="col-lg-12">
                     <label for="">Diagnostico</label>
                     <textarea name="" id="txt_diagnostico" rows="5" class="form-control" style="resize:none">
                     </textarea><br><br>
                    </div>          
                  </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="registrarConsulta()"><i class="fa fa-check"><b>&nbsp;Registrar</b></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
        </div>
    </div>
</form>
<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_editar_consultas" role="dialog">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><b>Editar Consulta</b></h4>
            </div>
            <div class="modal-body">
            <div class="col-lg-12">
                    <input type="text" id="txt_idconsulta">
                    <label for="">Paciente</label>
                    <input type="text" id="txt_pacienteEditar" readonly class="form-control">   
                </div>
                <div class="col-lg-12">
                     <label for="">Descripcion</label>
                     <textarea name="" id="txt_descripcionEditar" rows="5" class="form-control" style="resize:none">
                     </textarea>
                    </div> 
                    <div class="col-lg-12">
                     <label for="">Diagnostico</label>
                     <textarea name="" id="txt_diagnosticoEditar" rows="5" class="form-control" style="resize:none">
                     </textarea><br><br>
                    </div>          
                  </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="editarConsulta()"><i class="fa fa-check"><b>&nbsp;Registrar</b></i></button>
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

   listar_historial();
   
    
} );



</script>