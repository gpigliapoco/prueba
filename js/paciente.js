var table; //// para poder llamar al reload en otra funcion.

function listar_paciente(){
	table = $("#tabla_paciente").DataTable({
	  "ordering":false,   
	  "bLengthChange":false,
	  "searching": { "regex": false },
	  "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
	  "pageLength": 10,
	  "destroy":true,
	  "async": false ,
	  "processing": true,
	  "ajax":{
		   url:"../controlador/paciente/control_listar_paciente.php",
		  type:'POST'
	  },
	  "columns":[
		  {"data":"idpaciente"},
		  {"data":"paciente"},
		  {"data":"pa_sexo",
		  	render: function (data, type, row ) {
				if(data=='m'){
					return "MASCULINO";                   
				}else{
					return "FEMENINO";                 
				}
			}},
		  {"data":"pa_movil"},		 	
		  {"data":"pa_dni"},		 
          {"data":"pa_direccion"},	
          {"data":"pa_status",
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

  
  

  document.getElementById("tabla_paciente_filter").style.display="none";
  $('input.global_filter').on( 'keyup click', function () {
	   filterGlobal();
   } );
   $('input.column_filter').on( 'keyup click', function () {
	   filterColumn( $(this).parents('tr').attr('data-column') );
   });
 

}

$('#tabla_paciente').on('click','.activar',function(){
	var data =table.row($(this).parents('tr')).data();
	alert(data.idpaciente);////// funcion que tomas almacena todos los datos de una fila de la tabla y almacena en data.
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
            modificarStatus(data.idpaciente,'ACTIVO');
        }
      })

})

$('#tabla_paciente').on('click','.desactivar',function(){
	var data =table.row($(this).parents('tr')).data();
	alert(data.idpaciente);////// funcion que tomas almacena todos los datos de una fila de la tabla y almacena en data.
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
            modificarStatus(data.idpaciente,'INACTIVO');
        }
      })

})

function modificarStatus(idpaciente,status){	
	
	$.ajax({
		url:"../controlador/paciente/control_paciente_status.php",
		type: "POST",
		data:{
			idpaciente:idpaciente,
			status:status
			
		}
	}).done(function(resp){
		alert(resp);
	   table.ajax.reload();
	})

}