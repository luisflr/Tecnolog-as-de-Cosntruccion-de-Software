<?php
    $cocina = Array("Frigider","Microondas","waflera");
    $taller = Array("Llave","Martillo","alicate");
    $cuarto = Array("Escritorio","Cama","Comoda");
    $casa = Array($cocina,$taller,$cuarto);
    //$casa1 = ['cocina','taller','cuarto'];   

    $item1 = $_REQUEST['item1'];
    $item2 = $_REQUEST['item2'];
    if("DELETE"==strtoupper($_SERVER['REQUEST_METHOD'])){
        unset($casa[$item1][$item2]);
        echo json_encode($casa[$item1]);
    }
 
?>  