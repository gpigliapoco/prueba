var table; //// para poder llamar al reload en otra funcion.

function listar_historial(){
		var fechaN=$("#txt_fechaN").val();
		var fechaF=$("#txt_fechaF").val();

	 table = $("#tabla_historial").DataTable({
	  "ordering":false,   
	  "bLengthChange":false,
	  "searching": { "regex": false },
	  "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
	  "pageLength": 10,
	  "destroy":true,
	  "async": false ,
	  "processing": true,
	  "ajax":{
		   url:"../controlador/historial/control_historial_listar.php",
		  type:'POST',
		  data: {
			  fechaN:fechaN,
			  fechaF:fechaF
		  }
	  },
	  "columns":[
		  {"data":"idfua"},
          {"data":"fua_fecha_registro"},
		  {"data":"pa_dni"},
		  {"data":"paciente"},		 
		  {"data":"medico"},
		  {"data":"con_diagnostico"},	 	 
		
		  
		  {"defaultContent":"<button style='font-size:13px;' type='button' class='desactivar btn btn-danger'><i class='fa fa-trash'></i></button>"}
	  ],

	  "language":idioma_espanol,
	  select: true
  });
  

  document.getElementById("tabla_historial_filter").style.display="none";
  $('input.global_filter').on( 'keyup click', function () {
	   filterGlobal();
   } );
   $('input.column_filter').on( 'keyup click', function () {
	   filterColumn( $(this).parents('tr').attr('data-column') );
   });
 

}

/////////////////tabla mantenimiento/////////////


var tableConsultas; //// para poder llamar al reload en otra funcion.

function listar_historialDia(){
		

	 tableConsultas = $("#tabla_Consultahistorial").DataTable({
	  "ordering":false,   
	  "bLengthChange":false,
	  "searching": { "regex": false },
	  "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
	  "pageLength": 10,
	  "destroy":true,
	  "async": false ,
	  "processing": true,
	  "ajax":{
		   url:"../controlador/historial/control_historialDia.php",
		  type:'POST',
		 
	  },
	  "columns":[
		  {"data":"idconsulta"},
          {"data":"con_fecha_registro"},
		  {"data":"idhistoria_clinica"},
		  {"data":"paciente"},
		  {"defaultContent":"<button style='font-size:13px;' type='button' class='enviar btn btn-success' title='enviar'><i class='fa fa-play-circle'></i>enviar</button>"}
	  ],

	  "language":idioma_espanol,
	  select: true
  });
  

  document.getElementById("tabla_Consultahistorial_filter").style.display="none";
  $('input.global_filter').on( 'keyup click', function () {
	   filterGlobal();
   } );
   $('input.column_filter').on( 'keyup click', function () {
	   filterColumn( $(this).parents('tr').attr('data-column') );
   });
 

}

function AbrirModalHistorial(){
	$("#modal_historialDia_consultas").modal({backdrop:'static',keyboard:false});
	$("#modal_historialDia_consultas").modal('show');
	listar_historialDia();
} 

$('#tabla_Consultahistorial').on('click','.enviar',function(){
	
	var data =tableConsultas.row($(this).parents('tr')).data();

	//alert(data.paciente);
	alert(data.idhistoria_clinica);
	$("#modal_historialDia_consultas").modal({backdrop:'static',keyboard:false});
	$("#modal_historialDia_consultas").modal('hide')
	$("#txt_codigo").val(data.idhistoria_clinica);	
	$("#txt_pacienteMante").val(data.paciente);
	$("#txt_descripcionMante").val(data.con_descripcion);
	$("#txt_diagnosticoMante").val(data.con_diagnostico);
	$("#txt_idConsulta").val(data.idconsulta);

	

})

function comboInsumos(){
	$.ajax({
		url: "../controlador/historial/control_combo_insumos.php",
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
				cadena+="<option value='"+data[i].idinsumos+"'>"+data[i].ins_nombre+"</option>";
			}
			$("#cbm_insumos").html(cadena);
			//$("#cbm_pacienteEditar").html(cadena);
		}
	})
}

function comboProcedimientos(){
	$.ajax({
		url: "../controlador/historial/control_combo_procedimientos.php",
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
				cadena+="<option value='"+data[i].idprocedimientos+"'>"+data[i].pro_nombre+"</option>";
			}
			$("#cbm_procedimientos").html(cadena);
			//$("#cbm_pacienteEditar").html(cadena);
		}
	})
}

function comboMedicamentos(){
	$.ajax({
		url: "../controlador/historial/control_combo_medicamentos.php",
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
				cadena+="<option value='"+data[i].idmedicamentos+"'>"+data[i].medi_nombre+"</option>";
			}
			$("#cbm_medicamento").html(cadena);
			//$("#cbm_pacienteEditar").html(cadena);
		}
	})
}

function agregarProcedimientos(){
	var id=$("#cbm_procedimientos").val();
	var procedi=$("#cbm_procedimientos option:selected").text();

	if(verificarID(id)){
		return Swal.fire("ya existe en la tabla","warning");
	}

	var agregarDatos="<tr>";
	 agregarDatos+= "<td for='id'>"+id+"</td>";
	 agregarDatos+= "<td>"+procedi+"</td>";
	 agregarDatos+= "<td><button class='btn btn-danger' onclick='remove(this)'><i class='fa fa-trash'></i></button></td>";
	 agregarDatos+= "</tr>";

	 $("#tbody_tabla_procedimientos").append(agregarDatos);
}

function verificarID(id){
	let idverificar=document.querySelectorAll('#tabla_procedimientos td[for="id"] '); /// captura los datos 
	return [].filter.call(idverificar, td=> td.textContent === id ).length===1; ///verifica si el id ya esta agregado en la tabla , para no agregar dos veces
}

function remove(t){
	var td= t.parentNode;
	var tr= td.parentNode;
	var table= tr.parentNode;
	table.removeChild(tr);
}