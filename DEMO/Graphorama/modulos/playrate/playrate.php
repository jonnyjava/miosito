<div class="leyenda">
    <label>Dia 1</label><span style="background-color:#0000FF"></span>
    <label>Dia 2</label><span style="background-color:#ADD8E6"></span>
    <label>Dia 3</label><span style="background-color:#7FFFD4"></span>
    <label>Dia 4</label><span style="background-color:#90EE90"></span>
    <label>Dia 5</label><span style="background-color:#D2691E"></span>
    <label>Dia 6</label><span style="background-color:#FFA500"></span>
    <label>Dia 7</label><span style="background-color:#FF0000"></span>
  </div>
    <div class="listadoArchivos" style="float:right; padding-right: 50px;">
    <a href="ficheros/MatrizInactividad.xls">
      <img src="img/excel.jpg" id="btnExporta" alt="descargar excel" title="descargar excel" style="cursor:pointer;"/>
      Descargar
    </a>
  </div>
  <div id="capaplayrate" style="width:60%;float:left;margin-top:10px;"></div>
<script type="text/javascript">
cargaPlayrate();
function cargaPlayrate(){
  var data = "";
  $.post('modulos/playrate/damePlayrate.php',data,function(msg){
    $('#capaplayrate').html(msg);
    colorea();
  });
}
function colorea(){
  var vectorcolores = ["#ADD8E6","#7FFFD4","#90EE90","#D2691E","#FFA500","#FF0000"]
  var lineas = $("tr:gt(1)").length;
  for(var i = 2; i<=lineas;i++){
    var uno = $('tr:eq('+(i-1)+') > td').length;
    var dos = $('tr:eq('+i+') > td').length;
    if (uno>dos){
      $('tr:eq('+(i-1)+') td:eq('+(uno-1)+')').css("background-color", "#0000FF");
      $('tr:eq('+(i-1)+') td:eq('+(uno-1)+')').css("color", "#FFFFFF");
      for(var k= 0;k<vectorcolores.length;k++){
        if((i-k)>1){
          $('tr:eq('+(i-2-k)+') td:eq('+(uno-1)+')').css("background-color", vectorcolores[k]);
        }
      }
    }
  }
  $('tr:eq('+(lineas+1)+') td:eq(1)').css("background-color", "#0000FF");
  for(var k= 0;k<vectorcolores.length;k++){
    $('tr:eq('+(lineas-k)+') td:eq(1)').css("background-color", vectorcolores[k]);
  }
  $('tr:eq('+(lineas+1)+') td:eq(1)').css("color", "#FFFFFF");
}
</script>