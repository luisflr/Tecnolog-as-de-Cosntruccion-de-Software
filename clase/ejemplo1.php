<?php
    $cocina = Array("Frigider","Microondas","Waflera");
    $taller = Array("Llave","Martillo","Alicate");
    $cuarto = Array("Escritorio","Cama","Comoda");
    $casa = Array($cocina,$taller,$cuarto);
    $casa1 = ['cocina','taller','cuarto'];   

    //Obtener los datos de un objeto
    $tipoRoom=$_GET['tipo_room'];
    if($tipoRoom=='cocina'||$tipoRoom=='taller'||$tipoRoom=='cuarto'){
        echo json_encode($tipoRoom);
        
        while ($nombre_lugar = current($casa1)) {
            if ($nombre_lugar == $tipoRoom) {
                $var = key($casa1);
                    echo json_encode($casa[$var],true);
            }
            next($casa1);
            
        }
    }
    //obtener un objeto segun sus datos
    foreach($casa as $key => $value)
    {
        foreach($value as $clave => $valor){
            if($tipoRoom == $valor){
                $posicion = $key;
                echo "Pertenece a: ".json_encode($casa1[$posicion]);
                //echo ;
            }
        }
    }
    
 
?>
