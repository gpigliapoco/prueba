<script type="text/javascript" src="../js/citas.js?rev=<?php echo time();?>"></script>
<div class="col-md-12">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
              <h3 class="box-title">BIENVENIDO A ESPECIALIDADES </h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
              <!-- /.box-tools -->
        </div>
            <!-- /.box-header -->
            <div class="form-group">
                <div class="col-lg-10">
                <div class="input-group">
                        <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    </div>
                </div>
                <div class="col-lg-2">
                <button class="btn btn-danger" style="width:100%" onclick="AbrirModalRegistro()"><i class="glyphicon glyphicon-plus"></i>Nuevo Registro</button>
                </div>
            </div>
            <div class="box-body">
            <table id="tabla_citas" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Numero</th>
                        <th>Fecha registro</th>
                        <th>Paciente</th>    
                        <th>Medico</th> 
                        <th>Status</th>                     
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Numero</th>
                        <th>Fecha registro</th>
                        <th>Paciente</th>    
                        <th>Medico</th> 
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
    <div class="modal fade" id="modal_registro_citas" role="dialog">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><b>Registrar citas</b></h4>
            <div class="row">
            </div>
                <div class="col-lg-12">
                    <label for="">Paciente</label>
                    <select class="js-example-basic-single" name="state" id="cbm_paciente" style="width:100%;">       
                    </select><br><br>
                </div>
                <div class="col-lg-6">
                    <label for="">Especialidad</label>
                    <select class="js-example-basic-single" name="state" id="cbm_especial" style="width:100%;">       
                    </select><br><br>
                </div>
                <div class="col-lg-6">
                    <label for="">Medico</label>
                    <select class="js-example-basic-single" name="state" id="cbm_medico" style="width:100%;">       
                    </select><br><br>
                </div>
                     <div class="col-lg-12">
                     <label for="">Descripcion</label>
                     <textarea name="" id="txt_descripcion" rows="5" class="form-control" style="resize:none">
                     </textarea>
                </div>
                </div> 
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="registrarCita()"><i class="fa fa-check"><b>&nbsp;Registrar</b></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
        </div>
    </div>
</form>
<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_editar_citas" role="dialog">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><b>Editar citas</b></h4>
            <div class="row">
            </div>
                <div class="col-lg-12">
                    <label for="">Paciente</label>
                    <input type="text" id="txt_idCita">
                    <select class="js-example-basic-single" name="state" id="cbm_pacienteEditar" style="width:100%;">       
                    </select><br><br>
                </div>
                <div class="col-lg-6">
                    <label for="">Especialidad</label>
                    <select class="js-example-basic-single" name="state" id="cbm_especialEditar" style="width:100%;">       
                    </select><br><br>
                </div>
                <div class="col-lg-6">
                    <label for="">Medico</label>
                    <select class="js-example-basic-single" name="state" id="cbm_medicoEditar" style="width:100%;">       
                    </select><br><br>
                </div>
                     <div class="col-lg-12">
                     <label for="">Descripcion</label>
                     <textarea name="" id="txt_descripcionEditar" rows="5" class="form-control" style="resize:none">
                     </textarea>
                </div>
                </div> 
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="editarCita()"><i class="fa fa-check"><b>&nbsp;Registrar</b></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {
    listar_citas();
    comboEspecial();
    comboPaciente();
    comboPacienteEditar();
	comboEspecialEditar();
    $("#cbm_especial").change(function(){ ////funcion para que cambie el combobox de medico
        var id=$("#cbm_especial").val();
        comboMedico(id);
    })
    $("#cbm_especialEditar").change(function(){ ////funcion para que cambie el combobox de medico
        var id=$("#cbm_especialEditar").val();
        comboMedicoEditar(id);
    })
  
} );



</script>