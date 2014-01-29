<?php
$margen="#ECECEC";          //Margen que rodea a la grafica
$titulo="#2E6281";          //Leyenda de la grafica
$linea='navy@0.7';          //Linea de la grafica
$relleno='skyblue@0.5';     //Relleno de la linea (transparente)
$punto='blue@0.5';          //Punto de la linea
$relleno_punto='lightblue'; //Relleno del punto
$valor='navy@0.7';          //Valor numerico asociado al punto
$gradiente="#5791B3";

require_once ('../../jpgraph/jpgraph.php');
require_once ('../../jpgraph/jpgraph_stock.php');

// Data must be in the format : open,close,min,max
$datay = array(
    34,42,27,45,
    55,25,14,59,
    15,40,12,47,
    62,38,25,65,
    38,49,32,64,
    34,42,27,45,
    38,49,32,64
    );
$graph = new Graph(960, 600, "auto");
$graph->img->SetMargin(40, 40, 40, 100);
$graph->SetScale("textlin");
$graph->SetMarginColor($margen);
$graph->title->Set('Stockchart example');
$graph->title->SetMargin(12);
$graph->title->SetFont(FF_VERDANA, FS_NORMAL, 12);
$graph->title->SetColor($titulo);
$graph->xaxis->SetFont(FF_VERDANA, FS_BOLD, 7);
$graph->yaxis->SetFont(FF_VERDANA, FS_BOLD, 7);
$graph->xaxis->title->Set('X axis');
$graph->yaxis->title->Set('Y axis');
$graph->xaxis->title->SetMargin(12);
$graph->yaxis->title->SetMargin(-2);
$graph->xaxis->title->SetFont(FF_VERDANA, FS_NORMAL, 9);
$graph->yaxis->title->SetFont(FF_VERDANA, FS_NORMAL, 9);
$graph->legend->Pos(0.5,0.96,"center","bottom");
$graph->yscale->ticks->SupressZeroLabel(true);
$graph->xaxis->SetTickLabels($datalinear);
$graph->xaxis->SetLabelAngle(50);
$graph->xaxis->SetPos("min"); // "min"


$p1 = new StockPlot($datay);
$p1->SetWidth(7);
$p1->value->Show();

// Uncomment the following line to hide the horizontal end lines
//$p1->HideEndLines();

$graph->Add($p1);
$graph->Stroke();

?>