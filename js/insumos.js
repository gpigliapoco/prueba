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
		  {"data":"nombre"},
          {"data":"stock"},
          {"data":"fecha_registro"}, 
		  {"data":"status",
			render:function(data,type,row){
				if(data=='activo'){
					return "<span class='label label-success'>"+data+"</span>";
				}else{
					return "<span class='label label-danger'>"+data+"</span>";
				}
			}},
		  
		  {"defaultContent":"<button style='font-size:13px;' type='button' class='desactivar btn btn-danger'><i class='fa fa-trash'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success'><i class='fa fa-check'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"}
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
	var fecha=$("#txt_fecha").val();


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
				stock:stock,
				fecha:fecha
			}
		}).done(function(resp){
			if(resp==1){
				$("#modal_registro_insumos").modal('hide');
				return Swal.fire("Insumo Registrado","success")
				.then ( ( value ) =>  {
                    //limpiarRegistros();
                    table.ajax.reload(); /// sino esta este algorismo no refresca la tabla.
                }); 
			}
		})
		
	
}
function modificarStatus(idinsumos,status){	
	
	$.ajax({
		url:"../controlador/insumos/control_insumos_modificarStatus.php",
		type: "POST",
		data:{
			idinsumos:idinsumos,
			status:status
			
		}
	}).done(function(resp){
		alert(resp);
	   table.ajax.reload();
	})

}

$('#tabla_insumos').on('click','.activar',function(){
	var data =table.row($(this).parents('tr')).data();
	alert(data.idinsumos);////// funcion que tomas almacena todos los datos de una fila de la tabla y almacena en data.
	Swal.fire({
        title: 'Esta seguro de activar al usuario?',
        text: "Una vez hecho esto el usuario  tendra acceso al sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
      }).then((result) => {
        if (result.value) {
            modificarStatus(data.idinsumos,'ACTIVO');
        }
      })

})

$('#tabla_insumos').on('click','.desactivar',function(){
	var data =table.row($(this).parents('tr')).data();
	alert(data.idinsumos);////// funcion que tomas almacena todos los datos de una fila de la tabla y almacena en data.
	Swal.fire({
        title: 'Esta seguro de desactivar al usuario?',
        text: "Una vez hecho esto el usuario  no tendra acceso al sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
      }).then((result) => {
        if (result.value) {
            modificarStatus(data.idinsumos,'INACTIVO');
        }
      })

})
