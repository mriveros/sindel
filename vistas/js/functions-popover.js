 // registrarCliente();
        // notificacion en el input
        $(document).ready(function (){
            $('#codigo_equipo').popover({
                'placemenet': 'right',
                'html' : true,
                'trigger' : 'hover',
                'content' : '<ul><li>Ingrese Codigo</li><li>Ejemplo: PC1</li></ul>',
                'title' : 'Ingrese Codigo Equipo'

            });


            $('#sistema_operativo').popover({
                'placemenet': 'right',
                'html' : true,
                'trigger' : 'focus',
                'content' : '<ul><li>Debian, Ubuntu, Linux mint</li><li>Ejemplo: Debian Whezy</li></ul>',
                'title' : 'Ingrese Sistema Operativo'

            });

            $('#tipo_sistema').popover({
                'placemenet': 'right',
                'html' : true,
                'trigger' : 'focus',
                'content' : '<ul><li>32 0 64</li><li>Ejemplo: 64 bit</li></ul>',
                'title' : 'Ingrese Arquitectura del Sistema Operativo'

            });

            $('#procesador').popover({
                'placemenet': 'right',
                'html' : true,
                'trigger' : 'focus',
                'content' : '<ul><li>Marca Modelo Frecuencia</li><li>Ejemplo: Intel I3-2330 2.20Ghz</li></ul>',
                'title' : 'Ingrese Tipo Procesador'

            });

            $('#memoria').popover({
                'placemenet': 'right',
                'html' : true,
                'trigger' : 'focus',
                'content' : '<ul><li>Cantidad Marca Capacidad Tipo Frecuencia</li><li>Ejemplo: 1 kingston 4Gb DDR3 2.20Ghz</li></ul>',
                'title' : 'Ingrese Tipo Memoria'

            });

                $('#dd').popover({
                'placemenet': 'right',
                'html' : true,
                'trigger' : 'focus',
                'content' : '<ul><li>Marca Capacidad Tipo</li><li>Ejemplo:Maxtor 500Gb sata</li></ul>',
                'title' : 'Ingrese Tipo Disco Duro'

            });

                 $('#usuario').popover({
                'placemenet': 'right',
                'html' : true,
                'trigger' : 'focus',
                'content' : '<ul><li>Debe ser un nombre unico que lo identifique</li></ul>',
                'title' : 'Ingrese Nombre de Usuario'

            });



                $('#contra').popover({
                'placemenet': 'right',
                'html' : true,
                'trigger' : 'focus',
                'content' : '<ul><li>La clave debe contener letras, numeros, caracter especial</li><li>Minimo 7 caracteres de rango</li></ul>',
                'title' : 'Ingrese Su Clave'

            });

                $('#contra2').popover({
                'placemenet': 'right',
                'html' : true,
                'trigger' : 'focus',
                'content' : '<ul><li>La clave debe ser igual a la anterior</li><li>Minimo 8 caracteres de rango</li></ul>',
                'title' : 'Vuelva a Ingresar Su Clave'

            });

                
        });