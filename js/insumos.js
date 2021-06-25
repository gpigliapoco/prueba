var table; //// para poder llamar al reload en otra funcion.

function listar_insumos(){
	 table = $("#tabla_insumos").DataTable({
	  "ordering":false,   
	  "bLengthChange":false,
	  "searching": { "regex": false },
	  "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
	  "pageLength": 10,
	  "destroy":true,
	  "async": false ,
	  "processing": true,
	  "ajax":{
		   url:"../controlador/insumos/control_insumos_listar.php",
		  type:'POST'
	  },
	  "columns":[
		  {"data":"idinsumos"},
		  {"data":"ins_nombre"},
          {"data":"ins_stock"},
          {"data":"ins_fecha_registro"}, 
		  {"data":"ins_status",
			render:function(data,type,row){
				if(data=='activo'){
					return "<span class='label label-success'>"+data+"</span>";
				}else{
					return "<span class='label label-danger'>"+data+"</span>";
				}
			}},
		  
		  {"defaultContent":"</i></button>&nbsp;<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"}
	  ],

	  "language":idioma_espanol,
	  select: true
  });
  

  document.getElementById("tabla_insumos_filter").style.display="none";
  $('input.global_filter').on( 'keyup click', function () {
	   filterGlobal();
   } );
   $('input.column_filter').on( 'keyup click', function () {
	   filterColumn( $(this).parents('tr').attr('data-column') );
   });
 

}

function AbrirModalRegistro(){
	$("#modal_registro_insumos").modal({backdrop:'static',keyboard:false});
	$("#modal_registro_insumos").modal('show');
}  

function registrarInsumos(){
	
	var nombre=$("#txt_insumo").val();
	var stock=$("#txt_stock").val();
	

	if(nombre.lenght==0){
		return Swal.fire("Hay campos vacios","warning");
	}
	if(stock.lenght==0){
		return Swal.fire("Stock no puede ser 0","warning");
	}
		$.ajax({
			url:"../controlador/insumos/control_insumos_registrar.php",
			type:"POST",
			data:{
				nombre:nombre,
				stock:stock				
			}
		}).done(function(resp){
			if(resp==1){
				$("#modal_registro_insumos").modal('hide');
				return Swal.fire("Insumo Registrado","success")
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

$('#tabla_insumos').on('click','.editar',function(){
	var data =table.row($(this).parents('tr')).data();

	alert(data.idinsumos);
	$("#modal_editar_insumos").modal({backdrop:'static',keyboard:false});
	$("#modal_editar_insumos").modal('show');
	$("#txtIdinsumos").val(data.idinsumos);  //// tare los datos de la tabla y los agrega en los input
	$("#txt_nombreEditar").val(data.ins_nombre);
	$("#txt_stockEditar").val(data.ins_stock);
	$("#cbm_statusEditar").val(data.ins_status).trigger("change");

})

function modificarinsumos(){
	
	var idinsumos=$("#txtIdinsumos").val();	
	var nombre=$("#txt_nombreEditar").val();
	var stock=$("#txt_stockEditar").val();
	var status=$("#cbm_statusEditar").val();
	
		
		$.ajax({
			 url:"../controlador/insumos/control_insumos_modificar.php",
			 type: "POST",
			 data:{
				 idinsumos:idinsumos,
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
				$("#modal_editar_insumos").modal('hide');

			}
			
		 })
	
}


