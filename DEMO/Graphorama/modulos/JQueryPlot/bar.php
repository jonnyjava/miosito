<script type="text/javascript">
 $(document).ready(function(){
    var ticks = ['January','February','March','April','May', 'June', 'July', 'August','September','Octuber','November','December'];
    var plot2 = $.jqplot('bar', [
        [[Math.round(12*Math.random()),1],[Math.round(12*Math.random()),2],[Math.round(12*Math.random()),3],[Math.round(12*Math.random()),4],[Math.round(12*Math.random()),5],[Math.round(12*Math.random()),6],[Math.round(12*Math.random()),7],[Math.round(12*Math.random()),8],[Math.round(12*Math.random()),9],[Math.round(12*Math.random()),10],[Math.round(12*Math.random()),11],[Math.round(12*Math.random()),12]],
        [[Math.round(12*Math.random()),1],[Math.round(12*Math.random()),2],[Math.round(12*Math.random()),3],[Math.round(12*Math.random()),4],[Math.round(12*Math.random()),5],[Math.round(12*Math.random()),6],[Math.round(12*Math.random()),7],[Math.round(12*Math.random()),8],[Math.round(12*Math.random()),9],[Math.round(12*Math.random()),10],[Math.round(12*Math.random()),11],[Math.round(12*Math.random()),12]],
        [[Math.round(12*Math.random()),1],[Math.round(12*Math.random()),2],[Math.round(12*Math.random()),3],[Math.round(12*Math.random()),4],[Math.round(12*Math.random()),5],[Math.round(12*Math.random()),6],[Math.round(12*Math.random()),7],[Math.round(12*Math.random()),8],[Math.round(12*Math.random()),9],[Math.round(12*Math.random()),10],[Math.round(12*Math.random()),11],[Math.round(12*Math.random()),12]]], {
        seriesDefaults: {
            renderer:$.jqplot.BarRenderer,
            pointLabels: { show: true, location: 'e', edgeTolerance: -15 },
            shadow: false,
            rendererOptions: {
                barDirection: 'horizontal'
            }
        },
        axes: {
          xaxis: {
            renderer: $.jqplot.CategoryAxisRenderer,
            ticks: ticks
          },
            yaxis: {
                renderer: $.jqplot.CategoryAxisRenderer
            }
        }
    });
});
</script>
<br style="clear:both;"/>
<div style="height:560px; width:920px;padding:20px;Background-color:#000000; color:#ffffff; font-size:15px;">
  <div id="bar" style="height:100%;width:100%;color:green;"></div>
</div>