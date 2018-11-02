<?php

if ($_POST) {
    header('Access-Control-Allow-Origin: *');
    $res = array();
    $json = file_get_contents("php://input");
    $json = json_decode(json_encode($_POST));
    if ($json->token == "QWER@QWE#$%@#Q@#EW..?") {
        require '../BD/ConectarBD.php';
        $json->nombre = sha1(time()) . ".jpg";
        if (move_uploaded_file($_FILES["ionicfile"]["tmp_name"], "../img/" . $json->type . "/" . $json->nombre)) {
            $sql = "update " . $json->type . " set foto = ? where id = ?;";
            $bd = new ConectarBD();
            $conn = $bd->getConn();
            $stmp = $conn->prepare($sql);
            $stmp->bind_param("si", $json->nombre, $json->id);
            if ($stmp->execute()) {
                $res["success"] = "ok";
                $res["foto"] = $json->nombre;
                if($json->oldfoto != "sinfoto".$json->type .".svg")
                unlink("../img/" . $json->type . "/" . $json->oldfoto);
            } else {
                unlink("../img/" . $json->type . "/" . $json->nombre);
                $res["success"] = "no";
            }
        } else {
            $res["success"] = "1";
        }
    } else {
        $res["success"] = "error de acceso";
        
    }
    $res["info"] = "Ver0.0.1";
    echo json_encode($res);
} else {
    header("location: ../../");
}