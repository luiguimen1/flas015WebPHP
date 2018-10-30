<?php
if($_POST){
    header('Access-Control-Allow-Origin: *');
    $res = array();
    sleep(10);
    
    $json = file_get_contents("php://input");
    $json = json_decode($json);
    if($json->token == "QWER@QWE#$%@#Q@#EW..?"){
        require '../../BD/ConectarBD.php';
        $sql = "insert into usuario(nombre,apellido,cedula,correo,direccion,tele,clave) values(?,?,?,?,?,?,sha1(?));";
        $bd = new ConectarBD();
        $conn = $bd->getConn();
        $stmp = $conn->prepare($sql);
        
        $stmp->bind_param("sssssss",$json->nombre,$json->apellido,$json->cedula,$json->correo,$json->dir,$json->tele,$json->clave);
        
        if($stmp->execute()){
            $res["success"]="ok";
        }else{
            $res["success"]="no";
        }
    }else{
        $res["success"]="error de acceso";
    }
    $res["info"]="Ver0.0.1";
    echo json_encode($res);
}else{
    header("location: ../../");
}