function verificarUsuario1(){
	
	var usu=$("#txt_usu").val();
	var pass=$("#txt_con").val();

	if (usu.length == 0 || pass.length==0) {
		return Swal.fire("estan vacios algun campo","warning");
	}$.ajax({
		url:"../controlador/controladorUsu.php",
        type:'POST',
        
        data:{
            usu:usu,
            pass:pass,
          
	 }
	}).done(function(resp){
		alert("funciona"+resp);
		alert("   dale");
		limpiarRegistros();
	});

	

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
					iduser:data[0].id,
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

function listar_usuario(){
	var table = $("#tabla_usuario").DataTable({
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
		  {"data":"nombre"},
		  {"data":"contra"},
		  {"data":"sexo"},
		  {"data":"rol",
			   render: function (data, type, row ) {////define el sexoo
				   if(data=='M'){
					   return "MASCULINO";                   
				   }else{
					   return "FEMINO";                 
				   }
			   }
		  }, 
		  {"data":"usu_estatus",
			render: function (data, type, row ) {
			  if(data=='ACTIVO'){
				  return "<span class='label label-success'>"+data+"</span>";                   
			  }else{
				return "<span class='label label-danger'>"+data+"</span>";                 
			  }
			}
		  },  
		  {"defaultContent":"<button style='font-size:13px;' type='button' class='desactivar btn btn-danger'><i class='fa fa-trash'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success'><i class='fa fa-check'></i></button>"}
	  ],

	  "language":idioma_espanol,
	  select: true
  });
 

}