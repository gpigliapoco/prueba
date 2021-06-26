<script type="text/javascript" src="../js/medicos.js?rev=<?php echo time();?>"></script>
<div class="col-md-12">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
              <h3 class="box-title">BIENVENIDO A MEDICOS</h3>

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
            <table id="tabla_medicos" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Medico</th>                        
                        <th>Sexo</th>
                        <th>Movil</th>                        
                        <th>documento</th>
                        <th>colegiatura</th>
                        <th>especialidad</th>                        
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Medico</th>                        
                        <th>Sexo</th>
                        <th>Movil</th>                        
                        <th>documento</th>
                        <th>colegiatura</th>
                        <th>especialidad</th>                        
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
    <div class="modal fade" id="modal_registro_medicos" role="dialog">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><b>Registrar medico</b></h4>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-lg-6">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" id="txt_nombre" placeholder="Ingrese procedimiento"><br>
                </div>  
                <div class="col-lg-6">
                    <label for="">Apellido</label>
                    <input type="text" class="form-control" id="txt_apellido" placeholder="Ingrese procedimiento"><br>
                </div>     
                <div class="col-lg-6">
                    <label for="">direccion</label>
                    <input type="text" class="form-control" id="txt_direccion" placeholder="Ingrese procedimiento"><br>
                </div>     
                <div class="col-lg-4">
                    <label for="">movil</label>
                    <input type="text" class="form-control" id="txt_movil" placeholder="Ingrese procedimiento"><br>
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
                    <input type="date" class="form-control" id="txt_fecha" placeholder="Ingrese procedimiento"><br>
                </div>   
                <div class="col-lg-4">
                    <label for="">Documento</label>
                    <input type="text" class="form-control" id="txt_dni" placeholder="Ingrese procedimiento"><br>
                </div>  
                <div class="col-lg-4">
                    <label for="">Colegiatura</label>
                    <input type="text" class="form-control" id="txt_cole" placeholder="Ingrese procedimiento"><br>
                </div>  
                <div class="col-lg-4">
                    <label for="">especialidad</label>
                    <select class="js-example-basic-single" name="state" id="cbm_especial" style="width:100%;">
                    </select><br><br>
                </div> 
                <div class="col-lg-12" style="text-align:center">
                    <b>Datos Del Usuario</b>
                </div> 
                <div class="col-lg-6">
                    <label for="">Usuario</label>
                    <input type="text" class="form-control" id="txt_usu" placeholder="Ingrese procedimiento"><br>
                </div>   
                <div class="col-lg-6">
                    <label for="">Password</label>
                    <input type="text" class="form-control" id="txt_pass" placeholder="Ingrese procedimiento"><br>
                </div>  
                <div class="col-lg-6">
                    <label for="">Rol</label>
                    <select class="js-example-basic-single" name="state" id="cbm_rol" style="width:100%;">
                    </select><br><br>
                </div>
                <div class="col-lg-6">
                    <label for="">Email</label>
                    <input type="text" class="form-control" id="txt_email" placeholder="Ingrese procedimiento"><br>
                </div> 
                </div> 
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="registrar_medico()"><i class="fa fa-check"><b>&nbsp;Registrar</b></i></button>
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
            <h4 class="modal-title"><b>Registrar medico</b></h4>
            </div>
            <div class="modal-body">
            <div class="row">
                <input type="text" class="form-control" id="txtidmedico" placeholder="Ingrese procedimiento"><br>
                <div class="col-lg-6">  
                     <input type="text"  id="txtIdmedico" hidden>  
                    <label for="">Nombre</label>                   
                    <input type="text" class="form-control" id="txt_nombreEditar" placeholder="Ingrese procedimiento"><br>
                </div>  
                <div class="col-lg-6">
                    <label for="">Apellido</label>
                    <input type="text" class="form-control" id="txt_apellidoEditar" placeholder="Ingrese procedimiento"><br>
                </div>     
                <div class="col-lg-6">
                    <label for="">direccion</label>
                    <input type="text" class="form-control" id="txt_direccionEditar" placeholder="Ingrese procedimiento"><br>
                </div>     
                <div class="col-lg-4">
                    <label for="">movil</label>
                    <input type="text" class="form-control" id="txt_movilEditar" placeholder="Ingrese procedimiento"><br>
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
                    <input type="date" class="form-control" id="txt_fechaEditar" placeholder="Ingrese procedimiento"><br>
                </div>   
                <div class="col-lg-4">
                    <label for="">Documento</label>
                    <input type="text" class="form-control" id="txt_dniEditar" placeholder="Ingrese procedimiento"><br>
                </div>  
                <div class="col-lg-4">
                    <label for="">Colegiatura</label>
                    <input type="text" class="form-control" id="txt_coleEditar" placeholder="Ingrese procedimiento"><br>
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
                    <input type="text" class="form-control" id="txt_usuEditar" placeholder="Ingrese procedimiento"><br>
                </div>   
                <div class="col-lg-6">
                    <label for="">Password</label>
                    <input type="text" class="form-control" id="txt_passEditar" placeholder="Ingrese procedimiento"><br>
                </div>  
                <div class="col-lg-6">
                    <label for="">Rol</label>
                    <select class="js-example-basic-single" name="state" id="cbm_rolEditar" style="width:100%;">
                    </select><br><br>
                </div>
                <div class="col-lg-6">
                    <label for="">Email</label>
                    <input type="text" class="form-control" id="txt_emailEditar" placeholder="Ingrese procedimiento"><br>
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
    listar_medicos();
    comboRol();
    comboEspecial();
    listar();
} );



</script>