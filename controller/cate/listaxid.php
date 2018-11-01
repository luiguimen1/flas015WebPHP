<?php
sleep(3);
if ($_POST) {
    header('Access-Control-Allow-Origin: *');
    $res = array();

    $json = file_get_contents("php://input");
    $json = json_decode($json);
    if ($json->token == "QWER@QWE#$%@#Q@#EW..?") {
        require '../../BD/ConectarBD.php';
        $sql = "select id cod, nombre nom, detalles det, foto from cate where id =?;";
        $bd = new ConectarBD();
        $conn = $bd->getConn();
        $stmp = $conn->prepare($sql);
        $stmp->bind_param("i",$json->id);
        $res["success"]="no";
        if($stmp->execute()){
            $res["result"]=array();
            $data = $stmp->get_result();
            while($fila = $data->fetch_assoc()){
                $res["success"]="ok";
                $res["result"][] = $fila;
            }
        }
    } else {
        $res["success"] = "error de acceso";
    }
    $res["info"]="Ver0.0.1";
    echo json_encode($res);
} else {
    header("location: ../../");
}