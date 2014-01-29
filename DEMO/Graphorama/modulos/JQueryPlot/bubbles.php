<script type="text/javascript">
  $(document).ready(function(){
 
    var arr = [[Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()), "Product 1"],
      [Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()), "Product 2"],
      [Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()), "Product 3"],
      [Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()), "Product 4"],
      [Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()), "Product 5"],
      [Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()), "Product 6"],
      [Math.round(100*Math.random()), Math.round(100*Math.random()), Math.round(100*Math.random()), "Product 7"]
      ];
     
    var plot1 = $.jqplot('shadowbubble',[arr],{
        title: 'Sales summary for the year 2011',
        seriesDefaults:{
            renderer: $.jqplot.BubbleRenderer,
            rendererOptions: {
                bubbleGradients: true
            },
            shadow: true
        }
    });
    
    var plot2 = $.jqplot('trasparentbubble',[arr],{
        title: 'Sales summary for the year 2011',
        seriesDefaults:{
            renderer: $.jqplot.BubbleRenderer,
            rendererOptions: {
                bubbleAlpha: 0.6,
                highlightAlpha: 0.8
            },
            shadow: true,
            shadowAlpha: 0.05
        }
    }); 
});
</script>
<br style="clear:both;"/>
<div style="height:580px;">
  <div style="height:560px; width:460px;padding:10px;Background-color:#000000; color:#0000000; font-size:15px;float:left;">
    <div id="shadowbubble" style="height:100%;width:100%;color:#ffffff;"></div>
  </div>
  <div style="height:560px; width:460px;padding:10px;Background-color:#000000; color:#0000000; font-size:15px;float:left;">
    <div id="trasparentbubble" style="height:100%;width:100%;color:#ffffff;"></div>
  </div>
</div>