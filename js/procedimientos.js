var table; //// para poder llamar al reload en otra funcion.

function listar_especial(){
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
		   url:"../controlador/especialidad/control_especial_listar.php",
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

function limpiarRegistros(){
	$("#txt_nombre").val();
}

function AbrirModalRegistro(){
	$("#modal_registro_procedimientos").modal({backdrop:'static',keyboard:false});
	$("#modal_registro_procedimientos").modal('show');
}  

function AbrirModalRegistroEditar(){
	$("#modal_editar_procedimientos").modal({backdrop:'static',keyboard:false});
	$("#modal_editar_procedimientos").modal('show');
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
			if(resp==1){
				$("#modal_registro_procedimientos").modal('hide');
				return Swal.fire("Procedimiento Registrado","success")
				.then ( ( value ) =>  {
                    limpiarRegistros();
                    table.ajax.reload(); /// sino esta este algorismo no refresca la tabla.
                }); 
			}
		})
		
	
}

function modificarStatus(idproc,status){	
	
	$.ajax({
		url:"../controlador/procedimientos/control_proced_modiStatus.php",
		type: "POST",
		data:{
			idproc:idproc,
			status:status
			
		}
	}).done(function(resp){
		alert(resp);
	   table.ajax.reload();
	})

}

$('#tabla_procedimientos').on('click','.activar',function(){
	var data =table.row($(this).parents('tr')).data();
	alert(data.idprocedimientos);////// funcion que tomas almacena todos los datos de una fila de la tabla y almacena en data.
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
            modificarStatus(data.idprocedimientos,'ACTIVO');
        }
      })

})

$('#tabla_procedimientos').on('click','.desactivar',function(){
	var data =table.row($(this).parents('tr')).data();
	alert(data.idprocedimientos);////// funcion que tomas almacena todos los datos de una fila de la tabla y almacena en data.
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
            modificarStatus(data.idprocedimientos,'INACTIVO');
        }
      })

})

$('#tabla_procedimientos').on('click','.editar',function(){
	var data =table.row($(this).parents('tr')).data();

	alert(data.idprocedimientos);
	$("#modal_editar_procedimientos").modal({backdrop:'static',keyboard:false});
	$("#modal_editar_procedimientos").modal('show');
	$("#txtIdprocedimiento").val(data.idprocedimientos);  //// tare los datos de la tabla y los agrega en los input
	$("#txt_nombreEditar").val(data.nombre);
	

})

function modificarprocedimientos(){
	
	var idproc=$("#txtIdprocedimiento").val();	
	var nombre=$("#txt_nombreEditar").val();
	
	var validarEmail=$("#validar_emailEditar").val();
	if (idproc.length==0 ||  nombre.length==0 ) {
		return Swal.fire("llenar campos vacios","warning");
	 	}
		
		$.ajax({
			 url:"../controlador/procedimientos/control_modificar_proced.php",
			 type: "POST",
			 data:{
				 idproc:idproc,
				 nombre:nombre,
			 }
		 }).done(function(resp){
			 alert(resp);
			 var data=JSON.parse(resp);
			 alert(data);
			if(resp>0){
				return Swal.fire("procedimiento ya existe","warning");
			}else{
				return Swal.fire("procedimiento se puede modificar","warning");
			}
			
		 })
	
}
