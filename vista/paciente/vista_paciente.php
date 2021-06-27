<script type="text/javascript" src="../js/paciente.js?rev=<?php echo time();?>"></script>
<div class="col-md-12">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
              <h3 class="box-title">BIENVENIDO A PACIENTE</h3>

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
            <table id="tabla_paciente" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>                        
                        <th>Sexo</th>
                        <th>Movil</th>                        
                        <th>documento</th>
                        <th>Direccion</th>
                        <th>Status</th>                        
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>                        
                        <th>Sexo</th>
                        <th>Movil</th>                        
                        <th>documento</th>
                        <th>Direccion</th>
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
    <div class="modal fade" id="modal_registro_paciente" role="dialog">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><b>Registrar Paciente</b></h4>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-lg-6">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" id="txt_nombre" placeholder="Ingrese nombre"><br>
                </div>  
                <div class="col-lg-6">
                    <label for="">Apellido</label>
                    <input type="text" class="form-control" id="txt_apellido" placeholder="Ingrese Apellido"><br>
                </div>     
                <div class="col-lg-6">
                    <label for="">direccion</label>
                    <input type="text" class="form-control" id="txt_direccion" placeholder="Ingrese Direccion"><br>
                </div>
                <div class="col-lg-6">
                    <label for="">Documento</label>
                    <input type="text" class="form-control" id="txt_dni" placeholder="Ingrese Documento"><br>
                </div>        
                <div class="col-lg-4">
                    <label for="">movil</label>
                    <input type="text" class="form-control" id="txt_movil" placeholder="Ingrese Movil"><br>
                </div> 
                <div class="col-lg-4">
                    <label for="">Sexo</label>
                    <select class="js-example-basic-single" name="state" id="cbm_sexo" style="width:100%;">
                        <option value="m">MASCULINO</option>
                        <option value="f">FEMENINO</option>
                    </select><br><br>
                </div>
                <div class="col-lg-4">
                    <label for="">Fecha Nacimiento</label>
                    <input type="date" class="form-control" id="txt_fecha"><br>
                </div>                  
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="registrar_paciente()"><i class="fa fa-check"><b>&nbsp;Registrar</b></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
        </div>
    </div>
</form>
<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_editar_medicos" role="dialog">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><b>Editar medico</b></h4>
            </div>
            <div class="modal-body">
            <div class="row">
                <input type="text" class="form-control" id="txtidmedico" placeholder="Ingrese procedimiento"><br>
                <div class="col-lg-6">  
                     <input type="text"  id="txtIdmedico" hidden>  
                    <label for="">Nombre</label>                   
                    <input type="text" class="form-control" id="txt_nombreEditar" placeholder="Ingrese nombre"><br>
                </div>  
                <div class="col-lg-6">
                    <label for="">Apellido</label>
                    <input type="text" class="form-control" id="txt_apellidoEditar" placeholder="Ingrese Apellido"><br>
                </div>     
                <div class="col-lg-6">
                    <label for="">direccion</label>
                    <input type="text" class="form-control" id="txt_direccionEditar" placeholder="Ingrese direccion"><br>
                </div>     
                <div class="col-lg-4">
                    <label for="">movil</label>
                    <input type="text" class="form-control" id="txt_movilEditar" placeholder="Ingrese movil"><br>
                </div> 
                <div class="col-lg-4">
                    <label for="">Sexo</label>
                    <select class="js-example-basic-single" name="state" id="cbm_sexoEditar" style="width:100%;">
                        <option value="m">MASCULINO</option>
                        <option value="f">FEMENINO</option>
                    </select><br><br>
                </div>
                <div class="col-lg-4">
                    <label for="">Fecha Nacimiento</label>
                    <input type="date" class="form-control" id="txt_fechaEditar" ><br>
                </div>   
                <div class="col-lg-4">
                    <label for="">Documento</label>
                    <input type="text" class="form-control" id="txt_dniEditar" placeholder="Ingrese dni"><br>
                </div>  
                <div class="col-lg-4">
                    <label for="">Colegiatura</label>
                    <input type="text" class="form-control" id="txt_coleEditar" placeholder="Ingrese colegiatura"><br>
                </div>  
                <div class="col-lg-4">
                    <label for="">especialidad</label>
                    <select class="js-example-basic-single" name="state" id="cbm_especialEditar" style="width:100%;">
                    </select><br><br>
                </div> 
                <div class="col-lg-12" style="text-align:center">
                    <b>Datos Del Usuario</b>
                </div> 
                <div class="col-lg-6">
                    <input type="text"  id="txtIdusu" hidden> 
                    <label for="">Usuario</label>
                    <input type="text" class="form-control" id="txt_usuEditar" placeholder="Ingrese usuario"><br>
                </div>   
                <div class="col-lg-6">
                    <label for="">Password</label>
                    <input type="text" class="form-control" id="txt_passEditar" placeholder="Ingrese pass"><br>
                </div>  
                <div class="col-lg-6">
                    <label for="">Rol</label>
                    <select class="js-example-basic-single" name="state" id="cbm_rolEditar" style="width:100%;">
                    </select><br><br>
                </div>
                <div class="col-lg-6">
                    <label for="">Email</label>
                    <input type="text" class="form-control" id="txt_emailEditar" placeholder="Ingrese email"><br>
                </div> 
                </div> 
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="editar_medico()"><i class="fa fa-check"><b>&nbsp;Registrar</b></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
        </div>
    </div>
</form>
<script>
$(document).ready(function() {
    listar_paciente();
    
   
} );



</script>