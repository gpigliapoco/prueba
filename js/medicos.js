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
		  {"data":"doc_sexo",
		  	render: function (data, type, row ) {
				if(data=='m'){
					return "MASCULINO";                   
				}else{
					return "FEMENINO";                 
				}
			}},
		  {"data":"doc_movil"},		 	
		  {"data":"doc_dni"},		 
          {"data":"doc_cole"},	
          {"data":"es_especialidad"},	
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
			$("#cbm_rolEditar").html(cadena);
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
				cadena+="<option value='"+data[i].idespecialidad+"'>"+data[i].es_especialidad+"</option>";
			}
			$("#cbm_especial").html(cadena);
			$("#cbm_especialEditar").html(cadena);
		}
	})
}
function registrar_medico(){
	var nombre=$("#txt_nombre").val();
	var apellido=$("#txt_apellido").val();
	var direccion=$("#txt_direccion").val();
	var movil=$("#txt_movil").val();
	var sexo=$("#cbm_sexo").val();
	var fecha=$("#txt_fecha").val();
	var dni=$("#txt_dni").val();
	var cole=$("#txt_cole").val();
	var especial=$("#cbm_especial").val();
	var usu=$("#txt_usu").val();
	var pass=$("#txt_pass").val();
	var rol=$("#cbm_rol").val();
	var email=$("#txt_email").val();

	alert(sexo);
	alert(fecha);

	if(nombre.length==0 || apellido.length==0 || direccion.length==0 || movil.length==0 || sexo.length==0 || fecha.length==0){
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
					limpiarRegistros();
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
	$("#cbm_sexo").val("");
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

	alert(data.idespecialidad);
	$("#modal_editar_medicos").modal({backdrop:'static',keyboard:false});
	$("#modal_editar_medicos").modal('show');
	$("#txtIdmedico").val(data.idmedico); 
	$("#txt_nombreEditar").val(data.doc_nombre);
	$("#txt_apellidoEditar").val(data.doc_apellido);
	$("#txt_direccionEditar").val(data.doc_direccion);
	$("#txt_movilEditar").val(data.doc_movil);
	$("#cbm_sexoEditar").val(data.doc_sexo).trigger("change");
	$("#txt_fechaEditar").val(data.doc_fecha_nac);
	$("#txt_dniEditar").val(data.doc_dni);
	$("#txt_coleEditar").val(data.doc_cole);
	$("#cbm_especialEditar").val(data.idespecialidad).trigger("change");
	$("#txt_usuEditar").val(data.usu_nombre);
	$("#txt_passEditar").val(data.usu_contra);
	$("#cbm_rolEditar").val(data.idrol_usuario).trigger("change");
	$("#txt_emailEditar").val(data.usu_email);

})

function editar_medico(){
	var nombre=$("#txt_nombreEditar").val();
	var apellido=$("#txt_apellidoEditar").val();
	var direccion=$("#txt_direccionEditar").val();
	var movil=$("#txt_movilEditar").val();
	var sexo=$("#cbm_sexoEditar").val();
	var fecha=$("#txt_fechaEditar").val();
	var dni=$("#txt_dniEditar").val();
	var cole=$("#txt_coleEditar").val();
	var especial=$("#cbm_especialEditar").val();
	var usu=$("#txt_usuEditar").val();
	var pass=$("#txt_passEditar").val();
	var rol=$("#cbm_rolEditar").val();
	var email=$("#txt_emailEditar").val();
	var idmedico=$("#txtIdmedico").val();
	var idUsuario=$("#txtIdusu").val();

	if(nombre.length==0 || apellido.length==0 || direccion.length==0 || movil.length==0){
		return Swal.fire("llenar campos vacios","warning");
	}$.ajax({
			 url:"../controlador/usuario/controlUsuModificar.php",
			 type: "POST",
			 data:{
				 idUsuario:idUsuario,
				 usu:usu,				 
				 sexo:sexo,
				 rol:rol,
				 email:email
			 }
	}).done(function(resp){
		alert(resp);
		if(resp==1){
			$.ajax({
				url:"../controlador/medicos/control_modificar_medico.php",
				type: "POST",
				data:{
					idmedico:idmedico,
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
					limpiarRegistros();
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