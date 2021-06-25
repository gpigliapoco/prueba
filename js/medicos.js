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

/* function listar(){
	$.ajax({
	  url:"../controlador/medicos/control_listar_medico.php",
	  type:'POST'
	}).done(function(resp){
		alert(resp);
		alert(resp.apellido);
		var data=JSON.parse(resp);
		alert(data);
		alert(data[0].sexo);
		
	})
} */

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

	if(nombre.length==0 || apellido.length==0 || direccion.length==0 || movil.length==0){
		return Swal.fire("llenar campos vacios","warning");
	}$.ajax({
			 url:"../controlador/usuario/controladorUsu.php",
			 type: "POST",
			 data:{
				 usu:usu,
				 pass:pass,
				 sexo:sexo,
				 rol:rol,
				 email:email
			 }
	}).done(function(resp){
		alert(resp);
		if(resp==1){
			$.ajax({
				url:"../controlador/medicos/control_registrar_medico.php",
				type: "POST",
				data:{
					nombre:nombre,
					apellido:apellido,
					direccion:direccion,
					movil:movil,
					sexo:sexo,
					fecha:fecha,
					dni:dni,
					cole:cole,
					especial:especial
				}
			}).done(function(resp){
				alert(resp);
				if(resp==1){
					$("#modal_registro_medicos").modal('hide');
				Swal.fire("Mensaje De Confirmacion","Datos correctamente, Nuevo Usuario Registrado","success")            
                .then ( ( value ) =>  {
                    
                    table.ajax.reload();
                }); 
				}else{
					return Swal.fire("No se puedo registar medico","warning");
				}
			})
		}else{
			return Swal.fire("No se puedo registar usuario","warning");
		}
		
	})
	
}

function limpiarRegistros(){
	$("#txt_nombre").val("");
	$("#txt_apellido").val("");
	$("#txt_direccion").val("");
	$("#txt_movil").val("");
	$("#cmb_sexo").val("");
	$("#txt_fecha").val("");
	$("#txt_dni").val("");
	$("#txt_cole").val("");
	$("#cbm_especial").val("");
	$("#txt_usu").val("");
	$("#txt_pass").val("");
	$("#cbm_rol").val("");
	$("#txt_email").val("");


}

$('#tabla_medicos').on('click','.editar',function(){
	var data =table.row($(this).parents('tr')).data();

	alert(data.medico);
	$("#modal_editar_medico").modal({backdrop:'static',keyboard:false});
	$("#modal_editar_medico").modal('show');
	$("#txtidmedico").val(data.idmedico); 
	$("#txt_nombreEditar").val(data.nombre);
	$("#txt_apellidoEditar").val(data.apellido);
	$("#txt_direccionEditar").val(data.direccion);
	$("#txt_movilEditar").val(data.movil);
	$("#cmb_sexoEditar").val(data.sexo).trigger("change");
	$("#txt_fechaEditar").val(data.fecha_nac);
	$("#txt_dniEditar").val(data.documento);
	$("#txt_coleEditar").val(data.colegiatura);
	$("#cbm_especialEditar").val(idespecialidad).trigger("change");
	$("#txt_usuEditar").val(data.nombre);
	$("#txt_passEditar").val("");
	$("#cbm_rolEditar").val("");
	$("#txt_emailEditar").val("");

})