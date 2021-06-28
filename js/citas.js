var table; //// para poder llamar al reload en otra funcion.

function listar_citas(){
	 table = $("#tabla_citas").DataTable({
	  "ordering":false,   
	  "bLengthChange":false,
	  "searching": { "regex": false },
	  "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
	  "pageLength": 10,
	  "destroy":true,
	  "async": false ,
	  "processing": true,
	  "ajax":{
		   url:"../controlador/cita/control_cita_listar.php",
		  type:'POST'
	  },
	  "columns":[
		  {"data":"idcita"},
		  {"data":"cita_n_ate"},
          {"data":"cita_fecha_registro"},
          {"data":"paciente"},
          {"data":"medico"},  
		  {"data":"cita_status",
			render:function(data,type,row){
				if(data=='activo'){
					return "<span class='label label-success'>"+data+"</span>";
				}else{
					return "<span class='label label-danger'>"+data+"</span>";
				}
			}},
			{"data":"es_status",
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
  

  document.getElementById("tabla_citas_filter").style.display="none";
  $('input.global_filter').on( 'keyup click', function () {
	   filterGlobal();
   } );
   $('input.column_filter').on( 'keyup click', function () {
	   filterColumn( $(this).parents('tr').attr('data-column') );
   });
 

}

function AbrirModalRegistro(){
	$("#modal_registro_citas").modal({backdrop:'static',keyboard:false});
	$("#modal_registro_citas").modal("show");
}

function comboEspecial(){
	$.ajax({
		url: "../controlador/medicos/control_combo_especial.php",
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
				cadena+="<option value='"+data[i].idespecialidad+"'>"+data[i].es_especialidad+"</option>";
				
			}
			$("#cbm_especial").html(cadena);
			var id=$("#cbm_especial").val();
			comboMedico(id);
			///$("#cbm_especialEditar").html(cadena);
		}
	})
}

function comboMedico(espe){
	$.ajax({
		url: "../controlador/cita/control_combo_medico.php",
		type: "POST",
		data:{
			espe:espe
		}

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
				cadena+="<option value='"+data[i].idmedico+"'>"+data[i].medico+"</option>";
			}
			$("#cbm_medico").html(cadena);
			///$("#cbm_especialEditar").html(cadena);
		}else{
			cadena+="<option value=0>no hay registros</option>";
			$("#cbm_medico").html(cadena);
		}
	})
}

function comboPaciente(){
	$.ajax({
		url: "../controlador/cita/control_combo_paciente.php",
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
			$("#cbm_paciente").html(cadena);
			///$("#cbm_especialEditar").html(cadena);
		}
	})
}
