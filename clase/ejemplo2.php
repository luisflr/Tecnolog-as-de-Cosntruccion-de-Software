<?php
    $cocina = Array("Frigider","Microondas","waflera");
    $taller = Array("Llave","Martillo","alicate");
    $cuarto = Array("Escritorio","Cama","Comoda");
    $casa = Array($cocina,$taller,$cuarto);
    $casa1 = ['cocina','taller','cuarto'];   

    if('POST'==strtoupper($_SERVER['REQUEST_METHOD'])){
        $json = json_decode(file_get_contents('php://input'),true);
        foreach($json as $key => $value){
            echo "$key :";
            while($posicion = current($casa1)){
                if($posicion == $key){
                    $var = key($casa1);
                    $casa[$var][]=$value;
                    echo json_encode($casa[$var]);
                }
                next($casa1);
            }
            
        }
        
    }
    
    
 
?>