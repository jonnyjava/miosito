<?php
$dias = $_POST['dias'];
$operadora = $_POST['operadora'];
$link = mssql_connect("SQLPROMOBRA2.DB.ZED.LOCAL, 1433","alventobra2","bra2alvento");
if (!$link) {die('Something went wrong while connecting to MSSQL  <br/>');}
mssql_select_db('BRA2_PROMOCIONES', $link);
if($operadora==0){
  $query  = "exec proc_matriz_inactividad ".$dias;
}
else{
    $query  = "exec proc_matriz_inactividad_operadora ".$dias .",".$operadora;
}
$rs=mssql_query($query,$link);

$code .= '<table width="100%" id="tablainactividad"><tr><td class="cabeceraTablainactividad">Inactividad</td>';
$code .= '<td class="cabeceraTablainactividad">U</td><td class="cabeceraTablainactividad">L</td><td class="cabeceraTablainactividad">M</td>';
$code .= '<td class="cabeceraTablainactividad">H</td><td class="cabeceraTablainactividad">SH</td></tr>';


while($row=mssql_fetch_array($rs,MSSQL_BOTH)){
  
    if($claseCss == 'contenidoPar')
      $claseCss = 'contenidoImpar';
    else
      $claseCss = 'contenidoPar';

    $code .= '<tr class="'.$claseCss.'">';
    $code .= '<td class="contenidoTablainactividad">'.$row["Inactividad"].'</td>';
    $code .= '<td class="contenidoTablainactividad">'.$row["U"].'</td>';
    $code .= '<td class="contenidoTablainactividad">'.$row["L"].'</td>';
    $code .= '<td class="contenidoTablainactividad">'.$row["M"].'</td>';
    $code .= '<td class="contenidoTablainactividad">'.$row["H"].'</td>';
    $code .= '<td class="contenidoTablainactividad">'.$row["SH"].'</td>';
    $code .= '</tr>';
  }
$code .= '</table>';
echo $code;
mssql_close();
?>

