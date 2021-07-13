<script type="text/javascript" src="../js/historial.js?rev=<?php echo time();?>"></script>
<div class="col-md-12">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
              <h3 class="box-title">Consultas medicas mantenimiento</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
              <!-- /.box-tools -->
        </div>
            <!-- /.box-header -->
           
            <div class="box-body">
                <div class="col-lg-2">
                    <label for="">Codigo Historial</label>
                    <input type="text" id="txt_codigo" class="form-control">
                </div>
                <div class="col-lg-8">
                    <label for="">Paciente</label>
                    <input type="text" id="txt_pacienteMante" class="form-control">
                </div>
                <div class="col-lg-2">
                    <label for="">&nbsp;</label><br>
                    <button class="btn btn-success" onclick="AbrirModalHistorial()" ><i class="fa fa-search"></i>Buscar Consultas</button>
                </div>
                <div class="col-lg-6">
                    <label for="">Descripcion cita</label>
                    <textarea name="" id="txt_descripcionMante" cols="30" rows="3" class="form-control"></textarea>
                </div>
                <div class="col-lg-6">
                    <label for="">Diagnostico de Consulta</label>
                    <textarea name="" id="txt_diagnosticoMante" cols="30" rows="3" class="form-control"></textarea>
                </div>
                <input type="text" id="txt_idConsulta" hidden>
                <br>
                <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Procedimientos</a></li>
              <li><a href="#tab_2" data-toggle="tab">Medicamentos</a></li>
              <li><a href="#tab_3" data-toggle="tab">Insumos</a></li>
              
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="row">
                      <div class="col-lg-10">
                      <label for="">Procedimientos</label>
                        <select class="js-example-basic-single" name="state" id="cbm_procedimientos" style="width:100%;"> 
                        
                        </select><br><br>
                      </div>
                      <div class="col-lg-2">
                        <label>&nbsp;</label>
                        <button class="btn btn-primary" style="width:100%" onclick="agregarProcedimiento()"><i class="fa fa-plus-square"></i>&nbsp;agregar</button>

                      </div>
                      <div class="col-lg-12 table-responsive"><br>
                        <table id="tabla_procedimientos" style="width:100%" class="table">
                          <thead bgcolor="black" style="color:#ffffff;">
                            <th>ID</th>
                            <th>PROCEDIMIENTO</th>
                            <th>ACCION</th>
                          </thead> 
                          <tbody id="tbody_tabla_procedimientos">

                          </tbody>

                        </table>

                      </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
              <div class="row">
                      <div class="col-lg-6">
                      <label for="">Insumos</label>
                        <select class="js-example-basic-single" name="state" id="cbm_insumos" style="width:100%;"> 
                        
                        </select><br><br>
                      </div>
                      <div class="col-lg-2">
                        <label for="">Stock actual</label>
                        <input class="text" class="form-control" id="txt_INstock">
                      </div>
                      <div class="col-lg-2">
                        <label for="">Cantidad agregar</label>
                        <input class="text" class="form-control" id="txt_INcantidad">
                      </div>

                      <div class="col-lg-2">
                        <label>&nbsp;</label>
                        <button class="btn btn-primary" style="width:100%"><i class="fa fa-plus-square"></i>&nbsp;agregar</button>

                      </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
              <div class="row">
                      <div class="col-lg-6">
                      <label for="">Medicamentos</label>
                        <select class="js-example-basic-single" name="state" id="cbm_medicamento" style="width:100%;"> 
                        
                        </select><br><br>
                      </div>
                      <div class="col-lg-2">
                        <label for="">Stock actual</label>
                        <input class="text" class="form-control" id="txt_MEstock">
                      </div>
                      <div class="col-lg-2">
                        <label for="">Cantidad agregar</label>
                        <input class="text" class="form-control" id="txt_MEcantidad">
                      </div>

                      <div class="col-lg-2">
                        <label>&nbsp;</label>
                        <button class="btn btn-primary" style="width:100%"><i class="fa fa-plus-square"></i>&nbsp;agregar</button>

                      </div>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
            </div>
            <!-- /.box-body -->
    </div>
          <!-- /.box -->
</div>
<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_historialDia_consultas" role="dialog">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><b>Listado de Consulta</b></h4>
            </div>
                <div class="modal-body">
                <table id="tabla_Consultahistorial" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Codigo Historial</th>
                        <th>Paciente</th>                                                                        
                        <th>Accion</th>
                    </tr>
                </thead>
                
            </table>        
                </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
        </div>
    </div>
</form>


<script>
$(document).ready(function() {
  comboMedicamentos();
  comboInsumos();
  comboProcedimientos();
    
} );



</script>