function verificarUsuario(){
	
	var usu=$("#txt_usu").val();
	var pass=$("#txt_con").val();

	if (usu.length == 0 || pass.length==0) {
		return Swal.fire("estan vacios algun campo","warning");
	}$.ajax({
		url:"../controlador/controladorUsu.php",
        type:'POST',
        dataType: "json",
        data:{
            usu:usu,
            pass:pass,
            
	 }
	}).done(function(resp){
		alert("funciona")
	});

	

}