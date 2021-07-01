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

function abrirModalRegistro(){
	$("#modal_registro_paciente").modal({backdrop:'static',keyboard:false});
	$("#modal_registro_paciente").modal("show");
}




function registrar_paciente(){
	var nombre=$("#txt_nombre").val();
	var apellido=$("#txt_apellido").val();
	var direccion=$("#txt_direccion").val();
	var movil=$("#txt_movil").val();
	var sexo=$("#cbm_sexo").val();
	var fecha=$("#txt_fecha").val();
	var dni=$("#txt_dni").val();

	
	if(nombre.length==0 || apellido.length==0 || direccion.length==0 || movil.length==0 || sexo.length==0 || fecha.length==0){
		return Swal.fire("llenar campos vacios","warning");
	}$.ajax({
			 url:"../controlador/paciente/control_registrar_paciente.php",
			 type: "POST",
			 data:{
				nombre:nombre,
				apellido:apellido,
				direccion:direccion,
				movil:movil,
				sexo:sexo,
				fecha:fecha,
				dni:dni

			 }
	}).done(function(resp){
		alert(resp);
		if(resp==1){
			$("#modal_registro_paciente").modal('hide');
		Swal.fire("Mensaje De Confirmacion","Datos correctamente, Nuevo Usuario Registrado","success")            
		.then ( ( value ) =>  {
			
			table.ajax.reload();
			limpiarRegistros();
		}); 
		}else{
			return Swal.fire("No se puedo registar medico","warning");
		}
	})
	
}

function limpiarRegistros(){
	$("#txt_nombre").val("");
	$("#txt_apellido").val("");
	$("#txt_direccion").val("");
	$("#txt_movil").val("");
	$("#cbm_sexo").val("");
	$("#txt_fecha").val("");
	$("#txt_dni").val("");
	


}

$('#tabla_paciente').on('click','.editar',function(){
	var data =table.row($(this).parents('tr')).data();

	alert(data.idpaciente);
	$("#modal_registro_paciente").modal({backdrop:'static',keyboard:false});
	$("#modal_registro_paciente").modal('show');
	$("#txtIdpaciente").val(data.idpaciente); 
	$("#txt_nombreEditar").val(data.pa_nombre);
	$("#txt_apellidoEditar").val(data.pa_apellido);
	$("#txt_direccionEditar").val(data.pa_direccion);
	$("#txt_movilEditar").val(data.pa_movil);
	$("#cbm_sexoEditar").val(data.pa_sexo).trigger("change");
	$("#txt_fechaEditar").val(data.pa_fecha_nac);
	$("#txt_dniEditar").val(data.pa_dni);
	

})