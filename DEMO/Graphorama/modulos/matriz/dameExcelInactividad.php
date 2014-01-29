<?php
/*
$modulo	= "tracking";
$bloque	= "tracking";
*/

require('Classes/PHPExcel.php');
error_reporting(E_ALL);
ini_set("display_errors", 1);

$styleTituloArray = array(
  'font' => array('bold' => true,),
  'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
  'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'argb' => '00000000',),),
  'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'argb' => 'FFFF00FF',),
);

$styleTotalesArray = array(
  'font' => array('bold' => true,),
  'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
  'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'argb' => '00000000',),),
  'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'argb' => 'FFFF0000',),
);

$styleGeneralArray = array(
  'font' => array('bold' => false,),
  'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
  'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'argb' => '00000000',),),
  'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'argb' => 'FFFF0000',),
);
$stylePorcentageArray = array(
  'font' => array('bold' => true,),
  'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
  'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'argb' => '00000000',),),
  'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'argb' => 'FF00FF00',),
);

$dias     = $_GET['dias'];
$operadora = $_GET['operadora'];
$link = mssql_connect("SQLPROMOBRA2.DB.ZED.LOCAL, 1433","alventobra2","bra2alvento");
if (!$link) {die('Something went wrong while connecting to MSSQL  <br/>');}
mssql_select_db('BRA2_PROMOCIONES', $link);
if($operadora==0){
  $query  = "exec proc_matriz_inactividad ".$dias;
}
else{
    $query  = "exec proc_matriz_inactividad_operadora ".$dias .",".$operadora;
}


date_default_timezone_set('Europe/London');
$fecha=date("d_m_Y",strtotime("yesterday"));

$rs = mssql_query($query,$link);
$rs1 =mssql_query($query,$link);
// Create new PHPExcel object

$objPHPExcel = new PHPExcel();
// Set properties


$objPHPExcel->getProperties()
    ->setCreator("ZED")
    ->setLastModifiedBy("ZED")
    ->setTitle('MatrizInactividad')
    ->setSubject('MatrizInactividad');


// Add some data
$i = 1;
$totalU = 0;
$totalL = 0;
$totalM = 0;
$totalH = 0;
$totalSH = 0;

$objPHPExcel->setActiveSheetIndex(0)
  ->setCellValue('A'.$i, 'INACTIVIDAD')
  ->setCellValue('B'.$i, 'U')
  ->setCellValue('C'.$i, 'L')
  ->setCellValue('D'.$i, 'M')
  ->setCellValue('E'.$i, 'H')
  ->setCellValue('F'.$i, 'SH')
  ->setCellValue('G'.$i, 'Usuarios')

  ->setCellValue('J'.$i, 'INACTIVIDAD')
  ->setCellValue('K'.$i, 'U')
  ->setCellValue('L'.$i, 'L')
  ->setCellValue('M'.$i, 'M')
  ->setCellValue('N'.$i, 'H')
  ->setCellValue('O'.$i, 'SH');
  $i++;

  //while($ts = $rs1->fetchRow())
  while($ts = mssql_fetch_array($rs1,MSSQL_BOTH))
  {
    $totalU  += $ts['U'];
    $totalL  += $ts['L'];
    $totalM  += $ts['M'];
    $totalH  += $ts['H'];
    $totalSH += $ts['SH'];
    $i++;
  }
  $i = 2;
 while($hs = mssql_fetch_array($rs,MSSQL_BOTH))
{
  $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A'.$i, $hs['Inactividad'])
    ->setCellValue('B'.$i, $hs['U'])
    ->setCellValue('C'.$i, $hs['L'])
    ->setCellValue('D'.$i, $hs['M'])
    ->setCellValue('E'.$i, $hs['H'])
    ->setCellValue('F'.$i, $hs['SH'])
    ->setCellValue('G'.$i, '=(B'.$i.'+C'.$i.'+D'.$i.'+E'.$i.'+F'.$i.')')
    ->setCellValue('J'.$i, $hs['Inactividad'])
    ->setCellValue('K'.$i, ($hs['U']*100/$totalU))
    ->setCellValue('L'.$i, ($hs['L']*100/$totalL))
    ->setCellValue('M'.$i, ($hs['M']*100/$totalM))
    ->setCellValue('N'.$i, ($hs['H']*100/$totalH))
    ->setCellValue('O'.$i, ($hs['SH']*100/$totalSH));
  //si el valor es mas que un tercio del total coloreamos la celda en amarillo
    if($hs['U']>=($totalU*0.25)){$objPHPExcel->getActiveSheet()->getStyle('B'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');}
    if($hs['L']>=($totalL*0.25)){$objPHPExcel->getActiveSheet()->getStyle('C'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');}
    if($hs['M']>=($totalM*0.25)){$objPHPExcel->getActiveSheet()->getStyle('D'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');}
    if($hs['H']>=($totalH*0.25)){$objPHPExcel->getActiveSheet()->getStyle('E'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');}
    if($hs['SH']>=($totalSH*0.25)){$objPHPExcel->getActiveSheet()->getStyle('F'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');}
//si el valor es mas que la mitad del total coloreamos la celda en naranja
  if($hs['U']>=($totalU*0.5)){$objPHPExcel->getActiveSheet()->getStyle('B'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFA500');}
    if($hs['L']>=($totalL*0.5)){$objPHPExcel->getActiveSheet()->getStyle('C'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFA500');}
    if($hs['M']>=($totalM*0.5)){$objPHPExcel->getActiveSheet()->getStyle('D'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFA500');}
    if($hs['H']>=($totalH*0.5)){$objPHPExcel->getActiveSheet()->getStyle('E'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFA500');}
    if($hs['SH']>=($totalSH*0.5)){$objPHPExcel->getActiveSheet()->getStyle('F'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFA500');}
    $i++;
 }
 $objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A'.$i, 'TOTAL')
->setCellValue('B'.$i, $totalU )
->setCellValue('C'.$i, $totalL )
->setCellValue('D'.$i, $totalM )
->setCellValue('E'.$i, $totalH )
->setCellValue('F'.$i, $totalSH )
->setCellValue('G'.$i, '=(B'.$i.'+C'.$i.'+D'.$i.'+E'.$i.'+F'.$i.')');

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle($fecha);

$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(9);

//linea titulo
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleTituloArray);
$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF4282B4');
//columna 1

$objPHPExcel->getActiveSheet()->getStyle('A2:A'.($i-1))->applyFromArray($styleTituloArray);
$objPHPExcel->getActiveSheet()->getStyle('A2:A'.($i-1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF4282B4');
//columna totales
$objPHPExcel->getActiveSheet()->getStyle('G1:G'.($i-1))->applyFromArray($styleTotalesArray);
$objPHPExcel->getActiveSheet()->getStyle('G1:G'.($i-1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000');
$objPHPExcel->getActiveSheet()->getStyle('G1:G'.($i-1))->getFont()->getColor()->setARGB('FFFFFFFF');
//linea totales
$objPHPExcel->getActiveSheet()->getStyle('A'.($i).':G'.($i))->applyFromArray($styleTotalesArray);
$objPHPExcel->getActiveSheet()->getStyle('A'.($i).':G'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000');
$objPHPExcel->getActiveSheet()->getStyle('A'.($i).':G'.($i))->getFont()->getColor()->setARGB('FFFFFFFF');

//titulo porcentages
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getStyle('J1:O1')->applyFromArray($stylePorcentageArray);
$objPHPExcel->getActiveSheet()->getStyle('J2:J'.($i-1))->applyFromArray($stylePorcentageArray);
$objPHPExcel->getActiveSheet()->getStyle('J1:O1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF00FF00');
$objPHPExcel->getActiveSheet()->getStyle('J2:J'.($i-1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF00FF00');
//resto
$objPHPExcel->getActiveSheet()->getStyle('B2:F'.($i-1))->applyFromArray($styleGeneralArray);
$objPHPExcel->getActiveSheet()->getStyle('K2:O'.($i-1))->applyFromArray($styleGeneralArray);
$objPHPExcel->getActiveSheet()->getStyle('K2:O'.($i-1))->getNumberFormat()->setFormatCode('#,##0.00');

//dimesiones
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);

$objPHPExcel->getActiveSheet()->getRowDimension('1:'.($i-1))->setRowHeight(15);

// Redirect output to a clientes web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="MatrizInactividad.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>