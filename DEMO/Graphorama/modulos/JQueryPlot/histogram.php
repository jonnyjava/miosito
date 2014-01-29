<script type="text/javascript">
  $(document).ready(function(){
  var line1 = [
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
  var plot3 = $.jqplot('histogram', [line1], {
    title: 'Sales report for 2011',
    series:[
      {renderer:$.jqplot.BarRenderer,
        pointLabels: {show: true}
      }],
    axesDefaults: {
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
          angle: -30
        }
    },
    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        tickOptions: {
          labelPosition: 'middle'
        }
      },
      yaxis: {
        autoscale:true,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
          labelPosition: 'start'
        }
      }
    }
  });
});
</script>
<br style="clear:both;"/>
<div style="height:560px; width:920px;padding:20px;Background-color:#000000; color:#ffffff; font-size:15px;">
  <div id="histogram" style="height:100%;width:100%;color:#000000;"></div>
</div>