<?php
include_once './generic-sql-to-json.php';
function getStandalone($id, $onlyKnoIfExist = false)
{

    //echo
    $req = "SELECT * FROM biere WHERE id_biere=" . $id;
    $stmt = $GLOBALS['pdo']->prepare($req);
    //$res=$stmt->fetchAll();
    if (!$onlyKnoIfExist) {
        executeAndConvertJSON($stmt, 'GET', $id);
    } else {
        $stmt->execute();
        $res = $stmt->fetchAll();
        //print_r($res);

        if (isset($res[0])) {return true;} else {
            return false;
        }

    }
}
$basereq = '';
//recuperation de la methode
$method = $_SERVER['REQUEST_METHOD'];
$id = '';
if (!isset($valuesInPath[1]) || $valuesInPath[1] == "") {
    if ($method == 'DELETE' || $method == 'PUT' || $method == 'PATCH') {
        header('HTTP/1.1 401 Unauthorized');
        exit();
    }
} else { //post interdit la presence d'id
    if ($method == 'POST') {
        header('HTTP/1.1 401 Unauthorized');
        exit();
    }

    $id = $valuesInPath[1];
    $isExist = getStandalone($id, true);
    if (!$isExist) {
        header('HTTP/1.1 404 Not Found');
        echo '{}';
        exit();
    }
}

//recupareation du content
if ($method == 'PUT' || $method == 'PATCH' || $method == 'POST') {
    try {
        $postin = json_decode(file_get_contents("php://input"));
    } catch (Exception $ex) {
        header('HTTP/1.1 500 Internal Server Error');
        echo '{}';
        exit();
    }
}
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST': //echo
        $basereq .= "INSERT INTO `biere`(`nom_biere`, `photo`, `degres_d_alcool`, `quantite`, `description`, `en_stock`, `id_type_de_biere`, `id_origine`) VALUES ('" . str_replace("'", '\\\'', $postin->nom_biere) . "','" . $postin->photo . "','" . $postin->degres_d_alcool . "','" . $postin->quantite . "','" . str_replace("'", '\\\'', $postin->description) . "','" . $postin->en_stock . "','" . $postin->id_type_de_biere . "','" . $postin->id_origine . "') ";
        break;
    case 'PUT': //echo
        $basereq .= "UPDATE  `biere` SET `nom_biere`='" . str_replace("'", '\\\'', $postin->nom_biere) . "',`photo`='" . $postin->photo . "',`degres_d_alcool`=" . $postin->degres_d_alcool . ",`quantite`=" . $postin->quantite . ",`description`='" . str_replace("'", '\\\'', $postin->description) . "',`en_stock`=" . $postin->en_stock . ",`id_type_de_biere`=" . $postin->id_type_de_biere . ",`id_origine`=" . $postin->id_origine . " WHERE id_biere=" . $id;
        break;
    case 'PATCH':
        $basereq .= "UPDATE `biere` SET ";
        $o2arr = (Array) $postin;
        //print_r($o2arr);
        foreach ($o2arr as $key => $value) {
            # code...
            $basereq .= $key . "='" . $value . "' ,";
        }
        $basereq = substr($basereq, 0, strlen($basereq) - 2);
        echo $basereq .= " WHERE id_biere=" . $id;
        break;

    case 'DELETE': //echo
        $basereq .= "DELETE FROM biere WHERE id_biere=" . $id;
        break;
    case 'GET':$basereq .= "SELECT * FROM biere ";
        if ($id != '') {$basereq .= "WHERE id_biere=" . $id;}
        //echo $basereq;
        break;
}
$deleteRes = null;
//recuperation pour renvoie de l'objet supprimé
if ($method == 'DELETE') {
    $req = "SELECT * FROM biere WHERE id_biere=" . $id;
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $deleteRes = $stmt->fetchAll();
    // $outputObject=$res[0];
}

$stmt = $pdo->prepare($basereq);

$valueReturned = executeAndConvertJSON($stmt, $method, $id);

if ($method == 'POST' || $method == 'PUT' || $method == 'PATCH') {
    getStandalone($valueReturned);
    //print_r('get last id');
    if ($method == 'POST') {
        header('HTTP/1.1 201 Created');
        exit();
    }
} else if ($method == 'DELETE') {
    autoConvertExecutedStatementJsonOutput($deleteRes, false);
}
header('HTTP/1.1 200 Ok');
