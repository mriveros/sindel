 $(document).ready(function () {
 	
 	$("#tipo").click(function(){

 			var tipo = $("#tipo").val();
 			// console.log("hola");
 			if (tipo == "externo")
 	 		{
 	 			$("#formulario").load('cliente_visitante.php', function(resp) { });
 	 		}; 

 	 		if (tipo == "interno")
 	 		{
 	 			$("#formulario").load('cliente_investigador.php', function(resp) { });
 	 		}; 
 	});

 	$("#estado").click(function(){
 		console.log('hola ' + $("#estado").val());
 		$("#municipio").load('ajax_municipio.php', { id_estado : $("#estado").val() } , function(resp) { });
 	});
 	

 });