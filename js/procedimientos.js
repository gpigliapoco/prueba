var table; //// para poder llamar al reload en otra funcion.

function listar_procedimientos(){
	 table = $("#tabla_procedimientos").DataTable({
	  "ordering":false,   
	  "bLengthChange":false,
	  "searching": { "regex": false },
	  "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
	  "pageLength": 10,
	  "destroy":true,
	  "async": false ,
	  "processing": true,
	  "ajax":{
		   url:"../controlador/procedimientos/control_proced_listar.php",
		  type:'POST'
	  },
	  "columns":[
		  {"data":"idprocedimientos"},
		  {"data":"nombre"},
		 	 
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
  

  document.getElementById("tabla_procedimientos_filter").style.display="none";
  $('input.global_filter').on( 'keyup click', function () {
	   filterGlobal();
   } );
   $('input.column_filter').on( 'keyup click', function () {
	   filterColumn( $(this).parents('tr').attr('data-column') );
   });
 

}

function AbrirModalRegistro(){
	$("#modal_registro_procedimientos").modal({backdrop:'static',keyboard:false});
	$("#modal_registro_procedimientos").modal('show');
}  

function registrarProcedimiento(){
	
	var nombre=$("#txt_nombre").val();

	if(nombre.lenght==0){
		return Swal.fire("Hay campos vacios","warning");
	}
		$.ajax({
			url:"../controlador/procedimientos/control_registrar_proced.php",
			type:"POST",
			data:{
				nombre:nombre
			}
		}).done(function(resp){
			alert(resp);
		})
	
	
	
}