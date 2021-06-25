var table; //// para poder llamar al reload en otra funcion.

function listar_medicamento(){
	 table = $("#tabla_medicamento").DataTable({
	  "ordering":false,   
	  "bLengthChange":false,
	  "searching": { "regex": false },
	  "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
	  "pageLength": 10,
	  "destroy":true,
	  "async": false ,
	  "processing": true,
	  "ajax":{
		   url:"../controlador/medicamento/control_listar_medicamento.php",
		  type:'POST'
	  },
	  "columns":[
		  {"data":"idmedicamentos"},
		  {"data":"medi_nombre"},
          {"data":"medi_stock"},
          {"data":"medi_fecha_registro"}, 
		  {"data":"medi_status",
			render:function(data,type,row){
				if(data=='activo'){
					return "<span class='label label-success'>"+data+"</span>";
				}else{
					return "<span class='label label-danger'>"+data+"</span>";
				}
			}},
			{"data":"medi_status",
			render:function(data,type,row){
				if(data=='activo'){
					return "<button style='font-size:13px;' type='button' class='desactivar btn btn-danger'><i class='fa fa-trash'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success' disabled><i class='fa fa-check'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>";
				}else{
					return "<button style='font-size:13px;' type='button' class='desactivar btn btn-danger' disabled><i class='fa fa-trash'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success'><i class='fa fa-check'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>";
				}
			}},		  
		  
	  ],

	  "language":idioma_espanol,
	  select: true
  });
  

  document.getElementById("tabla_medicamento_filter").style.display="none";
  $('input.global_filter').on( 'keyup click', function () {
	   filterGlobal();
   } );
   $('input.column_filter').on( 'keyup click', function () {
	   filterColumn( $(this).parents('tr').attr('data-column') );
   });
 

}

function AbrirModalRegistro(){
	$("#modal_registro_medicamento").modal({backdrop:'static',keyboard:false});
	$("#modal_registro_medicamento").modal("show");
}

function AbrirModalRegistroEditar(){
	$("#modal_editar_medicamento").modal({backdrop:'static',keyboard:false});
	$("#modal_editar_medicamento").modal('show');
}  

function registrarInsumos(){
	
	var nombre=$("#txt_medicamento").val();
	var stock=$("#txt_stock").val();
	

	if(nombre.lenght==0){
		return Swal.fire("Hay campos vacios","warning");
	}
	if(stock.lenght==0){
		return Swal.fire("Stock no puede ser 0","warning");
	}
		$.ajax({
			url:"../controlador/medicamento/control_registrar_medicamento.php",
			type:"POST",
			data:{
				nombre:nombre,
				stock:stock				
			}
		}).done(function(resp){
			if(resp==1){
				$("#modal_registro_medicamento").modal('hide');
				return Swal.fire("Medicamento Registrado","success")
				.then ( ( value ) =>  {
                    limpiarRegistros();
                    table.ajax.reload(); /// sino esta este algorismo no refresca la tabla.
                }); 
			}
		})
		
	
}

function limpiarRegistros(){
	$("#txt_nombre").val();
	$("#txt_stock").val();
}

$('#tabla_medicamento').on('click','.editar',function(){
	var data =table.row($(this).parents('tr')).data();

	alert(data.idmedicamentos);
	$("#modal_editar_medicamento").modal({backdrop:'static',keyboard:false});
	$("#modal_editar_medicamento").modal('show');
	$("#txtIdmedicamento").val(data.idmedicamentos);  //// tare los datos de la tabla y los agrega en los input
	$("#txt_nombreEditar").val(data.medi_nombre);
	$("#txt_stockEditar").val(data.medi_stock);
	$("#cbm_statusEditar").val(data.medi_status).trigger("change");

})

function modificarmedicamentos(){
	
	var idmedicamentos=$("#txtIdmedicamentos").val();	
	var nombre=$("#txt_nombreEditar").val();
	var stock=$("#txt_stockEditar").val();
	var status=$("#cbm_statusEditar").val();
	
		
		$.ajax({
			 url:"../controlador/medicamento/control_editar_medicamento.php",
			 type: "POST",
			 data:{
				 idmedicamentos:idmedicamentos,
				 nombre:nombre,
				 stock:stock,
				 status:status
			 }
		 }).done(function(resp){
			// alert(resp);
			//var data=JSON.parse(resp);
			//alert(data);
			if(resp==1){
				table.ajax.reload();
				return Swal.fire("insumo modificado","success");
				$("#modal_editar_medicamento").modal('hide');

			}
			
		 })
	
}
