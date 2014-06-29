/*
A simple pie chart builder based on EaselJS
created by Spencer Williams https://github.com/spilliams
for more information see https://github.com/spilliams/hoverpie for more details
*/
var HoverPie = {};
HoverPie.config = {
  canvasPadding : 5,
  hoverScaleX : 1.125,
  hoverScaleY : 1.125,
  labelColor : "rgba(255,255,255,1)",
  labelHoverColor : "rgba(255,255,255,1)",
  labelRadiusFactor : 0.6,
  labelFontFamily : "Ubuntu",
  labelFontWeight : "bold",
  labelFontSize : 13,
  sectorFillColor : "#ffffff",
  sectorStrokeColor : "#ffffff",
  sectorStrokeWidth : 2,
};
HoverPie.make = (function($canvas, data, config){
  config = $.extend({}, HoverPie.config, config);
  
  var percent2radians = (function(percent) { return percent*Math.PI*2; });
  
  var ctx = $canvas[0].getContext("2d");
  var oX = ctx.canvas.width/2;
  var oY = ctx.canvas.height/2;
  var r = Math.min(oX,oY) - config.canvasPadding;
  var stage = new createjs.Stage("myCanvas");
  stage.enableMouseOver(20);
  
  var cumulativeAngle = 1.5*Math.PI;
  
  for (var i=0; i<data.length; i++) {
    
    var sector = new createjs.Shape();
    var container = new createjs.Container();
    container.name = container.id;
    
    // Draw the arc
    var sectorFillColor = data[i].fillColor || config.sectorFillColor;
    var sectorStrokeColor = data[i].strokeColor || config.sectorStrokeColor;
    sector.graphics.moveTo(oX,oY).beginFill(sectorFillColor).setStrokeStyle(config.sectorStrokeWidth).beginStroke(sectorStrokeColor);
    
    var sectorAngle = percent2radians(data[i].percentage);
    sector.graphics.arc(oX,oY,r,cumulativeAngle,cumulativeAngle+sectorAngle);
    
    sector.graphics.closePath();
    
    container.addChild(sector);
    
    // Draw the label
    if (data[i].label) {
      
      // One for unhovered sectors
      var font = config.labelFontWeight+" "+config.labelFontSize+"px "+config.labelFontFamily;
      var unhoverLabel = new createjs.Text(data[i].label,font,config.labelColor);
      unhoverLabel.textAlign = "center";
      unhoverLabel.textBaseline = "bottom";
      
      // The label is to be placed such that the center of its baseline
      // is tangent to a circle of radius r*config.labelRadiusFactor
      // and a line drawn along the center of the sector
      var unhoverLabelRadius = r*config.labelRadiusFactor;
      var unhoverLabelAngle = cumulativeAngle + sectorAngle/2.0;
      unhoverLabel.x = oX + unhoverLabelRadius * Math.cos(unhoverLabelAngle);
      unhoverLabel.y = oY + unhoverLabelRadius * Math.sin(unhoverLabelAngle);
      unhoverLabel.name = "label";
      
      // and one for hovered sectors
      
      
      container.addChild(unhoverLabel);
    }
    
    // Draw the description
    
    // reposition scale origin and draw origin
    container.regX = oX;
    container.regY = oY;
    container.x = oX;
    container.y = oY;
    
    cumulativeAngle+=sectorAngle;
    stage.addChild(container);
    stage.update();
  } // percentages loop
  
  // This array tracks the currently-hovered pie sectors.
  // if it is empty, there are no sectors hovered.
  var hovers = [];
  
  var hover = (function(ids){
    //console.log(ids,stage.children);
    
    // This function is to be called with a list of stage IDs
    // it will revert any currently-hovered elements to their
    // original style, and apply hover style to the new set.
    
    // any ids in hovers that aren't in ids need to be unhovered
    var toUnhover = [];
    for (var i=0; i<hovers.length; i++) {
      if (ids.indexOf(hovers[i]) == -1) {
        // didn't find hover[i] in ids, so add to toUnhover
        toUnhover.push(hovers[i]);
      }
    }
    for (var i=0; i<toUnhover.length; i++) {
      var child = stage.getChildByName(toUnhover[i]);
      child.scaleX = 1;
      child.scaleY = 1;
    }
    
    // and ids in ids that aren't in hovers need to be hovered
    var toHover = [];
    for (var i=0; i<ids.length; i++) {
      if (hovers.indexOf(ids[i]) == -1) {
        // didn't find ids[i] in hovers, so add to toHover
        toHover.push(ids[i]);
      }
    }
    for (var i=0; i<toHover.length; i++) {
      var child = stage.getChildByName(toHover[i]);
      child.scaleX = config.hoverScaleX;
      child.scaleY = config.hoverScaleY;
    }
    
    hovers = ids;
    stage.update();
  });
});
