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
				if(data=='pendiente'){
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
		//alert(resp);  // para ver que datos trae
		var data=JSON.parse(resp);
		var cadena="";
	 	// alert(data);
		//alert(data[0].idcita);
		//for(var i=0;i < data.length;i++){
	//		alert(data[i].rol);			// prueba de recorrido de datos.
	//	}  
		if(data.length>0){
			for(var i=0;i < data.length;i++){
				cadena+="<option value='"+data[i].idcita+"'>"+data[i].paciente+"</option>";
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
	var idCita= $("#cbm_paciente_consulta").val();
	var diagnostico= $("#txt_diagnostico").val();
	var descripcion= $("#txt_descripcion").val();
	
		
		$.ajax({
			url: "../controlador/consultas/control_registrar_consulta.php",
			type: "POST",
			data: {
				idCita:idCita,
				diagnostico:diagnostico,
				descripcion:descripcion
				
			}
		}).done(function(resp){
			alert(resp);
			if(resp>0){
				$("#modal_registro_consultas").modal("hide");
				Swal.fire("Mensaje De Confirmacion","Consulta registrada","success");
				table.ajax.reload();
				//limpiarRegistros();

			}
			else{
				Swal.fire("Mensaje De Confirmacion","no se puede registrar consulta","warning");
			}
		})

} 

$("#tabla_consultas").on('click','.editar',function(){
	var data =table.row($(this).parents('tr')).data();

	//alert(data.idpaciente);
	$("#modal_editar_consultas").modal({backdrop:'static',keyboard:false});
	$("#modal_editar_consultas").modal('show')
	$("#txt_idconsulta").val(data.idconsulta);	
	$("#txt_pacienteEditar").val(data.paciente);
	$("#txt_descripcionEditar").val(data.con_descripcion);
	$("#txt_diagnosticoEditar").val(data.con_diagnostico);
	
})

function editarConsulta(){
	var idconsulta= $("#txt_idconsulta").val();
	var diagnostico= $("#txt_diagnosticoEditar").val();
	var descripcion= $("#txt_descripcionEditar").val();
		
		$.ajax({
			url: "../controlador/consultas/control_editar_consulta.php",
			type: "POST",
			data: {
				idconsulta:idconsulta,
				diagnostico:diagnostico,
				descripcion:descripcion
			}
		}).done(function(resp){
			alert(resp);
			if(resp>0){
				$("#modal_editar_consultas").modal("hide");
				Swal.fire("Mensaje De Confirmacion","Consulta editada","success");
				table.ajax.reload();
				//limpiarRegistros();

			}
			else{
				Swal.fire("Mensaje De Confirmacion","no se puede registrar consulta","warning");
			}
		})

} 