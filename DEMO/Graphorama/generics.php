<?php
function formatfecha($f){
  $fechaformateada = substr($f,6,2)."/".substr($f,4,2)."/".substr($f,0,4);
  return $fechaformateada;
}
function damePlayrate(){
  $rs = array();
  $n=6;
  $random = date("Hi");
  for($i=35;$i>=0;$i--){
    $data = date ("Ymd", mktime (0, 0, 0, date("m"), date("d"), date("Y"))-($i*24*60*60));
    for($k=0;$k<$n;$k++){
      $linea = array("dia"=>$data, "semana"=>$k, "ratio"=>rand(0,$random));
      $rs[] = $linea ;
    }
    if(($i%7)==0){$n--;}
  }
  return $rs;
}
?>