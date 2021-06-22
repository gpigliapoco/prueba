var table; //// para poder llamar al reload en otra funcion.

function listar_especial(){
	 table = $("#tabla_especial").DataTable({
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
		  {"data":"idespecialidad"},
		  {"data":"especialidad"},
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
  

  document.getElementById("tabla_especial_filter").style.display="none";
  $('input.global_filter').on( 'keyup click', function () {
	   filterGlobal();
   } );
   $('input.column_filter').on( 'keyup click', function () {
	   filterColumn( $(this).parents('tr').attr('data-column') );
   });
 

}

function AbrirModalRegistro(){
	$("#modal_registro_especial").modal({backdrop:'static',keyboard:false});
	$("#modal_registro_especial").modal("show");
}

function registrarEspecial(){
	var nombre= $("#txt_nombre").val();
	var fecha= $("#txt_fecha").val();

	if(nombre.lenght==0 || fecha.lenght==0){
		return Swal.fire("Hay campos vacios","warning");
	}
		$.ajax({
			url: "../controlador/especialidad/control_especial_registrar.php",
			type: "POST",
			data: {
				nombre:nombre,
				fecha:fecha
			}
		}).done(function(resp){
			alert(resp);
		})

}

function modificarStatus(idespe,status){	
	
	$.ajax({
		url:"../controlador/especialidad/control_especial_modiStatus.php",
		type: "POST",
		data:{
			idespe:idespe,
			status:status
			
		}
	}).done(function(resp){
		alert(resp);
	   table.ajax.reload();
	})

}

$('#tabla_especial').on('click','.activar',function(){
	var data =table.row($(this).parents('tr')).data();
	alert(data.idespecialidad);////// funcion que tomas almacena todos los datos de una fila de la tabla y almacena en data.
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
            modificarStatus(data.idespecialidad,'ACTIVO');
        }
      })

})

$('#tabla_especial').on('click','.desactivar',function(){
	var data =table.row($(this).parents('tr')).data();
	alert(data.idespecialidad);////// funcion que tomas almacena todos los datos de una fila de la tabla y almacena en data.
	Swal.fire({
        title: 'Esta seguro de desactivar al especialidad?',
        text: "Una vez hecho esto el usuario  no tendra acceso al sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
      }).then((result) => {
        if (result.value) {
            modificarStatus(data.idespecialidad,'INACTIVO');
        }
      })

})