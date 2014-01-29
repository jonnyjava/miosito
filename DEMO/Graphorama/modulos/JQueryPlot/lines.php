<script type="text/javascript">
$(document).ready(function(){
   var ticks = ['January','February','March','April','May', 'June', 'July', 'August','September','Octuber','November','December'];
   var s1 = [Math.round(10+Math.random()), Math.round(10-Math.random()), Math.round(10+Math.random()), Math.round(10-Math.random()),Math.round(10+Math.random()), Math.round(10-Math.random()), Math.round(10+Math.random()), Math.round(10-Math.random()),Math.round(10+Math.random()), Math.round(10-Math.random()), Math.round(10+Math.random()), Math.round(10-Math.random())];
   var s2 = [Math.round(20+Math.random()), Math.round(18-Math.random()), Math.round(20+Math.random()), Math.round(18-Math.random()),Math.round(20+Math.random()), Math.round(18-Math.random()), Math.round(20+Math.random()), Math.round(18-Math.random()),Math.round(20+Math.random()), Math.round(18-Math.random()), Math.round(20+Math.random()), Math.round(18-Math.random())];
   var s3 = [Math.round(32+Math.random()), Math.round(28+Math.random()), Math.round(32+Math.random()), Math.round(28+Math.random()),Math.round(32+Math.random()), Math.round(28+Math.random()), Math.round(32+Math.random()), Math.round(28+Math.random()),Math.round(32+Math.random()), Math.round(28+Math.random()), Math.round(32+Math.random()), Math.round(28+Math.random())];
   var s4 = [Math.round(50+Math.random()), Math.round(40-Math.random()), Math.round(50+Math.random()), Math.round(40-Math.random()),Math.round(50+Math.random()), Math.round(40-Math.random()), Math.round(50+Math.random()), Math.round(40-Math.random()),Math.round(50+Math.random()), Math.round(40-Math.random()), Math.round(50+Math.random()), Math.round(40-Math.random())];
   var plot3 = $.jqplot('lines', [s1,s2,s3,s4], 
    { 
      title:'Line Style Options', 
      seriesDefaults: { 
        showMarker:true,
        pointLabels: { show:true } 
      },
       series:[ 
          {
           lineWidth:2, 
            markerOptions: { style:'diamond' }
          }, 
          {
            showLine:false, 
            markerOptions: { size: 10, style:"x" }
          },
          { 
            markerOptions: { style:"circle" }
          }, 
          {
            lineWidth:5, 
            markerOptions: { style:"filledSquare", size:12 }
          }
      ],
      axes:{
        xaxis: {
          renderer: $.jqplot.CategoryAxisRenderer,
          ticks: ticks
      },
        yaxis:{
          label:'Cosine',
          labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
          labelOptions: {
            fontFamily: 'Calibri, Georgia, Serif',
            fontSize: '15pt'
          }
        }
      },
      highlighter: {
        show: true,
        sizeAdjust: 7.5
      },
      cursor: {
        show: true,
        tooltipLocation:'sw'
      }
    }
  );
    
});
</script>
<br style="clear:both;"/>
<div style="height:560px; width:920px;padding:20px;Background-color:#000000; color:#ffffff; font-size:15px;">
  <div id="lines" style="height:100%;width:100%;color:green;"></div>
</div>