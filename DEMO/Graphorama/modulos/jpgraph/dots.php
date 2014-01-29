<?php
$margen="#ECECEC";          //Margen que rodea a la grafica
$titulo="#2E6281";          //Leyenda de la grafica
$linea='navy@0.7';          //Linea de la grafica
$relleno='skyblue@0.5';     //Relleno de la linea (transparente)
$punto='blue@0.5';          //Punto de la linea
$relleno_punto='lightblue'; //Relleno del punto
$valor='navy@0.7';          //Valor numerico asociado al punto
$gradiente="#5791B3";          //Color oscuro para degradados

require_once ('../../jpgraph/jpgraph.php');
require_once ('../../jpgraph/jpgraph_scatter.php');

// Each ballon is specificed by four values.
// (X,Y,Size,Color)
$data = array(
    array(0,20,20,'green'),
    array(1,15,15,'orange'),
    array(2,10,10,'blue'),
    array(3,21,21,'red'),
    array(4,16,16,'lightblue'),
    array(5,34,34,'yellow'),
    array(6,23,23,'orange'),
    array(7,28,28,'red'),
    array(8,12,12,'lightblue'),
    array(9,22,22,'yellow'),
    array(10,11,11,'orange'),
    array(11,17,17,'blue')
);

$n = count($data);

for( $i=0; $i < $n; $i++ ) {
    $datax[$i] = $data[$i][0];
   $datay[$i] = $data[$i][1];
   $format[strval($datax[$i])][strval($datay[$i])] = array($data[$i][2],$data[$i][3]);
}
function FCallback($aYVal,$aXVal) {
    global $format;
    return array($format[strval($aXVal)][strval($aYVal)][0],'',$format[strval($aXVal)][strval($aYVal)][1],'','');
}

$graph = new Graph(960, 600, "auto");
$graph->img->SetMargin(40, 40, 40, 100);
$graph->SetScale("intlin");
$graph->SetMarginColor($margen);
$graph->SetShadow();
$graph->title->Set('Dots Graph');
$graph->title->SetMargin(12);
$graph->yaxis->scale->SetGrace(5,5);
$graph->xaxis->scale->SetGrace(5,5);
$graph->title->SetFont(FF_VERDANA, FS_NORMAL, 12);
$graph->title->SetColor($titulo);
$graph->xaxis->SetFont(FF_VERDANA, FS_BOLD, 7);
$graph->yaxis->SetFont(FF_VERDANA, FS_BOLD, 7);
$graph->xaxis->title->Set('X axis');
$graph->yaxis->title->Set('Y axis');
$graph->xaxis->title->SetMargin(12);
$graph->yaxis->title->SetMargin(-2);
$graph->legend->Pos(0.5,0.96,"center","bottom");
$graph->yscale->ticks->SupressZeroLabel(true);
$graph->xaxis->SetLabelAngle(50);
$graph->xaxis->SetPos("min"); // "min"
$graph->xscale->SetAutoMin(0);

$sp1 = new ScatterPlot($datay,$datax);
$sp1->mark->SetType(MARK_FILLEDCIRCLE);
$sp1->value->Show();
$sp1->value->SetFont(FF_FONT1,FS_BOLD);
$sp1->mark->SetCallbackYX("FCallback");

$graph->Add($sp1);
$graph->Stroke();

?>