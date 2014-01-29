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
require_once ('../../jpgraph/jpgraph_gantt.php');

// Standard calls to create a new graph
$graph = new GanttGraph(960, 600, "auto");
$graph->SetShadow();
$graph->SetBox();
$graph->SetMarginColor($margen);
$graph->SetShadow();
$graph->img->SetMargin(30, 30, 30, 30);
$graph->title->Set("Gantt graph");
$graph->title->SetColor($titulo);
$graph->subtitle->Set("(Revision: 2011-02-01)");
$graph->title->SetFont(FF_ARIAL,FS_BOLD,12);
$graph->ShowHeaders(GANTT_HYEAR | GANTT_HMONTH | GANTT_HDAY | GANTT_HWEEK);
$graph->scale->week->SetStyle(WEEKSTYLE_FIRSTDAY);
$graph->scale->week->SetFont(FF_FONT0);
$graph->scale->year->SetFont(FF_ARIAL,FS_BOLD,12);

$data = array(
        array(0," Group 1", "2011-01-19","2011-01-27",FF_ARIAL,FS_BOLD,8),
        array(1,"  Label 2", "2011-01-8","2011-01-14"),
        array(2,"  Label 3", "2011-01-01","2011-01-08"),
        array(4," Group 2", "2011-01-07","2011-01-19",FF_ARIAL,FS_BOLD,8),
        array(5,"  Label 4", "2011-01-8","2011-01-19"),
        array(6,"  Label 5", "2011-01-01","2011-01-8"),
        array(7," Group 3", "2011-01-01","2011-01-19",FF_ARIAL,FS_BOLD,8),
        array(8,"  Label 6", "2011-01-08","2011-01-29"),
        array(9,"  Label 7", "2011-01-01","2011-01-31")
        );

for($i=0; $i<count($data); ++$i) {
  
    $xx = rand(0,100);
    /*
  $bar = new GanttBar($data[$i][0],$data[$i][1],$data[$i][2],$data[$i][3],"[".$xx."%]",$xx);
   */
   $bar = new GanttBar($data[$i][0],$data[$i][1],$data[$i][2],$data[$i][3],"[".$xx."%]",0.5);
  if( count($data[$i])>4 ){
    $bar->title->SetFont($data[$i][4],$data[$i][5],$data[$i][6]);
  }
    $bar->SetShadow(true,"darkgray");
    $bar->SetPattern(BAND_SOLID,$relleno_punto);
    $bar->SetFillColor("black");
    $bar->progress->Set(($xx/100));
    $bar->rightMark->SetType(MARK_FILLEDCIRCLE);
    $bar->rightMark->SetFillColor("blue");
    $bar->rightMark->SetColor("blue");
    $bar->rightMark->SetWidth(12);
    $bar->rightMark->title->Set("".$i+1);
    $bar->rightMark->title->SetColor("white");
    $bar->rightMark->title->SetFont(FF_ARIAL,FS_BOLD,11);
    $bar->rightMark->Show();
    $graph->Add($bar);
}

// Create a milestone mark
$ms1 = new MileStone(10,"Scrum meetings","2011-01-01","Startup meeting");
$ms2 = new MileStone(10,"","2011-01-10","Sprint meeting");
$ms3 = new MileStone(10,"","2011-01-20","Sprint meeting");
$ms4 = new MileStone(10,"","2011-01-31","Retrospective");
$ms1->title->SetFont(FF_ARIAL,FS_NORMAL,9);
$ms2->title->SetFont(FF_ARIAL,FS_NORMAL,7);
$ms3->title->SetFont(FF_ARIAL,FS_NORMAL,7);
$ms4->title->SetFont(FF_ARIAL,FS_NORMAL,7);
$graph->Add($ms1);
$graph->Add($ms2);
$graph->Add($ms3);
$graph->Add($ms4);
$v0 = new GanttVLine("2011-01-01 13:00","Start project","darkblue");
$vl = new GanttVLine("2011-01-10 13:00","End first sprint","blue");
$v2 = new GanttVLine("2011-01-20 13:00","End second sprint","blue");
$v3 = new GanttVLine("2011-01-31 13:00","End project","darkblue");
$v0->SetDayOffset(0);
$vl->SetDayOffset(0);
$v2->SetDayOffset(0);
$v3->SetDayOffset(0);
$graph->Add($v0);
$graph->Add($vl); 
$graph->Add($v2);
$graph->Add($v3);

// Output the graph
$graph->Stroke();

// EOF
?>