<?php

$servidor = "localhost";
$username = "lfloresr";
$password = "12345678";
$db = "dblumen";

$conexion = new mysqli($servidor,$username,$password,$db);

if($conexion->connect_error){
    die("Conexion fallida".$conexion->connect_error);
}

$time=time();
$id=" ";
$pwd=" ";

if('POST'==strtoupper($_SERVER['REQUEST_METHOD']));
{
    $json = json_decode(file_get_contents('php://input'),true);
    foreach($json as $key => $value){
        if($key=="id"){
            $id=$value;
        }
        if($key=="pwd"){
            $pwd=$value;
        }
    }
    //echo "pwd: ".$pwd."  ";
    $hash=sha1($id.$time.$pwd);
    
}
    $sql = "INSERT INTO usuarios(id,pasword,time)
                values ('$id','$pwd',$time)";
    if ($conexion->query($sql)==true){
        echo "Te has registrado\n";
        echo "Tu token es: ".$hash;
    }
    else{
        die("Hubo un error".$conexion->connect_error);
    }

?>