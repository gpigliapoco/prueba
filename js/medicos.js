var table; //// para poder llamar al reload en otra funcion.

function listar_medicos(){
	table = $("#tabla_medicos").DataTable({
	  "ordering":false,   
	  "bLengthChange":false,
	  "searching": { "regex": false },
	  "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
	  "pageLength": 10,
	  "destroy":true,
	  "async": false ,
	  "processing": true,
	  "ajax":{
		   url:"../controlador/medicos/control_listar_medico.php",
		  type:'POST'
	  },
	  "columns":[
		  {"data":"idmedico"},
		  {"data":"medico"},
		  {"data":"sexo",
		  	render: function (data, type, row ) {
				if(data=='m'){
					return "MASCULINO";                   
				}else{
					return "FEMINO";                 
				}
			}},
		  {"data":"movil"},		 	
		  {"data":"documento"},		 
          {"data":"colegiatura"},	
          {"data":"especialidad"},	
		  {"defaultContent":"<button style='font-size:13px;' type='button' class='desactivar btn btn-danger'><i class='fa fa-trash'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success'><i class='fa fa-check'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"}
		  
		  
	  ],

	  "language":idioma_espanol,
	  select: true
  });
  

  document.getElementById("tabla_medicos_filter").style.display="none";
  $('input.global_filter').on( 'keyup click', function () {
	   filterGlobal();
   } );
   $('input.column_filter').on( 'keyup click', function () {
	   filterColumn( $(this).parents('tr').attr('data-column') );
   });
 

}

function AbrirModalRegistro(){
	$("#modal_registro_medicos").modal({backdrop:'static',keyboard:false});
	$("#modal_registro_medicos").modal('show');
} 

function comboRol(){
	$.ajax({
		url: "../controlador/usuario/control_combo_rol.php",
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
				cadena+="<option value='"+data[i].idrol_usuario+"'>"+data[i].rol+"</option>";
			}
			$("#cbm_rol").html(cadena);
			$("#cbm_rol_editar").html(cadena);
		}
	})
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
				cadena+="<option value='"+data[i].idespecialidad+"'>"+data[i].especialidad+"</option>";
			}
			$("#cbm_especial").html(cadena);
			//$("#cbm_especial_editar").html(cadena);
		}
	})
}
function registrar_medico(){
	var nombre=$("#txt_nombre").val();
	var apellido=$("#txt_apellido").val();
	var direccion=$("#txt_direccion").val();
	var movil=$("#txt_movil").val();
	var sexo=$("#cmb_sexo").val();
	var fecha=$("#txt_fecha").val();
	var dni=$("#txt_dni").val();
	var cole=$("#txt_cole").val();
	var especial=$("#cbm_especial").val();
	var usu=$("#txt_usu").val();
	var pass=$("#txt_pass").val();
	var rol=$("#cbm_rol").val();
	var email=$("#txt_email").val();
	
}