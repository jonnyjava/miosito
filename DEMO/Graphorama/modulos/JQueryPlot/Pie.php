<script type="text/javascript">
$(document).ready(function(){
  var data = [
    ['Product 1', Math.round(100*Math.random())],
    ['Product 2', Math.round(100*Math.random())],
    ['Product 3', Math.round(100*Math.random())],
    ['Product 4', Math.round(100*Math.random())],
    ['Product 5', Math.round(100*Math.random())],
    ['Product 6', Math.round(100*Math.random())],
    ['Product 7', Math.round(100*Math.random())]
  ];
  var plot1 = jQuery.jqplot ('fullpie', [data], 
    { 
      title: 'Sales report for 2011',
      seriesDefaults: {
        renderer: jQuery.jqplot.PieRenderer, 
        rendererOptions: {
          showDataLabels: true
        }
      }, 
      legend: { show:true, location: 'e' }
    }
  );
  var plot2 = jQuery.jqplot ('emptypie', [data], 
    {
      title: 'Sales report for 2011',
      seriesDefaults: {
        renderer: jQuery.jqplot.PieRenderer, 
        rendererOptions: {
          fill: false,
          showDataLabels: true, 
          sliceMargin: 6, 
          lineWidth: 2
        }
      }, 
      legend: { show:true, location: 'e' }
    }
  );
});
</script>
<br style="clear:both;"/>
<div style="height:580px;">
  <div style="height:560px; width:460px;padding:10px;Background-color:#000000; color:#0000000; font-size:15px;float:left;">
    <div id="fullpie" style="height:100%;width:100%;color:#000000;"></div>
  </div>
  <div style="height:560px; width:460px;padding:10px;Background-color:#000000; color:#0000000; font-size:15px;float:left;">
    <div id="emptypie" style="height:100%;width:100%;color:#000000;"></div>
  </div>
</div>
