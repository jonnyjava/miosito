<div>
      <div style="margin-top:15px;margin-left: 20px;">
        <label  class="labeldias" style="float:left;width:90px;">Operadora:</label>
        <div id="radio">
          <input type="radio" id="radio1" name="radio" value="0" onclick="cargaMatriz();" checked="checked"/><label for="radio1">GLOBAL</label>
          <input type="radio" id="radio2" name="radio" value="1" onclick="cargaMatriz();"/><label for="radio2">GRUPO 1</label>
          <input type="radio" id="radio3" name="radio" value="2" onclick="cargaMatriz();"/><label for="radio3">GRUPO 2</label>
          <input type="radio" id="radio4" name="radio" value="3" onclick="cargaMatriz();"/><label for="radio4">GRUPO 3</label>
          <input type="radio" id="radio5" name="radio" value="4" onclick="cargaMatriz();"/><label for="radio5">GRUPO 4</label>
	</div>
      </div>
      <div>
      <div class="sliderdias">
        <label  class="labeldias" style="padding-top: 0px;width:60px;">Dias:</label>
        <input type="text" id="amount" class="inputdias" />
        <div id="slider-range-min" style="width:400px;float:left;margin-left:10px;"></div>
        <img src="img/excel.jpg" id="btnExportaExcel" onclick="exporta();" alt="exportar a excel" title="exportar a excel" style="cursor:pointer;float:left;"/>
      </div>
        <div class="sliderdias" id="capaInactividad"></div>
        <div class="listadoArchivos"  style="float:right;padding-right:60px;">
          <a href="../ficheros/MatrizInactividad.xls" style="float:left">
            <img src="img/excel.jpg" id="btnExporta" alt="descargar excel" title="descargar excel" style="cursor:pointer;"/>
            Matriz de inactividad completa
          </a><br/>
          <a href="../ficheros/MatrizInactividad_vivo.xls" style="float:left">
            <img src="img/excel.jpg" id="btnExporta" alt="descargar excel" title="descargar excel" style="cursor:pointer;"/>
            Matriz de inactividad GRUPO 1
          </a><br/>
          <a href="../ficheros/MatrizInactividad_claro.xls" style="float:left">
            <img src="img/excel.jpg" id="btnExporta" alt="descargar excel" title="descargar excel" style="cursor:pointer;"/>
            Matriz de inactividad GRUPO 2
          </a><br/>
          <a href="../ficheros/MatrizInactividad_tim.xls" style="float:left">
            <img src="img/excel.jpg" id="btnExporta" alt="descargar excel" title="descargar excel" style="cursor:pointer;"/>
            Matriz de inactividad GRUPO 3
          </a><br/>
          <a href="../ficheros/MatrizInactividad_oi.xls" style="float:left">
            <img src="img/excel.jpg" id="btnExporta" alt="descargar excel" title="descargar excel" style="cursor:pointer;"/>
            Matriz de inactividad GRUPO 4
          </a>
        </div>
    </div>
  </div>
<script type="text/javascript">
  $( "#radio" ).buttonset();
  cargaslider();
  cargaMatriz(5);

  function cargaslider(){
    $( "#slider-range-min" ).slider({
      range: "min",
      value: 5,
      min: 1,
      max: 60,
      slide: function( event, ui ) {
        $( "#amount" ).val( " " + ui.value );
      },
      stop: function(event, ui) {
        cargaMatriz(ui.value);
        }
    });
    $( "#amount" ).val( " " + $( "#slider-range-min" ).slider( "value" ) );
}
function cargaMatriz(){
  var operadora = $("input:checked").val();
  var dias = $( "#amount" ).val();
  var data = "dias="+dias+"&operadora="+operadora;
  $.post('dameMatrizInactividad.php',data,function(msg){
    $('#capaInactividad').html(msg);
  });
}
function exporta(){
  var dias= $( "#amount" ).val();
  var operadora = 0;
  window.open("dameExcelInactividad.php?dias="+dias+"&operadora="+operadora);
}
</script>