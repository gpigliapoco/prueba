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
		
		  
		  {"defaultContent":"<button style='font-size:13px;' type='button' class='desactivar btn btn-danger'><i class='fa fa-trash'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success'><i class='fa fa-check'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"}
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

		  {"defaultContent":"</i></button>&nbsp;<button style='font-size:13px;' type='button' class='enviar btn btn-primary'><i class='fa fa-edit'></i></button>"}
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

$("#tabla_Consultahistorial").on('click','.enviar',function(){
	//var data =tableConsultas.row($(this).parents('tr')).data();

	alert("funciona");
	
})