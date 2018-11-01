<?php

if ($_POST) {
    header('Access-Control-Allow-Origin: *');
    $res = array();
    $json = file_get_contents("php://input");
    $json = json_decode($json);
    if ($json->token == "QWER@QWE#$%@#Q@#EW..?") {
        require '../../BD/ConectarBD.php';
        $sql = "update cate set nombre = ?, detalles = ? where id = ?;";
        $bd = new ConectarBD();
        $conn = $bd->getConn();
        $stmp = $conn->prepare($sql);
        $stmp->bind_param("ssi", $json->nombre, $json->detalles, $json->id);
        if ($stmp->execute()) {
            $res["success"] = "ok";
        } else {
            $res["success"] = "no";
        }
        $res["json"] = $json;
    } else {
        $res["success"] = "error de acceso";
    }
    $res["info"] = "Ver0.0.1";
    echo json_encode($res);
} else {
    header("location: ../../");
}