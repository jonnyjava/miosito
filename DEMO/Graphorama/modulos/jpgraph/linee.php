<?
$margen="#ECECEC";          //Margen que rodea a la grafica
$titulo="#2E6281";          //Leyenda de la grafica
$linea='navy@0.7';          //Linea de la grafica
$relleno='skyblue@0.5';     //Relleno de la linea (transparente)
$punto='blue@0.5';          //Punto de la linea
$relleno_punto='lightblue'; //Relleno del punto
$valor='navy@0.7';          //Valor numerico asociado al punto
$gradiente="#5791B3";          //Color oscuro para degradados

require_once ("../../jpgraph/jpgraph.php");
require_once ("../../jpgraph/jpgraph_bar.php");
require_once ("../../jpgraph/jpgraph_line.php");
for($i=0; $i<=31; $i++){
  $datalinear[]=$i;
  $dataupdown[]=(sin($i)+cos($i))*10;
  $datarandom[]=$i+rand(0, $i);
}

$graph = new Graph(960, 500, "auto");
$graph->img->SetMargin(40, 40, 40, 100);
$graph->SetScale("textlin");
$graph->SetMarginColor($margen);
$graph->SetShadow();
$graph->title->Set('Linear Graph');
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

$linea1 = new LinePlot($datalinear);
$linea1->SetColor("black");
$linea1->SetCenter();
$linea1->SetWeight(3);
$linea1->value->SetColor($valor);
$linea1->value->SetFormat('%d');
$linea1->SetLegend("Linear progression","black");
$linea1->mark->SetType(MARK_SQUARE);
$linea1->mark->SetColor("blue");
$linea1->mark->SetFillColor($relleno_punto);
$linea1->mark->SetSize(10);
$linea1->value->Show();

$linea2 = new LinePlot($datarandom);
$linea2->SetColor("red");
$linea2->SetCenter();
$linea2->SetWeight(3);
$linea2->value->SetColor($valor);
$linea2->value->SetFormat('%d');
$linea2->SetLegend("Random values","red");
$linea2->mark->SetType(MARK_CROSS);
$linea2->mark->SetColor("blue");
$linea2->mark->SetFillColor($relleno_punto);
$linea2->mark->SetSize(10);
$linea2->value->Show();

$linea3 = new LinePlot($dataupdown);
$linea3->SetColor("blue");
$linea3->SetCenter();
$linea3->SetWeight(3);
$linea3->value->SetColor($valor);
$linea3->value->SetFormat('%0.01f');
$linea3->SetLegend("Sin-Cos values","blue");
$linea3->mark->SetType(MARK_DIAMOND);
$linea3->mark->SetColor("blue");
$linea3->mark->SetFillColor($relleno_punto);
$linea3->mark->SetSize(10);
$linea3->value->Show();


$graph->Add($linea1);
$graph->Add($linea2);
$graph->Add($linea3);

$graph->Stroke();
?>
