<script type="text/javascript" src="../js/insumos.js?rev=<?php echo time();?>"></script>
<div class="col-md-12">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
              <h3 class="box-title">BIENVENIDO A INSUMOS</h3>

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
            <table id="tabla_insumos" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Stock</th>
                        <th>Fecha Registro</th>
                        <th>Status</th>                        
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Stock</th>
                        <th>Fecha Registro</th>
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
    <div class="modal fade" id="modal_registro_insumos" role="dialog">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><b>Registrar Insumos</b></h4>
            </div>         
            <div class="modal-body">
                <div class="col-lg-12">
                    <label for="">Insumo</label>
                    <input type="text" class="form-control" id="txt_insumo" placeholder="ingrese insumo" maxlenght="5" onkeypress="return soloLetras(event)"  ><br>
                </div>               
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <label for="">Stock</label>
                    <input type="text" class="form-control" id="txt_stock" placeholder="ingrese stock" maxlenght="5" onkeypress="return soloNumeros(event)" ><br>
                </div>               
            </div>           
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="registrarInsumos()"><i class="fa fa-check"><b>&nbsp;Registrar</b></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
        </div>
    </div>
</form>
<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_editar_insumos" role="dialog">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><b>Editar insumos</b></h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <input type="text" id="txtIdinsumos" hidden> 
                    <label for="">Procedimiento</label>
                    <input type="text" class="form-control" id="txt_nombreEditar" placeholder="Ingrese insumos" ><br>
                </div>              
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <label for="">Stock</label>
                    <input type="text" class="form-control" id="txt_stockEditar" placeholder="ingrese stock" maxlenght="5" onkeypress="return soloNumeros(event)" ><br>
                </div>               
            </div>  
            <div class="col-lg-12">
                    <label for="">Status</label>
                    <select class="js-example-basic-single" name="state" id="cbm_statusEditar" style="width:100%;">
                        <option value="activo">ACTIVO</option>
                        <option value="inactivo">INACTIVO</option>
                    </select><br><br>
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
    listar_insumos();
    $("#modal_registro_insumos").on('shown.bs.modal',function(){
        $("#txt_insumo").focus();  
    })
    
} );



</script>