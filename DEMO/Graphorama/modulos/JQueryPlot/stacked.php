<script type="text/javascript">
  $(document).ready(function(){
  var s1 = [Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()),Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()),Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random())];
  var s2 = [Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()),Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()),Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random())];
  var s3 = [Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()),Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()),Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random())];
  var s4 = [Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()),Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()),Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random())];
  var ticks = ['January','February','March','April','May', 'June', 'July', 'August','September','Octuber','November','December'];
  
 var plot3 = $.jqplot('stacked', [s1, s2, s3,s4], {
    title: 'Sales report for 2011',
    stackSeries: true,
    captureRightClick: true,
    seriesDefaults:{
      renderer:$.jqplot.BarRenderer,
      rendererOptions: {
        barMargin: 30,
        highlightMouseOver: true
      },
      pointLabels: {
        show: true,
        stackedValue: true
      }
    },
    series:[
      {label:'Product 1'},
      {label:'Product 2'},
      {label:'Product 3'},
      {label:'Product 4'}
    ],
    axes: {
      xaxis: {
          renderer: $.jqplot.CategoryAxisRenderer,
          ticks: ticks
      },
      yaxis: {
        padMin: 0
      }
    },
    legend: {
      show: true,
      location: 'nw',
      placement: 'inside'
    }      
  });
});
</script>
<br style="clear:both;"/>
<div style="height:560px; width:920px;padding:20px;Background-color:#000000; color:#ffffff; font-size:15px;">
  <div id="stacked" style="height:100%;width:100%;color:green;"></div>
</div>