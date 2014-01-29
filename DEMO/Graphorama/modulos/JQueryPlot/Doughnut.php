<script type="text/javascript">
  $(document).ready(function(){
  var s1 = [
    ['January', Math.round(100*Math.random())],
    ['February', Math.round(100*Math.random())],
    ['March', Math.round(100*Math.random())],
    ['April', Math.round(100*Math.random())],
    ['May', Math.round(100*Math.random())],
    ['June',Math.round(100*Math.random()) ],
    ['July', Math.round(100*Math.random())],
    ['August', Math.round(100*Math.random())],
    ['September', Math.round(100*Math.random())],
    ['October', Math.round(100*Math.random())],
    ['November', Math.round(100*Math.random())],
    ['December', Math.round(100*Math.random())]
  ];
  var s2 = [
    ['Product 1', Math.round(100*Math.random())],
    ['Product 2', Math.round(100*Math.random())],
    ['Product 3', Math.round(100*Math.random())],
    ['Product 4', Math.round(100*Math.random())],
    ['Product 5', Math.round(100*Math.random())],
    ['Product 6', Math.round(100*Math.random())],
    ['Product 7', Math.round(100*Math.random())]
  ];
   
  var plot3 = $.jqplot('Doughnut', [s1, s2], {
    seriesDefaults: {
      renderer:$.jqplot.DonutRenderer,
      rendererOptions:{
        sliceMargin: 3,
        startAngle: -90,
        showDataLabels: true,
        dataLabels: 'value',
        color:'#000000'
      }
    },
    legend: { show:true, location: 'e' }
    
  });
});
</script>
<br style="clear:both;"/>
<div style="height:560px; width:920px;padding:20px;Background-color:#000000; color:#000000; font-size:15px;">
  <div id="Doughnut" style="height:100%;width:100%;color:#000000;"></div>
</div>