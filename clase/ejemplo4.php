<?php
    $cocina = Array("Frigider","Microondas","waflera");
    $taller = Array("Llave","Martillo","alicate");
    $cuarto = Array("Escritorio","Cama","Comoda");
    $casa = Array($cocina,$taller,$cuarto);
    //$casa1 = ['cocina','taller','cuarto'];   

    $item1 = $_REQUEST['item1'];
    if('PUT'==strtoupper($_SERVER['REQUEST_METHOD'])){
        $json = json_decode(file_get_contents('php://input'),true);
        foreach($casa[$item1] as $clave => $valor){
            foreach($json as $key => $value){
                if($valor == $key)
                {
                    $casa[$item1][$clave]=$value;
                    print_r($casa[$item1]);
                }
            }
            
            next($casa[$item1]);
        }
        
    }
 
?> 