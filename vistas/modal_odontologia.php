<div id="modal_cita" class="modal fade" role="dialog">
  <div class="modal-dialog">
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
      <form action="terminar_cita.php" method="post" accept-charset="utf-8">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">HISTORIA CLINICA</h4>
      </div>
      <div class="modal-body" id="modal_body_cita">
          
          
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Enfermedad actual</label>
                        <input type="text" name="enfermedad_actual" id="enfermedad_actual" class="form-control" placeholder="Fiebre">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Diagnósticos</label>
                        <textarea name="diagnostico" id="diagnostico" class="form-control" placeholder=""></textarea>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Comentarios</label>
                        <textarea name="comentarios" id="comentarios" class="form-control" placeholder=""></textarea>
                    </div>
                </div><br>
                <fieldset>
                  <legend>Antecedentes</legend>
                  <div class="row">
                    <div class="col-md-6">
                        <label for="">Personales</label>
                        <textarea name="antecedentes_personales" id="antecedentes_personales" class="form-control" placeholder="Niega alergia a medicamentos, Diabetes"></textarea>
                    </div>
                  </div><br>

                  <div class="row">
                    <div class="col-md-6">
                        <label for="">Quirúrgicos</label>
                        <textarea name="antecedentes_quirurgicos" id="antecedentes_quirurgicos" class="form-control" placeholder=""></textarea>
                    </div>
                  </div><br>

                  <div class="row">
                    <div class="col-md-6">
                        <label for="">Familiares</label>
                        <textarea name="antecedentes_familiares" id="antecedentes_familiares" class="form-control" placeholder=""></textarea>
                    </div>
                  </div>
                </fieldset>
                  <br>
                <fieldset>
                  <legend>Hábitos Psicobiológicos</legend>
                
                  <div class="row">
                    <div class="col-md-6">
                        <label for="">Hábitos</label>
                        <textarea name="habitos" id="habitos" class="form-control" placeholder=""></textarea>
                    </div>
                  </div>
                </fieldset>  
                
         
          
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id_cita" id="id_cita">
        <input type="hidden" name="ci_pacnt" id="ci_pacnt" value="">
        <input type="submit" name="" class="btn btn-primary" value="Guardar">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
       </form>
    </div>
  </div>
</div>

