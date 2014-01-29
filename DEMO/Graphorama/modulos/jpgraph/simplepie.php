<?
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

// Some data
$data1 = array(rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50));
$data2 = array(rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50));
$data3 = array(rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50));
$data4 = array(rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50),rand(0, 50));


// Create the Pie Graph.
$graph = new PieGraph(960, 600, "auto");
$graph->img->SetMargin(40, 40, 40, 100);
$graph->SetScale("textlin");
$graph->SetMarginColor($margen);
$graph->SetShadow();
$graph->title->Set('Multiple Pie');
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
$graph->legend->Pos(0.9,0.45,"center","middle");
$graph->yscale->ticks->SupressZeroLabel(false);
$graph->xaxis->SetTickLabels($scale);
$graph->xaxis->SetLabelAngle(50);
$graph->xaxis->SetPos("min"); // "min"

// Create plots
$size=0.16;
$p1 = new PiePlot($data1);
$p1->SetLegends(array("Jan","Feb","Mar","Apr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"));
$p1->SetSize($size);
$p1->SetCenter(0.25,0.28);
$p1->value->SetFont(FF_VERDANA, FS_NORMAL, 8);
$p1->title->Set("2008");
$p1->title->SetFont(FF_VERDANA, FS_NORMAL, 12);

$p2 = new PiePlot($data2);
$p2->SetSize($size);
$p2->SetCenter(0.60,0.28);
$p2->value->SetFont(FF_VERDANA, FS_NORMAL, 8);
$p2->title->Set("2009");
$p2->title->SetFont(FF_VERDANA, FS_NORMAL, 12);

$p3 = new PiePlot($data3);
$p3->SetSize($size);
$p3->SetCenter(0.25,0.75);
$p3->value->SetFont(FF_VERDANA, FS_NORMAL, 8);
$p3->title->Set("2010");
$p3->title->SetFont(FF_VERDANA, FS_NORMAL, 12);

$p4 = new PiePlot($data4);
$p4->SetSize($size);
$p4->SetCenter(0.60,0.75);
$p4->value->SetFont(FF_VERDANA, FS_NORMAL, 8);
$p4->title->Set("2011");
$p4->title->SetFont(FF_VERDANA, FS_NORMAL, 12);

$graph->Add($p1);
$graph->Add($p2);
$graph->Add($p3);
$graph->Add($p4);

$graph->Stroke();

?>