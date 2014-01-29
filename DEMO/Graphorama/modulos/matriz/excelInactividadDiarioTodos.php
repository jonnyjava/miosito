<?php
include('Classes/PHPExcel.php');
include("mail.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
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

$i = 1;
$totalU = 0;
$totalL = 0;
$totalM = 0;
$totalH = 0;
$totalSH = 0;
$fecha=date("d_m_Y",time());

$link = mssql_connect("SQLPROMOBRA2.DB.ZED.LOCAL, 1433","alventobra2","bra2alvento");
if (!$link) {die('Something went wrong while connecting to MSSQL  <br/>');}
mssql_select_db('BRA2_PROMOCIONES', $link);
$query  = "exec proc_matriz_inactividad 1";
$rs=mssql_query($query,$link);
$rs1=mssql_query($query,$link);
//echo mssql_get_last_message() . "\n";
//$objPHPExcel = new PHPExcel();
$objPHPExcel = PHPExcel_IOFactory::load("ficheros/MatrizInactividad.xls");
$objWorksheet1 = $objPHPExcel->createSheet();
$objWorksheet1->setTitle($fecha);

//$objWorksheet1 = $objPHPExcel->setActiveSheetIndex(0);
$objWorksheet1
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
//  echo "por aqui pasamos";
//  echo mssql_num_rows($rs1);
  while($ts=mssql_fetch_array($rs1,MSSQL_BOTH)){
    $totalU  += $ts['U'];
    $totalL  += $ts['L'];
    $totalM  += $ts['M'];
    $totalH  += $ts['H'];
    $totalSH += $ts['SH'];
    $i++;
  }
  $i = 2;
 while($hs=mssql_fetch_array($rs,MSSQL_BOTH)){
  $objWorksheet1
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
  //si el valor es mas que la mitad del total coloreamos la celda en naranja
  //y si no en blanco
if($hs['U']>=($totalU*0.5)){$objWorksheet1->getStyle('B'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFA500');}
else if($hs['U']>=($totalU*0.25)){$objWorksheet1->getStyle('B'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');}
else {$objWorksheet1->getStyle('B'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFFFF');}

if($hs['L']>=($totalL*0.5)){$objWorksheet1->getStyle('C'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFA500');}
else if($hs['L']>=($totalL*0.25)){$objWorksheet1->getStyle('C'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');}
else {$objWorksheet1->getStyle('C'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFFFF');}

if($hs['M']>=($totalM*0.5)){$objWorksheet1->getStyle('D'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFA500');}
else if($hs['M']>=($totalM*0.25)){$objWorksheet1->getStyle('D'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');}
else {$objWorksheet1->getStyle('D'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFFFF');}

if($hs['H']>=($totalH*0.5)){$objWorksheet1->getStyle('E'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFA500');}
else if($hs['H']>=($totalH*0.25)){$objWorksheet1->getStyle('E'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');}
else {$objWorksheet1->getStyle('E'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFFFF');}

if($hs['SH']>=($totalSH*0.5)){$objWorksheet1->getStyle('F'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFA500');}
else if($hs['SH']>=($totalSH*0.25)){$objWorksheet1->getStyle('F'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');}
else {$objWorksheet1->getStyle('F'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFFFF');}
    $i++;
 }
 $objWorksheet1
->setCellValue('A'.$i, 'TOTAL')
->setCellValue('B'.$i, $totalU )
->setCellValue('C'.$i, $totalL )
->setCellValue('D'.$i, $totalM )
->setCellValue('E'.$i, $totalH )
->setCellValue('F'.$i, $totalSH )
->setCellValue('G'.$i, '=(B'.$i.'+C'.$i.'+D'.$i.'+E'.$i.'+F'.$i.')');

$objWorksheet1->getDefaultStyle()->getFont()->setName('Arial');
$objWorksheet1->getDefaultStyle()->getFont()->setSize(9);

//linea titulo
$objWorksheet1->getStyle('A1:F1')->applyFromArray($styleTituloArray);
$objWorksheet1->getStyle('A1:F1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF4282B4');
//columna 1
$objWorksheet1->getStyle('A2:A'.($i-1))->applyFromArray($styleTituloArray);
$objWorksheet1->getStyle('A2:A'.($i-1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF4282B4');
//columna totales
$objWorksheet1->getStyle('G1:G'.($i-1))->applyFromArray($styleTotalesArray);
$objWorksheet1->getStyle('G1:G'.($i-1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000');
$objWorksheet1->getStyle('G1:G'.($i-1))->getFont()->getColor()->setARGB('FFFFFFFF');
//linea totales
$objWorksheet1->getStyle('A'.($i).':G'.($i))->applyFromArray($styleTotalesArray);
$objWorksheet1->getStyle('A'.($i).':G'.($i))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000');
$objWorksheet1->getStyle('A'.($i).':G'.($i))->getFont()->getColor()->setARGB('FFFFFFFF');
//titulo porcentages
$objWorksheet1->getStyle('J1:O1')->applyFromArray($stylePorcentageArray);
$objWorksheet1->getStyle('J2:J'.($i-1))->applyFromArray($stylePorcentageArray);
$objWorksheet1->getStyle('J1:O1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF00FF00');
$objWorksheet1->getStyle('J2:J'.($i-1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF00FF00');
//resto
$objWorksheet1->getStyle('B2:F'.($i-1))->applyFromArray($styleGeneralArray);
$objWorksheet1->getStyle('K2:O'.($i-1))->applyFromArray($styleGeneralArray);
$objWorksheet1->getStyle('K2:O'.($i-1))->getNumberFormat()->setFormatCode('#,##0.00');
$objWorksheet1->getStyle('K2:O'.($i-1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFFFF');
//dimesiones
$objWorksheet1->getColumnDimension('A')->setWidth(16);
$objWorksheet1->getColumnDimension('J')->setWidth(16);
$objWorksheet1->getColumnDimension('B:F')->setWidth(10);
$objWorksheet1->getColumnDimension('K:O')->setWidth(10);
$objWorksheet1->getRowDimension('1:'.($i-1))->setRowHeight(15);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('ficheros/MatrizInactividad.xls');
//echo "fichero generado, enviamos mail?";
/*
$textomail = "En adjunto se envian las matrices de inactividad de la promo BRA2 con los datos del dia anterior. \n ";
$textomail .= "Para cada tipo de usuario, su porcentaje respecto del total de usuarios del mismo tipo (U, L, M, H, SH) se representa con la siguiente leyenda:> 50%: Naranja; > 25%: Amarillo. \n Un saludo";
$to = array("acarrozzo@zed.com");
*/
/*$to = array("vruano@zed.com","MZumarraga@zed.com");
$cc = array("iaguero@zed.com","cgoetz@zed.com","MSRobles@zed.com","jdaly@zed.com");*/
//envia_mail("Matrices Inactividad BRA2 $fecha", $to,$cc, $textomail);
//echo "mail enviada";
exit;
?>