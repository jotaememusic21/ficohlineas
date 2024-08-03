<?php
require "../varv.php";
$file_name = __JSONFILE__;
if (file_exists($file_name)) {
    $current_data = file_get_contents($file_name);
    $array_data = json_decode($current_data, true);
}
function getData($array, $id)
{
    
    if (empty($array)) {
       return  $contenedor = "<tr><td colspan='6'>No hay datos</td></tr>";
    }else{
        $contenedor = [];
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i]['Id'] == $id) {
               $contenedor[] = $array[$i];
            }
        }
        return json_encode($contenedor);
    }
    
}
if(isset($_POST["id1"])){
   echo getData($array_data,$_POST["id1"]);
}
