<?php
    $cocina = Array("Frigider","Microondas","Waflera");
    $taller = Array("Llave","Martillo","Alicate");
    $cuarto = Array("Escritorio","Cama","Comoda");
    $casa = Array($cocina,$taller,$cuarto);
    $casa1 = ['cocina','taller','cuarto'];   

    if(!array_key_exists('HTTP_X_HASH',$_SERVER)||
    !array_key_exists('HTTP_X_TIMESTAMP',$_SERVER)||
    !array_key_exists('HTTP_X_UID',$_SERVER)){
        die;
    }

    list($hash,$uid,$timestamp)=[
    $_SERVER['HTTP_X_HASH'],
    $_SERVER['HTTP_X_UID'],
    $_SERVER['HTTP_X_TIMESTAMP']
    ];

    $pwd='my password';

    $newHash = sha1($uid.$timestamp.$pwd);

    if($newHash !== $hash){
        echo "Sesion no valida";
        die;
    }
    else{
        if('GET'==strtoupper($_SERVER['REQUEST_METHOD'])){
            $tipoRoom=$_GET['tipo_room'];
            //Obtener los datos de un objeto
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
            else{
                //obtener un objeto segun sus datos
                foreach($casa as $key => $value)
                {
                    foreach($value as $clave => $valor){
                        if($tipoRoom == $valor){
                            $posicion = $key;
                            echo "Pertenece a: ".json_encode($casa1[$posicion]);
                        }
                    }
                }
            }
        }
    
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
        
        if('PUT'==strtoupper($_SERVER['REQUEST_METHOD'])){
            $item1 = $_REQUEST['item1'];
            $json = json_decode(file_get_contents('php://input'),true);
            foreach($casa[$item1] as $clave => $valor){
                foreach($json as $key => $value){
                    if($valor == $key)
                    {
                        $casa[$item1][$clave]=$value;
                        echo json_encode($casa[$item1]);
                    }
                }
                
                next($casa[$item1]);
            }
            
        }
    
        if("DELETE"==strtoupper($_SERVER['REQUEST_METHOD'])){
            $item1 = $_REQUEST['item1'];
            $item2 = $_REQUEST['item2'];
            echo $casa1[$item1].":";
            unset($casa[$item1][$item2]);
            echo json_encode($casa[$item1]);
        }
    }

    
 
?> 