<?php
include ("../../generics.php");
$rs = damePlayrate();
$n=6;
$random = date("Hi");
$code = "";
$dia = 0;
for($j=0;$j<count($rs);$j++){
  $r = $rs[$j]; 
  $percentuale = round((($r["ratio"]*100)/$random),2);
  if ($dia ==0){
    $code .= '<tr>';
    $code .= '<td>'.formatfecha($r["dia"]).'</td>';
    $code .= '<td align="center" r="'.$random.'" p="'.$percentuale.'">'.$percentuale.'%</td>';
    $dia =$r["dia"];
  }
  elseif ($dia !=$r["dia"]){
    $code .= '</tr><tr>';
    $code .= '<td>'.formatfecha($r["dia"]).'</td>';
    $code .= '<td align="center" r="'.$random.'" p="'.$percentuale.'">'.$percentuale.'%</td>';
    $dia =$r["dia"];
  }
  else{
    $code .= '<td align="center" r="'.$random.'" p="'.$percentuale.'">'.$percentuale.'%</td>';
  }
}
$code .= '</tr></table>';
$cadenasemana= "<tr><td class='playratecabecera' align='center'><b>Tot: ".$random."</b></td>";
for($i=0;$i<$n;$i++){
  $cadenasemana.= "<td class='playratecabecera' align='center' style='width:100px;'>Semana ".$i."</td>";
}
$cadenasemana.= "</tr>";
$code = '<table border="0" class="playrate" cellspacing="0" cellpadding="0" id="playrate">'.$cadenasemana.$code;
echo $code;
?>