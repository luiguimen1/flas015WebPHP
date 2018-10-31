<?php

if ($_POST) {
    header('Access-Control-Allow-Origin: *');
    $res = array();

    $json = file_get_contents("php://input");
    $json = json_decode($json);
    if ($json->token == "QWER@QWE#$%@#Q@#EW..?") {
        require '../../BD/ConectarBD.php';
        $sql = "insert into cate (nombre, detalles) values(?,?);";
        $bd = new ConectarBD();
        $conn = $bd->getConn();
        $stmp = $conn->prepare($sql);
        $stmp->bind_param("ss",$json->nombre,$json->detalles);
        if($stmp->execute()){
            $res["success"]="ok";
        }else{
            $res["success"]="no";
        }
    } else {
        $res["success"] = "error de acceso";
    }
    $res["info"]="Ver0.0.1";
    echo json_encode($res);
} else {
    header("location: ../../");
}