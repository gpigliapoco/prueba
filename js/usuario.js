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
		dataType:"JSON",
		data:{
			usu:usu,
			pass:pass,
		}	
	}).done(function(resp){
		alert(resp);
	})
}