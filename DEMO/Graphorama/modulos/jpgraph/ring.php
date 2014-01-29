<?php
$margen="#ECECEC";          //Margen que rodea a la grafica
$titulo="#2E6281";          //Leyenda de la grafica
$linea='navy@0.7';          //Linea de la grafica
$relleno='skyblue@0.5';     //Relleno de la linea (transparente)
$punto='blue@0.5';          //Punto de la linea
$relleno_punto='lightblue'; //Relleno del punto
$valor='navy@0.7';          //Valor numerico asociado al punto
$gradiente="#579fB3";          //Color oscuro para degradados

require_once ('../../jpgraph/jpgraph.php');
require_once ('../../jpgraph/jpgraph_pie.php');
$data = array(rand(5, 50),rand(5, 50),rand(5, 50),rand(5, 50),rand(5, 50),rand(5, 50),rand(5, 50));
$graph = new PieGraph(960, 600, "auto");
$graph->img->SetMargin(40, 40, 40, 100);
$graph->SetScale("textlin");
$graph->SetMarginColor($margen);
$graph->SetShadow();
$graph->title->Set('Ring Graph');
$graph->title->SetMargin(12);
$graph->title->SetFont(FF_VERDANA, FS_NORMAL, 12);
$graph->title->SetColor($titulo);
$graph->xaxis->SetFont(FF_VERDANA, FS_BOLD, 7);
$graph->yaxis->SetFont(FF_VERDANA, FS_BOLD, 7);
$graph->yaxis->scale->SetGrace(15,15);
$graph->xaxis->scale->SetGrace(15,15);
$graph->xaxis->title->Set('X axis');
$graph->yaxis->title->Set('Y axis');
$graph->xaxis->title->SetMargin(12);
$graph->yaxis->title->SetMargin(-2);
$graph->xaxis->title->SetFont(FF_VERDANA, FS_NORMAL, 9);
$graph->yaxis->title->SetFont(FF_VERDANA, FS_NORMAL, 9);
$graph->legend->Pos(0.95,0.35,"center","middle");
$graph->yscale->ticks->SupressZeroLabel(false);
$graph->xaxis->SetTickLabels($scale);
$graph->xaxis->SetLabelAngle(50);
$graph->xaxis->SetPos("min"); 
$p1 = new PiePlotC($data);
$p1->SetSize(0.35);
$p1->value->SetFont(FF_ARIAL,FS_BOLD,14);
$p1->value->SetColor('white');
$p1->value->Show();
$p1->midtitle->Set("%Emergency calls\nin a week");
$p1->midtitle->SetFont(FF_ARIAL,FS_NORMAL,12);
$p1->SetMidColor('yellow');
$p1->SetLabelType(PIE_VALUE_PER);
$lbl = array("Monday\n%.1f%%","Thursady\n%.1f%%","Wednesday\n%.1f%%","Tuesday\n%.1f%%","Friday\n%.1f%%","Saturday\n%.1f%%","Sunday\n%.1f%%");
$p1->SetLabels($lbl);
$p1->value->SetColor('black');
$p1->value->SetFont(FF_ARIAL,FS_BOLD,11);
$p1->SetShadow();
$p1->ExplodeAll(15);
$graph->Add($p1);
$graph->Stroke();
?>