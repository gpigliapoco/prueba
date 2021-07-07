var table; //// para poder llamar al reload en otra funcion.

function listar_consultas(){
		var fechaN=$("#txt_fechaN").val();
		var fechaF=$("#txt_fechaF").val();

	 table = $("#tabla_consultas").DataTable({
	  "ordering":false,   
	  "bLengthChange":false,
	  "searching": { "regex": false },
	  "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
	  "pageLength": 10,
	  "destroy":true,
	  "async": false ,
	  "processing": true,
	  "ajax":{
		   url:"../controlador/consultas/control_consultas_listar.php",
		  type:'POST',
		  data: {
			  fechaN:fechaN,
			  fechaF:fechaF
		  }
	  },
	  "columns":[
		  {"data":"idconsulta"},
		  {"data":"pa_dni"},
		  {"data":"paciente"},
		  {"data":"con_fecha_registro"},	
		  {"data":"medico"},
		  {"data":"es_especialidad"},	 	 
		  {"data":"con_status",
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
  

  document.getElementById("tabla_consultas_filter").style.display="none";
  $('input.global_filter').on( 'keyup click', function () {
	   filterGlobal();
   } );
   $('input.column_filter').on( 'keyup click', function () {
	   filterColumn( $(this).parents('tr').attr('data-column') );
   });
 

}

function comboPacienteConsulta(){
	$.ajax({
		url: "../controlador/consultas/control_combo_paciente_consulta.php",
		type: "POST",
	}).done(function(resp){
	//	alert(resp);  // para ver que datos trae
		var data=JSON.parse(resp);
		var cadena="";
	/* 	 alert(data);
		alert(data[0].rol);
		for(var i=0;i < data.length;i++){
			alert(data[i].rol);			// prueba de recorrido de datos.
		}  */
		if(data.length>0){
			for(var i=0;i < data.length;i++){
				cadena+="<option value='"+data[i].idpaciente+"'>"+data[i].paciente+"</option>";
			}
			$("#cbm_paciente_consulta").html(cadena);
			//$("#cbm_pacienteEditar").html(cadena);
		}
	})
}



function AbrirModalRegistro(){
	$("#modal_registro_consultas").modal({backdrop:'static',keyboard:false});
	$("#modal_registro_consultas").modal('show');
} 

function registrarConsulta(){
	var idPaciente= $("#cbm_paciente").val();
	var diagnostico= $("#txt_diagnostico").val();
	var descripcion= $("#txt_descripcion").val();
	var idCita=

	if(idMedico.lenght==0 || idPaciente.lenght==0){
		return Swal.fire("Hay campos vacios","warning");
	}
		$.ajax({
			url: "../controlador/cita/control_cita_registrar.php",
			type: "POST",
			data: {
				idMedico:idMedico,
				idPaciente:idPaciente,
				descripcion:descripcion
			}
		}).done(function(resp){
			alert(resp);
			if(resp>0){
				$("#modal_registro_citas").modal("hide");
				Swal.fire("Mensaje De Confirmacion","Cita registrada","success");
				table.ajax.reload();
				limpiarRegistros();

			}
			else{
				Swal.fire("Mensaje De Confirmacion","no se puede registrar cita","warning");
			}
		})

}