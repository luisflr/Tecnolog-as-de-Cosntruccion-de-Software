<?php
    $cocina = Array("Frigider","Microondas","waflera");
    $taller = Array("Llave","Martillo","alicate");
    $cuarto = Array("Escritorio","Cama","Comoda");
    $casa = Array($cocina,$taller,$cuarto);
    $casa1 = ['cocina','taller','cuarto'];   

    //Obtener los datos de un objeto
    $tipoRoom=$_GET['tipo_room'];
    echo json_encode($tipoRoom);
    echo "<br>";
    while ($nombre_lugar = current($casa1)) {
        if ($nombre_lugar == $tipoRoom) {
            $var = key($casa1);
                echo json_encode($casa[$var],true);
        }
        next($casa1);
        
    }
    //obtener un objeto segun sus datos 
    $producto=$_GET['producto'];
    foreach($casa as $key => $value)
    {
        foreach($value as $clave => $valor){
            if($producto == $valor){
                $posicion = $key;
                
                echo json_encode($casa1[$posicion]);
            }
        }
    }
    
 
?>