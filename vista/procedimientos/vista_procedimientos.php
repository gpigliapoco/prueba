<script type="text/javascript" src="../js/procedimientos.js?rev=<?php echo time();?>"></script>
<div class="col-md-12">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
              <h3 class="box-title">BIENVENIDO A PROCEDIMIENTOS</h3>

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
            <table id="tabla_procedimientos" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Status</th>                        
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
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
    <div class="modal fade" id="modal_editar" role="dialog">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><b>Editar De Usuario</b></h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <input type="text" id="txtIdusuario" hidden> 
                    <label for="">Usuario</label>
                    <input type="text" class="form-control" id="txt_usuEditar" placeholder="Ingrese usuario" disabled><br>
                </div>  
                <div class="col-lg-12">
                    <label for="">Email</label>
                    <input type="text" class="form-control" id="txt_emailEditar" placeholder="Ingrese email"><br>
                    <label for="" id="emailOkEdit" style="color:red;"></label>
                    <input type="text" id="validar_emailEditar" hidden>
                </div>              
                <div class="col-lg-12">
                    <label for="">Sexo</label>
                    <select class="js-example-basic-single" name="state" id="cbm_sexo_editar" style="width:100%;">
                        <option value="m">MASCULINO</option>
                        <option value="f">FEMENINO</option>
                    </select><br><br>
                </div>
                <div class="col-lg-12">
                    <label for="">Rol</label>
                    <select class="js-example-basic-single" name="state" id="cbm_rol_editar" style="width:100%;">
                    </select><br><br>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="modificarUsuario()"><i class="fa fa-check"><b>&nbsp;Modificar</b></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
        </div>
    </div>
</form>
<script>
$(document).ready(function() {
    listar_procedimientos();
    
} );



</script>