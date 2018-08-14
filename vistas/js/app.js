// ========================================================================
//  select2
// ========================================================================
$(function() {
    $('select').select2();
});

// ========================================================================
//  DataTable
// ========================================================================
$(function() {
    $(".dataTable").DataTable( {
            "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
            }
    } );
});

// ========================================================================
//  Eventos Modulo Citas
// ========================================================================
$(function() {

    $(".ver_cita").click(function(e) {
        e.preventDefault();
        $("#modal_cita").modal();
        $("#title_cita").text($(this).data('title'));
        var id_cita = $(this).data('id');
        $.ajax({
                        url: "buscar_cita.php",
                        type : 'POST',
                        data: { id_cita : id_cita },
                        success:
                            function (data) {                                   
                                $("#modal_body_cita").html(data);
                                                              
                            }
        });
    });

});


// ========================================================================
//  Eventos Modulo Pacientes
// ========================================================================
$(function() {

    $("#buscar_paciente").click(function(e) {
        e.preventDefault();
        var cedula_paciente = $("#ci_pacnt").val();
        if (cedula_paciente == '') {
            alert("El campo cedula no debe estar vacio");
            $("#ci_pacnt").focus()
        }else{

            $.ajax({
                    url: "form_pacientes.php",
                    type : 'POST',
                    data: { cedula_paciente : cedula_paciente },
                    success:
                        function (data) {                                   
                            $("#form_paciente").html(data);                               
                        }
            });
        }
        
    });

});



// ========================================================================
//  Eventos Modulo Pacientes
// ========================================================================
$(function() {

    $("#buscar_cita").click(function(e) {
        e.preventDefault();
        var cedula_paciente = $("#ci_pacnt").val();
        if (cedula_paciente == '') {
            alert("El campo cedula no debe estar vacio");
            $("#ci_pacnt").focus()
        }else{

            $.ajax({
                    url: "form_citas.php",
                    type : 'POST',
                    data: { cedula_paciente : cedula_paciente },
                    success:
                        function (data) {                                   
                            $("#form_cita").html(data);                               
                        }
            });
        }
        
    });

});






 // Calendar.setup(
 //                                            {
 //                                          inputField : "fecha_cita",
 //                                          ifFormat   : "%Y/%m/%d",
 //                                          //button     : "Image1"
 //                                            }
 //                                          );


    //     inputField : 'fn_medic',
    //     ifFormat : '%Y/%m/%d',
        
    //     align : 'Bl',
    //     singleClick : true,
    //   disableFunc: function(date) {
    //       var now= new Date();
    //     if(date.getFullYear()<now.getFullYear())
    //     {
    //         return true;
    //     }
    //     if(date.getFullYear()==now.getFullYear())
    //     {
    //         if(date.getMonth()<now.getMonth())
    //         {
    //             return true;
    //         }
    //     }
    //     if(date.getMonth()==now.getMonth())
    //     {
    //         if(date.getDate()<now.getDate())
    //         {
    //             return true;
    //         }
    //     }
    // }


