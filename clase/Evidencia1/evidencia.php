<?php error_reporting(0);?>
<?php
//conexión a la base de datos
$servidor = "localhost";
$username = "lfloresr";
$password = "12345678";
$db = "dblumen";
$conexion = new mysqli($servidor,$username,$password,$db);
if($conexion->connect_error){
    die("Conexion fallida".$conexion->connect_error);
}
//consulta a la base de datos
$id = "SELECT id FROM usuarios";
$pwd = "SELECT pasword FROM usuarios";
$time = "SELECT time FROM usuarios";
$rid = $conexion->query($id);
$rpwd = $conexion->query($pwd);
$rtime = $conexion->query($time);
$rowid = mysqli_fetch_assoc($rid);
$rowpwd = mysqli_fetch_assoc($rpwd);
$rowtime = mysqli_fetch_assoc($rtime);
//variables necesarias 
$uid = $rowid['id'] ;
$pwd = $rowpwd['pasword'];
$timestamp = $rowtime['time'];
// cocinas
$cocinas = [
        1=>['tipo' => 'cocina1', 
        'marca' => 'samsung'],
        2=>['tipo' => 'cocina2', 
        'marca' => 'LG'],
];
$refrigeradores = [
    1=>['tipo' => 'frigider1', 
    'marca' => 'carioco'],
    2=>['tipo' => 'frigider2', 
    'marca' => 'LG'],
];
$cocina = array($cocinas, $refrigeradores);
// taller 
$martillo = [
    1=>['tipo' => 'martillo1', 
    'marca' => 'sodimac'],
    2=>['tipo' => 'martillo2', 
    'marca' => 'chancho'],
];
$tornillo = [
    1=>['tipo' => 'tornillo1', 
    'marca' => 'intor'],
    2=>['tipo' => 'tornillo2', 
    'marca' => 'flat'],
];
$taller = array($martillo, $tornillo);
//$taller1 = Array("martillo","tornillo");
// cuarto
$cama = [
    1=>['tipo' => 'cama1', 
    'marca' => 'cisne'],
    2=>['tipo' => 'cama2', 
    'marca' => 'paraiso'],
];
$escritorio = [
    1=>['tipo' => 'escritorio1', 
    'marca' => 'office'],
    2=>['tipo' => 'escritorio2', 
    'marca' => 'room'],
];
$cuarto = array($cama, $escritorio);
// productos
$productos = array($cocina, $taller, $cuarto);
$product = ['cocina','taller','cuarto'];
if(!array_key_exists('HTTP_X_HASH',$_SERVER)){
    echo "El token esta vacio";
    die;
}
list($hash)=[
$_SERVER['HTTP_X_HASH']
];
$tiempo = time();
$newHash = sha1($uid.$timestamp.$pwd);
if($newHash !== $hash){
    echo "Sesion no valida";
    die;
}
if($tiempo-$timestamp>=120){
   // echo "La sesion ha expirado";
    $sql = "DELETE FROM usuarios";
    $conexion->query($sql);
    echo "La sesion ha expirado";
    die;
}
else{
    if('GET'==strtoupper($_SERVER['REQUEST_METHOD'])){
        $tipoRoom=$_GET['idproducto'];
        $idpro2=$_GET['idpro2'];
        echo $product[$tipoRoom]."   ";
        echo json_encode($productos[$tipoRoom][$idpro2]);
    }
    if ('POST'==strtoupper($_SERVER['REQUEST_METHOD'])){
        $idproducto=$_REQUEST['idproducto'];
        $idpro2=$_REQUEST['idpro2'];
        $json = file_get_contents('php://input');
        $productos[$idproducto][$idpro2][]=json_decode($json,true);
        echo json_encode($productos[$idproducto[$idpro2-1]]);
        //print_r($productos[$idproducto[1]]);
    }
    if ('PUT'==strtoupper($_SERVER['REQUEST_METHOD'])){
        $idproducto=$_REQUEST['idproducto'];
        $idpro2=$_REQUEST['idpro2'];
        $idpro3=$_REQUEST['idpro3'];
        $json = file_get_contents('php://input');
        $productos[$idproducto][$idpro2][$idpro3]=json_decode($json,true);
        echo json_encode($productos[$idproducto[$idpro2-1]]);
    }
    if ('DELETE'==strtoupper($_SERVER['REQUEST_METHOD'])){
        $idproducto=$_REQUEST['idproducto'];
        $idpro2=$_REQUEST['idpro2'];
        $idpro3=$_REQUEST['idpro3'];
        unset($productos[$idproducto][$idpro2][$idpro3]);
        echo json_encode($productos[$idproducto[$idpro2-1]]);
    }
}
?>
