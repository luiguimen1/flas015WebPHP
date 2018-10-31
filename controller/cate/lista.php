<?php

if ($_POST) {
    header('Access-Control-Allow-Origin: *');
    $res = array();

    $json = file_get_contents("php://input");
    $json = json_decode($json);
    if ($json->token == "QWER@QWE#$%@#Q@#EW..?") {
        require '../../BD/ConectarBD.php';
        $sql = "select id cod, nombre nom, detalles det, foto from cate order by nombre;";
        $bd = new ConectarBD();
        $conn = $bd->getConn();
        $stmp = $conn->prepare($sql);
        if($stmp->execute()){
            $res["success"]="ok";
            $res["result"]=array();
            $data = $stmp->get_result();
            while($fila = $data->fetch_assoc()){
                $res["result"][] = $fila;
            }
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