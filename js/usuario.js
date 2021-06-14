function registrarUsuario(){
	
	var usu=$("#txt_usu").val();
	var pass=$("#txt_con1").val();
	var pass1=$("#txt_con2").val();
	var sexo=$("#cbm_sexo").val();
	var rol=$("#cbm_rol").val();
	if (usu.length==0 || pass.length==0 || pass1.length==0 || sexo.length==0 || rol.length==0) {
		return Swal.fire("llenar campos vacios","warning");
	 	}
		 if(pass.length != pass1.length) {
			return Swal.fire("las claves no coinciden","warning");
		 }
		 $.ajax({
			 url:"../controlador/controladorUsu.php",
			 type: "POST",
			 data:{
				 usu:usu,
				 pass:pass,
				 sexo:sexo,
				 rol:rol,
			 }
		 }).done(function(resp){
			if(resp==1){
				$("#modal_registro").modal('hide');
				Swal.fire("Mensaje De Confirmacion","Datos correctamente, Nuevo Usuario Registrado","success")            
                .then ( ( value ) =>  {
                    
                    table.ajax.reload();
                }); 
			}
		 })
		
	

	
	

}

function limpiarRegistros(){
	$("#txt_usu").val("");
	$("#txt_con").val("");

}

function verificarUsuario(){
	var usu=$("#txt_usu").val();
	var pass=$("#txt_con").val();
	if(usu.length == 0 || pass.length == 0){
		return Swal.fire("llenar campos vacios","warning");
	}$.ajax({
		url:"../controlador/control_verifica_user.php",
		type:"POST",
		daType:"JSON",  //// no anda con esto manda objeto
		data:{
			usu:usu,
			pass:pass,
		}	
	}).done(function(resp){
		if(resp==0){
			Swal.fire("usuario y pass incorrecta","error");
		}else{
			alert(resp);
			var data=JSON.parse(resp);////devuelve objeto
			alert(data);
			alert(data[0].nombre);
			$.ajax({
				url:"../controlador/control_crear_sesion.php",
				type:"POST",
				
				data:{
					iduser:data[0].idusuarios,
					usu:data[0].nombre,
				}	

			}).done(function(resp){
				let timerInterval
                Swal.fire({
                title: 'BIENVENIDO AL SISTEMA',
                html: 'Usted sera redireccionado en <b></b> milisegundos.',
                timer: 2000,
                timerProgressBar: true,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                    const content = Swal.getContent()
                    if (content) {
                        const b = content.querySelector('b')
                        if (b) {
                        b.textContent = Swal.getTimerLeft()
                        }
                    }
                    }, 100)
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    location.reload(); //// lo mas importante es esto
                }
})	

			})
			
		}
	})
}

var table; //// para poder llamar al reload en otra funcion.

function listar_usuario(){
	table = $("#tabla_usuario").DataTable({
	  "ordering":false,   
	  "bLengthChange":false,
	  "searching": { "regex": false },
	  "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
	  "pageLength": 10,
	  "destroy":true,
	  "async": false ,
	  "processing": true,
	  "ajax":{
		   url:"../controlador/control_listar_usu.php",
		  type:'POST'
	  },
	  "columns":[
		  {"data":"idusuarios"},
		  {"data":"nombre"},
		  {"data":"sexo",
		  	render: function (data, type, row ) {
				if(data=='M'){
					return "MASCULINO";                   
				}else{
					return "FEMINO";                 
				}
			}},
		  {"data":"idrol_usuario",
		  render: function (data, type, row ) {
			if(data=='1'){
				return "administrador";                   
			}else{
				return "mantenimiento";                 
				}
		    }},		 
		  {"data":"status"},
		  
		  {"defaultContent":"<button style='font-size:13px;' type='button' class='desactivar btn btn-danger'><i class='fa fa-trash'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success'><i class='fa fa-check'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"}
	  ],

	  "language":idioma_espanol,
	  select: true
  });
  

  document.getElementById("tabla_usuario_filter").style.display="none";
  $('input.global_filter').on( 'keyup click', function () {
	   filterGlobal();
   } );
   $('input.column_filter').on( 'keyup click', function () {
	   filterColumn( $(this).parents('tr').attr('data-column') );
   });
 

}

$('#tabla_usuario').on('click','.activar',function(){
	var data =table.row($(this).parents('tr')).data();
	alert(data.idusuarios);////// funcion que tomas almacena todos los datos de una fila de la tabla y almacena en data.
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
            modificarStatus(data.idusuarios,'ACTIVO');
        }
      })

})

$('#tabla_usuario').on('click','.desactivar',function(){
	var data =table.row($(this).parents('tr')).data();
	alert(data.idusuarios);////// funcion que tomas almacena todos los datos de una fila de la tabla y almacena en data.
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
            modificarStatus(data.idusuarios,'INACTIVO');
        }
      })

})

$('#tabla_usuario').on('click','.editar',function(){
	var data =table.row($(this).parents('tr')).data();

	alert(data.sexo);
	$("#modal_editar").modal({backdrop:'static',keyboard:false});
	$("#modal_editar").modal('show');
	$("#txtIdusuario").val(data.idusuarios);
	$("#txt_usuEditar").val(data.nombre);
	$("#cbm_sexo_editar").val(data.sexo).trigger("change");
	$("#cbm_rol_editar").val(data.idrol_usuario);

})

function modificarStatus(idUsu,status){	
	
		 $.ajax({
			 url:"../controlador/control_modificarStatus.php",
			 type: "POST",
			 data:{
				 idUsu:idUsu,
				 status:status
				 
			 }
		 }).done(function(resp){
			 alert(resp);
			table.ajax.reload();
		 })

}


 function AbrirModalRegistro(){
	$("#modal_registro").modal({backdrop:'static',keyboard:false});
	$("#modal_registro").modal('show');
} 
function comboRol(){
	$.ajax({
		url: "../controlador/control_combo_rol.php",
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
		}
	})
}