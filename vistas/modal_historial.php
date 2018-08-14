
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
      <form  accept-charset="utf-8">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">DETALLE DE LA CITA</h4>
      </div>
      <div class="modal-body" id="modal_body_cita">
          <div class="row">
                    <div class="col-md-6">
                        <label for="">Enfermedad actual</label>
                      <input name="enfermedad_actual" id="enfermedad_actual" class="form-control" type="text" readonly>
                    </div>
                </div>
                <br>
               
          <br>
            <div class="row">
                <div class="col-md-6">
                    PA<input name="pa" width="10px" id="pa" class="form-control" type="number" readonly>
                    FC<input name="fc" id="fc" class="form-control" type="number" readonly>
                </div>
                <div class="col-md-6">
                    EF<input name="ef" id="ef" class="form-control" type="number" readonly >
                    HR<input name="hr" id="hr" class="form-control" type="number" readonly>
                </div>
            </div>
          <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Diagnósticos</label>
                        <textarea name="diagnostico" id="diagnostico" class="form-control" placeholder="" readonly></textarea>
                    </div>
                     <div class="col-md-6">
                        <label for="">Tratamiento</label>
                        <textarea name="tratamiento" id="tratamiento" class="form-control" placeholder="" readonly></textarea>
                    </div>
                </div><br>
               
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Plan</label>
                        <textarea name="plan" id="plan" class="form-control" placeholder="" readonly> </textarea>
                    </div>
                     <div class="col-md-6">
                        <label for="">Comentarios</label>
                        <textarea name="comentarios" id="comentarios" class="form-control" placeholder="" readonly></textarea>
                    </div>
                </div><br>
            
                <h4 class="modal-title">EXAMENES CLINICOS</h4>
                <div class="row">
                    <div class="col-md-6">
                     <input type="checkbox" id="radiografia" value=""><label for="cbox2"> Radiografia</label><br>
                     <input type="checkbox" id="ecografia" value=""><label for="cbox2"> Ecografia</label><br>
                     <input type="checkbox" id="analisissangre" value=""><label for="cbox2"> Analisis de Sangre</label><br>
                     <input type="checkbox" id="analisisorina" value=""><label for="cbox2"> Analisis de Orina</label><br>
                     <input type="checkbox" id="tomografia" value=""><label for="cbox2"> Tomografia</label>   
                    </div>
                </div>
                
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id_cita" id="id_cita">
        <input type="hidden" name="id_pacnt" id="id_pacnt" value="">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
       </form>
    </div>
  </div>
</div>


