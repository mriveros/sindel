<div id="modal_cita" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cita de <span id="title_cita"></span></h4>
      </div>
      <div class="modal-body" id="modal_body_cita">
          
          <div class="row">
              <div class="col-md-6">
                  <label for="">Fecha de Ingreso</label>
                  {{$personal->fecha_ingreso}}
              </div>
          </div>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- modal historia -->

<div id="modal_hitoria" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../control/reg_paciente_fast.php" method="post" accept-charset="utf-8">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Carga Rapida de Pacientes</h4>
      </div>
      <div class="modal-body" id="modal_body_cita">
          
          
                <div class="row">
                    <div class="col-md-6">
                        <label for="">CI Paciente</label>
                        <input type="number" name="ci_pacnt" id="ci_pacnt" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Nombre Paciente</label>
                        <input type="text" name="nom_pacnt" id="nom_pacnt" class="form-control" placeholder="Nombre Paciente">
                    </div>
                </div><br>
                
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Apellido Paciente</label>
                        <input type="text" name="apel_pacnt" id="apel_pacnt" class="form-control" placeholder="Nombre Paciente">
                    </div>
                </div><br>
                
                 <div class="row">
                    <div class="col-md-6">
                        <label for="">Sexo</label>
                        <select class="form-control" name="sexo_pacnt" id="sexo_pacnt">
                                <option value="Masculino" >Masculino</option>
                                <option value="Femenino" >Femenino</option>
                        </select>
                    </div>
                </div><br>
                
                <div class="row">
                    <div class="col-md-6">
                        <label>Fecha de Nacimiento:</label>
                        <input name="fn_pacnt" id="fn_pacnt" class="form-control" type="datetime" required="true">
                    </div>
                </div><br>
                
                <div class="row">
                    <div class="col-md-6">
                        <label>Direccion:</label>
                            <input title="Direccion del Paciente" type="text" name="dir_pacnt" id="dir_pacnt" class="form-control" placeholder="Ingrese Aqui" required>
                    </div>
                </div>
      </div>
      <div class="modal-footer">
        <input type="submit" name="" class="btn btn-primary" value="Guardar">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
       </form>
    </div>
  </div>
</div>


<script>
$(document).ready(function() {
            $("select").select2();
            $("#form_paciente_2").validate({
                rules: {
                    nom_pacnt : {
                            required: true,
                            minlength: 2
                    },
                    apel_pacnt : {
                            required: true,
                            minlength: 2
                    },
                    sexo_pacnt : {
                            required: true,
                    },
                    fn_pacnt : {
                            required: true,
                            
                    },
                    dir_pacnt : {
                            required: true,
                    },
                    mail_pacnt : {
                            required: true,
                            email: true
                    },
                    tlf_pacnt : {
                            required: true,
                            number: true,
                            minlength: 6,
                            maxlength: 10,
                    },
                },
                messages: {
                    nom_pacnt:{                            
                            required: 'el campo es requerido',
                            minlength: 'minimo 2 caracteres'
                    },
                    apel_pacnt:{                            
                            required: 'el campo es requerido',
                            minlength: 'minimo 2 caracteres'
                    },
                    sexo_pacnt:{                            
                            required: 'el campo es requerido',
                    },
                    fn_pacnt:{                            
                            required: 'el campo es requerido',
                            
                    },
                    dir_pacnt:{                            
                            required: 'el campo es requerido',
                    },
                    mail_pacnt:{                            
                            required: 'el campo es requerido',
                             email: 'debe ser un correo'
                    },
                    tlf_pacnt:{                            
                            required: 'el campo es requerido',
                            number: 'solo numeros',
                            minlength: 'minimo 6 numeros',
                            maxlength:'maximo 10 numeros',
                    },
                },
            });

            Calendar.setup({
                            inputField : "fn_pacnt",
                            ifFormat   : "%d-%m-%Y",
                            //button     : "Image1"
            });
            $("#fn_pacnt").keypress(function(e) {
                return false;
            });
});
</script>
<style type="text/css">
    
#from_user label.error {
        margin-left: 10px;
        width: auto;
        display: inline;
    }

    .error {
        text-decoration-color: red;
        color: red;
    } 
</style>