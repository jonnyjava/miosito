<?
$margen="#ECECEC";          //Margen que rodea a la grafica
$titulo="#2E6281";          //Leyenda de la grafica
$linea='navy@0.7';          //Linea de la grafica
$relleno='skyblue@0.5';     //Relleno de la linea (transparente)
$punto='blue@0.5';          //Punto de la linea
$relleno_punto='lightblue'; //Relleno del punto
$valor='navy@0.7';          //Valor numerico asociado al punto
$gradiente="#579fB3";          //Color oscuro para degradados

require_once ("../../jpgraph/jpgraph.php");
require_once ("../../jpgraph/jpgraph_bar.php");
require_once ("../../jpgraph/jpgraph_line.php");
for($i=0; $i<=31; $i++){
  $scale[] = $i;
  $datacolumn[]=(sin($i)+cos($i))+8;
  $datatrig[]=(sin($i)+cos($i))+10;
}

$graph = new Graph(960, 600, "auto");
$graph->img->SetMargin(40, 40, 40, 100);
$graph->SetScale("textlin");
$graph->SetMarginColor($margen);
$graph->SetShadow();
$graph->title->Set('Bar Graph and area');
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
$graph->yscale->ticks->SupressZeroLabel(false);
$graph->xaxis->SetTickLabels($scale);
$graph->xaxis->SetLabelAngle(50);
$graph->xaxis->SetPos("min"); // "min"

$bars = new BarPlot($datacolumn);
$bars->SetColor("blue");
$bars->SetCenter();
$bars->value->SetColor($valor);
$bars->SetFillColor('red@0.3');
$bars->value->SetFormat('%d');
$bars->value->Show();
$bars->value->SetFont(FF_VERDANA, FS_NORMAL, 9);
$bars->SetLegend("Histogram","black");


$area = new LinePlot($datatrig);
$area->SetColor($gradiente);
$area->SetCenter();
$area->value->SetColor($valor);
$area->value->SetFormat('%0.01f');
$area->value->SetFont(FF_VERDANA, FS_NORMAL, 9);
$area->SetFillColor($gradiente);
$area->SetLegend("Coloured Area","black");
$area->mark->SetType(MARK_DTRIANGLE);
$area->mark->SetColor("black");
$area->mark->SetFillColor("black");
$area->mark->SetSize(5);
$area->value->Show();

$graph->Add($area);
$graph->Add($bars);
// Finally send the graph to the browser

$graph->Stroke();

?>
